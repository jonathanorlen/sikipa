@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('header', 'User Form')
@section('breadcrumb')
  {{ Breadcrumbs::render('user') }}
@endsection
@section('content')
  <div class="row mb-0">
    <div class="col-md-3 col-12">
      <div class="card card-statistic-2">
        <div class="card-icon bg-primary  m-2">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header pt-2">
            <h4>User</h4>
          </div>
          <div class="card-body mt-1">
            <h4>{{ $items->count() }}</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 ml-auto">
      <a href="{{ route('admin.user.create') }}" class="btn btn-icon btn-lg btn-info float-right mb-2"><i
          class="fas fa-plus"></i> Tambah User</a>
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
          <div class="card-body p-0">
            <form action="{{ route('admin.user.index') }}" method="get"
              class="form-group w-25 float-right mb-0 mt-3 ml-3">
              <div class="input-group mb-3">
                <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control"
                  placeholder="Search All" aria-label="">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">Button</button>
                </div>
              </div>
            </form>
            <div class="table-responsive">
              <table class="table table-striped table-md">
                <tbody>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                  @php
                    $no = 1;
                  @endphp
                  @foreach ($items as $key => $item)
                    <tr>
                      <td>{{ $items->firstItem() + $key }}</td>
                      <td>{{ $item->name }}</td>
                      <td>{{ $item->email }}</td>
                      <td>
                        <a href="{{ route('admin.user.edit', $item->id) }}" class="btn btn-info" data-toggle="tooltip"
                          title="Edit User"><i class="fa fa-pencil-alt"></i></a>
                        <form action="{{ route('admin.user.destroy', $item->id) }}" method="post" class="d-inline">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure?')"
                            data-toggle="tooltip" title="Hapus User"><i class="fa fa-trash"></i></button>
                        </form>
                      </td>
                    </tr>
                    @php
                      $no++;
                    @endphp
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer text-right">
            <nav class="d-inline-block">
              {{ $items->links('vendor.pagination.custom') }}
              {{-- <ul class="pagination mb-0">
                          <li class="page-item disabled">
                              <a class="page-link" href="#" tabindex="-1"><i
                                      class="fas fa-chevron-left"></i></a>
                          </li>
                          <li class="page-item active"><a class="page-link" href="#">1 <span
                                      class="sr-only">(current)</span></a></li>
                          <li class="page-item">
                              <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item">
                              <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                          </li>
                      </ul> --}}
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('page-scripts')

@endpush
