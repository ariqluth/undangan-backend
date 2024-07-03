<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan - Item 2</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .invitation-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
        }
        .invitation-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invitation-body {
            text-align: center;
        }
        .invitation-footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="invitation-container">
        <div class="invitation-header">
            <h1>Undangan Pernikahan</h1>
            <h2>{{ $data['nama_pengantin_pria'] }} & {{ $data['nama_pengantin_wanita'] }}</h2>
        </div>
        <div class="invitation-body">
            <p>Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud menyelenggarakan acara pernikahan kami pada:</p>
            <p><strong>Tanggal:</strong> {{ $data['tanggal_pernikahan'] }}</p>
            <p><strong>Lokasi:</strong> {{ $data['lokasi_pernikahan'] }}</p>
            <p><strong>Alamat:</strong> {{ $data['alamat'] }}</p>
            <p><strong>Longitude:</strong> {{ $data['longitude'] }}, <strong>Latitude:</strong> {{ $data['latitude'] }}</p>
        </div>
        <div class="invitation-footer">
            <p>Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu.</p>
            <p>Wassalamu'alaikum Warahmatullahi Wabarakatuh</p>
        </div>
    </div>
</body>
</html>
