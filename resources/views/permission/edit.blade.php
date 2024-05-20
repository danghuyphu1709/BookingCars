@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center">Thêm quyền</h4>
            </div>
            <div class="card-body">
                @error('success')
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <form action="/permissions/{{ $permission->id }}" method="post" enctype="multipart/form-data" id="formPermissions" class="">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4 mt-5">
                        <div class="col-xl-3">
                        </div>
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Quyền mới</label>
                            <input id="permission" type="text" name="permission"  class="form-control" value="{{ $permission->name }}">
                            @error('permission')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                            <hr>
                        </div>
                        <div class="col-xl-3">
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success" style="margin-top: 50px;">Sửa</button>
                        <a href="/permissions"><button type="button" class="btn btn-primary" style="margin-top: 50px;">Quay lại</button></a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
