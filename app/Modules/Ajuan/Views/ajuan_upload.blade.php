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
                Upload File Pendukung Ajuan
            </h6>
            <div class="card-body">
                <div class="row">
                    <div class="col-10">
                        
                    </div>
                    <div class="col-2">  
						<a href="{{ route('ajuan.index') }}" class="btn btn-primary"><i class="fa fa-solid fa-arrow-left"></i> Kembali</a> 
                    </div>
                </div>
                @include('include.flash')
                <div class="table-responsive-md col-12">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th width="15">No</th>
                                <td>File</td>
                                <td>File Sekarang</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Surat Tanggung Jawab Mutlak</td>
                                <td>
                                    @if ($data->surat_tanggung_jawab)
                                        <a target="_blank" href="{{ url('uploads/surat_tanggung_jawab/'. $data->surat_tanggung_jawab) }}">Lihat Surat</a>
                                    @else
                                        <span class="text-error">Belum Ada Data</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('ajuan.aksi_upload.store', $data->id) }}">
                                        @csrf
                                        <input type="hidden" name="jenis" value="surat_tanggung_jawab">
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
                                <td>Surat Kehilangan Kepolisian</td>
                                <td>
                                    @if ($data->surat_kehilangan)
                                        <a target="_blank" href="{{ url('uploads/surat_kehilangan/'. $data->surat_kehilangan) }}">Lihat Surat</a>
                                    @else
                                        <span class="text-error">Belum Ada Data</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('ajuan.aksi_upload.store', $data->id) }}">
                                        @csrf
                                        <input type="hidden" name="jenis" value="surat_kehilangan">
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
                                <td>Surat Pernyataan Saksi 1</td>
                                <td>
                                    @if ($data->super_1)
                                        <a target="_blank" href="{{ url('uploads/super_1/'. $data->super_1) }}">Lihat Surat</a>
                                    @else
                                        <span class="text-error">Belum Ada Data</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('ajuan.aksi_upload.store', $data->id) }}">
                                        @csrf
                                        <input type="hidden" name="jenis" value="super_1">
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
                                <td>Surat Pernyataan Saksi 2</td>
                                <td>
                                    @if ($data->super_2)
                                        <a target="_blank" href="{{ url('uploads/super_2/'. $data->super_2) }}">Lihat Surat</a>
                                    @else
                                        <span class="text-error">Belum Ada Data</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('ajuan.aksi_upload.store', $data->id) }}">
                                        @csrf
                                        <input type="hidden" name="jenis" value="super_2">
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
                                <td>Foto Saksi 1</td>
                                <td>
                                    @if ($data->foto_saksi_1)
                                        <a target="_blank" href="{{ url('uploads/foto_saksi_1/'. $data->foto_saksi_1) }}">Lihat Foto</a>
                                    @else
                                        <span class="text-error">Belum Ada Data</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('ajuan.aksi_upload.store', $data->id) }}">
                                        @csrf
                                        <input type="hidden" name="jenis" value="foto_saksi_1">
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
                                <td>Foto Saksi 2</td>
                                <td>
                                    @if ($data->foto_saksi_2)
                                        <a target="_blank" href="{{ url('uploads/foto_saksi_2/'. $data->foto_saksi_2) }}">Lihat Foto</a>
                                    @else
                                        <span class="text-error">Belum Ada Data</span>
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('ajuan.aksi_upload.store', $data->id) }}">
                                        @csrf
                                        <input type="hidden" name="jenis" value="foto_saksi_2">
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