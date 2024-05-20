@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center">Tuyến đường</h4>
            </div>
            <div class="card-body">
                @error('success')
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <form action="/roadRoute" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row mb-4 mt-5">
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Khu vực khởi hành</label>
                            <select class="form-control" aria-label="Default select example" id="CityStarting">
                                    @foreach($city as $items)
                                        <option value="{{ $items->id }}"> {{ $items->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Khu vực đến</label>
                            <select class="form-control" aria-label="Default select example" id="CityDestination">
                                @foreach($city as $items)
                                    <option value="{{ $items->id }}"> {{ $items->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Xe</label>
                            <select class="form-control" aria-label="Default select example" name="car_id">
                                @foreach($cars as $items)
                                    <option value="{{ $items->id }}"> {{ $items->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>
                    </div>
                    <div class="row mb-4 mt-5">
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Địa điểm xuất phát</label>
                            <select class="form-control" aria-label="Default select example" name="Starting" id="Starting">

                            </select>
                            @error('Starting')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Địa điểm đến</label>
                            <select class="form-control" aria-label="Default select example" name="Destination" id="Destination">

                            </select>
                            @error('Destination')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Số km đi</label>
                           <input type="number" class="form-control" name="kilometer">

                            <div class="form-check mt-5">
                                <input class="form-check-input larger-checkbox" type="checkbox" name="active" value="1" id="flexCheckIndeterminate">
                                <label class="form-check-label" for="flexCheckIndeterminate">
                                    Hoạt Động
                                </label>
                            </div>
                            @error('kilometer')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <hr>
                    </div>
                    @error('errors_road')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                    <div>
                        <button type="submit" class="btn btn-success" style="margin-top: 50px;">Thêm</button>
                        <a href="/roadRoute"><button type="button" class="btn btn-primary" style="margin-top: 50px;">Quay lại</button></a>
                    </div>
                </form>
            </div>
            <script src="{{asset('backend/jquery/roadRoute.js')}}"></script>
        </div>
    </section>
@endsection
