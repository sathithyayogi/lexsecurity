@extends('layouts.app')

@section('content')
<main>
    <div class="container-fluid">
      <h1 class="mt-4">Diagnostics</h1>
      <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
          <li class="breadcrumb-item active">Diagnostics</li>
      </ol>

<div id="app">
<no-alarm/>
</div>
<diagnostics/>
    </div>
  </main>
  @endsection
