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
                <td>{{ $transaksi->created_at->format('d/m/Y') }}</td>
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

        <table class="payment-table">
            <tr>
                <td>Suku Cadang</td>
                <td class="text-right">Rp {{ number_format($transaksi->repairOrder->sparepart->price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Biaya Layanan</td>
                <td class="text-right">Rp {{ number_format($transaksi->repairOrder->estimated_cost, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Pembayaran</td>
                <td class="text-right">Rp {{ number_format($total_payment = $transaksi->repairOrder->estimated_cost + $transaksi ->repairOrder->sparepart->price, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="footer">
            Terima kasih atas kepercayaan Anda.
        </div>
    </div>
</body>
</html>
