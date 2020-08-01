@extends('layouts.app')

@section('content')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">List of Devices</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
            <li class="breadcrumb-item active">List of Devices</li>
        </ol>
     
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                Devices List
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Device Name</th>
                                <th>Device ID</th>
                                <th>Mobile Number</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>S.No</th>
                                <th>Device Name</th>
                                <th>Device ID</th>
                                <th>Mobile Number</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if (count($devices) > 0)
                            @foreach ($devices as $device)
                            <tr>
                                <td>{{ $device->id }}</td>
                                <td>{{ $device->deviceName }}</td>
                                <td>{{ $device->deviceID }}</td>
                                <td>{{ $device->mobileNumber }}</td>
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