<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Pernikahan - Item 1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/bingkai/bingkai.css') }}" />
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
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
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

                        const map = L.map('map').setView([undangan.latitude, undangan.longitude], 13);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);
                        L.marker([undangan.latitude, undangan.longitude]).addTo(map)
                            .bindPopup(`${undangan.lokasi_pernikahan}`)
                            .openPopup();

                       
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(position => {
                                const currentLocation = [position.coords.latitude, position.coords.longitude];
                                L.Routing.control({
                                    waypoints: [
                                        L.latLng(currentLocation),
                                        L.latLng(undangan.latitude, undangan.longitude)
                                    ],
                                    routeWhileDragging: true
                                }).addTo(map);
                            }, error => {
                                console.error('Error getting current location:', error);
                            });
                        } else {
                            console.error('Geolocation is not supported by this browser.');
                        }

                    
                        const tamuList = document.getElementById('tamu_list');
                        undangan.tamus.forEach((tamu, index) => {
                            const tamuItem = document.createElement('li');
                            tamuItem.innerText = `${tamu.nama_tamu} (${tamu.kategori}) - ${tamu.status}`;
                            tamuList.appendChild(tamuItem);

                            
                            const qrCodeContainer = document.createElement('qr-code');
                            qrCodeContainer.setAttribute('id', `qr${index}`);
                            qrCodeContainer.setAttribute('contents', tamu.kodeqr);
                            qrCodeContainer.setAttribute('module-color', '#1c7d43');
                            qrCodeContainer.setAttribute('position-ring-color', '#13532d');
                            qrCodeContainer.setAttribute('position-center-color', '#70c559');
                            qrCodeContainer.setAttribute('style', 'width: 200px; height: 200px; margin: 2em auto; background-color: #fff;');
                            tamuItem.appendChild(qrCodeContainer);

                            
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
