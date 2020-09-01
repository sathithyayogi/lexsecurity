@extends('layouts.app')

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">List of Numbers</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">List of Numbers</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-xl-6">
                        <i class="fas fa-table mr-1"></i>
                        Devices List
                    </div>
                    <div class="col-xl-6"><a href="/device/mobilenumber/add" class="btn btn-primary">Add Mobile Number</a></div>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Mobile Number</th>
                                <th>Edit</th>
                                {{-- <th>Delete</th> --}}
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S.No</th>
                                <th>Mobile Number</th>
                                <th>Edit</th>
                                {{-- <th>Delete</th> --}}
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($devices) > 0)
                            @foreach ($devices as $device)
                            <tr>
                                <td>{{ $device->id }}</td>
                                <td>{{ $device->mobileNumber }}</td>
                                <td><a href="/device/config/{{$device->id}}/" class="btn btn-default">Edit</a></td>
                                {{-- <td>
                                    <form action="{{ action('deviceSettingController@destroyed', $device->id) }}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            <button class="form-control  btn btn-danger btn-block"  type="submit">Remove</button>
                                        </form>
                                </td> --}}
                            </tr>
                            @endforeach
                            @endif


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
