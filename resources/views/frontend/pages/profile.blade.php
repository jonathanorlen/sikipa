@extends('frontend.layouts.user')
@section('header', 'sticky-top')
  @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
  @endpush
@section('content')
  @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible show fade" role="alert">
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      {{ session()->get('success') }}
    </div>
  @endif
  @if (session()->has('error'))
    <div class="alert alert-danger" role="alert">
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      {{ session()->get('error') }}
    </div>
  @endif
  <form action="{{ route('user.profile-update', $data->nik) }}" method="POST" enctype="multipart/form-data" id="form">
    @csrf
    <div class="card-body row pb-0">
      <div class="mb-4 col-md-4">
        <label class="form-label">Nama</label>
        <input type="text" name="nama" id="nama" class="form-control @error('nama')is-invalid @enderror"
          value="{{ isset($data->nama) ? $data->nama : old('nama') }}" required>
        @error('nama')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-4 col-md-4">
        <label class="form-label">Nomor KK</label>
        <select class="form-control select-2 js-example-basic-multiple @error('nomor_kk')is-invalid @enderror"
          name="nomor_kk" required>
          <option value="" hidden></option>
          @foreach ($kartu_keluarga as $item)
            <option value="{{ $item->nomor_kk }}"
              {{ (isset($edit) ? ($data->nomor_kk == $item->nomor_kk ? 'selected' : null) : @old('nomor_kk') == $item->nomor_kk) ? 'selected' : null }}>
              {{ $item->nomor_kk }}</option>
          @endforeach
        </select>
        @error('nomor_kk')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-4 col-md-4">
        <label class="form-label">NIK</label>
        <input type="text" name="nik" id="nik" class="form-control @error('nik')is-invalid @enderror"
          value="{{ isset($data->nik) ? $data->nik : old('nik') }}" required>
        @error('nik')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-4 col-md-4">
        <label class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control"
          value="{{ isset($data->email) ? $data->email : old('email') }}">
        @error('email')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-4 col-md-4">
        <label class="form-label">Tempat lahir</label>
        <input type="text" name="tempat_lahir" id="tempat_lahir"
          class="form-control @error('tempat_lahir')is-invalid @enderror"
          value="{{ isset($data->tempat_lahir) ? $data->tempat_lahir : old('tempat_lahir') }}" required>
        @error('tempat_lahir')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-4 col-md-4">
        <label class="form-label">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" id="tanggal_lahir"
          class="form-control @error('tanggal_lahir')is-invalid @enderror"
          value="{{ isset($data->tanggal_lahir) ? $data->tanggal_lahir : old('tanggal_lahir') }}" required>
        @error('tanggal_lahir')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-4 col-md-6">
        <label class="form-label">Pendidikan</label>
        <select name="pendidikan" id="pendidikan" class="form-control @error('pendidikan')is-invalid @enderror" required>
          <option value="" hidden>Pilih Pendidikan</option>
          <option value="Tidak/Belum Sekolah"
            {{ (isset($edit) ? ($data->pendidikan == 'Tidak/Belum Sekolah' ? 'selected' : null) : @old('pendidikan') == 'Tidak/Belum Sekolah') ? 'selected' : null }}>
            Tidak/Belum Sekolah</option>
          <option value="Belum Tamat SD/Sederajat"
            {{ (isset($edit) ? ($data->pendidikan == 'Belum Tamat SD/Sederajat' ? 'selected' : null) : @old('pendidikan') == 'Belum Tamat SD/Derajat') ? 'selected' : null }}>
            Belum Tamat SD/Sederajat</option>
          <option value="SLTP/Sederajat"
            {{ (isset($edit) ? ($data->pendidikan == 'SLTP/Sederajat' ? 'selected' : null) : @old('pendidikan') == 'SLTP/Sederajat') ? 'selected' : null }}>
            SLTP/Sederajat</option>
          <option value="SLTA/Sederajat"
            {{ (isset($edit) ? ($data->pendidikan == 'SLTA/Sederajat' ? 'selected' : null) : @old('pendidikan') == 'SLTA/Sederajat') ? 'selected' : null }}>
            SLTA/Sederajat</option>
          <option value="Akademi/Diploma III/Sarjana Muda"
            {{ (isset($edit) ? ($data->pendidikan == 'Akademi/Diploma III/Sarjana Muda' ? 'selected' : null) : @old('pendidikan') == 'Akademi/Diploma III/Sarjana Muda') ? 'selected' : null }}>
            Akademi/Diploma III/Sarjana Muda</option>
          <option value="Diploma IV/ Strata I"
            {{ (isset($edit) ? ($data->pendidikan == 'Diploma IV/ Strata I' ? 'selected' : null) : @old('pendidikan') == 'Diploma IV/ Strata I') ? 'selected' : null }}>
            Diploma IV/ Strata I</option>
          <option value="Strata II"
            {{ (isset($edit) ? ($data->pendidikan == 'Strata II' ? 'selected' : null) : @old('pendidikan') == 'Strata II') ? 'selected' : null }}>
            Strata II</option>
          <option value="Strata III"
            {{ (isset($edit) ? ($data->pendidikan == 'Strata III' ? 'selected' : null) : @old('pendidikan') == 'Strata III') ? 'selected' : null }}>
            Strata III</option>
        </select>
        @error('pendidikan')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-4 col-md-6">
        <label class="form-label">Pekerjaan</label>
        <select name="pekerjaan" id="pekerjaan" class="form-control @error('pekerjaan')is-invalid @enderror" required>
          <option value="" hidden>Pilih Pekerjaan</option>
          @foreach ($pekerjaan as $item)
            <option value="{{ $item->nama }}"
              {{ (isset($edit) ? ($item->nama == $data->pekerjaan ? 'selected' : null) : $item->nama == @old('pekerjaan')) ? 'selected' : null }}>
              {{ $item->nama }}
            </option>
          @endforeach
        </select>
        @error('pekerjaan')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <div class="mb-4 col-md-3">
        <label class="form-label">Agama</label>
        <select name="agama" id="agama" class="form-control @error('agama')is-invalid @enderror" required>
          <option value="" hidden>Pilih Agama</option>
          <option value="Islam"
            {{ (isset($edit) ? ($data->agama == 'Islam' ? 'selected' : null) : @old('agama') == 'Islam') ? 'selected' : null }}>
            Islam</option>
          <option value="Kristen"
            {{ (isset($edit) ? ($data->agama == 'Kristen' ? 'selected' : null) : @old('agama') == 'Kristen') ? 'selected' : null }}>
            Kristen</option>
          <option
            {{ (isset($edit) ? ($data->agama == 'Katolik' ? 'selected' : null) : @old('agama') == 'Katolik') ? 'selected' : null }}
            value="Katolik">Katolik</option>
          <option value="Konghucu"
            {{ (isset($edit) ? ($data->agama == 'Konghucu' ? 'selected' : null) : @old('agama') == 'Konghucu') ? 'selected' : null }}>
            Konghucu</option>
          <option value="Budha"
            {{ (isset($edit) ? ($data->agama == 'Budha' ? 'selected' : null) : @old('agama') == 'Budha') ? 'selected' : null }}>
            Budha</option>
          <option value="Hindu"
            {{ (isset($edit) ? ($data->agama == 'Hindu' ? 'selected' : null) : @old('agama') == 'Hindu') ? 'selected' : null }}>
            Hindu</option>
        </select>
        @error('agama')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-4 col-md-3">
        <label class="form-label">Jenis Kelamin</label>
        <select name="jenis_kelamin" id="" class="form-control @error('jenis_kelamin')is-invalid @enderror" required>
          <option value="" hidden>Pilih Jenis Kelamin</option>
          <option value="Laki-Laki"
            {{ (isset($edit) ? ($data->jenis_kelamin == 'Laki-Laki' ? 'selected' : null) : @old('jenis_kelamin') == 'Laki-Laki') ? 'selected' : null }}>
            Laki-Laki</option>
          <option value="Perempuan"
            {{ (isset($edit) ? ($data->jenis_kelamin == 'Perempuan' ? 'selected' : null) : @old('jenis_kelamin') == 'Perempuan') ? 'selected' : null }}>
            Perempuan</option>
        </select>
        @error('jenis_kelamin')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-4 col-md-3">
        <label class="form-label">Golongan Darah</label>
        <input type="text" name="golongan_darah" id="golongan_darah" class="form-control"
          value="{{ isset($data->golongan_darah) ? $data->golongan_darah : old('golongan_darah') }}">
        @error('golongan_darah')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-4 col-md-3">
        <label class="form-label">Umur</label>
        <input type="number" name="umur" id="umur" class="form-control"
          value="{{ isset($data->umur) ? $data->umur : old('umur') }}">
        @error('umur')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="row"></div>

      <div class="col-md-12"></div>
      <div class="mb-4 col-md-7">
        <label class="form-label">Alamat</label>
        <textarea name="alamat" id="" cols="28" rows="0" class="form-control  @error('alamat') is-invalid @enderror"
          style="height:130px !important"
          required>{{ isset($data->alamat) ? $data->alamat : @old('alamat') }}</textarea>
        @error('alamat')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="col-md-5">
        <div class="row">
          <div class="mb-4 col-md-12">
            <label class="form-label">Kelurahan</label>
            <select name="kelurahan" id="kelurahan" class="form-control kelurahan @error('kelurahan')is-invalid @enderror"
              required>
              <option value="" hidden>Pilih Kelurahan</option>
              @foreach ($kelurahan as $item)
                <option value="{{ $item->kelurahan }}" key="{{ $item->id }}"
                  {{ (isset($data->kelurahan) ? ($data->kelurahan == $item->kelurahan ? 'selected' : null) : @old('kelurahan') == $item->kelurahan) ? 'selected' : null }}>
                  {{ $item->kelurahan }}
                </option>
              @endforeach
            </select>
            @error('kelurahan')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-4 col-md-6">
            <label class="form-label">RW</label>
            <select name="rw" id="rw" class="form-control rw @error('rw')is-invalid @enderror" required>
              <option value="" hidden> Pilih RW</option>
              @if (isset($data->rw))
                @foreach ($rw as $item)
                  <option value="{{ $item->nomor_rw }}" key="{{ $item->nomor_rw }}" @if ($item->nomor_rw == $data->rw) {{ 'selected' }} @endif>
                    {{ $item->nomor_rw }}
                  </option>
                @endforeach
              @endif
            </select>
            @error('rw')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="mb-4 col-md-6">
            <label class="form-label">RT</label>
            <select name="rt" id="rt" class="form-control @error('rt')is-invalid @enderror" required>
              <option value="" hidden> Pilih RT</option>
              @if (isset($data->rt))
                @foreach ($rt as $item)
                  <option value="{{ $item->nomor_rt }}" key="{{ $item->nomor_rt }}" @if ($item->nomor_rt == $data->rt) {{ 'selected' }} @endif>
                    {{ $item->nomor_rt }}
                  </option>
                @endforeach
              @endif
            </select>
            @error('rt')
              <small class="text-danger">{{ $message }}</small>
            @enderror
          </div>
        </div>
      </div>
      <div class="row"></div>
      <div class="col-md-12"></div>
      <div class="mb-4 col-md-4">
        <label class="form-label">Status Keluarga</label>
        <select name="status_keluarga" id="status_keluarga"
          class="form-control @error('status_keluarga')is-invalid @enderror" required>
          <option value="" hidden>Pilih Status Keluarga</option>
          <option value="Kepala Keluarga"
            {{ (isset($edit) ? ($data->status_keluarga == 'Kepala Keluarga' ? 'selected' : null) : 'Kepala Keluarga' == @old('status_keluarga')) ? 'selected' : null }}>
            Kepala Keluarga</option>
          <option value="Istri"
            {{ (isset($edit) ? ($data->status_keluarga == 'Istri' ? 'selected' : null) : 'Istri' == @old('status_keluarga')) ? 'selected' : null }}>
            Istri</option>
          <option value="Anak"
            {{ (isset($edit) ? ($data->status_keluarga == 'Anak' ? 'selected' : null) : 'Anak' == @old('status_keluarga')) ? 'selected' : null }}>
            Anak</option>
          <option value="Mertua"
            {{ (isset($edit) ? ($data->status_keluarga == 'Mertua' ? 'selected' : null) : 'Mertua' == @old('status_keluarga')) ? 'selected' : null }}>
            Mertua</option>
          <option value="Orang Tua"
            {{ (isset($edit) ? ($data->status_keluarga == 'Orang Tua' ? 'selected' : null) : 'Orang Tua' == @old('status_keluarga')) ? 'selected' : null }}>
            Orang Tua</option>
          <option value="Famili Lain"
            {{ (isset($edit) ? ($data->status_keluarga == 'Famili Lain' ? 'selected' : null) : 'Famili Lain' == @old('status_keluarga')) ? 'selected' : null }}>
            Famili Lain</option>
          <option value="Cucu"
            {{ (isset($edit) ? ($data->status_keluarga == 'Cucu' ? 'selected' : null) : 'Cucu' == @old('status_keluarga')) ? 'selected' : null }}>
            Cucu</option>
        </select>
        @error('status_keluarga')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-4 col-md-4">
        <label class="form-label">Status Perkawinan</label>
        <select name="status_perkawinan" id="status_perkawinan"
          class="form-control @error('status_perkawinan')is-invalid @enderror" required>
          <option value="" hidden>Pilih Status Perkawinan</option>
          <option value="Kawin"
            {{ (isset($edit) ? ($data->status_perkawinan == 'Kawin' ? 'selected' : null) : 'Kawin' == @old('status_perkawinan')) ? 'selected' : null }}>
            Kawin</option>
          <option value="Belum Kawin"
            {{ (isset($edit) ? ($data->status_perkawinan == 'Belum Kawin' ? 'selected' : null) : 'Belum Kawin' == @old('status_perkawinan')) ? 'selected' : null }}>
            Belum Kawin</option>
          <option value="Cerai Mati"
            {{ (isset($edit) ? ($data->status_perkawinan == 'Cerai Mati' ? 'selected' : null) : 'Cerai Mati' == @old('status_perkawinan')) ? 'selected' : null }}>
            Cerai Mati</option>
          <option value="Kawin Tercatat"
            {{ (isset($edit) ? ($data->status_perkawinan == 'Kawin Tercatat' ? 'selected' : null) : 'Kawin Tercata' == @old('status_perkawinan')) ? 'selected' : null }}>
            Kawin Tercatat</option>
        </select>
        @error('status_perkawinan')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-4 col-md-4">
        <label class="form-label">Kewarganegaraan</label>
        <select name="kewarganegaraan" id="kewarganegaraan"
          class="form-control @error('kewarganegaraan')is-invalid @enderror" required>
          <option value="WNI"
            {{ (isset($edit) ? ($data->kewarganegaraan == 'WNI' ? 'selected' : null) : 'WNI' == @old('kewarganegaraa')) ? 'selected' : null }}>
            WNI</option>
          <option value="WNA"
            {{ (isset($edit) ? ($data->kewarganegaraa == 'WNA' ? 'selected' : null) : 'WNA' == @old('kewarganegaraa')) ? 'selected' : null }}>
            WNA</option>
        </select>
        @error('kewarganegaraan')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="col-md-12"></div>
      <div class="mb-4 col-md-6">
        <label class="form-label">Ayah</label>
        <input type="text" name="ayah" id="ayah" class="form-control"
          value="{{ isset($data->ayah) ? $data->ayah : old('ayah') }}">
        @error('ayah')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="mb-4 col-md-6">
        <label class="form-label">Ibu</label>
        <input type="text" name="ibu" id="ibu" class="form-control"
          value="{{ isset($data->ibu) ? $data->ibu : old('ibu') }}">
        @error('ibu')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
    </div>
    <div class="card-footer text-right align-right">
      <button type="submit" class="btn btn-primary ml-auto">Submit</button>
    </div>
  </form>
  </section>
@endsection
@push('javascripts')
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
  {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js">
  </script> --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.1.1/dist/select2-bootstrap-5-theme.min.css" />
  <script type="text/javascript">
    var url = {{ Request::segment(3) }}
    $(document).ready(function() {
      $(".js-example-basic-multiple").select2({
        theme: 'bootstrap-5',
        placeholder: "Pilih Nomor Kartu Keluarga",
      });
    });
  </script>
@endpush
