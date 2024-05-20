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
                <form action="/cars/{{ $car->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4 mt-5">
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Tên xe</label>
                            <input  type="text" name="name"  class="form-control" value="{{ $car->name }}">
                            @error('name')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Giá ghế/1km</label>
                            <input type="number" name="seat_price"  class="form-control" value="{{ $car->seats_price }}">
                            @error('seat_price')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Số lượng ghế</label>
                            <input type="number" name="seat_quantity" class="form-control" value="{{ $car->seats_quantity }}">
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
                                    @if($car->service_id == $items->id )
                                        <option value="{{ $items->id }}" selected>{{ $items->name}}</option>
                                    @else
                                        <option value="{{ $items->id }}">{{ $items->name}}</option>
                                    @endif
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
                                    @if($car->type_car_id == $items->id)
                                        <option value="{{ $items->id }}" selected>{{ $items->name}}</option>
                                    @else
                                        <option value="{{ $items->id }}">{{ $items->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('typeCar')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-4">
                            <div class="form-check mt-5">
                                @if($car->status)
                                    <input class="form-check-input larger-checkbox" type="checkbox" name="active" value="1" id="flexCheckIndeterminate" checked>
                                @else
                                    <input class="form-check-input larger-checkbox" type="checkbox" name="active" value="1" id="flexCheckIndeterminate">
                                @endif
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
