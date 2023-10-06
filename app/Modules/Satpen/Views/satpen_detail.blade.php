@extends('layouts.app')

@section('page-css')
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <a href="{{ route('satpen.index') }}" class="btn btn-sm icon icon-left btn-outline-secondary"><i class="fa fa-arrow-left"></i> Kembali </a>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('satpen.index') }}">{{ $title }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $satpen->nama }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <h6 class="card-header">
                Detail Data {{ $title }}: {{ $satpen->nama }}
            </h6>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10 offset-lg-2">
                        <div class="row">
                            <div class='col-lg-2'><p>Kelompok</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $satpen->kelompok->id }}</p></div>
									<div class='col-lg-2'><p>Status Sekolah</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $satpen->statusSekolah->id }}</p></div>
									<div class='col-lg-2'><p>Satpen</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $satpen->satpen }}</p></div>
									<div class='col-lg-2'><p>Yayasan</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $satpen->yayasan }}</p></div>
									<div class='col-lg-2'><p>Alamat</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $satpen->alamat }}</p></div>
									<div class='col-lg-2'><p>Npsn</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $satpen->npsn }}</p></div>
									<div class='col-lg-2'><p>Nss</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $satpen->nss }}</p></div>
									<div class='col-lg-2'><p>Nama Ks</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $satpen->nama_ks }}</p></div>
									<div class='col-lg-2'><p>Nip Ks</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $satpen->nip_ks }}</p></div>
									<div class='col-lg-2'><p>No Telp</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $satpen->no_telp }}</p></div>
									
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