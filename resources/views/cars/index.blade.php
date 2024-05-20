@extends('layout.main')
@section('main-content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" >
                <a href="/cars" class="text-decoration-none"><h1 class="h3 mb-2 text-gray-800 text-center">Quản lý xe</h1></a>
                <div class="text-right">
                    <a href="/cars/create">
                        <button type="button" class="btn btn-success">
                            <i class="fa-solid fa-plus" style="font-size: 15px"></i> Thêm xe</button>
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
                            <th>Dịch vụ xe</th>
                            <th>Loại xe</th>
                            <th>Tên xe</th>
                            <th>Giá ghế/1km</th>
                            <th>Số lượng ghế</th>
                            <th>Trang Thái</th>
                            <th class="text-right">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody id="data">
                        @if(isset($cars))
                            @foreach($cars as $items)
                                <tr>
                                    <td>{{$items->service_name}}</td>
                                    <td>{{$items->type_car_name}}</td>
                                    <td>{{$items->name}}</td>
                                    <td>{{ number_format($items->seats_price, 0, ',', '.') . ' VND'}}</td>
                                    <td>{{$items->seats_quantity}}</td>
                                    <td>@if($items->status  ==  1)
                                            <span style="color: green">Đang Hoạt Động</span>
                                        @else
                                            <span style="color: red">Ngừng đoạt động</span>
                                        @endif</td>
                                    <td class="text-right">
                                        <div class="d-flex justify-content-center " style="gap: 10px">
                                            <a href="/cars/{{$items->id}}/edit">
                                                <button type="button" class="btn btn-outline-warning">

                                                    <i class="fa-solid fa-pen-to-square" style="color: #f7d708; font-size:15px"></i>
                                                </button>
                                            </a>
                                            <form action="/cars/{{$items->id}}" method="post" onclick="return confirm('Bạn có muốn khóa trường này ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger">
                                                    <i class="fa-solid fa-trash-can" style="color: #ff0000; font-size:15px"></i>
                                                </button>
                                            </form>
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
                </div>
            </div>
            <script src="{{asset('backend/jquery/cars.js')}}"></script>
        </div>
    </div>
@endsection

