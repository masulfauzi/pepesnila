@extends('layouts.app')

@section('page-css')
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <a href="{{ route('ajuan.index') }}" class="btn btn-sm icon icon-left btn-outline-secondary"><i class="fa fa-arrow-left"></i> Kembali </a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('ajuan.index') }}">{{ $title }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $ajuan->nama }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <h6 class="card-header">
                Detail Data {{ $title }}: {{ $ajuan->nama }}
            </h6>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10 offset-lg-2">
                        <div class="row">
                            <div class='col-lg-2'><p>Status Ajuan</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $ajuan->statusAjuan->id }}</p></div>
									<div class='col-lg-2'><p>Alumni</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $ajuan->alumni->id }}</p></div>
									<div class='col-lg-2'><p>Jenis Ajuan</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $ajuan->jenisAjuan->id }}</p></div>
									<div class='col-lg-2'><p>Surat Tanggung Jawab</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $ajuan->surat_tanggung_jawab }}</p></div>
									<div class='col-lg-2'><p>Surat Kehilangan</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $ajuan->surat_kehilangan }}</p></div>
									<div class='col-lg-2'><p>Super 1</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $ajuan->super_1 }}</p></div>
									<div class='col-lg-2'><p>Super 2</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $ajuan->super_2 }}</p></div>
									<div class='col-lg-2'><p>Foto Saksi 1</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $ajuan->foto_saksi_1 }}</p></div>
									<div class='col-lg-2'><p>Foto Saksi 2</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $ajuan->foto_saksi_2 }}</p></div>
									
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