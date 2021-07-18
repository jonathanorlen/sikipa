@extends('backend.layouts.main')
@section('title', 'Dashboard')
@section('header', 'Dashboard')
@section('content')
  <div class="row">
    <div class="col-lg-4 col-md-6 col-sm-12">
      <div class="card card-statistic-2">
        <div class="card-icon shadow-primary bg-primary">
          <i class="fas fa-users"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Penduduk</h4>
          </div>
          <div class="card-body">
            {{ $penduduk->count() }}
          </div>
        </div>
        <div class="card-stats">
          <div class="card-stats-items mb-4">
            <div class="card-stats-item">
              <div class="card-stats-item-count">{{ $keluarga->count() }}</div>
              <div class="card-stats-item-label">Keluarga</div>
            </div>
            <div class="card-stats-item">
              <div class="card-stats-item-count">{{ $laki->count() }}</div>
              <div class="card-stats-item-label">Laki-Laki</div>
            </div>
            <div class="card-stats-item">
              <div class="card-stats-item-count">{{ $perempuan->count() }}</div>
              <div class="card-stats-item-label">Perempuan</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-primary">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Total Admin</h4>
          </div>
          <div class="card-body">
            {{ $user->count() }}
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-danger">
          <i class="far fa-newspaper"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>News</h4>
          </div>
          <div class="card-body">
            42
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-warning">
          <i class="far fa-file"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Reports</h4>
          </div>
          <div class="card-body">
            1,201
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
      <div class="card card-statistic-1">
        <div class="card-icon bg-success">
          <i class="fas fa-circle"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header">
            <h4>Online Users</h4>
          </div>
          <div class="card-body">
            47
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection

@push('page-scripts')

@endpush
