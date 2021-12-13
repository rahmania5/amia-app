<html>
<head>
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
    <title>Print Laporan Penjualan Bulanan AMIA</title>
</head>
<body>
    <header>
        <b><h4 class="text-center title">CV. RATNA JUWITA</h4></b>
        <b><h4 class="text-center">INDUSTRI AIR MINUMAN DALAM KEMASAN</h4></b>
        <b><h6 class="text-center">Pabrik : Jl. Puti Bungsu - Kiambang Batusangkar Telp. (0752)574036</h6></b>
    </header>

    <main id="main">
    <div>
        @if (isset($province))
        <b><h4>{{ __('Data Distributor Provinsi '. $province->nama_provinsi) }}</h4></b>
        @else
        <b><h4>{{ __('Data Distributor AMIA') }}</h4></b>
        @endif
        <span class="float-right"><p>Tanggal : {{ now()->format('d/m/Y') }}</p>
    </div>
    
    {{-- LIST OF DISTRIBUTORS --}}
        <table id="table-1" class="real-table">
            <thead class="text-center">
                <tr>
                    <th class="real-table">Distributor</th>
                    <th class="real-table">NIK</th>
                    @if (!isset($province))
                    <th class="real-table">Provinsi</th>
                    @endif
                    <th class="real-table">Kab/Kota</th>
                    <th class="real-table">Kecamatan</th>
                    <th class="real-table">Alamat</th>
                    <th class="real-table">No. Telp</th>
                    <th class="real-table">Jumlah Transaksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse($printDistributors as $d)
                <tr>
                    <td class="real-table">{{ $d->user->name }}</td>
                    <td class="real-table">{{ $d->nik }}</td>
                    @if (!isset($province))
                    <td class="real-table">{{ $d->district->city->province->nama_provinsi }}</td>
                    @endif
                    <td class="real-table">{{ $d->district->city->nama_kab_kota }}</td>
                    <td class="real-table">{{ $d->district->nama_kecamatan }}</td>
                    <td class="real-table">{{ $d->alamat }}</td>
                    <td class="real-table">{{ $d->no_telepon }}</td>
                    @if ($d->sales_transaction)
                    <td class="text-center real-table">{{ $d->sales_transaction->count() }}</td>
                    @else
                    <td class="text-center real-table">0</td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center real-table">Belum ada data distributor</td>
                </tr>
            @endforelse
            </tbody>
        </table>   
    </main>
</body>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lora&display=swap');

    body {
        font-family: 'Lora', serif;
    }

    h4, h6 {
        margin: 0;
    }

    h6 {
        margin-top: 5px;
        margin-bottom: 15px;
    }

    p {
        font-size: 12px;
    }

    .title {
        margin: 15px auto 5px;
        text-decoration: underline;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .float-right {
        float: right;
    }

    .real-table {
        border: 1px solid;
        border-collapse:collapse;
        padding: 5px 10px;
        margin-top: 10px;
        font-size: 12px;
    }

    table.real-table {
        width: 100%;
    }

    .real-table th {
        text-decoration:bold;
    }
</style>

<script>
    window.print();
</script>