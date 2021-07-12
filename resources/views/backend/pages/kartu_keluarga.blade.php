@extends('backend.layouts.app')
@section('title', 'Kartu Keluarga')
@section('header', 'Kartu Keluarga')
@section('breadcrumb')
  {{ Breadcrumbs::render('kartu_keluarga') }}
@endsection
@section('content')
  <div class="row mb-4">
    <div class="col-md-12">
      <a href="{{ route('admin.kartu-keluarga.create') }}" class="btn btn-icon btn-lg btn-info float-right"><i
          class="fas fa-plus"></i> Tambah</a>
      <a id="import-excel" data-toggle="modal" data-target="#modal-import"
        class="btn btn-icon btn-lg btn-success float-right mr-2"><i class="fas fa-file-download"></i> Import Excel</a>
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
            <form action="{{ route('admin.kartu-keluarga') }}" method="get"
              class="form-group w-25 float-right mb-0 mt-3 ml-3">
              <div class="input-group mb-3">
                <input type="text" name="search" value="{{ Request::get('search') }}" class="form-control"
                  placeholder="Search All" aria-label="">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">Button</button>
                </div>
              </div>
            </form>
            <div class="table-responsive">
              <table class="table table-striped table-md">
                <tbody>
                  <tr>
                    <th>#</th>
                    <th>Nomor KK</th>
                    <th>Anggota Keluarga</th>
                    <th>Action</th>
                  </tr>
                  @php
                    $no = 1;
                  @endphp
                  @foreach ($items as $key => $item)
                    <tr>
                      <td>{{ $items->firstItem() + $key }}</td>
                      <td>{{ $item->nomor_kk }}</td>
                      <td>{{ $item->email }}</td>
                      <td>
                        <a href="{{ route('admin.kartu-keluarga.edit', $item->nomor_kk) }}" class="btn btn-info"><i
                            class="fa fa-pencil-alt"></i>
                        </a>
                        {{-- <form action="{{ route('admin.kartu-keluarga.destroy', $item->nomor_kk) }}" method="post"
                          class="d-inline">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Are You Sure?')"><i
                              class="fa fa-trash"></i></button>
                        </form> --}}
                        <button
                          data-confirm="Apakah Yakin?|Jika menghapus data Nomor KK {{ $item->nomor_kk }} Maka akan menghapus semua data anggota keluarag, apakah anda yakin?"
                          data-confirm-yes="window.location ='{{ route('admin.kartu-keluarga.destroy', $item->nomor_kk) }}'"
                          class="btn btn-icon btn-danger" data-toggle="tooltip" title="Change Event Status">
                          <i class="fa fa-trash"></i>
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
            <nav class="d-inline-block">
              {{ $items->links('vendor.pagination.custom') }}
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
              <label for="">Upload Data Excel</label>
              <div class="progress mb-1" style="height:8px" id="progress">
                <div class="progress-bar" style="width:0%;height:20px"></div>
              </div>
              <input type="file" name="file" id="file" class="form-control">
              <div id="success"></div>
            </div>
          </div>
          <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button id="submit" class="btn btn-primary">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="{{ url('assets/modules/sweetalert/sweetalert.min.js') }}"></script>
  <script>
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
