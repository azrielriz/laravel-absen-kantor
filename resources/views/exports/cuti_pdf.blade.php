<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Cuti</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 5px; }
    </style>
</head>
<body>
    <h3>Laporan Cuti</h3>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Jumlah Hari</th>
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cutis as $cuti)
                <tr>
                    <td>{{ $cuti->username }}</td>
                    <td>{{ $cuti->tanggal_mulai }}</td>
                    <td>{{ $cuti->tanggal_selesai }}</td>
                    <td>{{ $cuti->jumlah_hari }}</td>
                    <td>{{ $cuti->alasan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
