<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan - Item 1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #f3f4f6;
            color: #333;
        }
        .invitation-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            border: 2px solid #e0e0e0;
            border-radius: 15px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .invitation-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invitation-header h1 {
            font-family: 'Great Vibes', cursive;
            font-size: 3em;
            color: #d4af37;
        }
        .invitation-header h2 {
            font-size: 2em;
            color: #555;
        }
        .invitation-body {
            text-align: center;
            margin-bottom: 30px;
        }
        .invitation-body p {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .invitation-footer {
            text-align: center;
            margin-top: 30px;
        }
        .invitation-footer p {
            font-size: 1.1em;
            margin-bottom: 10px;
        }
        .tamu-list {
            list-style: none;
            padding: 0;
            margin-top: 20px;
        }
        .tamu-list li {
            font-size: 1em;
            margin-bottom: 5px;
        }
        .decorative-line {
            width: 100px;
            height: 2px;
            background-color: #d4af37;
            margin: 20px auto;
        }
        #map {
            height: 300px;
            margin-top: 20px;
        }
        .qr-code {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="invitation-container">
        <div class="invitation-header">
            <h1>Undangan Pernikahan</h1>
            <h2 id="nama_pengantin"></h2>
        </div>
        <div class="decorative-line"></div>
        <div class="invitation-body">
            <p>Dengan memohon rahmat dan ridho Allah SWT, kami bermaksud menyelenggarakan acara pernikahan kami pada:</p>
            <p><strong>Tanggal:</strong> <span id="tanggal_pernikahan"></span></p>
            <p><strong>Lokasi:</strong> <span id="lokasi_pernikahan"></span></p>
            <p style="display: none"><strong>Longitude:</strong> <span id="longitude"></span>, <strong>Latitude:</strong> <span id="latitude"></span></p>
            <div id="map"></div>
        </div>
        <div class="decorative-line"></div>
        <div class="invitation-footer">
            <p>Merupakan suatu kehormatan dan kebahagiaan bagi kami apabila Bapak/Ibu/Saudara/i berkenan hadir untuk memberikan doa restu.</p>
            <p>Wassalamu'alaikum Warahmatullahi Wabarakatuh</p>
            <ul class="tamu-list" id="tamu_list"></ul>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/@bitjson/qr-code@1.0.2/dist/qr-code.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const undanganId = "{{ $undangan_id }}";
            const namaTamu = "{{ $nama_tamu }}";
            let apiUrl = `/api/tamu/${undanganId}/share`;

            if (namaTamu) {
                apiUrl += `?nama_tamu=${encodeURIComponent(namaTamu)}`;
            }

            console.log('Fetching data from:', apiUrl);

            fetch(apiUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        const undangan = data.data;
                        document.getElementById('nama_pengantin').innerText = `${undangan.nama_pengantin_pria} & ${undangan.nama_pengantin_wanita}`;
                        document.getElementById('tanggal_pernikahan').innerText = undangan.tanggal_pernikahan;
                        document.getElementById('lokasi_pernikahan').innerText = undangan.lokasi_pernikahan;
                        document.getElementById('longitude').innerText = undangan.longitude;
                        document.getElementById('latitude').innerText = undangan.latitude;

                        // Menampilkan peta
                        const map = L.map('map').setView([undangan.latitude, undangan.longitude], 13);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);
                        L.marker([undangan.latitude, undangan.longitude]).addTo(map)
                            .bindPopup(`${undangan.lokasi_pernikahan}`)
                            .openPopup();

                        // Menampilkan tamu
                        const tamuList = document.getElementById('tamu_list');
                        undangan.tamus.forEach((tamu, index) => {
                            const tamuItem = document.createElement('li');
                            tamuItem.innerText = `${tamu.nama_tamu} (${tamu.kategori}) - ${tamu.status}`;
                            tamuList.appendChild(tamuItem);

                            // Generate QR code
                            const qrCodeContainer = document.createElement('qr-code');
                            qrCodeContainer.setAttribute('id', `qr${index}`);
                            qrCodeContainer.setAttribute('contents', tamu.kodeqr);
                            qrCodeContainer.setAttribute('module-color', '#1c7d43');
                            qrCodeContainer.setAttribute('position-ring-color', '#13532d');
                            qrCodeContainer.setAttribute('position-center-color', '#70c559');
                            qrCodeContainer.setAttribute('style', 'width: 200px; height: 200px; margin: 2em auto; background-color: #fff;');
                            tamuItem.appendChild(qrCodeContainer);

                            // Add image inside QR code
                            const img = document.createElement('img');
                            img.setAttribute('src', '{{ asset("assets/img/stisla.svg") }}');
                            img.setAttribute('slot', 'icon');
                            qrCodeContainer.appendChild(img);

                            qrCodeContainer.addEventListener('codeRendered', () => {
                                qrCodeContainer.animateQRCode('RadialRippleIn');
                            });
                        });
                    } else {
                        alert('Data not found');
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                    alert('An error occurred while fetching data');
                });
        });
    </script>
</body>
</html>
