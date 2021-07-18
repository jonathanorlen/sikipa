@extends('backend.layouts.app')
@section('title', 'Keluarga')
@section('header', 'Keluarga')
@section('breadcrumb')
  {{ Breadcrumbs::render('kartu_keluarga.list', $nomor_kk) }}
@endsection
@section('content')
  <div class="row mb-4">
    <div class="col-md-12">
      {{-- <a href="{{ route('admin.kartu-keluarga.create') }}" class="btn btn-icon btn-lg btn-info float-right"><i
          class="fas fa-plus"></i> Tambah</a> --}}
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
            <div class="table-responsive">
              <table class="table table-striped table-md">
                <tbody>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Anggota</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Action</th>
                  </tr>
                  @php
                    $no = 1;
                  @endphp
                  @foreach ($items as $key => $item)
                    <tr>
                      <td>{{ ++$key }}</td>
                      <td>{{ $item->nama }}</td>
                      <td>{{ $item->status_keluarga }}</td>
                      <td>{{ $item->tempat_lahir }}</td>
                      <td>{{ date('d M Y', strtotime($item->tanggal_lahir)) }}</td>
                      <td>{{ $item->jenis_kelamin }}</td>
                      <td>
                         <a href="{{ route('admin.kartu-keluarga.detail', [$item->nomor_kk,$item->nik]) }}" class="btn btn-info"><i
                            class="fa fa-eye"></i>
                        </a>
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
            <nav class="d-inline-block">
              {{-- {{ $items->links('vendor.pagination.custom') }} --}}
              {{-- <ul class="pagination mb-0">
                          <li class="page-item disabled">
                              <a class="page-link" href="#" tabindex="-1"><i
                                      class="fas fa-chevron-left"></i></a>
                          </li>
                          <li class="page-item active"><a class="page-link" href="#">1 <span
                                      class="sr-only">(current)</span></a></li>
                          <li class="page-item">
                              <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item">
                              <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                          </li>
                      </ul> --}}
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('after-scripts')
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-export">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Export Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="export-data" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="modal-body p-3">
            {{-- <div class="alert alert-danger alert-dismissible fade hide" role="alert" id="alert-error">
              <ul id="error" class="mb-0">

              </ul>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="alert alert-success alert-dismissible fade hide" role="alert" id="alert-success">
              <span id="error-import-message">Data Berhasil Di Upload
              </span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> --}}
            <div class="form-group">
              <label for="">Agama</label>
              <select name="agama" id="agama" class="form-control" onchange="get_view()">
                <option value="">Pilih Agama</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="Konghucu">Konghucu</option>
              </select>
            </div>
            <div class="form-row">
              <div class="form-group col-6">
                <label for="">Umur</label>
                <input type="number" name="umur_awal" id="umur_awal" class="form-control" placeholder="Umur Awal" onchange="get_view()">
              </div>
              <div class="form-group col-6">
                <label for="">&nbsp</label>
                <input type="number" name="umur_akhir" id="umur_akhir" class="form-control" placeholder="Umur Akhir" onchange="get_view()">
              </div>
            </div>
            <div class="form-group">
              <label>Pendidikan</label>
              <select name="pendidikan" id="pendidikan" class="form-control @error('pendidikan')is-invalid @enderror"
                onchange="get_view()">
                <option value="">Pilih Pendidikan</option>
                <option value="Tidak/Belum Sekolah">Tidak/Belum Sekolah</option>
                <option value="Belum Tamat SD/Sederajat">Belum Tamat SD/Sederajat</option>
                <option value="SLTP/Sederajat">SLTP/Sederajat</option>
                <option value="SLTA/Sederajat">SLTA/Sederajat</option>
                <option value="Akademi/Diploma III/Sarjana Muda">Akademi/Diploma III/Sarjana Muda</option>
                <option value="Diploma IV/ Strata I">Diploma IV/ Strata I</option>
                <option value="Strata II">Strata II</option>
                <option value="Strata III">Strata III</option>
              </select>
            </div>
            <div class="form-group">
              <label>Status Keluarga</label>
              <select name="status_keluarga" id="status_keluarga"
                class="form-control @error('status_keluarga')is-invalid @enderror" onchange="get_view()">
                <option value="">Pilih Status Keluarga</option>
                <option value="Kepala Keluarga">Kepala Keluarga</option>
                <option value="Istri">Istri</option>
                <option value="Anak">Anak</option>
                <option value="Mertua">Mertua</option>
                <option value="Orang Tua">Orang Tua</option>
                <option value="Famili Lain">Famili Lain</option>
                <option value="Cucu">Cucu</option>
              </select>
            </div>
            <div class="form-group">
              <label>Pekerjaan</label>
              <select name="pekerjaan" id="pekerjaan" class="form-control @error('pekerjaan')is-invalid @enderror"
                onchange="get_view()">
                <option value="">Pilih Pekerjaan</option>
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
            <div class="form-group">
              <label>Kewarganegaraan</label>
              <select name="kewarganegaraan" id="kewarganegaraan"
                class="form-control @error('kewarganegaraan')is-invalid @enderror" onchange="get_view()">
                <option value="">Pilih Kewarganegaraan</option>
                <option value="WNI">WNI</option>
                <option value="WNA">WNA</option>
              </select>
              @error('kewarganegaraan')
                <small class="text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label>Jenis Kelamin</label>
              <select name="jenis_kelamin" id="" class="form-control @error('email')is-invalid @enderror"
                onchange="get_view()">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
              </select>
            </div>
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" id="export-btn">Export
              <span class="badge badge-secondary" id="jumlah-import"></span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="modal fade" tabindex="-1" role="dialog" id="modal-import">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Import Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="import-data" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="modal-body p-3">
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-error">
              <ul id="error" class="mb-0">

              </ul>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
              <span id="error-import-message">Data Berhasil Di Upload
              </span>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="form-group">
              <label for="">Download Data Excel</label>
              <input type="file" name="file" id="file" class="form-control">
              <div id="success"></div>
            </div>
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <a href="{{ url('Import Penduduk.xlsx') }}" class="btn btn-outline-success ml-0 mr-auto">Excel Template</a>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="{{ url('assets/modules/sweetalert/sweetalert.min.js') }}"></script>
  <script>
    function get_view(e) {
      let form_data = $("#export-data").serialize();
      $.ajax({
        url: "{{ route('admin.kartu-keluarga.getexport') }}",
        type: "GET",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success: function(response) {
          if (response.code == 200) {
            if (response.jumlah == 0) {
              $("#export-btn").prop('disabled', true);
            }else{
              $("#export-btn").prop('disabled', false);
            }
            $("#jumlah-import").html(response.jumlah);
          } else {
            $("#jumlah-import").html(0);
            $("#export-btn").prop('disabled', true);
          }
        },
        error: function(response) {
          console.log('error');
          console.log(response);
        },
      });
    }

    $('#export-data').on('submit', function(e) {
      e.preventDefault();
      let form_data = $("#export-data").serialize();
      $.ajax({
        url: "{{ route('admin.kartu-keluarga.export') }}",
        type: "GET",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        // beforeSend: function() {
        //   $("#progress").show();
        // },
        success: function (response, status, xhr) {
                // check for a filename
                var filename = "";
                var disposition = xhr.getResponseHeader('Content-Disposition');
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    var matches = filenameRegex.exec(disposition);
                    if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                }

                var type = xhr.getResponseHeader('Content-Type');
                var blob = new Blob([response], { type: type });

                if (typeof window.navigator.msSaveBlob !== 'undefined') {
                    // IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                    window.navigator.msSaveBlob(blob, filename);
                } else {
                    var URL = window.URL || window.webkitURL;
                    var downloadUrl = URL.createObjectURL(blob);

                    if (filename) {
                        // use HTML5 a[download] attribute to specify filename
                        var a = document.createElement("a");
                        // safari doesn't support this yet
                        if (typeof a.download === 'undefined') {
                            window.location = downloadUrl;
                        } else {
                            a.href = downloadUrl;
                            a.download = filename;
                            document.body.appendChild(a);
                            a.click();
                        }
                    } else {
                        window.location = downloadUrl;
                    }

                    setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
                }

            },
        error: function(response) {
          console.log('error');
          console.log(response);
        },
      });
    });

    $("#alert-error").hide();
    $("#alert-success").hide();
    $("#progress").hide();

    $('#import-data').on('submit', function(e) {
      e.preventDefault();
      console.log($('#file').val());
      if ($('#file').val() == '') {
        $("#alert-error").show();
        let ul = document.getElementById("error");
        let list = document.createElement("li");
        list.innerHTML = "Masukan file excel";
        ul.innerHTML = "";
        ul.appendChild(list);
        return true;
      } else {
        e.preventDefault();
        var file_data = $('#file').prop('files')[0];
        var token = $('input[name="_token"]').val();
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('_token', token);
        $.ajax({
          url: "{{ route('admin.kartu-keluarga.import') }}",
          type: "POST",
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          // beforeSend: function() {
          //   $("#progress").show();
          // },
          success: function(response) {
            if (response.code == 200) {
              $("#alert-success").show();
              window.setTimeout('refresh()', 3000);
            } else {
              $("#alert-error").show();
              let ul = document.getElementById("error");
              ul.innerHTML = "";
              response.message.forEach(data => {
                let list = document.createElement("li");
                list.innerHTML = "Baris ke " + data.row + " " + data.errors[0];
                ul.appendChild(list);
              });
            }
          },
          error: function(response) {
            console.log('error');
            console.log(response);
          },
        });
      }
    });

    function refresh() {
      window.location.reload();
    }
  </script>
@endpush
