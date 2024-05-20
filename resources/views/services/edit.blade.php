@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center">Dịch Vụ</h4>
            </div>
            <div class="card-body">
                @error('success')
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <form action="/services/{{$service->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4 mt-5">
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Dịch vụ mới</label>
                            <input  type="text" name="name"  class="form-control" value="{{ $service->name}}">
                            @error('name')
                            <span style="color: red">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="col-xl-3 ">
                            <label for="exampleInputPassword1">Ảnh</label>
                            <input type="file" name="images"  class="form-control">
                             <input type="hidden" name="image_old" value="{{ $service->image}}">
                            <img src="{{ asset('storage/images/'.$service->image)  }}" alt="" width="100px" class="mt-3">
                            @error('images')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-3">
                            <div class="form-check mt-5">
                                @if($service->status)
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
                        <a href="/services"><button type="button" class="btn btn-primary" style="margin-top: 50px;">Quay lại</button></a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
