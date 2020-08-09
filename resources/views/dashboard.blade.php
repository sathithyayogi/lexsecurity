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
            @if ($device->movementStatus == 0)
            {{-- <div class="mainindicatorstop"><p>red</p></div> --}}
            <div class="circleindicator red"></div>
            @elseif($device->movementStatus == 1)
            {{-- <div class="mainindicatoryellow"><p>red</p></div> --}}
            <div class="circleindicator yellow" ></div>
            @elseif($device->movementStatus == 2)
            <div class="circleindicator green" ></div>
            {{-- <div class="mainindicatorgo"><p>red</p></div> --}}
            @endif
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
<script src="js/app.js"></script>
