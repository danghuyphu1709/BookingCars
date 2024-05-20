@extends('layout.main')
@section('main-content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" >
                <a href="/roles" class="text-decoration-none"><h1 class="h3 mb-2 text-gray-800 text-center">Quản lý vai trò</h1></a>
                <div class="text-right">
                    <a href="/roles/create">
                        <button type="button" class="btn btn-success">
                            <i class="fa-solid fa-plus" style="font-size: 15px"></i>Thêm Vai Trò</button>
                    </a>
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
                            <th>Vai Trò</th>
                            <th>Quyền bảo vệ</th>
                            <th>Ngày tạo</th>
                            <th>Cập nhật mới </th>
                            <th class="text-right">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody id="data">
                        @if(isset($roles))
                            @foreach($roles as $items)
                                <tr id="list-cate">
                                    <td>{{ $items->name}}</td>
                                    <td>{{ $items->guard_name}}</td>
                                    <td>{{ $items->created_at }}</td>
                                    <td>{{ $items->updated_at }}</td>
                                    <td class="text-right">
                                        <a href="/roles/{{$items->id}}/apply">
                                            <button type="button" class="btn btn-outline-success">
                                                Áp dụng
                                            </button>
                                        </a>
                                        <a href="/roles/{{$items->id}}/edit">
                                            <button type="button" class="btn btn-outline-danger">
                                               Sửa thông tin
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div class="pagination justify-content-center">
                        @if(!isset($isSearch))
                            {{ $roles->links('vendor.pagination.bootstrap-4') }} <!-- Sử dụng blade phân trang của trang index -->
                        @endif
                    </div>
                </div>
            </div>
            <script src="{{asset('backend/jquery/search.js')}}"></script>
        </div>
    </div>
@endsection
