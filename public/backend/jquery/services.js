$(document).ready(function (){
    var url = window.location.href;
    var parts = url.split("/");
    var endpoint = parts[parts.length - 1];
    var timeout = null;
    $("#search").on('input',function (){
        clearTimeout(timeout);
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        timeout = setTimeout(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            var keyword = $("#search").val();
            var statusString = '';
            $.ajax({
                url: '/search/'+`${endpoint}`,
                method: 'POST',
                data: {
                    'keyword': keyword
                },
                success: function (response) {
                    $('#pagination').html('')
                    if(response.status){
                        $('#errors').html('');
                        console.log(response.data)
                        $('#data').empty();
                        // Thêm dữ liệu mới từ response vào phần tử có id là data
                        $.each(response.data, function(index, items) {
                            var image = '/storage/images/'+items.image;
                            if(items.status){
                                statusString = '<span style="color: green">Đang hoạt động</span>'
                            }else{
                                statusString = '<span style="color: red">Ngừng hoạt động</span>'
                            }
                            var row = `<tr>
                                    <td>${items.name}</td>
                                    <td><img src="${image}" alt="" width="150px"></td>
                                    <td>
                                     ${statusString}
                                    </td>
                                    <td class="text-right">
                                        <div class="d-flex justify-content-center " style="gap: 10px">
                                            <a href="/services/${items.id}/edit">
                                                <button type="button" class="btn btn-outline-warning">
                                                    <i class="fa-solid fa-pen-to-square" style="color: #f7d708; font-size:15px"></i>
                                                </button>
                                            </a>
                                            <form action="/services/${items.id}" method="post" onclick="return confirm('Bạn có muốn khóa trường này ?')">
                                                <input type="hidden" name="_token" value="${csrfToken}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-outline-danger">
                                                    <i class="fa-solid fa-trash-can" style="color: #ff0000; font-size:15px"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>`
                            $('#data').append(row);
                        });
                    }else{
                        $('#errors').html(response.data);
                    }
                },
                error: function (xhr, status, error) {
                    // Xử lý lỗi nếu có
                }
            });
        }, 500); // 1 giây
    })


});
