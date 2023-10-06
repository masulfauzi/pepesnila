@extends('layouts.app')

@section('page-css')
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Manajemen Data {{ $title }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <h6 class="card-header">
                Upload File Pendukung Alumni
            </h6>
            <div class="card-body">
                <div class="row">
                    <div class="col-10">
                    </div>
                    <div class="col-2">
                        <a href="{{ route('alumni.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
                @include('include.flash')
                <div class="table-responsive-md col-12">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th width="15">No</th>
                                <th>File</th>
                                <th>File Sekarang</th>
                                <th>Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Pas Foto 3x4</td>
                                <td>
                                    @if ($data->foto)
                                        <a target="_blank" href="{{ url('uploads/foto/'. $data->foto) }}">Lihat Foto</a>
                                    @else
                                        <span class="text-error">Belum Ada Data</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('alumni.aksi_upload.store', ["alumni" => $data->id]) }}">
                                        @csrf
                                        <input type="hidden" name="jenis" value="foto">
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <input type="file" name="file" class="form-control" required>
                                        <small class="text-danger">File yang bisa diterima adalah .pdf, .jpg, .jpeg, .png</small>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Kartu Keluarga</td>
                                <td>
                                    @if ($data->kk)
                                        <a target="_blank" href="{{ url('uploads/kk/'. $data->foto) }}">Lihat KK</a>
                                    @else
                                        <span class="text-error">Belum Ada Data</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('alumni.aksi_upload.store', ["alumni" => $data->id]) }}">
                                        @csrf
                                        <input type="hidden" name="jenis" value="kk">
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <input type="file" name="file" class="form-control" required>
                                        <small class="text-danger">File yang bisa diterima adalah .pdf, .jpg, .jpeg, .png</small>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Akta Kelahiran</td>
                                <td>
                                    @if ($data->akta_lahir)
                                        <a target="_blank" href="{{ url('uploads/akta_lahir/'. $data->akta_lahir) }}">Lihat Akta Kelahiran</a>
                                    @else
                                        <span class="text-error">Belum Ada Data</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('alumni.aksi_upload.store', ["alumni" => $data->id]) }}">
                                        @csrf
                                        <input type="hidden" name="jenis" value="akta_lahir">
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <input type="file" name="file" class="form-control" required>
                                        <small class="text-danger">File yang bisa diterima adalah .pdf, .jpg, .jpeg, .png</small>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Ijazah SMP</td>
                                <td>
                                    @if ($data->ijazah_smp)
                                        <a target="_blank" href="{{ url('uploads/ijazah_smp/'. $data->ijazah_smp) }}">Lihat Ijazah SMP</a>
                                    @else
                                        <span class="text-error">Belum Ada Data</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('alumni.aksi_upload.store', ["alumni" => $data->id]) }}">
                                        @csrf
                                        <input type="hidden" name="jenis" value="ijazah_smp">
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <input type="file" name="file" class="form-control" required>
                                        <small class="text-danger">File yang bisa diterima adalah .pdf, .jpg, .jpeg, .png</small>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>FC Rapor</td>
                                <td>
                                    @if ($data->fc_rapor)
                                        <a target="_blank" href="{{ url('uploads/fc_rapor/'. $data->fc_rapor) }}">Lihat FC Rapor</a>
                                    @else
                                        <span class="text-error">Belum Ada Data</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('alumni.aksi_upload.store', ["alumni" => $data->id]) }}">
                                        @csrf
                                        <input type="hidden" name="jenis" value="fc_rapor">
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <input type="file" name="file" class="form-control" required>
                                        <small class="text-danger">File yang bisa diterima adalah .pdf, .jpg, .jpeg, .png</small>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>FC Ijazah</td>
                                <td>
                                    @if ($data->fc_ijazah)
                                        <a target="_blank" href="{{ url('uploads/fc_ijazah/'. $data->fc_ijazah) }}">Lihat FC Ijazah</a>
                                    @else
                                        <span class="text-error">Belum Ada Data</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('alumni.aksi_upload.store', ["alumni" => $data->id]) }}">
                                        @csrf
                                        <input type="hidden" name="jenis" value="fc_ijazah">
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <input type="file" name="file" class="form-control" required>
                                        <small class="text-danger">File yang bisa diterima adalah .pdf, .jpg, .jpeg, .png</small>
                                        <br>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection

@section('page-js')
@endsection

@section('inline-js')
@endsection