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
                <form action="/tickets/{{ $ticket->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-4 mt-5">
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Thời gian khời hành</label>
                            <select class="form-control" aria-label="Default select example"  name="departureTime">
                                @foreach($departureTime as $items)
                                    @if($ticket->departure_day_id = $items->id)
                                        <option value="{{ $items->id }}" selected> {{ $items->preparation_time }} - {{ $items->departure_time }}</option>
                                    @else
                                        <option value="{{ $items->id }}" > {{ $items->preparation_time }} - {{ $items->departure_time }}</option>
                                    @endif

                                @endforeach
                            </select>
                            @error('departureTime')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Tuyến đường</label>
                            <select class="form-control" aria-label="Default select example" name="road_route">
                                @foreach($roadRoute as $items)
                                    @if($ticket->roadRoute_id = $items->id)
                                        <option value="{{ $items->id }}" selected> {{ $items->starting_name }} -> {{ $items->destination_name }} / {{ $items->car_name }}</option>
                                    @else
                                        <option value="{{ $items->id }}" > {{ $items->starting_name }} -> {{ $items->destination_name }} / {{ $items->car_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('road_route')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-xl-4">
                            <label for="exampleInputPassword1">Số lượng vé</label>
                            <input type="number" class="form-control" name="ticket_quantity" value="{{ $ticket->ticket_quantity }}">
                            @error('ticket_quantity')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <hr>
                    </div>

                    <div class="form-check mt-5">
                        @if($ticket->status)
                            <input class="form-check-input larger-checkbox" type="checkbox" name="active" value="1" id="flexCheckIndeterminate" checked>
                        @else
                            <input class="form-check-input larger-checkbox" type="checkbox" name="active" value="1" id="flexCheckIndeterminate">
                        @endif
                        <label class="form-check-label" for="flexCheckIndeterminate">
                            Hoạt Động
                        </label>
                    </div>

                    @error('errors_tickets')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                    <div>
                        <button type="submit" class="btn btn-success" style="margin-top: 50px;">Thêm</button>
                        <a href="/tickets"><button type="button" class="btn btn-primary" style="margin-top: 50px;">Quay lại</button></a>
                    </div>
                </form>
            </div>
            <script src="{{asset('backend/jquery/roadRoute.js')}}"></script>
        </div>
    </section>
@endsection
