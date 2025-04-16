<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nota Servis</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { border: 1px solid #000; padding: 15px; }
        table { width: 100%; margin-top: 10px; }
        td { padding: 5px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Nota Servis</h2>
        <p>Tukang servis abal abal </p>
    </div>
    <div class="content">
        <table>
            <tr>
                <td><strong>Kode Nota:</strong></td>
                <td>{{ $servis->kode_notaservis }}</td>
            </tr>
            <tr>
                <td><strong>Tanggal:</strong></td>
                <td>{{ $servis->tanggal }}</td>
            </tr>
            <tr>
                <td><strong>Nama Pelanggan:</strong></td>
                <td>{{ $servis->nama_pelanggan }}</td>
            </tr>
            <tr>
                <td><strong>No. Telp:</strong></td>
                <td>{{ $servis->no_telp }}</td>
            </tr>
            <tr>
                <td><strong>Deskripsi:</strong></td>
                <td>{{ $servis->deskripsi }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
