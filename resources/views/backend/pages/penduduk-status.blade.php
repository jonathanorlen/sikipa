@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('header')
  {{-- @if ($form == 'create')
    Tambah Penduduk
  @elseif($form == 'edit')
    Edit <span style="font-weight:normal;">{{ isset($item->nama) ? $item->nama : '' }}</span>
  @else
    Data <span style="font-weight:normal;">{{ isset($item->nama) ? $item->nama : '' }} </span>
  @endif --}}
@endsection
@section('breadcrumb')
  {{-- @if ($form == 'create')
    {{ Breadcrumbs::render('penduduk.create') }}
  @elseif($form == 'edit')
    {{ Breadcrumbs::render('penduduk.edit', $item) }}
  @else
    {{ Breadcrumbs::render('penduduk.detail', $item) }}
  @endif --}}
@endsection

@section('content')
  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
          <form action="{{ route('admin.penduduk.ganti_status_update', $item->nik) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body row pb-0">
              <div class="form-group col-md-6">
                <label>Dokumen KK</label>
                <select name="dokumen_kk" id="" class="form-control">
                  <option value="" hidden>Pilih Status</option>
                  <option value="Lengkap" {{ $item->dokumen_kk == 'Lengkap' ? 'selected' : null }}>Lengkap</option>
                  <option value="Belum Lengkap" {{ $item->dokumen_kk == 'Belum Lengkap' ? 'selected' : null }}>Belum
                    Lengkap
                  </option>
                </select>
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label>Dokumen KTP</label>
                <select name="dokumen_ktp" id="" class="form-control">
                  <option value="" hidden> Pilih Status</option>
                  <option value="Lengkap" {{ $item->dokumen_ktp == 'Lengkap' ? 'selected' : null }}>Lengkap</option>
                  <option value="Belum Lengkap" {{ $item->dokumen_ktp == 'Belum Lengkap' ? 'selected' : null }}>Belum
                    Lengkap</option>
                </select>
                @error('nik')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-12">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control" id="" cols="30" rows="30">

                                                              </textarea>
                @error('nik')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary float">Submit</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('after-scripts')

@endpush
