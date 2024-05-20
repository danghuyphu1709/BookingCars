@extends('layout.main')
@section('main-content')
    <section class="container-fluid mt-3ct">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="text-center">Vai trò</h4>
            </div>
            <div class="card-body">
                @error('success')
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <form action="/roles/{{$id}}/apply" method="post" enctype="multipart/form-data" id="formPermissions" class="" id="roleForm">
                    @csrf
                    @method('POST')
                    <div class="row">
                       @foreach($permissions as $items)
                           @if($items->status == 1)
                                <div class="form-check col-3 ">
                                    <input class="form-check-input larger-checkbox" type="checkbox" value="{{ $items->id }}" id="flexCheckDefault" name="permissions[]" checked>
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $items->name }}
                                    </label>
                                </div>
                            @else
                                <div class="form-check col-3">
                                    <input class="form-check-input larger-checkbox" type="checkbox" value="{{ $items->id }}" id="flexCheckDefault" name="permissions[]">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        {{ $items->name }}
                                    </label>
                                </div>
                           @endif
                       @endforeach
                    </div>
                     @error('permissions')
                      <span style="color: red"> {{ $message }} </span>
                     @enderror
                    <div>
                        <button type="submit" class="btn btn-success" style="margin-top: 50px;">Thêm</button>
                        <a href="/roles"><button type="button" class="btn btn-primary" style="margin-top: 50px;">Quay lại</button></a>
                    </div>
                </form>

            </div>
        </div>
    </section>
@endsection
