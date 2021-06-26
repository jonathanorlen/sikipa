@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('header')
    @if ($form == 'create')
        Tambah Penduduk
    @elseif($form == 'edit')
        Edit <span style="font-weight:normal;">{{isset($item->nama)?$item->nama:''}}</span>
    @else
        Data <span style="font-weight:normal;">{{isset($item->nama)?$item->nama:''}} </span>
    @endif
@endsection
@section('breadcrumb')
    @if ($form == 'create')
        {{ Breadcrumbs::render('penduduk.create') }}
    @elseif($form == 'edit')
        {{ Breadcrumbs::render('penduduk.edit', $item) }}
    @else
        {{ Breadcrumbs::render('penduduk.detail', $item) }}
    @endif
@endsection
@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card">
                <form action="{{($form=='create')?route('penduduk.store'):route('penduduk.update',$item->nik)}}" method="POST" enctype="multipart/form-data">
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
                        <input type="text" name="name" id="name" class="form-control" value="{{isset($item->name)?$item->name:old('name')}}">
                        @error('name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>NIK</label>
                        <input type="number" name="nik" id="nik" class="form-control" value="{{isset($item->nik)?$item->nik:old('nik')}}">
                        @error('nik')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Nomer KK</label>
                        <input type="number" name="nomor_kk" id="nomor_kk" class="form-control" value="{{isset($item->nomor_kk)?$item->nomor_kk:old('nomor_kk')}}">
                        @error('nomor_kk')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-8">
                        <label>Alamat</label>
                        <input type="number" name="alamat" id="alamat" class="form-control" value="{{isset($item->alamat)?$item->alamat:old('alamat')}}">
                        @error('alamat')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label>RT</label>
                        <input type="number" name="rt" id="rt" class="form-control" value="{{isset($item->rt)?$item->rt:old('rt')}}">
                        @error('rt')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label>RW</label>
                        <input type="number" name="rw" id="rw" class="form-control" value="{{isset($item->rw)?$item->rw:old('rw')}}">
                        @error('rw')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Umur</label>
                        <input type="number" name="umur" id="umur" class="form-control" value="{{isset($item->umur)?$item->umur:old('umur')}}">
                        @error('umur')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                                <option value="">PILIH JENIS KELAMIN</option>
                                <option value="Laki-Laki" 
                                    {{ isset($item->jenis_kelamin)?($item->jenis_kelamin == 'Laki-Laki')?'selected':'':'' }}
                                    >Laki - Laki</option>
                                <option
                                {{ isset($item->jenis_kelamin)?($item->jenis_kelamin == 'Perempuan')?'selected':'':'' }}
                                value="Perempuan">Perempuan</option>
                            </select>
                        @error('nomor_kk')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Agama</label>
                        <input type="text" name="agama" id="agama" class="form-control" value="{{isset($item->agama)?$item->agama:old('agama')}}">
                        @error('agama')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Pendidikan</label>
                        <input type="text" name="pendidikan" id="pendidikan" class="form-control" value="{{isset($item->pendidikan)?$item->pendidikan:old('pendidikan')}}">
                        @error('pendidikan')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Pekerjaan</label>
                        <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="{{isset($item->pekerjaan)?$item->pekerjaan:old('pekerjaan')}}">
                        @error('pekerjaan')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Golongan Darah</label>
                        <input type="text" name="golongan_darah" id="golongan_darah" class="form-control" value="{{isset($item->golongan_darah)?$item->golongan_darah:old('golongan_darah')}}">
                        @error('golongan_darah')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Status Keluarga</label>
                        <input type="text" name="status_keluarga" id="status_keluarga" class="form-control" value="{{isset($item->status_keluarga)?$item->status_keluarga:old('status_keluarga')}}">
                        @error('status_keluarga')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Status Perkawinan</label>
                        <input type="text" name="status_perkawinan" id="status_perkawinan" class="form-control" value="{{isset($item->status_perkawinan)?$item->status_perkawinan:old('status_perkawinan')}}">
                        @error('status_perkawinan')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Kewarganegaraan</label>
                        <input type="text" name="kewarganegaraan" id="kewarganegaraan" class="form-control" value="{{isset($item->kewarganegaraan)?$item->kewarganegaraan:old('kewarganegaraan')}}">
                        @error('kewarganegaraan')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Ayah</label>
                        <input type="text" name="ayah" id="ayah" class="form-control" value="{{isset($item->ayah)?$item->ayah:old('ayah')}}">
                        @error('ayah')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Ibu</label>
                        <input type="text" name="ibu" id="ibu" class="form-control" value="{{isset($item->ibu)?$item->ibu:old('ibu')}}">
                        @error('ibu')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{isset($item->email)?$item->email:old('email')}}">
                        @error('email')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{isset($item->tanggal_lahir)?$item->tanggal_lahir:old('tanggal_lahir')}}">
                        @error('tanggal_lahir')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                {{-- <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div> --}}
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('page-scripts')

@endpush
