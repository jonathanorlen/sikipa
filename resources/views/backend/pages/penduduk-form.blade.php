@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('header')
  @if (!isset($edit))
    Tambah Penduduk
  @else
    Data <span style="font-weight:normal;">{{ isset($data->nama) ? $data->nama : '' }} </span>
  @endif
@endsection
@section('breadcrumb')
  @if (!isset($edit))
    {{ Breadcrumbs::render('penduduk.create') }}
  @else
    {{ Breadcrumbs::render('penduduk.data', $data) }}
  @endif
@endsection
@push('styles')
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <style>
    .select2 {
      width: 100% !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
      color: #444;
      line-height: 300%;
    }

    .select2-container.select2-container--open .select2-selection--single {
      background-color: #fefeff;
      border-color: red !important;
    }

  </style>
@endpush
@section('content')
  <div class="section-body">
    <div class="row">
      @if (isset($edit))
        <div class="col-md-12 pr-3" id="btn-edit">
          <a id="import-excel" class="btn btn-icon btn-lg btn-outline-light float-right mb-2" onclick="show()"><i
              class="fas fa-edit"></i>
            Edit</a>
        </div>
        <div class="col-md-12 pr-3" id="btn-close">
          <a id="import-excel" class="btn btn-icon btn-lg btn-outline-danger float-right mb-2" onclick="hide()"><i
              class="fas fa-close"></i>
            Close</a>
        </div>
      @endif
      <div class="col-12 col-md-12 col-lg-12">
        {{-- @if ($errors->any())
          <div class="alert alert-danger">
            <p><strong>Opps Something went wrong</strong></p>
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif --}}
        <div class="card">
          <form
            action="{{ !isset($edit) ? route('admin.penduduk.store') : route('admin.penduduk.update', $data->nik) }}"
            method="POST" enctype="multipart/form-data" id="form">
            @csrf
            @if (isset($edit))
              @method('PUT')
            @endif
            <div class="card-body row pb-0">
              <div class="form-group col-md-4">
                <label>Nama</label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama')is-invalid @enderror"
                  value="{{ isset($data->nama) ? $data->nama : old('nama') }}" required>
                @error('nama')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label>Nomor KK</label>
                <select class="form-control js-example-basic-multiple @error('nomor_kk')is-invalid @enderror"
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
              <div class="form-group col-md-4">
                <label>NIK</label>
                <input type="text" name="nik" id="nik" class="form-control @error('nik')is-invalid @enderror"
                  value="{{ isset($data->nik) ? $data->nik : old('nik') }}" required>
                @error('nik')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control"
                  value="{{ isset($data->email) ? $data->email : old('email') }}">
                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label>Tempat lahir</label>
                <input type="text" name="tempat_lahir" id="tempat_lahir"
                  class="form-control @error('tempat_lahir')is-invalid @enderror"
                  value="{{ isset($data->tempat_lahir) ? $data->tempat_lahir : old('tempat_lahir') }}" required>
                @error('tempat_lahir')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                  class="form-control @error('tanggal_lahir')is-invalid @enderror"
                  value="{{ isset($data->tanggal_lahir) ? $data->tanggal_lahir : old('tanggal_lahir') }}" required>
                @error('tanggal_lahir')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label>Pendidikan</label>
                <select name="pendidikan" id="pendidikan" class="form-control @error('pendidikan')is-invalid @enderror"
                  required>
                  <option value="" hidden>Pilih Pendidikan</option>
                  <option value="Tidak/Belum Sekolah"
                    {{ (isset($edit) ? ($data->pendidikan == 'Tidak/Belum Sekolah' ? 'selected' : null) : @old('pendidikan') == 'Tidak/Belum Sekolah') ? 'selected' : null }}>
                    Tidak/Belum Sekolah</option>
                  <option value="Belum Tamat SD/Sederajat"
                    {{ (isset($edit) ? ($data->pendidikan == 'Belum Tamat SD/Derajat' ? 'selected' : null) : @old('pendidikan') == 'Belum Tamat SD/Derajat') ? 'selected' : null }}>
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
              <div class="form-group col-md-6">
                <label>Pekerjaan</label>
                <select name="pekerjaan" id="pekerjaan" class="form-control @error('pekerjaan')is-invalid @enderror"
                  required>
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

              <div class="form-group col-md-3">
                <label>Agama</label>
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
              <div class="form-group col-md-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" id="" class="form-control @error('jenis_kelamin')is-invalid @enderror"
                  required>
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
              <div class="form-group col-md-3">
                <label>Golongan Darah</label>
                <input type="text" name="golongan_darah" id="golongan_darah" class="form-control"
                  value="{{ isset($data->golongan_darah) ? $data->golongan_darah : old('golongan_darah') }}">
                @error('golongan_darah')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-3">
                <label>Umur</label>
                <input type="number" name="umur" id="umur" class="form-control"
                  value="{{ isset($data->umur) ? $data->umur : old('umur') }}">
                @error('umur')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="row"></div>
              <div class="section-title">Alamat Rumah</div>
              <div class="col-md-12"></div>
              <div class="form-group col-md-7">
                <label>Alamat</label>
                <textarea name="alamat" id="" cols="30" rows="0"
                  class="form-control  @error('alamat') is-invalid @enderror" style="height:135px !important" required>
                                                                                                                                                                            {{ isset($data->alamat) ? $data->alamat : @old('alamat') }}
                                                                                                                                                                        </textarea>
                @error('alamat')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="col-md-5">
                <div class="row">
                  <div class="form-group col-md-12">
                    <label>Kelurahan</label>
                    <select name="kelurahan" id="kelurahan"
                      class="form-control kelurahan @error('kelurahan')is-invalid @enderror" required>
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
                  <div class="form-group col-md-6">
                    <label>RW</label>
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
                  <div class="form-group col-md-6">
                    <label>RT</label>
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
              <div class="section-title">Status</div>
              <div class="col-md-12"></div>
              <div class="form-group col-md-4">
                <label>Status Keluarga</label>
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
              <div class="form-group col-md-4">
                <label>Status Perkawinan</label>
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
              <div class="form-group col-md-4">
                <label>Kewarganegaraan</label>
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
              <div class="section-title">Orang Tua</div>
              <div class="col-md-12"></div>
              <div class="form-group col-md-6">
                <label>Ayah</label>
                <input type="text" name="ayah" id="ayah" class="form-control"
                  value="{{ isset($data->ayah) ? $data->ayah : old('ayah') }}">
                @error('ayah')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label>Ibu</label>
                <input type="text" name="ibu" id="ibu" class="form-control"
                  value="{{ isset($data->ibu) ? $data->ibu : old('ibu') }}">
                @error('ibu')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="section-title">Lain Lain</div>
              <div class="col-md-12"></div>
              <div class="form-group col-md-4">
                <label>Kategori Penduduk</label>
                <select name="kategori_penduduk" id="kategori_penduduk"
                  class="form-control @error('kategori_penduduk')is-invalid @enderror">
                  <option value="Tetap"
                    {{ (isset($edit) ? ($data->kategori_penduduk == 'Tetap' ? 'selected' : null) : 'Tetap' == @old('kategori_penduduk')) ? 'selected' : null }}>
                    Tetap</option>
                  <option value="Kontrak"
                    {{ (isset($edit) ? ($data->kategori_penduduk == 'Kontrak' ? 'selected' : null) : 'Kontrak' == @old('kategori_penduduk')) ? 'selected' : null }}>
                    Kontrak</option>
                  <option value="Pendatang"
                    {{ (isset($edit) ? ($data->kategori_penduduk == 'Pendatang' ? 'selected' : null) : 'Pendatang' == @old('kategori_penduduk')) ? 'selected' : null }}>
                    Pendatang</option>
                  <option value="Anak Kost"
                    {{ (isset($edit) ? ($data->kategori_penduduk == 'Anak Kost' ? 'selected' : null) : 'Anak Kost' == @old('kategori_penduduk')) ? 'selected' : null }}>
                    Anak Kost</option>
                </select>
                @error('kategori_penduduk')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label>Foto KTP</label>
                <input type="file" name="ktp" id="ktp" class="form-control @error('ktp')is-invalid @enderror">
                @error('ktp')
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

