@extends('layout.main')
@section('main-content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" >
                <a href="/type_car" class="text-decoration-none"><h1 class="h3 mb-2 text-gray-800 text-center">Quản lý loại xe</h1></a>
                <div class="text-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCreate">
                        <i class="fa-solid fa-plus" style="font-size: 15px"></i> Thêm loại xe
                    </button>
                </div>
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control bg-light border-0 small"
                                   placeholder="Nhập tên..."
                                   aria-label="search" aria-describedby="basic-addon2" name="search" id="search">
                        </div>
                    </div>
                    <span style="color: red" id="errors"></span>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Tên loại xe</th>
                            <th>Trang Thái</th>
                            <th class="text-right">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody id="data">
                        @if(isset($typeCar))
                            @foreach($typeCar as $items)
                                <tr id="row_{{$items->id}}">
                                    <td>{{ $items->code }}</td>
                                    <td>{{$items->name}}</td>
                                    <td>@if($items->status  ==  1)
                                            <span style="color: green">Đang Hoạt Động</span>
                                        @else
                                            <span style="color: red">Ngừng đoạt động</span>
                                        @endif</td>
                                    <td class="text-right">
                                        <div class="d-flex justify-content-center " style="gap: 10px">
                                            <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#exampleModalUpdate" data-bs-id="{{ $items->id}}">
                                                <i class="fa-solid fa-pen-to-square" style="color: #f7d708; font-size:15px"></i>
                                            </button>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="pagination justify-content-center">
                        @if(isset($cars))
                            {{ $cars->links('vendor.pagination.bootstrap-4') }} <!-- Sử dụng blade phân trang của trang index -->
                        @endif
                    </div>
                    <!-- Modal Create -->
                    <div class="modal fade" id="exampleModalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm loại xe</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-4 mt-5">
                                        <div class="col-xl-6">
                                            <label for="exampleInputPassword1">Loại xe mới</label>
                                            <input  type="text" name="name" class="form-control" id="name">
                                            <span style="color:red;" id="error_name"></span>
                                        </div>
                                        <div class="">
                                            <div class="form-check mt-5">
                                                <input class="form-check-input larger-checkbox" type="checkbox" name="active" value="1" id="active">
                                                <label class="form-check-label" for="flexCheckIndeterminate">
                                                    Hoạt Động
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success" id='create'>Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Update -->
                    <div class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Sửa loại xe</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-4 mt-5">
                                        <input type="hidden" id="image_old">
                                        <input type="hidden" id="id">
                                        <div class="col-xl-6">
                                            <label for="exampleInputPassword1">Dịch vụ mới</label>
                                            <input  type="text" name="name" class="form-control" id="nameUp">
                                            <span style="color:red;" id="error_name"></span>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-check mt-5">
                                                <input class="form-check-input larger-checkbox" type="checkbox" name="active" value="1" id="activeUp">
                                                <label class="form-check-label" for="flexCheckIndeterminate">
                                                    Hoạt Động
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-warning" id='update'>Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @vite(['resources/js/jquery/typecar.js'])
        </div>
    </div>
@endsection

