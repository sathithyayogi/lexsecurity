@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Change Mobile Number</h3></div>
                    <div class="card-body">
                        <form action="{{ action('deviceSettingController@change', $device->id) }}" method="POST">
                            {{-- <form action="/devices/{{$device->id}}/edit" method="POST"> --}}
                                <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                            <div class="form-row">
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="mobileNumber">Mobile Number</label>
                                <input class="form-control py-4" id="mobileNumber" value="{{ $device->mobileNumber }}" type="number" name="mobileNumber"/>
                            </div>
                            <button class="form-control btn btn-primary btn-block"  type="submit">Edit Number</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
