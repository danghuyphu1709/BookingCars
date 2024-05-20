@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center">Xe</h4>
            </div>
            <div class="card-body">
                @error('success')
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <form action="/cars" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row mb-4 mt-5">
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Tên xe</label>
                            <input  type="text" name="name"  class="form-control">
                            @error('name')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Giá ghế/1km</label>
                            <input type="number" name="seat_price"  class="form-control">
                            @error('seat_price')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Số lượng ghế</label>
                            <input type="number" name="seat_quantity" class="form-control">
                            @error('seat_quantity')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <hr>
                    </div>
                    <div class="row mb-4 mt-5">
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Dịch vụ xe</label>
                            <select class="form-control" aria-label="Default select example" name="service">
                                @foreach($services as $items)
                                    <option value="{{ $items->id }}">{{ $items->name}}</option>
                                @endforeach
                            </select>
                            @error('service')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Loại xe</label>
                            <select class="form-control" aria-label="Default select example" name="typeCar">
                                @foreach($typeCar as $items)
                                    <option value="{{ $items->id }}">{{ $items->name}}</option>
                                @endforeach
                            </select>
                            @error('typeCar')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-4">
                            <div class="form-check mt-5">
                                <input class="form-check-input larger-checkbox" type="checkbox" name="active" value="1" id="flexCheckIndeterminate">
                                <label class="form-check-label" for="flexCheckIndeterminate">
                                    Hoạt Động
                                </label>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success" style="margin-top: 50px;">Thêm</button>
                        <a href="/cars"><button type="button" class="btn btn-primary" style="margin-top: 50px;">Quay lại</button></a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
