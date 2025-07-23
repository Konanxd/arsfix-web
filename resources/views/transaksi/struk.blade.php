<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .invoice-box {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #eee;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .info-table, .payment-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .info-table td, .payment-table td {
            padding: 8px;
        }

        .payment-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .payment-table tr:last-child td {
            font-weight: bold;
            border-top: 1px solid #ccc;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            text-align: center;
            font-style: italic;
            color: #777;
            margin-top: 30px;
        }

    </style>
</head>
<body>
    <div class="invoice-box">
        <h1>Arsfix.</h1>
        <h2>Struk Pembayaran</h2>

        <table class="info-table">
            <tr>
                <td><strong>ID Transaksi:</strong></td>
                <td>{{ $transaksi->id }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal:</strong></td>
                <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->translatedFormat('d F Y') }}</td>
            </tr>
            <tr>
                <td><strong>Nama Pelanggan:</strong></td>
                <td>{{ $transaksi->repairOrder->customer->name }}</td>
            </tr>
            <tr>
                <td><strong>Nama Teknisi:</strong></td>
                <td>{{ $transaksi->repairOrder->technician->name }}</td>
            </tr>
            <tr>
                <td><strong>Deskripsi:</strong></td>
                <td>{{ $transaksi->repairOrder->description }}</td>
            </tr>
        </table>

        <table class="payment-table w-full text-sm border-collapse">
            <tr>
                <td class="font-semibold align-top"><strong>Suku Cadang</strong></td>
                <td>
                        @foreach($transaksi->repairOrder->spareparts as $sparepart)
                            <tr class="border-b">
                                <td class="text-gray-500">
                                    {{ $sparepart->name }} (x{{ $sparepart->pivot->jumlah ?? 1 }})
                                </td>
                                <td class="text-right">
                                    Rp{{ number_format($sparepart->price * ($sparepart->pivot->jumlah ?? 1), 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                </td>
            </tr>

            <tr>
                <td><strong>Biaya Layanan</strong></td>
                <td class="text-right">Rp {{ number_format($transaksi->repairOrder->estimated_cost, 0, ',', '.') }}</td>
            </tr>

            @php
                $repairOrder = $transaksi->repairOrder;
                $spareparts = $repairOrder?->spareparts ?? collect();

                $totalSparepartPrice = $spareparts->reduce(function($carry, $item) {
                    return $carry + ($item->price * ($item->pivot->jumlah ?? 1));
                }, 0);

                $totalPayment = $totalSparepartPrice + ($repairOrder?->estimated_cost ?? 0);
            @endphp
            <tr>
                <tr>
                    <td class="font-semibold">Total Pembayaran</td>
                    <td class="text-right">Rp {{ number_format($totalPayment, 0, ',', '.') }}</td>
                </tr>
            </tr>
        </table>

        <div class="footer">
            Terima kasih atas kepercayaan Anda.
        </div>
    </div>
</body>
</html>
