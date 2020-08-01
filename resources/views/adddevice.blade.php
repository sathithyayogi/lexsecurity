@extends('layouts.app')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Device</h3></div>
                    <div class="card-body">
                        <form action="deviceController@store" method="POST">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Device ID</label>
                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Device Name</label>
                                        <input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter last name" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Mobile Number</label>
                                <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" />
                            </div>
                            <input class="form-control py-4 btn btn-primary btn-block"  type="submit" placeholder="Add Device" />
                            
                        </form>
                    </div>
                 
                </div>
            </div>
        </div>
    </div>
</main>
@endsection