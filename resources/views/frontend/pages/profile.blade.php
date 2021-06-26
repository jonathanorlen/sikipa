@extends('frontend.layouts.user')
@section('header','sticky-top')
@section('content')
          <form action="/action_page.php" class="row">
            <div class="form-group mb-4 col-md-6">
              <label for="nama">Nama:</label>
              <input type="text" class="form-control" placeholder="Masukan Nama Anda" id="nama" value="{{ $item->nama }}">
            </div>
            <div class="form-group mb-4 col-md-6">
              <label for="nomor_telepon">Nomor Telepon:</label>
              <input type="nomor_telepon" class="form-control" placeholder="Masukan Nomor Telepon  Anda" id="nomor_telepon">
            </div>
            <div class="form-group mb-4 col-md-6">
              <label for="nik">Nik:</label>
              <input type="number" class="form-control" placeholder="Masukan Nik Anda" id="nik" value="{{ $item->nik }}">
            </div>
            <div class="form-group mb-4 col-md-6">
              <label for="nomor_kk">Nomor KK:</label>
              <input type="number" class="form-control" placeholder="Masukan Nomor KK Anda" id="nomor_kk" value="{{ $item->nomor_kk }}">
            </div>
            <div class="form-group mb-4 col-md-6">
              <label for="alamat">Alamat</label>
              <input type="text" class="form-control" placeholder="Masukan Alamat Anda" id="alamat" value="{{ $item->alamat }}">
            </div>
            <div class="form-group mb-4 col-md-3">
              <label for="rt">RT</label>
              <input type="number" class="form-control" placeholder="RT Anda" id="RT" value="{{ $item->rt }}">
            </div>
            <div class="form-group mb-4 col-md-3">
              <label for="RW">RW</label>
              <input type="number" class="form-control" placeholder="RW Anda" id="rw" value="{{ $item->rw }}">
            </div>
            <div class="form-group mb-4 col-md-4">
              <label for="agama">Agama</label>
              <select name="agama" id="agama" class="form-control">
                <option value="">PILIH AGAMA ANDA</option>
                <option value="">Islam</option>
                <option value="">Kristen</option>
                <option value="">Katolik</option>
                <option value="">Hindu</option>
                <option value="">Budha</option>
                <option value="">Konghucu</option>
              </select>
            </div>
            <div class="form-group mb-4 col-md-4">
              <label for="pendidikan">Pendidikan</label>
              <select name="pendidikan" id="pendidikan" class="form-control">
                <option value="">PILIH PENDIDIKAN ANDA</option>
              </select>
            </div>
            <div class="form-group mb-4 col-md-4">
              <label for="pekerjaan">Pekerjaan</label>
              <select name="pekerjaan" id="pekerjaan" class="form-control">
                <option value="">PILIH PEKERJAAN ANDA</option>
              </select>  
            </div>
            <div class="form-group mb-4 col-md-3">
              <label for="golongan_darah">Golongan Darah</label>
              <select name="golongan_darah" id="golongan_darah" class="form-control">
                <option value="">PILIH GOLONGAN DARAH</option>
                <option value="">A</option>
                <option value="">AB</option>
                <option value="">B</option>
                <option value="">O</option>
              </select>
            </div>
            <div class="form-group mb-4 col-md-3">
              <label for="status_keluarga">Status Keluarga</label>
              <select name="golongan_darah" id="golongan_darah" class="form-control">
                <option value="">PILIH STATUS KELUARGA ANDA</option>
              </select>
            </div>
            <div class="form-group mb-4 col-md-3">
              <label for="status_perkawinan">Status Perkawinan</label>
              <select name="status_perkawinan" id="golongan_darah" class="form-control">
                <option value="">PILIH STATUS Perkawinan</option>
              </select>
            </div>
            <div class="form-group mb-4 col-md-3">
              <label for="kewarganegaraam">Kewarganegaraan</label>
              <select name="kewarganegaraam" id="kewarganegaraam" class="form-control">
                <option value="">WNI</option>
                <option value="">WNA</option>
              </select>  
            </div>
            <div class="form-group mb-4 col-md-6">
              <label for="email">Ayah</label>
              <input type="email" class="form-control" placeholder="Masukan Email Anda" id="email">
            </div>
            <div class="form-group mb-4 col-md-6">
              <label for="email">Ibu</label>
              <input type="email" class="form-control" placeholder="Masukan Email Anda" id="email">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        
</section>
@endsection