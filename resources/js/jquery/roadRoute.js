import axios from "axios";

$(document).ready(function (){
    var url = window.location.href;
    var parts = url.split("/");
    var endpoint = parts[parts.length - 1];
    var timeout = null;
    var csrfToken = $('meta[name="csrf-token"]').attr('content');


    Echo.channel('typeCars')
        .listen('TypeCars.CreateEvent',(e)=>{
            let statusString = '';
            if(e.type_car.status){
                statusString = '<span style="color: green">Đang hoạt động</span>'
            }else{
                statusString = '<span style="color: red">Ngừng hoạt động</span>'
            }
            let row = `<tr id="row_${e.type_car.id}">
                                    <td>${e.type_car.code}</td>
                                    <td>${e.type_car.name}</td>
                                    <td>${statusString}</td>
                                    <td class="text-right">
                                        <div class="d-flex justify-content-center " style="gap: 10px">
                                                <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#exampleModalUpdate" data-bs-id="${e.type_car.id}">
                                                    <i class="fa-solid fa-pen-to-square" style="color: #f7d708; font-size:15px"></i>
                                                </button>
                                        </div>

                                    </td>
                                </tr>`
            $("#data").prepend(row);
        })
        .listen('TypeCars.UpdateEvent',(e)=>{
            let statusString = '';
            if(e.type_car.status){
                statusString = '<span style="color: green">Đang hoạt động</span>'
            }else{
                statusString = '<span style="color: red">Ngừng hoạt động</span>'
            }
            let row = `
                                    <td>${e.type_car.code}</td>
                                    <td>${e.type_car.name}</td>
                                    <td>${statusString}</td>
                                    <td class="text-right">
                                        <div class="d-flex justify-content-center " style="gap: 10px">
                                                <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#exampleModalUpdate" data-bs-id="${e.type_car.id}">
                                                    <i class="fa-solid fa-pen-to-square" style="color: #f7d708; font-size:15px"></i>
                                                </button>
                                        </div>

                                    </td>
                               `
            $(`#row_${e.type_car.id}`).html(row);
        })

    function reset(){
        $('#name').val('');
        $('#active').prop('checked', false);
        $("#error_name").html('');
    }
    function resetUpdate(){
        $('#id').val('');
        $('#nameUp').val('');
        $('#activeUp').prop('checked', false);
        $("#error_name").html('');
    }
    /// create
    $("#create").on('click',function (){
        var name = $('#name').val()
        var active = $('#active').is(':checked');
        active = active ? 1 : 0;
        let legit = true;
        if (name.trim() < 3 ) {
            $("#error_name").html('Tên dịch vụ ít nhất có 3 kí tự');
            legit = false;
        }else {
            $("#error_name").html('');
            legit = true;
        }
        let data = {
            name: name,
            active: active
        }
        if(legit){
            axios.post(`/api/${endpoint}`, data,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(function (response) {
                    console.log(response.data.status)
                    if(response.data.status){
                        $('#exampleModalCreate .close').click();
                        reset();
                    }else{
                        console.log(response.data);
                        let errors  = response.data;
                        $("#error_images").html(errors.data.images);
                        $("#error_name").html(errors.data.name);
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        }
    })
    /// detail
    $('#exampleModalUpdate').on('show.bs.modal', function (e) {
        let button = e.relatedTarget
        let id = button.getAttribute('data-bs-id')
        if(id){
            axios.get(`/api/${endpoint}/${id}`)
                .then(function (response) {
                    $('#id').val(response.data.id);
                    $('#nameUp').val(response.data.name);
                    if (response.data.status) {
                        $('#activeUp').prop('checked', true);
                    } else {
                        $('#activeUp').prop('checked', false);
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        }
    })
    // update
    $("#update").on('click',function (){
        let id = $('#id').val();
        let name = $('#nameUp').val()
        let active = $('#activeUp').is(':checked');
        active = active ? 1 : 0;
        let legit = true;
        if (name.trim() < 3 ) {
            $("#error_name").html('Tên dịch vụ ít nhất có 3 kí tự');
            legit = false;
        }else {
            $("#error_name").html('');
            legit = true;
        }
        let data = {
            name: name,
            active: active,
        }
        if(legit){
            axios.post(`/api/${endpoint}/${id}`, data,{
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then(function (response) {
                    console.log(response.data.status)
                    if(response.data.status){
                        $('#exampleModalUpdate .close').click();
                        resetUpdate();
                    }else{
                        console.log(response.data);
                        let errors  = response.data;
                        $("#error_images").html(errors.data.images);
                        $("#error_name").html(errors.data.name);
                    }
                })
                .catch(function (error) {
                    console.error(error);
                });
        }
    })


    $("#CityStarting").on('change', function (){
        var id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/search/'+`${endpoint}`,
            method: 'POST',
            data: {
                'id': id
            },
            success: function (response) {
                if(response.status){
                    console.log(response.data);
                    $('#Starting').empty();
                    $.each(response.data, function(index, item) {
                        var  html = `
                       <option value="${item.id}">${item.name}</option>
                        `
                        $('#Starting').append(html);
                    })
                }
            },
            error: function (xhr, status, error) {
                // Xử lý lỗi nếu có
            }
        });

    });


    $("#CityDestination").on('change', function (){
        var id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/search/'+`${endpoint}`,
            method: 'POST',
            data: {
                'id': id
            },
            success: function (response) {
                if(response.status){
                    console.log(response.data);
                    $('#Destination').empty();
                    $.each(response.data, function(index, item) {
                        var  html = `
                       <option value="${item.id}">${item.name}</option>
                        `
                        $('#Destination').append(html);
                    })
                }
            },
            error: function (xhr, status, error) {
                // Xử lý lỗi nếu có
            }
        });

    });


      $("#search").on('input',function (){
        clearTimeout(timeout);
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
                                    <td>${items.code}</td>
                                    <td>${items.starting_name}</td>
                                    <td>${items.destination_name}</td>
                                    <td>${items.car_name}</td>
                                    <td>${items.kilometer}</td>
                                    <td>
                                     ${statusString}
                                    </td>
                                    <td class="text-right">
                                        <div class="d-flex justify-content-center " style="gap: 10px">
                                            <a href="/roadRoute/${items.id}/edit">
                                                <button type="button" class="btn btn-outline-warning">
                                                    <i class="fa-solid fa-pen-to-square" style="color: #f7d708; font-size:15px"></i>
                                                </button>
                                            </a>
                                            <form action="/roadRoute/${items.id}" method="post" onclick="return confirm('Bạn có muốn khóa trường này ?')">
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
                    console.error('Error:', xhr.responseText);
                }
            });
        }, 500);
    })

});
