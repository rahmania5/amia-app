<html>
<head>
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
    <title>Print Permintaan Order Barang AMIA</title>
</head>
<body>
    <header>
        <div>
            <b><h2>CV. RATNA JUWITA</h2></b><h5> - Telp. (0752)574036 - Fax. (0752)574036</h5>
        </div>
        <b><h3 class="text-center title">PERMINTAAN ORDER BARANG</h3></b>
        <h4 class="text-center">No.: {{ $salesTransaction->id }}/POB/Markt/...../.....</h4>
    </header>

    <main id="main">
    {{-- SALES TRANSACTION INFORMATION --}}
        <table class="info">
            <tr>
                <td>Dari</td>
                <td>:</td>
                <td>Marketing</td>
                <td>Untuk : Logistik</td>
            </tr>
            <tr>
                <td>Distributor</td>
                <td>:</td>
                <td>{{ $salesTransaction->distributor->user->name }}</td>
            </tr>
            <tr>
                <td>Alamat Pengirim</td>
                <td>:</td>
                <td class="truncate">{{ $salesTransaction->distributor->alamat }}</td>
            </tr>
            <tr>
                <td>Tanggal Kirim</td>
                <td>:</td>
                <td>{{ $salesTransaction->tanggal_kirim }}</td>
            </tr>
        </table>
        
        {{-- LIST OF ITEMS --}}
        <table id="table-1" class="real-table">
            <thead>
                 <tr class="real-table">
                    <th class="real-table">No.</th>
                    <th class="real-table">Jenis Barang</th>
                    <th class="real-table">Stn</th>
                    <th class="real-table">Brand</th>
                    <th class="real-table">Jumlah</th>
                    <th colspan="2" class="real-table">Keterangan</th>
                </tr>
            </thead>

            <tbody>
            @foreach($printTransactionDetails as $std)
                <tr class="real-table">
                    <td class="real-table text-center"> {{ $loop->iteration }} </td>
                    <td class="real-table">{{ $std->goods->nama_barang }}</td>
                    @if ($std->goods->nama_barang == 'Gallon 19 ltr')
                    <td class="real-table">Btl</td>
                    @else
                    <td class="real-table">Krtn</td>
                    @endif
                    <td class="real-table text-center">AMIA</td>
                    <td class="real-table text-center">{{ $std->qty }}</td>
                    <td colspan="2" class="real-table">{{ $std->keterangan }}</td>
                </tr>
            @endforeach
                <tr class="real-table">
                    <td colspan="2" class="real-table text-center">Distributor / Debo</td>
                    <td colspan="2" class="real-table text-center">Marketing</td>
                    <td class="real-table text-center">Log</td>
                    <td class="real-table text-center">F/A</td>
                    <td class="real-table text-center">Catatan</td>
                </tr>
                <tr class="empty-table">
                    <td colspan="2" rowspan="2" class="empty-table"></td>
                    <td colspan="2" rowspan="2" class="empty-table"></td>
                    <td rowspan="2" class="empty-table"></td>
                    <td rowspan="2" class="empty-table"></td>
                    <td class="empty-table"></td>
                </tr>
                <tr class="empty-table">
                    <td class="empty-table"> </td>
                </tr>
                <tr class="empty-table">
                    <td colspan="2" class="empty-table text-center"></td>
                    <td colspan="2" class="empty-table"></td>
                    <td class="empty-table"></td>
                    <td class="empty-table"></td>
                    <td class="empty-table"></td>
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

    h2, h3, h4 {
        margin: 0;
    }

    h2, h5 {
        display:inline;
    }

    .title {
        margin: 15px auto 5px;
        text-decoration: underline;
    }

    .text-center {
        text-align: center;
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
        padding: 5px 15px;
        margin-top: 10px;
    }

    table.real-table {
        width: 100%;
    }

    .real-table th {
        text-decoration:bold;
    }

    .empty-table {
        border: 1px solid;
        border-collapse:collapse;
        padding: 5px;
        margin-top: 10px;
        height: 30px;
    }
</style>

<script>
    window.print();
</script>