$(document).ready(function (){
    var url = window.location.href;
    var parts = url.split("/");
    var endpoint = parts[parts.length - 1];
    var timeout = null;
    $("#search").on('input',function (){
        clearTimeout(timeout);
        timeout = setTimeout(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var keyword = $("#search").val();

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
                        $.each(response.data, function(index, item) {
                            var createdAt = moment(item.created_at).format('YYYY-MM-DD HH:mm:ss');
                            var updatedAt = moment(item.updated_at).format('YYYY-MM-DD HH:mm:ss');
                            var row = '<tr id="list-cate">' +
                                '<td>' + item.name + '</td>' +
                                '<td>' + item.guard_name + '</td>' +
                                '<td>' + createdAt + '</td>' +
                                '<td>' + updatedAt + '</td>' +
                                '<td class="text-right d-flex justify-content-center" style="gap: 5px">' +
                                '<a href="/permissions/' + item.id + '/edit">' +
                                '<button type="button" class="btn btn-outline-warning">' +
                                '<i class="fa-solid fa-pen-to-square" style="color: #f7d708; font-size:15px"></i>' +
                                '</button>' +
                                '</a>' +
                                '</td>' +
                                '</tr>';
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
