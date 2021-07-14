@extends('backend.layouts.app')
@section('title', 'Dashboard')
@section('header')
  @if (!isset($edit))
    Tambah Pekerjaan
  @else
    Edit <span style="font-weight:normal;">{{ isset($item->nama) ? $item->nama : '' }}</span>
  @endif
@endsection
@section('breadcrumb')
  @if (!isset($edit))
    {{ Breadcrumbs::render('pekerjaan.create') }}
  @else
    {{ Breadcrumbs::render('pekerjaan.edit', $item) }}
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
        <form action="{{ !isset($edit) ? route('admin.pekerjaan.store') : route('admin.pekerjaan.update', $item->id) }}"
          method="POST" enctype="multipart/form-data">
          @csrf
          @if (isset($edit))
            @method('PUT')
          @endif
          <div class="card">
            <div class="card-body row pb-0">
              <div class="form-group col-md-12">
                <label>Nama Pekerjaan</label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama')is-invalid @enderror"
                  value="{{ isset($item->nama) ? $item->nama : old('nama') }}">
                @error('nama')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-primary float-right">Submit</button>
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
