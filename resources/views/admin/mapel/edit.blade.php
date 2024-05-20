@extends('template_backend.home')
@section('heading', 'Edit Data Mobil')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('mapel.index') }}">Mobil</a></li>
  <li class="breadcrumb-item active">Edit Data Mobil</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Data Mobil</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route('mapel.store') }}" method="post">
        @csrf
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
                <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                <div class="form-group">
                  <label for="nama_mapel">Nama Mobil</label>
                  <input type="text" id="nama_mapel" name="nama_mapel" value="{{ $mapel->nama_mapel }}" class="form-control @error('nama_mapel') is-invalid @enderror" placeholder="{{ __('Nama Mata Pelajaran') }}">
                </div>
                <div class="form-group">
                  <label for="paket_id">Paket</label>
                  <select id="paket_id" name="paket_id" class="form-control @error('paket_id') is-invalid @enderror select2bs4">
                    <option value="">-- Pilih Merk --</option>
                    <option value="9"
                        @if ($mapel->paket_id == '9')
                            selected
                        @endif
                    >Semua</option>
                    @foreach ($paket as $data)
                      <option value="{{ $data->id }}"
                        @if ($mapel->paket_id == $data->id)
                            selected
                        @endif
                      >{{ $data->ket }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="model">Model</label>
                  <input type="text" id="model" name="model" value="{{ $mapel->model }}" class="form-control @error('model') is-invalid @enderror" placeholder="{{ __('Model') }}">
                </div>
                <div class="form-group">
                  <label for="nopol">No. Plat</label>
                  <input type="text" id="nopol" name="nopol" value="{{ $mapel->nopol }}" class="form-control @error('nopol') is-invalid @enderror" placeholder="{{ __('No Plat') }}">
                </div>
                <div class="form-group">
                    <label for="kelompok">Tarif</label>
                    <select id="kelompok" name="kelompok" class="select2bs4 form-control @error('kelompok') is-invalid @enderror">
                        <option value="">-- Pilih Tarif --</option>
                        <option value="200000"
                            @if ($mapel->kelompok == '200000')
                                selected
                            @endif
                        >Mobil</option>
                        <option value="400000"
                            @if ($mapel->kelompok == '400000')
                                selected
                            @endif
                        >Mobil dan Supir</option>
                    </select>
                </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <a href="#" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
          <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Update</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#back').click(function() {
        window.location="{{ route('mapel.index') }}";
        });
    });
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataMapel").addClass("active");
</script>
@endsection