@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('header')
  RW <span class="text-secondary">Kelurahan {{ $kelurahan->kelurahan }}<span>
    @endsection
    @section('breadcrumb')
      {{ Breadcrumbs::render('rw', $kelurahan) }}
    @endsection
    @section('content')
      {{-- <div class="row mb-4">
    <div class="col-md-12">
        <a href="{{route('admin.kelurahan.create')}}" class="btn btn-icon btn-lg btn-info float-right">
            <i class="fas fa-plus"></i> 
            Tambah RW
        </a>
    </div>
  </div> --}}
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
              <div class="card-body">
                <div class="row align-items-start" dir='rtl'>
                  <div class="col-md-4 sticky-top pt-4 pt-md-1 bg-white">
                    <form action="{{ route('admin.rw.store') }}" method="POST">
                      @csrf
                      <div class="input mb-3">
                        <input type="hidden" name="kelurahan" value="{{ $kelurahan->kelurahan }}">
                        <input type="hidden" name="kelurahan_id" value="{{ $kelurahan->id }}">
                        <input type="number" name="nomor_rw" class="form-control text-left"
                          placeholder="Masukan Nomor RW cont:1, 2, 3" aria-label="">
                        @error('nomor_rw')
                          <small id="emailHelp" class="text-danger">{{ $message }}</small>
                        @enderror
                        <button type="submit" class="btn btn-primary btn-block mt-3">Tambah <i
                            class="fas fa-plus"></i></button>
                      </div>
                    </form>
                  </div>
                  <div class="col-md-8 mt-5 mt-md-0">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Action</th>
                          <th scope="col">Jumlah RT</th>
                          <th scope="col">RW</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($items as $item)
                          <tr>
                            <td>
                              <form action="{{ route('admin.rw.destroy', $item->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure?')"><i
                                    class="fa fa-trash"></i></button>
                              </form>
                              <a href="{{ route('admin.rt', [strtolower($kelurahan->kelurahan), $item->nomor_rw]) }}"
                                type="submit" class="btn btn-info">
                                <i class="fa fa-plus"></i>
                              </a>
                            </td>
                            <th scope="row">{{ $item->rts->count() }}</th>
                            <td>{{ $item->nomor_rw }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endsection

    @push('page-scripts')

    @endpush
