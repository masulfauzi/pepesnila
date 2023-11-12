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
                Upload Kop Surat
            </h6>
            <div class="card-body">
                
                @include('include.flash')
                <div class="table-responsive-md col-12">
                    <form action="{{ route('satpen.kop.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <table width="100%">
                            <tr>
                                <td>Kop Surat</td>
                                <td><input type="file" class="form-control" name="file"></td>
                                <td><button class="btn btn-primary">Simpan</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    </section>
    
    
    <section class="section">
        <div class="card">
            <h6 class="card-header">
                Kop Surat
            </h6>
            <div class="card-body">
                
                <div class="table-responsive-md col-12">
                    <table class="table" id="table1">
                        <tr>
                            <td>Kop Surat Sekarang</td>
                            <td>
                                @if ($satpen->kop_surat)
                                    <img src="{{ url('kepala_surat/'.$satpen->kop_surat) }}" alt="">
                                @else
                                    Belum Ada Data
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Aksi</td>
                            <td><a target="_blank" href="{{ route('satpen.contoh_surat.index', $satpen->id) }}" class="btn btn-secondary">Download</a></td>
                        </tr>
                        
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