@push('after-scripts')
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js">
  </script>
  <script type="text/javascript">
    var url = {{ Request::segment(3) }}
    if (url != 'create') {
      hide();
    }

    function hide() {
      $("#form input").prop("disabled", true);
      $("#form select").prop("disabled", true);
      $("#form textarea").prop("disabled", true);
      $("#btn-close").hide();
      $("#btn-edit").show();
      $(".card-footer").hide()
    }

    function show() {
      $("#form input").prop("disabled", false);
      $("#form select").prop("disabled", false);
      $("#form textarea").prop("disabled", false);
      $(".card-footer").show()
      $("#btn-close").show();
      $("#btn-edit").hide();
    }

    $(document).ready(function() {
      $(".js-example-basic-multiple").select2({
        placeholder: "Pilih Nomor Kartu Keluarga",
      });

      $(document).on('change', '#kelurahan', function() {
        let nomor = $(this).attr('key');
        let val = $('option:selected', this).attr('key');
        $.ajax({
          url: '{{ route('admin.getrw') }}',
          data: {
            id: val
          },
          type: 'get',
          dataType: 'json',
          beforeSend: function() {

          },
          success: function(res) {
            var select = $('#rw > option').length;
            if (select > 1) {
              $('#rw').empty()
            }
            $('#rt').empty()
            $('#rw').empty()

            var select = document.getElementById("rw");

            var choose = document.createElement("option");
            choose.text = 'Pilih RW';
            choose.disabled = "disabled";
            choose.selected = "selected";
            choose.hidden = "hidden";

            select.appendChild(choose);

            for (i = 0; i < res.length; i++) {
              var option = document.createElement("option");
              option.text = res[i].nomor_rw;
              option.value = res[i].nomor_rw;
              option.setAttribute('key', res[i].id);
              select.appendChild(option);
            }
          },
          error: function() {
            alert('Not Valid');
          }
        })
      })

      $(document).on('change', '#rw', function() {
        let nomor = $(this).attr('key');
        let val = $('option:selected', this).attr('key');
        console.log(val);
        $.ajax({
          url: '{{ route('admin.getrt') }}',
          data: {
            id: val
          },
          type: 'get',
          dataType: 'json',
          beforeSend: function() {

          },
          success: function(res) {
            var select = $('#rt > option').length;
            if (select > 1) {
              $('#rt').empty()
            }

            var select = document.getElementById("rt");

            var choose = document.createElement("option");
            choose.text = 'Pilih RT';
            choose.disabled = "disabled";
            choose.selected = "selected";
            choose.hidden = "hidden";

            select.appendChild(choose);

            for (i = 0; i < res.length; i++) {
              var option = document.createElement("option");
              option.text = res[i].nomor_rt;
              option.value = res[i].nomor_rt;
              option.setAttribute('key', res[i]);
              select.appendChild(option);
            }
          },
          error: function() {
            alert('Not Valid');
          }
        })
      })
    })
  </script>
@endpush
