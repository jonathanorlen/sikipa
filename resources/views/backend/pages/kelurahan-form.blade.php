@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('header', 'Tambah Kelurahan')
@section('breadcrumb')
  @if ($form == 'create')
    {{ Breadcrumbs::render('kelurahan.create') }}
  @elseif($form == 'edit')
    {{ Breadcrumbs::render('kelurahan.edit', $item) }}
  @else
    {{ Breadcrumbs::render('kelurahan.detail', $item) }}
  @endif
@endsection
@section('content')
  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form
            action="{{ $form == 'create' ? route('admin.kelurahan.store') : route('admin.kelurahan.update', $item->id) }}"
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
              <div class="form-group col-md-6">
                <label>Nama Kelurahan</label>
                <input type="text" name="kelurahan" id="kelurahan" class="form-control"
                  value="{{ isset($item->kelurahan) ? $item->kelurahan : old('kelurahan') }}">
                @error('kelurahan')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label>Kode Pos</label>
                <input type="number" name="kode_pos" id="kode_pos" class="form-control"
                  value="{{ isset($item->kode_pos) ? $item->kode_pos : old('kode_pos') }}">
                @error('kode_pos')
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
