<html>
<head>
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
    <title>Print Faktur Penjualan AMIA</title>
</head>
<body>
    <header>
        <b><h2 class="text-center title">CV. RATNA JUWITA</h2></b>
        <h4 class="text-center">Penyalur Air Minum Dalam Kemasan</h4>
        <h6 class="text-center">Pabrik : Jl. Puti Bungsu, Kiambang - Batusangkar - Sumatra Barat Telp. (0752)574036, Fax. (0752)574036</h6>
    </header>

    <main id="main">
    {{-- SALES TRANSACTION INFORMATION --}}
        <h3 class="text-center">FAKTUR PENJUALAN</h3>
        <table class="info">
            <tr>
                <td>Nama Toko</td>
                <td>:</td>
                <td>{{ $salesTransaction->distributor->user->name }}</td>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ $salesTransaction->tanggal_transaksi }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td class="truncate">{{ $salesTransaction->distributor->alamat }}</td>
                <td>Jatuh Tempo</td>
                <td>:</td>
                @if ($salesTransaction->jenis_pembayaran == 'Utang')
                <td>{{ date('Y-m-d', strtotime($salesTransaction->tanggal_transaksi." +15 days")) }}</td>
                @else
                <td></td>
                @endif
            </tr>
        </table>
        
        {{-- LIST OF ITEMS --}}
        <table id="table-1" class="real-table">
            <thead>
                 <tr class="real-table">
                    <th class="real-table">Banyak</th>
                    <th class="real-table">Nama Barang</th>
                    <th class="real-table">Harga</th>
                    <th class="real-table">Jumlah</th>
                    <th class="real-table">Keterangan</th>
                </tr>
            </thead>

            <tbody>
            @foreach($printTransactionDetails as $std)
                <tr class="real-table">
                    <td class="real-table text-center"> {{ $std->qty }} </td>
                    <td class="real-table">{{ $std->goods->nama_barang }}</td>
                    <td class="real-table text-right">{{ $std->goods->harga_barang }}</td>
                    <td class="real-table text-right">{{ $std->qty * $std->goods->harga_barang }}</td>
                    <td class="real-table">{{ $std->keterangan }}</td>
                </tr>
            @endforeach
                <tr class="empty-table">
                    <td class="empty-table text-center">Salesman</td>
                    <td class="empty-table text-center">Toko</td>
                    <td class="real-table">Total</td>
                    <td class="real-table text-right">{{ $salesTransaction->total_transaksi }}</td>
                    <td class="real-table"></td>
                </tr>
                <tr class="empty-table">
                    <td class="empty-table"></td>
                    <td class="empty-table"></td>
                    <td class="real-table">Bayar</td>
                    @if ($countPayment > 0)
                    <td class="real-table text-right">{{ $salesTransaction->payment[0]->jumlah_pembayaran }}</td>
                    @else
                    <td class="real-table text-right">0</td>
                    @endif
                    <td class="real-table"></td>
                </tr>
                <tr class="empty-table">
                    <td class="empty-table"></td>
                    <td class="empty-table"></td>
                    <td class="real-table">Sisa</td>
                    <td class="real-table text-right">{{ $salesTransaction->sisa_utang }}</td>
                    <td class="real-table"></td>
                </tr>
            </tbody>
        </table>   
    </main>
</body>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Lora&display=swap');

    body {
        font-family: 'Lora', serif;
        color: DarkBlue;
    }

    h2, h3, h4, h6 {
        margin: 0;
    }

    h6 {
        margin-top: 5px;
        margin-bottom: 15px;
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

    .info {
        margin-top: 10px;
    }

    .truncate {
        width: 300px;
        overflow-wrap:break-word;
    }

    .real-table {
        border: 1px solid;
        border-collapse:collapse;
        padding: 5px 25px;
        margin-top: 10px;
    }

    table.real-table {
        width: 100%;
    }

    .real-table th {
        text-decoration:bold;
    }

    .empty-table {
        border: 0px;
        border-collapse:collapse;
        padding: 5px;
        margin-top: 10px;
        height: 30px;
    }
</style>

<script>
    window.print();
</script>