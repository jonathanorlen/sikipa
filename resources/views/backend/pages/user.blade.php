@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('header','User Form')
@section('breadcrumb')
{{ Breadcrumbs::render('user') }}
@endsection
@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <a href="{{route('user.create')}}" class="btn btn-icon btn-lg btn-info float-right"><i class="fas fa-plus"></i> Tambah User</a>
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
                  <form action="{{route('user.index')}}" method="get" class="form-group w-25 float-right mb-0 mt-3 ml-3">
                    <div class="input-group mb-3">
                      <input type="text" name="search" value="{{Request::get('search')}}" class="form-control" placeholder="Search All" aria-label="">
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
                              @foreach ($items as $item)
                              <tr>
                                  <td>{{$no}}</td>
                                  <td>{{$item->name}}</td>
                                  <td>{{ $item->email }}</td>
                                  <td>
                                      <a href="{{route('user.edit',$item->id)}}" class="btn btn-info"><i class="fa fa-pencil-alt"></i></a>
                                      <form action="{{route('user.destroy',$item->id)}}" method="post" class="d-inline">
                                          @csrf
                                          @method('delete')
                                          <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure?')"><i class="fa fa-trash"></i></button>
                                      </form>
                                  </td>
                              </tr>
                              @php
                                  $no++
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
