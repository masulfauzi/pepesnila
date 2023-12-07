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
                <div class="row">
                    <div class="col-9">
                        <form action="{{ route('prestasi.index') }}" method="get">
                            <div class="form-group col-md-3 has-icon-left position-relative">
                                <input type="text" class="form-control" value="{{ request()->get('search') }}" name="search" placeholder="Search">
                                <div class="form-control-icon"><i class="fa fa-search"></i></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-3">  
                        @if (session()->get('active_role')['id'] == 'a5086fe7-87c2-4b3a-82bb-e71c5154faa4')
                        {!! button('prestasi.create', $title) !!}  
                        @endif
						
                    </div>
                </div>
                @include('include.flash')
                <div class="table-responsive-md col-12">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th width="15">No</th>
                                @if (session()->get('active_role')['id'] != 'a5086fe7-87c2-4b3a-82bb-e71c5154faa4')
                                    <td>Satpen</td>
                                @endif
                                <td>Prestasi</td>
								<td>Juara</td>
								{{-- <td>Tahun</td> --}}
								<td>Tgl Perolehan</td>
								<td>Sertifikat</td>
                                @if (session()->get('active_role')['id'] == 'a5086fe7-87c2-4b3a-82bb-e71c5154faa4')
                                    <th width="20%">Aksi</th>
                                @endif
                                
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = $data->firstItem(); @endphp
                            @forelse ($data as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    @if (session()->get('active_role')['id'] != 'a5086fe7-87c2-4b3a-82bb-e71c5154faa4')
                                        <td>{{ $item->satpen->satpen }}</td>
                                    @endif
                                    <td>{{ $item->prestasi }}</td>
									<td>{{ $item->juara->juara }}</td>
									{{-- <td>{{ $item->tahun }}</td> --}}
									{{-- <td>{{ $item->tgl_perolehan }}</td> --}}
                                    <td>{{ \App\Helpers\Format::tanggal($item->tgl_perolehan) }}</td>
									<td>
                                        <a href="{{ url('uploads/sertifikat/'. $item->sertifikat) }}" target="_blank" class="btn btn-primary">Lihat Sertifikat</a>
                                    </td>
									@if (session()->get('active_role')['id'] == 'a5086fe7-87c2-4b3a-82bb-e71c5154faa4')
                                        <td>
                                            {!! button('prestasi.show','', $item->id) !!}
                                            {!! button('prestasi.edit', $title, $item->id) !!}
                                            {!! button('prestasi.destroy', $title, $item->id) !!}
                                        </td>
                                    @endif
                                    
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center"><i>No data.</i></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
				{{ $data->links() }}
            </div>
        </div>

    </section>
    <section class="section">
        <div class="card">
            <h6 class="card-header">
                Grafik Data {{ $title }}
            </h6>
            <div class="card-body">
                <div id="container">

                </div>
            </div>
        </div>

    </section>
</div>
@endsection

@section('page-js')
@endsection

@section('inline-js')
<script>
    Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Jumlah Perolehan Prestasi',
        align: 'center'
    },
    subtitle: {
        text: '',
        align: 'left'
    },
    xAxis: {
        categories: [
            @foreach ($chart as $item)
                '{{ $item->tahun }}',
            @endforeach
        ],
        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah Prestasi'
        }
    },
    tooltip: {
        // valueSuffix: ' (1000 MT)'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Jumlah Prestasi',
            data: [
                @foreach ($chart as $item)
                    {{ $item->jml }},
                @endforeach
            ]
        }
    ]
});

</script>
@endsection