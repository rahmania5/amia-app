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
        <b><h4>{{ 'Laporan Penjualan '. $monthName .' '. $year }}</h4></b>
        <span class="float-right"><p>Tanggal : {{ now()->format('d/m/Y') }}</p>
    </div>
    
    {{-- LIST OF SALES --}}
        <table id="table-1" class="real-table">
            <thead class="text-center">
                <tr>
                    <th class="real-table">Tanggal Transaksi</th>
                    <th class="real-table">Distributor</th>
                    <th class="real-table">Jenis Pembayaran</th>
                    <th class="real-table">Total</th>
                </tr>
            </thead>

            <tbody>
            @forelse($printTransactions as $st)
                <tr>
                    <td class="real-table">{{ $st->tanggal_transaksi }}</td>
                    <td class="real-table">{{ $st->distributor->user->name }}</td>
                    <td class="real-table">{{ $st->jenis_pembayaran }}</td>
                    <td class="text-right real-table">{{ $st->total_transaksi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data penjualan</td>
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