@extends('frontend.layouts.user')
@section('content')
  <h2><span style="font-weight:300">Hallo</span> {{ session()->get('penduduk')->nama }}</h2>
  </section>
@endsection
