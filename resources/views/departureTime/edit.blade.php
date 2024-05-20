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
                <form action="/departure_times/{{ $departureTime->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4 mt-5">
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Thời gian bắt chuẩn bị</label>
                            <input type="time" name="preparation_time" class="form-control" value="{{ $departureTime->preparation_time }}">
                            @error('preparation_time')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Thời gian xuất phát</label>
                            <input type="time" name="departure_time" class="form-control" value="{{ $departureTime->departure_time }}">
                            @error('departure_time')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <hr>
                    </div>
                    <div class="form-check mt-5">
                        @if($departureTime->status)
                            <input class="form-check-input larger-checkbox" type="checkbox" name="active" value="1" id="flexCheckIndeterminate" checked>
                        @else
                            <input class="form-check-input larger-checkbox" type="checkbox" name="active" value="1" id="flexCheckIndeterminate">
                        @endif
                        <label class="form-check-label" for="flexCheckIndeterminate">
                            Hoạt Động
                        </label>
                    </div>
                    @error('departure_time.after')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                    @error('departure_time.date_format')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                    <div>
                        <button type="submit" class="btn btn-success" style="margin-top: 50px;">Thêm</button>
                        <a href="/departure_times"><button type="button" class="btn btn-primary" style="margin-top: 50px;">Quay lại</button></a>
                    </div>
                </form>
            </div>
            <script src="{{asset('backend/jquery/roadRoute.js')}}"></script>
        </div>
    </section>
@endsection
