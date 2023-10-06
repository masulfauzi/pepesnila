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
        <div class="row">
            <div class="col-10">
                <div class="card">
                    <h6 class="card-header">
                        Detail Ajuan
                    </h6>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                
                            </div>
                            <div class="col-3">  
                                {{-- {!! button('ajuan.create', $title) !!}   --}}
                            </div>
                        </div>
                        @include('include.flash')
                        <div class="table-responsive-md col-12">
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-2">
                                    <img width="100%" src="{{ url('uploads/foto/'.$ajuan->alumni->foto) }}" alt="Foto Alumni">
                                </div>
                                <div class="col-9">
                                    <table>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>{{ $ajuan->alumni->nama_alumni }}</td>
                                        </tr>
                                        <tr>
                                            <td>Satuan Pendidikan</td>
                                            <td>:</td>
                                            <td>{{ $ajuan->alumni->satpen->satpen }}</td>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td>:</td>
                                            <td>{{ $ajuan->alumni->nik }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Ayah</td>
                                            <td>:</td>
                                            <td>{{ $ajuan->alumni->nama_ayah }}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama Ibu</td>
                                            <td>:</td>
                                            <td>{{ $ajuan->alumni->nama_ibu }}</td>
                                        </tr>
                                        <tr>
                                            <td>Tempat & Tanggal Lahir</td>
                                            <td>:</td>
                                            <td>{{ $ajuan->alumni->tempat_lahir }}, {{ \App\Helpers\Format::Tanggal($ajuan->alumni->tgl_lahir) }}</td>
                                        </tr>
                                        <tr>
                                            <td>NIS</td>
                                            <td>:</td>
                                            <td>{{ $ajuan->nis }}</td>
                                        </tr>
                                        <tr>
                                            <td>NISN</td>
                                            <td>:</td>
                                            <td>{{ $ajuan->nisn }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Ajuan</td>
                                            <td>:</td>
                                            <td><span class="badge bg-danger">{{ $ajuan->jenisAjuan->jenis_ajuan }}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <h6 class="card-header">
                        Aksi
                    </h6>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-9">
                                
                            </div>
                            <div class="col-3">  
                                {{-- {!! button('ajuan.create', $title) !!}   --}}
                            </div>
                        </div>
                        <div class="row">
                            @if ($ajuan->id_status_ajuan == '25e33720-6db4-45c6-aa32-8a790c0a88bd')
                                <div class="col-12">
                                    <button onclick="buttonConfirm('{{ route('ajuan.admin_ubah_status.show', ["ajuan" => $ajuan->id, "status" => "d3855fc0-ddaf-426e-a7ca-7e98b7a1d22d"]) }}')" class="btn btn-success mb-2">VERVAL</button>
                                    <button onclick="buttonConfirm('{{ route('ajuan.admin_ubah_status.show', ["ajuan" => $ajuan->id, "status" => "b641d25c-7121-4355-9734-f79a8b09c27a"]) }}')" class="btn btn-danger mb-2">TOLAK</button>
                                </div>
                            @else
                                <div class="col-12">
                                    <h3>Status Ajuan ini Sudah <span class="badge bg-primary">{{ $ajuan->statusAjuan->status_ajuan }}</span></h3>
                                </div>
                            @endif
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <h6 class="card-header">
                File Pendukung
            </h6>
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        
                    </div>
                    <div class="col-3">  
						{{-- {!! button('ajuan.create', $title) !!}   --}}
                    </div>
                </div>
                @include('include.flash')
                <div class="table-responsive-md col-12">
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-stripped">
                                <tr>
                                    <th>No</th>
                                    <th>File Pendukung</th>
                                    <th>Aksi</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Kartu Keluarga</td>
                                    <td>
                                        @if ($ajuan->alumni->kk)
                                            <a target="_blank" class="btn btn-secondary" href="{{ url('uploads/kk/'.$ajuan->alumni->kk) }}">Lihat Kartu Keluarga</a>
                                        @else
                                            Belum Ada Data
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Akta Kelahiran</td>
                                    <td>
                                        @if ($ajuan->alumni->akta_lahir)
                                            <a target="_blank" class="btn btn-secondary" href="{{ url('uploads/akta_lahir/'.$ajuan->alumni->akta_lahir) }}">Lihat Akta Kelahiran</a>
                                        @else
                                            Belum Ada Data
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Ijazah SMP</td>
                                    <td>
                                        @if ($ajuan->alumni->ijazah_smp)
                                            <a target="_blank" class="btn btn-secondary" href="{{ url('uploads/ijazah_smp/'.$ajuan->alumni->ijazah_smp) }}">Lihat Ijazah SMP</a>
                                        @else
                                            Belum Ada Data
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>FC Rapor</td>
                                    <td>
                                        @if ($ajuan->alumni->fc_rapor)
                                            <a target="_blank" class="btn btn-secondary" href="{{ url('uploads/fc_rapor/'.$ajuan->alumni->fc_rapor) }}">Lihat FC Rapor</a>
                                        @else
                                            Belum Ada Data
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>FC Ijazah</td>
                                    <td>
                                        @if ($ajuan->alumni->fc_ijazah)
                                            <a target="_blank" class="btn btn-secondary" href="{{ url('uploads/fc_ijazah/'.$ajuan->alumni->fc_ijazah) }}">Lihat FC Ijazah</a>
                                        @else
                                            Belum Ada Data
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Surat Tanggung Jawab Mutlak</td>
                                    <td>
                                        @if ($ajuan->surat_tanggung_jawab)
                                            <a target="_blank" class="btn btn-secondary" href="{{ url('uploads/surat_tanggung_jawab/'.$ajuan->surat_tanggung_jawab) }}">Lihat Surat Tanggung Jawab Mutlak</a>
                                        @else
                                            Belum Ada Data
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Surat Kehilangan Kepolisian</td>
                                    <td>
                                        @if ($ajuan->surat_kehilangan)
                                            <a target="_blank" class="btn btn-secondary" href="{{ url('uploads/surat_kehilangan/'.$ajuan->surat_kehilangan) }}">Lihat Surat Kehilangan Kepolisian</a>
                                        @else
                                            Belum Ada Data
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Surat Pernyataan Saksi 1</td>
                                    <td>
                                        @if ($ajuan->super_1)
                                            <a target="_blank" class="btn btn-secondary" href="{{ url('uploads/super_1/'.$ajuan->super_1) }}">Lihat Surat Pernyataan Saksi 1</a>
                                        @else
                                            Belum Ada Data
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Surat Pernyataan Saksi 2</td>
                                    <td>
                                        @if ($ajuan->super_2)
                                            <a target="_blank" class="btn btn-secondary" href="{{ url('uploads/super_2/'.$ajuan->super_2) }}">Lihat Surat Pernyataan Saksi 2</a>
                                        @else
                                            Belum Ada Data
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Foto Saksi 1</td>
                                    <td>
                                        @if ($ajuan->foto_saksi_1)
                                            <a target="_blank" class="btn btn-secondary" href="{{ url('uploads/foto_saksi_1/'.$ajuan->foto_saksi_1) }}">Lihat Foto Saksi 2</a>
                                        @else
                                            Belum Ada Data
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>11</td>
                                    <td>Foto Saksi 2</td>
                                    <td>
                                        @if ($ajuan->foto_saksi_2)
                                            <a target="_blank" class="btn btn-secondary" href="{{ url('uploads/foto_saksi_2/'.$ajuan->foto_saksi_2) }}">Lihat Foto Saksi 2</a>
                                        @else
                                            Belum Ada Data
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        
                    </div>
                    
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