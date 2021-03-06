@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('header', 'Tambah User')
@section('breadcrumb')
  @if ($form == 'create')
    {{ Breadcrumbs::render('user.create') }}
  @elseif($form == 'edit')
    {{ Breadcrumbs::render('user.edit', $item) }}
  @else
    {{ Breadcrumbs::render('user.detail', $item) }}
  @endif
@endsection
@section('content')
  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ $form == 'create' ? route('admin.user.store') : route('admin.user.update', $item->id) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if ($form == 'edit')
              @method('PUT')
            @endif
            {{-- @php
                        if($form =='edit'){
                            echo method_field('PUT');
                        }
                    @endphp --}}
            <div class="card-body row pb-0">
              <div class="form-group col-md-4">
                <label>Nama</label>
                <input type="text" name="name" id="name" class="form-control @error('name')is-invalid @enderror"
                  value="{{ isset($item->name) ? $item->name : old('name') }}">
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label>Email</label>
                <input type="text" name="email" id="email" class="form-control @error('email')is-invalid @enderror"
                  value="{{ isset($item->email) ? $item->email : old('email') }}">
                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                  class="form-control @error('tanggal_lahir')is-invalid @enderror"
                  value="{{ isset($item->tanggal_lahir) ? $item->tanggal_lahir : old('tanggal_lahir') }}">
                @error('tanggal_lahir')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
            <div class="card-footer text-right">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('page-scripts')

@endpush
