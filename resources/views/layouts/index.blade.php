@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card">
          @yield('model-content')
        </div>
      </div>
    </div>
  </div>
@endsection
