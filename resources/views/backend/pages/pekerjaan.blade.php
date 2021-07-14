@extends('backend.layouts.app')
@section('title', 'Master Pekerjaan')
@section('header', 'Master Pekerjaan')
@section('breadcrumb')
  {{ Breadcrumbs::render('pekerjaan') }}
@endsection
@section('content')
  <div class="row mb-4">
    <div class="col-md-12">
      <a href="{{ route('admin.pekerjaan.create') }}" class="btn btn-icon btn-lg btn-info float-right"><i
          class="fas fa-plus"></i> Tambah</a>
    </div>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible show fade" role="alert">
            <button class="close" data-dismiss="alert">
              <span>×</span>
            </button>
            {{ session()->get('success') }}
          </div>
        @endif
        @if (session()->has('error'))
          <div class="alert alert-danger" role="alert">
            {{ session()->get('error') }}
          </div>
        @endif
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped table-md">
                <tbody>
                  <tr>
                    <th>#</th>
                    <th>Pekerjaan</th>
                    <th>Action</th>
                  </tr>
                  @foreach ($items as $key => $item)
                    <tr>
                      <td>{{ $key + 1 }}</td>
                      <td>{{ $item->nama }}</td>
                      <td>
                        <a href="{{ route('admin.pekerjaan.edit', $item->id) }}" class="btn btn-info">
                          <i class="fa fa-pencil-alt"></i>
                        </a>
                        <button data-confirm="Hapus Data|Apakah anda yakin akan menghapus pekerjaan {{ $item->nama }} ?"
                          data-confirm-yes="window.location ='{{ route('admin.pekerjaan.destroy', $item->id) }}'"
                          class="btn btn-icon btn-danger" data-toggle="tooltip" title="Change Event Status"><i
                            class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer text-right">
            <nav class="d-inline-block">
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
