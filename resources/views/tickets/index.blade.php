@extends('layout.main')
@section('main-content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3" >
                <a href="/tickets" class="text-decoration-none"><h1 class="h3 mb-2 text-gray-800 text-center">Quản lý vé xe</h1></a>
                <div class="text-right">
                    <a href="/tickets/create">
                        <button type="button" class="btn btn-success">
                            <i class="fa-solid fa-plus" style="font-size: 15px"></i> Thêm vé xe</button>
                    </a>
                </div>
                <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col">
                            <input type="text" class="form-control bg-light border-0 small"
                                   placeholder="Nhập code..."
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
                            <th>Tuyến đường và xe</th>
                            <th>Thời gian xuất phát</th>
                            <th>Số lượng vé</th>
                            <th>Trạng thái</th>
                            <th class="text-right">Thao Tác</th>
                        </tr>
                        </thead>
                        <tbody id="data">
                        @if(isset($tickets))
                            @foreach($tickets as $items)
                                <tr>
                                    <td>{{$items->code}}</td>
                                    <td>{{$items->starting_name}} ->{{ $items->destination_name}} / {{ $items->car_name }}</td>
                                    <td>{{$items->preparation_time }} - {{ $items->departure_time }}</td>
                                    <td>{{$items->ticket_quantity}}</td>
                                    <td>@if($items->status  ==  1)
                                            <span style="color: green">Đang Hoạt Động</span>
                                        @else
                                            <span style="color: red">Ngừng đoạt động</span>
                                        @endif</td>
                                    <td class="text-right">
                                        <div class="d-flex justify-content-center " style="gap: 10px">
                                            <a href="/tickets/{{$items->id}}/edit">
                                                <button type="button" class="btn btn-outline-warning">

                                                    <i class="fa-solid fa-pen-to-square" style="color: #f7d708; font-size:15px"></i>
                                                </button>
                                            </a>
                                            <form action="/tickets/{{$items->id}}" method="post" onclick="return confirm('Bạn có muốn khóa trường này ?')">
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
                        @if(isset($tickets))
                            {{ $tickets->links('vendor.pagination.bootstrap-4') }} <!-- Sử dụng blade phân trang của trang index -->
                        @endif
                    </div>
                </div>
            </div>
            <script src="{{asset('backend/jquery/.js')}}"></script>
        </div>
    </div>
@endsection

