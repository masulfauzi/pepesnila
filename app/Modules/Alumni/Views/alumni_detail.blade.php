@extends('layouts.app')

@section('page-css')
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <a href="{{ route('alumni.index') }}" class="btn btn-sm icon icon-left btn-outline-secondary"><i class="fa fa-arrow-left"></i> Kembali </a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('alumni.index') }}">{{ $title }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $alumni->nama }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <h6 class="card-header">
                Detail Data {{ $title }}: {{ $alumni->nama }}
            </h6>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10 offset-lg-2">
                        <div class="row">
                            <div class='col-lg-2'><p>Satpen</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->satpen->id }}</p></div>
									<div class='col-lg-2'><p>Nama Alumni</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->nama_alumni }}</p></div>
									<div class='col-lg-2'><p>Nik</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->nik }}</p></div>
									<div class='col-lg-2'><p>Nama Ayah</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->nama_ayah }}</p></div>
									<div class='col-lg-2'><p>Nama Ibu</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->nama_ibu }}</p></div>
									<div class='col-lg-2'><p>Tgl Lahir</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->tgl_lahir }}</p></div>
									<div class='col-lg-2'><p>Tempat Lahir</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->tempat_lahir }}</p></div>
									<div class='col-lg-2'><p>Nis</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->nis }}</p></div>
									<div class='col-lg-2'><p>Nisn</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->nisn }}</p></div>
									<div class='col-lg-2'><p>Foto</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->foto }}</p></div>
									<div class='col-lg-2'><p>Kk</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->kk }}</p></div>
									<div class='col-lg-2'><p>Akta Lahir</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->akta_lahir }}</p></div>
									<div class='col-lg-2'><p>Ijazah Smp</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->ijazah_smp }}</p></div>
									<div class='col-lg-2'><p>Fc Rapor</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->fc_rapor }}</p></div>
									<div class='col-lg-2'><p>Fc Ijazah</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $alumni->fc_ijazah }}</p></div>
									
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