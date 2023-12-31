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
                Tabel Data {{ $title }}
            </h6>
            <div class="card-body">
                
                @include('include.flash')
                <div class="table-responsive-md col-12">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th width="15">No</th>
                                <td>Nama Alumni</td>
                                <td>Jenis Ajuan</td>
                                <td>Status Ajuan</td>

                                @if ($active_route == 'ajuan.admin_ditolak.index')
                                    <td>Alasan Ditolak</td>
                                @endif
                                
								
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = $data->firstItem(); @endphp
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->alumni->nama_alumni }}</td>
                                    <td>{{ $item->jenisAjuan->jenis_ajuan }}</td>
                                    <td><span class="badge bg-primary">{{ $item->statusAjuan->status_ajuan }}</span></td>
                                    
                                    @if ($active_route == 'ajuan.admin_ditolak.index')
                                        <td>{{ $item->alasan_ditolak }}</td>
                                    @endif
									
									
                                    <td>
                                        @if ($item->id_status_ajuan == 'd3855fc0-ddaf-426e-a7ca-7e98b7a1d22d')
                                            <a class="btn btn-outline-primary btn-sm" href="{{ route('ajuan.download_surat.index', $item->id) }}">Download Surat</a>
                                        @endif
                                        <a href="{{ route('ajuan.admin_lihat.show', $item->id) }}" class="btn btn-sm icon icon-left btn-outline-secondary">Lihat Ajuan</a>
										
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center"><i>No data.</i></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
				{{ $data->links() }}
            </div>
        </div>

    </section>
</div>
@endsection

@section('page-js')
@endsection

@section('inline-js')
@endsection