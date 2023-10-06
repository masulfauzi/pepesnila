@extends('layouts.app')

@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">
@endsection

@section('main')
<div class="page-heading">
    <div class="page-title">
        <div class="row mb-2">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Dashboard</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="page-content">
    @include('include.flash')
    <section class="row">
        
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Selamat Datang {{ Auth::user()->name }}</h4>
                </div>
                <div class="card-content pb-4">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="text-danger">PERSYARATAN</h2>
    
                            <p>Mohon menjadi perhatian Anda. Persiapkan persyaratan sebagai berikut:</p>
    
                            <ol>
                                <li>Surat Pernyataan Tanggung Jawab Mutlak ber-materai. <a href="{{ url('downloads/Surat Tanggung Jawab Mutlak.docx') }}"><span class="badge bg-primary">Download Format</span></a></li>
                                <li>Surat Keterangan Kehilangan dari Kepolisian</li>
                                <li>Foto Hitam Putih 3x4</li>
                                <li>Materai 3 lembar</li>
                                <li>Fc. Ijazah / Raport sampai dengan lulus ter-legalisir</li>
                                <li>Surat Pernyataan Saksi ber-materai disertakan KTP-saksi. <a href="{{ url('downloads/Surat Pernyataan Saksi.docx') }}"><span class="badge bg-primary">Download Format</span></a></li>
                                <li>Foto 2 saksi teman Lulus se-angkatan (menyertakan fc. raport / ijazah teman)</li>
                                <li>Apabila tidak ada bukti data sama sekali dari sekolah yang bersangkutan,
                                    maka harus melalui proses penyidikan dan berita acara pemeriksaan dari Kepolisian</li>
                                <li>Mengisi data diri pada Form Pengajuan</li>
                            </ol>
    
                            <h3>Apabila terdapat kesalahan penulisan, dibuktikan dengan:</h3>
                            <ul>
                                <li>Fc. Akta Kelahiran</li>
                                <li>Fc. KK (Kartu Keluarga)</li>
                                <li>Fc. Ijazah SMP</li>
                            </ul>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            
        </div>
    </section>
</div>

@endsection

@section('page-js')
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
@endsection