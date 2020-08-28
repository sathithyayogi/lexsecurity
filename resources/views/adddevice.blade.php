@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Device</h3></div>
                    <div class="card-body">
                        <form action="{{ action('deviceController@store') }}" method="POST" id="adddevice">
                        {{-- <form id="adddevice"> --}}
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="deviceID">Device ID</label>
                                        <input class="form-control py-4" id="deviceID" type="text" name="deviceID" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="deviceName">Device Name</label>
                                        <input class="form-control py-4" id="deviceName" type="text" name="deviceName"/>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                                <label class="small mb-1" for="mobileNumber">Mobile Number</label>
                                <input class="form-control py-4" id="mobileNumber"  type="hidden" name="mobileNumber"/>
                            </div> --}}
                            <button class="form-control btn btn-primary btn-block"  type="submit">Add Device</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection
<script
src="https://code.jquery.com/jquery-3.5.1.js"
integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
crossorigin="anonymous"></script>
{{-- <script type="text/javascript">
    $(document).ready(function() {
        $('#adddevice').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url: "/devices",
                type: "POST",
                data: $('#adddevice').serialize(),
                success: function (response) {
                    console.log(response)
                    alert("New Device Added Successfully");
                    window.location = '/devices';
                },
                error: function(error){
                    console.log(error)
                    alert("Data Not Saved");
                }
            });
        });
    });
</script> --}}
