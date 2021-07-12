@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('header')
  @if ($form == 'create')
    Tambah Kartu Keluarga
  @elseif($form == 'edit')
    Edit <span style="font-weight:normal;">{{ isset($item->nama) ? $item->nama : '' }}</span>
  @else
    Data <span style="font-weight:normal;">{{ isset($item->nama) ? $item->nama : '' }} </span>
  @endif
@endsection
@section('breadcrumb')
  @if ($form == 'create')
    {{ Breadcrumbs::render('kartu_keluarga.create') }}
  @elseif($form == 'edit')
    {{ Breadcrumbs::render('kartu_keluarga.edit', $item) }}
  @endif
@endsection
@section('content')
  <style>
    hr {
      margin-top: 1rem;
      margin-bottom: 1rem;
      border: 0;
      border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

  </style>
  <div class="section-body">
    <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <form
          action="{{ $form == 'create' ? route('admin.kartu-keluarga.store') : route('admin.kartu-keluarga.update', $item->nik) }}"
          method="POST" enctype="multipart/form-data">
          @csrf
          @if ($form == 'edit')
            @method('PUT')
          @endif
          <div class="card">
            <div class="card-body row pb-0">
              <div class="form-group col-md-6">
                <label>Nomor Kartu Keluarga</label>
                <input type="number" name="nomor_kk" id="nomor_kk"
                  class="form-control @error('nomor_kk')is-invalid @enderror"
                  value="{{ isset($item->nomor_kk) ? $item->nomor_kk : old('nomor_kk') }}">
                @error('nomor_kk')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label>Foto</label>
                <input type="file" name="foto" id="foto" class="form-control @error('foto')is-invalid @enderror"
                  value="{{ isset($item->foto) ? $item->foto : old('foto') }}">
                @error('foto')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
          </div>
          <div id="detination"></div>
          <div class="card" id="anggota-keluarga" style="display:none">
            <div class="card-body row">
              <div class="form-group col-md-4">
                <label>Nama</label>
                <input type="text" name="nama[]" id="nama" class="form-control @error('nama')is-invalid @enderror"
                  value="{{ isset($item->nama) ? $item->nama : old('nama') }}" required>
                @error('nama')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label>NIK</label>
                <input type="number" name="nik[]" id="nik" class="form-control @error('nik')is-invalid @enderror"
                  value="{{ isset($item->nik) ? $item->nik : old('nik') }}" required>
                @error('nik')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label>Foto</label>
                <input type="file" name="foto_ktp" id="foto" class="form-control @error('foto')is-invalid @enderror"
                  value="{{ isset($item->foto) ? $item->foto : old('foto') }}">
                @error('foto')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control"
                  value="{{ isset($item->email) ? $item->email : old('email') }}">
                @error('email')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                  class="form-control @error('email')is-invalid @enderror"
                  value="{{ isset($item->tanggal_lahir) ? $item->tanggal_lahir : old('tanggal_lahir') }}" required>
                @error('tanggal_lahir')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" id="" class="form-control @error('email')is-invalid @enderror" required>
                  <option value="" hidden>Pilih Jenis Kelamin</option>
                  <option value="Laki-Laki">Laki-Laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
                @error('jenis_kelamin')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-2">
                <label>Umur</label>
                <input type="number" name="umur" id="umur" class="form-control"
                  value="{{ isset($item->umur) ? $item->umur : old('umur') }}">
                @error('umur')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label>Agama</label>
                <select name="agama" id="agama" class="form-control @error('agama')is-invalid @enderror" required>
                  <option value="" hidden>Pilih Agama</option>
                  <option value="Islam">Islam</option>
                  <option value="Kristen">Kristen</option>
                  <option value="Katolik">Katolik</option>
                  <option value="Konghucu">Konghucu</option>
                  <option value="Budha">Budha</option>
                  <option value="Hindu">Hindu</option>
                </select>
                @error('agama')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label>Pendidikan</label>
                <select name="pendidikan" id="pendidikan" class="form-control @error('pendidikan')is-invalid @enderror"
                  required>
                  <option value="" hidden>Pilih Pendidikan</option>
                  <option value="Tidak/Belum Sekolah">Tidak/Belum Sekolah</option>
                  <option value="Belum Tamat SD/Sederajat">Belum Tamat SD/Sederajat</option>
                  <option value="SLTP/Sederajat">SLTP/Sederajat</option>
                  <option value="SLTA/Sederajat">SLTA/Sederajat</option>
                  <option value="Akademi/Diploma III/Sarjana Muda">Akademi/Diploma III/Sarjana Muda</option>
                  <option value="Diploma IV/ Strata I">Diploma IV/ Strata I</option>
                  <option value="Strata II">Strata II</option>
                  <option value="Strata III">Strata III</option>
                </select>
                @error('pendidikan')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label>Pekerjaan</label>
                <select name="pekerjaan" id="pekerjaan" class="form-control @error('pekerjaan')is-invalid @enderror"
                  required>
                  <option value="" hidden>Pilih Pekerjaan</option>
                  <option value="Guru">Guru</option>
                  <option value="Karyawan Swasta">Karyawan Swasta</option>
                  <option value="Wiraswasta">Wiraswasta</option>
                  <option value="Mengurus Rumah Tanggan">Mengurus Rumah Tanggan</option>
                  <option value="Pelajar/Mahasiswa">Pelajar/Mahasiswa</option>
                  <option value="Belum/Tidak Bekerja">Belum/Tidak Bekerja</option>
                  <option value="Pedagang">Pedagang</option>
                  <option value="Buruh Harian Lepas">Buruh Harian Lepas</option>
                </select>
                @error('pekerjaan')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="section-title">Alamat Rumah</div>
              <div class="col-md-12"></div>
              <div class="form-group col-md-7">
                <label>Alamat</label>
                <textarea name="alamat" id="" cols="30" rows="0"
                  class="form-control  @error('alamat') is-invalid @enderror" style="height:135px !important" required>

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
                        <option value="{{ $item->kelurahan }}" key="{{ $item->id }}">{{ $item->kelurahan }}
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
                    </select>
                    @error('rw')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="form-group col-md-6">
                    <label>RT</label>
                    <select name="rt" id="rt" class="form-control @error('rt')is-invalid @enderror required">
                    </select>
                    @error('rt')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="section-title">Status</div>
              <div class="col-md-12"></div>
              <div class="form-group col-md-4">
                <label>Status Keluarga</label>
                <select name="status_keluarga" id="status_keluarga"
                  class="form-control @error('status_keluarga')is-invalid @enderror" required>
                  <option value="" hidden>Pilih Status Keluarga</option>
                  <option value="Kepala Keluarga">Kepala Keluarga</option>
                  <option value="Istri">Istri</option>
                  <option value="Anak">Anak</option>
                  <option value="Mertua">Mertua</option>
                  <option value="Orang Tua">Orang Tua</option>
                  <option value="Famili Lain">Famili Lain</option>
                  <option value="Cucu">Cucu</option>
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
                  <option value="Kawinf">Kawin</option>
                  <option value="Belum Kawin">Belum Kawin</option>
                  <option value="Cerai Mati">Cerai Mati</option>
                  <option value="Kawin Tercatat">Kawin Tercatat</option>
                </select>
                @error('status_perkawinan')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-4">
                <label>Kewarganegaraan</label>
                <select name="kewarganegaraan" id="kewarganegaraan"
                  class="form-control @error('kewarganegaraan')is-invalid @enderror" required>
                  <option value="WNI">WNI</option>
                  <option value="WNA">WNA</option>
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
                  value="{{ isset($item->ayah) ? $item->ayah : old('ayah') }}">
                @error('ayah')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group col-md-6">
                <label>Ibu</label>
                <input type="text" name="ibu" id="ibu" class="form-control"
                  value="{{ isset($item->ibu) ? $item->ibu : old('ibu') }}">
                @error('ibu')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="section-title">Lain Lain</div>
              <div class="col-md-12"></div>
              <div class="form-group col-md-4">
                <label>Kategori Penduduk</label>
                <select name="kategori_penduduk" id="kategori_penduduk"
                  class="form-control @error('kewarganegaraan')is-invalid @enderror">
                  <option value="wna">WNA</option>
                  <option value="wni">WNI</option>
                </select>
                @error('kategori_penduduk')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <a href="#" class="btn btn-outline-secondary" onclick="copy()">Tambah Anggota</a>
              <button type="submit" class="btn btn-primary float-right">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@push('after-scripts')
  <script>
    let jumlah = 0;

    function copy() {
      $.ajax({
        url: '{{ route('admin.kartu-keluarga.card') }}',
        type: 'get',
        dataType: "json",
        beforeSend: function() {

        },
        success: function(rest) {

          $('#detination').append(rest.html);

          document.getElementById('kelurahan').id = 'kelurahan' + jumlah;
          document.getElementById('rw').id = 'rw' + jumlah;
          document.getElementById('rt').id = 'rt' + jumlah;

          document.getElementById('kelurahan' + jumlah)
            .setAttribute("key", jumlah);
          document.getElementById('rw' + jumlah)
            .setAttribute("key", jumlah);
          document.getElementById('rt' + jumlah)
            .setAttribute("key", jumlah);
        }
      });
    }

    function remove(el) {
      el.parentNode.parentNode.parentNode.remove();
    }

    $(document).ready(function() {
      $(document).on('change', '.kelurahan', function() {
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
            var select = $('#rw' + nomor + ' > option').length;
            if (select > 1) {
              $('#rw').empty()
            }
            $('#rt' + nomor).empty()
            $('#rw' + nomor).empty()

            var select = document.getElementById("rw" + nomor);

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

      $(document).on('change', '.rw', function() {
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
            var select = $('#rt' + nomor + ' > option').length;
            if (select > 1) {
              $('#rt' + nomor).empty()
            }

            var select = document.getElementById("rt" + nomor);

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
              option.setAttribute('key', res[i].nomor_rt);
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
