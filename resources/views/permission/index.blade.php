@extends('layout.main')
@section('main-content')

    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" >
                <a href="/permissions" class="text-decoration-none"><h1 class="h3 mb-2 text-gray-800 text-center">Phân Quyền</h1></a>
                <div class="text-right">
                    <a href="/permissions/create">
                        <button type="button" class="btn btn-success">
                            <i class="fa-solid fa-plus" style="font-size: 15px"></i>Thêm Quyền Mới</button>
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
                            <th>Quyền truy cập</th>
                            <th>Bảo vệ quyền</th>
                            <th>Ngày tạo</th>
                            <th>Cập nhật mới</th>
                            <th class="text-right">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody id="data">
                        @if(isset($permissions))
                            @foreach($permissions as $items)
                                <tr id="list-cate">
                                    <td>{{ $items->name }}</td>
                                    <td>{{ $items->guard_name }}</td>
                                    <td>{{ $items->created_at }}</td>
                                    <td>{{ $items->updated_at }}</td>
                                    <td class="text-right d-flex justify-content-center" style="gap: 5px">
                                        <a href="/permissions/{{ $items->id }}/edit">
                                            <button type="button" class="btn btn-outline-warning">
                                                <i class="fa-solid fa-pen-to-square" style="color: #f7d708; font-size:15px"></i>
                                            </button>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <div id="pagination" class="pagination justify-content-center">
                                            @if(!isset($isSearch))
                                                {{ $permissions->links('vendor.pagination.bootstrap-4') }} <!-- Sử dụng blade phân trang của trang index -->
                                            @endif
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <script src="{{asset('backend/jquery/search.js')}}"></script>
    </div>
@endsection
