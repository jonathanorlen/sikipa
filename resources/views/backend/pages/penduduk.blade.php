@extends('backend.layouts.app')
@section('title', 'Penduduk')
@section('header', 'Penduduk')
@section('breadcrumb')
  {{ Breadcrumbs::render('penduduk') }}
@endsection
@push('styles')
  <link rel="stylesheet"
    href="{{ url('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ url('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endpush
@section('content')
  <div class="row mb-0">
    <div class="col-md-3 col-12">
      <div class="card card-statistic-2">
        <div class="card-icon bg-primary  m-2">
          <i class="far fa-user"></i>
        </div>
        <div class="card-wrap">
          <div class="card-header pt-2">
            <h4>Penduduk</h4>
          </div>
          <div class="card-body mt-1">
            <h4>{{ $items->count() }}</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 ml-auto">
      <a href="{{ route('admin.penduduk.create') }}" class="btn btn-icon btn-lg btn-info float-right  mb-2"><i
          class="fas fa-plus"></i> Tambah</a>
      {{-- <a id="import-excel" data-toggle="modal" data-target="#modal-import"
        class="btn btn-icon btn-lg btn-outline-light float-right mr-2"><i class="fas fa-file-upload"></i> Import Excel</a>
      <a id="export-excel" data-toggle="modal" data-target="#modal-export"
        class="btn btn-icon btn-lg btn-outline-light float-right mr-2"><i class="fas fa-file-download"></i> Export
        Excel</a> --}}
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
          <div class="card-body">
            {{-- <form action="{{ route('admin.penduduk.index') }}" method="get" class="form-row mb-0 mt-2 ml-3">
              <div class="col-md-2">
                <div class="message-toggle beep"></div>
              </div>
              <div class="form-group col-md-2 col-12 ml-auto">
                <select name="kelurahan" class="form-control kelurahan" id="kelurahan">
                  <option value="">Pilih Kelurahan</option>
                  @foreach ($kelurahan as $item)
                    <option value="{{ $item->kelurahan }}" key="{{ $item->id }}">{{ $item->kelurahan }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-md-2 col-6">
                <select name="rw" id="rw" class="form-control rw">
                  <option value="">Pilih RW</option>
                </select>
              </div>
              <div class="form-group col-md-2 col-6 mb-5 border-right">
                <select name=" rt" id="rt" class="form-control">
                  <option value="">Pilih RT</option>
                </select>
              </div>
              <div class="form-group col-md-3">
                <div class="input-group mb-3">
                  <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control"
                    placeholder="Search Nama" aria-label="">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </form> --}}
            <div class="table-responsive">
              <table class="table table-striped responsive table-md" id="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Kelurahan</th>
                    <th>RT</th>
                    <th>RW</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $no = 1;
                  @endphp
                  @foreach ($items as $key => $item)
                    <tr>
                      <td class="
                                                                                      @if ($item->
                        dokumen_ktp == '' ||
                        $item->dokumen_ktp ==
                        'Belum
                        Lengkap') border-left border-warning @endif
                        ">{{ ++$key }}</td>
                      <td>{{ $item->nama }}</td>
                      <td>{{ $item->kelurahan }}</td>
                      <td>{{ $item->rt }}</td>
                      <td>{{ $item->rw }}</td>
                      <td>
                        <a href="{{ route('admin.penduduk.show', $item->nik) }}" class="btn btn-info"><i
                            class="fa fa-eye"></i></a>
                        <a href="{{ route('admin.penduduk.ganti_status', $item->nik) }}" class="btn btn-info">
                          <i class="fas fa-toggle-on"></i>
                        </a>
                        <button data-confirm="Hapus Data|Apakah anda yakin akan menghapus data {{ $item->nama }} ?"
                          data-confirm-yes="window.location ='{{ route('admin.penduduk.destroy', $item->nik) }}'"
                          class="btn btn-icon btn-danger" data-toggle="tooltip" title="Change Event Status"><i
                            class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                    @php
                      $no++;
                    @endphp
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer text-right">
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('after-scripts')
  <script src="{{ url('assets/modules/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
  {{-- <script src="{{ url('assets/modules/datatables/Responsive-2.2.1/js/responsive.bootstrap4.min.js') }}"></script> --}}
  {{-- <script src="{{ url('assetsmodules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script> --}}
  <script src="{{ url('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
  <script>
    $("#table").DataTable({
      "columnDefs": [{
        "sortable": false,
        "targets": [5]
      }]
    });

    $(document).ready(function() {
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
