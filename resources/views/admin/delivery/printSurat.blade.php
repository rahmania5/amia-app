<html>
<head>
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <script src="{{ asset('assets') }}/js/core/jquery.min.js"></script>
    <title>Print Surat Pengantar Barang AMIA</title>
</head>
<body>
    <header>
        <b><h2 class="text-center title">CV. RATNA JUWITA</h2></b>
        <h4 class="text-center">Penyalur Air Minum Dalam Kemasan</h4>
        <h6 class="text-center">Pabrik : Jl. Puti Bungsu, Kiambang - Batusangkar - Sumatra Barat Telp. (0752)574036, Fax. (0752)574036</h6>
    </header>

    <main id="main">
    {{-- SALES TRANSACTION INFORMATION --}}
        <h3 class="text-center real-table">SURAT PENGANTAR BARANG</h3>
        
        {{-- LIST OF ITEMS --}}
        <table id="table-1" class="real-table">
            <thead>
                <tr class="real-table">
                    <td colspan="5" class="real-table">Nomor SPB : {{ $delivery->id }}</td>
                </tr>
                <tr>
                    <td colspan="3">Pemesan : {{ $salesTransaction->distributor->user->name }}</td>
                    <td rowspan="2" class="real-table"></td>
                    <td rowspan="2" class="truncate real-table">Dikirim Ke : {{ $salesTransaction->distributor->alamat }}</td>
                </tr>
                <tr>
                    <td colspan="3">No. POB : {{ $salesTransaction->id }}</td>
                </tr>
            </thead>
            <tbody>
                <tr class="real-table">
                    <th class="real-table fixed">No.</th>
                    <th class="real-table">Nama Barang</th>
                    <th class="real-table fixed">Satuan</th>
                    <th class="real-table fixed">Kuantitas Kirim</th>
                    <th colspan="2" class="real-table">Catatan</th>
                </tr>
            @foreach($printDeliveryDetails as $dd)
                <tr class="real-table">
                    <td class="real-table text-center"> {{ $loop->iteration }} </td>
                    <td class="real-table">{{ $dd->sales_transaction_detail->goods->nama_barang }}</td>
                    @if ($dd->sales_transaction_detail->goods->nama_barang == 'Gallon 19 ltr')
                    <td class="real-table">Gall</td>
                    @else
                    <td class="real-table">Kart</td>
                    @endif
                    <td class="real-table text-center"> {{ $dd->qty_barang_dikirim }} </td>
                    <td colspan="2" class="real-table"> </td>
                </tr>
            @endforeach
            </tbody>
        </table>   

        <h3 class="text-center real-table">BARANG YANG DIKEMBALIKAN</h3>
        
        {{-- LIST OF RETURN ITEMS --}}
        <table id="table-2" class="real-table">
            <thead>
                <tr class="real-table">
                    <th class="real-table fixed">No.</th>
                    <th class="real-table">Nama Barang</th>
                    <th class="real-table fixed">Satuan</th>
                    <th class="real-table fixed">Kuantitas</th>
                    <th colspan="2" class="real-table">Alasan Dikembalikan</th>
                </tr>
            </thead>
            <tbody>
            @if (!$returnDetails->isEmpty())
            @foreach($returnDetails as $rd)
                <tr class="real-table">
                    <td class="real-table text-center"> {{ $loop->iteration }} </td>
                    <td class="real-table">{{ $rd->sales_transaction_detail->goods->nama_barang }}</td>
                    @if ($rd->sales_transaction_detail->goods->nama_barang == 'Gallon 19 ltr')
                    <td class="real-table">Gall</td>
                    @else
                    <td class="real-table">Kart</td>
                    @endif
                    <td class="real-table text-center">{{ $rd->qty_return }}</td>
                    <td colspan="2" class="truncate real-table">{{ $rd->alasan_return }}</td>
                </tr>
            @endforeach
            @else
                <tr class="real-table">
                    <td class="empty-table"></td>
                    <td class="real-table"></td>
                    <td class="real-table"></td>
                    <td class="real-table"></td>
                    <td colspan="2" class="truncate real-table"></td>
                </tr>
            @endif
                <tr class="real-table">
                    <td colspan="2" class="real-table text-center">Dikembalikan Oleh,</td>
                    <td colspan="2" class="real-table text-center">Dibawa Oleh,</td>
                    <td colspan="2" class="real-table text-center">Diterima Oleh,</td>
                </tr>
                <tr class="real-table">
                    <td colspan="2" class="real-table sign"></td>
                    <td colspan="2" class="real-table"></td>
                    <td colspan="2" class="real-table"></td>
                </tr>
            </tbody>
        </table>   

        <table id="table-3" class="real-table">
            <thead>
                <tr class="real-table">
                    <td colspan="2" class="real-table text-center">Diterima Oleh,</td>
                    <td colspan="2" class="real-table text-center">Otorisasi</td>
                    <td colspan="2" class="real-table text-center">Dikirim dengan</td>
                </tr>
            </thead>
            <tbody>
                <tr class="info">
                    <td class="info">Nama</td>
                    <td class="info truncate-25">:</td>
                    <td rowspan="2" class="real-table fixed">Gudang</td>
                    <td rowspan="2" class="real-table fixed"></td>
                    <td class="info">Jenis Kendaraan</td>
                    <td class="info truncate-25">: {{ $delivery->vehicle->jenis_kendaraan }}</td>
                </tr>
                <tr class="info">
                    <td class="info">Tanggal</td>
                    <td class="info">: {{ $delivery->tanggal_pengantaran }}</td>
                    <td class="info">No. Pol.</td>
                    <td class="info">: {{ $delivery->vehicle->no_polisi }}</td>
                </tr>
                <tr class="info">
                    <td class="info">Jam Datang</td>
                    <td class="info">: @if (isset($delivery->jam_diterima)) {{ $delivery->jam_diterima }} @endif</td>
                    <td rowspan="2" class="real-table">Accounting</td>
                    <td rowspan="2" class="real-table"></td>
                    <td class="info">Jam Berangkat</td>
                    <td class="info">: {{ $delivery->jam_berangkat }}</td>
                </tr>
                <tr class="info">
                    <td class="info">Jam Berangkat</td>
                    <td class="info">: {{ $delivery->jam_berangkat }}</td>
                    <td class="info">Nama Sopir</td>
                    <td class="info">: {{ $delivery->driver->nama_driver }}</td>
                </tr>
                <tr class="info">
                    <td colspan="2" rowspan="2" class="info">Tanda Tangan/Cap Perusahaan</td>
                    <td rowspan="2" class="real-table">Satpam</td>
                    <td rowspan="2" class="real-table"></td>
                    <td rowspan="2"class="info">Tanda Tangan</td>
                    <td rowspan="2" class="info">:</td>
                </tr>
                <tr class="info"></tr>
            </tbody>
        </table>   
        <table class="lembar">
            <tr>
                <td>Lembar</td>
                <td>1. Penagihan</td>
                <td>2. Accounting</td>
                <td>3. Pemesan</td>
                <td>4. Penerima</td>
                <td>5. Gudang</td>
            </tr>
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

    td.info {
        padding: 5px 5px;
    }

    .truncate {
        width: 35%;
        overflow-wrap:break-word;
    }

    .truncate-25 {
        width: 25%;
        overflow-wrap:break-word;
    }

    .real-table {
        border: 1px solid;
        border-collapse:collapse;
        margin-top: 10px;
    }

    table.real-table {
        width: 100%;
    }

    .real-table th {
        text-decoration:bold;
    }

    .real-table th, tr, td {
        padding: 5px 25px;
    }

    .real-table .fixed {
        width: 10%;
    }

    .empty-table {
        border: 0px;
        border-collapse:collapse;
        padding: 5px;
        margin-top: 10px;
        height: 30px;
    }

    .sign {
        height: 80px;
    }

    .lembar {
        width: 100%;
        font-style: italic;
        font-size: 12px;
    }
</style>

<script>
    window.print();
</script>