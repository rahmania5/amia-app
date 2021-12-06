<html>
<head>
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
    <title>Print Kartu Piutang AMIA</title>
</head>
<body>
    <header>
        <b><h4 class="text-center title">CV. RATNA JUWITA</h4></b>
        <b><h4 class="text-center">INDUSTRI AIR MINUMAN DALAM KEMASAN</h4></b>
        <b><h6 class="text-center">Pabrik : Jl. Puti Bungsu - Kiambang Batusangkar Telp. (0752)574036</h6></b>
    </header>

    <main id="main">
    <div>
        <b><h4>KARTU PIUTANG DISTRIBUTOR</h4></b>
        <span class="float-right"><p>Tanggal : {{ now()->format('d/m/Y') }}</p>
    </div>
    
    {{-- DISTRIBUTOR INFORMATION --}}
        <table class="info">
            <tr>
                <td>Distributor</td>
                <td>:</td>
                <td>{{ $distributor->user->name }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td class="truncate">{{ $distributor->alamat }}</td>
            </tr>
        </table>
        
        {{-- LIST OF LOANS --}}
        <table id="table-1" class="real-table">
            <thead class="text-center">
                <tr>
                    <th rowspan="2" class="real-table">Tanggal</th>
                    <th rowspan="2" class="real-table">No. SPB</th>
                    <th rowspan="2" class="real-table">Total Transaksi</th>
                    <th rowspan="2" class="real-table">Tanggal</th>
                    <th rowspan="2" class="real-table">Pembayaran</th>
                    <th rowspan="2" class="real-table">Saldo Akhir</th>
                    <th rowspan="2" class="real-table">Keterangan</th>
                </tr>
            </thead>

            <tbody>
            @foreach($printTransactions as $st)
                <tr>
                    <td class="real-table">{{ $st->tanggal_transaksi }}</td>
                    @if (isset($st->sales_transaction_detail[0]->delivery_detail[0]->delivery_id))
                    <td class="real-table text-center"> {{ $st->sales_transaction_detail[0]->delivery_detail[0]->delivery_id }} </td>
                    @else
                    <td class="real-table"> </td>
                    @endif
                    <td class="text-right real-table">{{ $st['total_transaksi'] }}</td>
                    <td class="real-table"> </td>
                    <td class="real-table"> </td>
                    <td class="text-right real-table">{{ $st['total_transaksi'] }}</td>
                    <td class="real-table"> </td>
                </tr>
                @if (!$st->payment->isEmpty())
                @foreach($st->payment as $payment)
                <tr>
                    <td class="real-table"> </td>
                    <td class="real-table"> </td>
                    <td class="real-table"> </td>
                    <td class="real-table">{{ $payment->tanggal_pembayaran }}</td>
                    <td class="text-right real-table">{{ $payment->jumlah_pembayaran }}</td>
                    @if ($st->payment[0]->id == $payment->id)
                    <td class="text-right real-table">{{ $st->total_transaksi - $payment->jumlah_pembayaran }}</td>
                    @elseif ($st->payment[1]->id == $payment->id)
                    <td class="text-right real-table">{{ $st->total_transaksi - $st->payment[0]->jumlah_pembayaran - $st->payment[1]->jumlah_pembayaran }}</td>
                    @endif
                    <td class="real-table">{{ $payment->keterangan }}</td>
                </tr>
                @endforeach
                @endif
            @endforeach
            </tbody>
        </table>   
    </main>
</body>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lora&display=swap');

    body {
        font-family: 'Lora', serif;
    }

    h2, h3, h4, h6 {
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

    .info {
        margin-top: 10px;
        font-size: 12px;
    }

    .truncate {
        width: 300px;
        overflow-wrap:break-word;
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