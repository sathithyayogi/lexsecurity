@extends('layouts.app')

@section('content')
<main>
  <div class="container-fluid">
 


    <div class="row">

@if (count($devices) > 0)
      @foreach ($devices as $device)
      <div class="col-xl-3">
        <div class="card xl-3">
          <div class="card-header">
            <div class="row">
              <div class="col-xl-12">
                DeviceOne
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="mainindicator"><p>red</p></div>
            <div class="row">
              <div class="col-xl-6">
                <span class="badge badge-success">CONNECTED</span>
              </div>
            </div>
          </div>
        </div>
      </div>
  @endforeach
  @endif




    </div>
  </div>
</main>

@endsection