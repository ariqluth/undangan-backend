@extends('layouts.app2')

@section('contentvisitor')
    <section class="section">
        <div class="section-header">
            <h1>Hallo Selamat Datang PUSBAKOR aokwokwaokawoawkoawk</h1>
        </div>
        <div class="card card-primary">
            <div class="card">
                <div class="card-body" height="200px" width="200px">
                    <div class="owl-carousel owl-theme slider" id="slider2">
                        <div>
                            <div class="image-wrapper">
                                <img alt="image" src="../assets/img/pacitan/pacitan-4.png" class="image-resize">
                            </div>
                            <div class="slider-caption">
                                <div class="slider-title">Pacitan PUSKABOR (Perlaku Usaha Berbasis Titik Koordinat)</div>
                                <div class="slider-description">Pacitan Pertama kali membuat Perlaku Usaha Berbasiss Titik
                                    Koordinat </div>
                            </div>
                        </div>
                        <div>
                            <div class="image-wrapper">
                                <img alt="image" src="../assets/img/pacitan/pacitan-1.jpg" class="image-resize">
                            </div>
                            <div class="slider-caption">
                                <div class="slider-title">Seluruh Destinasi Wisata Pacitan Telah Dibuka </div>
                                <div class="slider-description">(Tentang Pemberlakuan Pembatasan Kegiatan Masyarakat level
                                    3, level 2 dan level 1
                                    Corona Disase 2019 Diwilayah Jawa-Bali)
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="image-wrapper">
                                <img alt="image" src="../assets/img/pacitan/pacitan-2.jpg" class="image-resize">
                            </div>
                            <div class="slider-caption">
                                <div class="slider-title">Image 3</div>
                                <div class="slider-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                    sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua.</div>
                            </div>
                        </div>
                        <div>
                            <div class="image-wrapper">
                                <img alt="image" src="../assets/img/pacitan/pacitan-3.jpg" class="image-resize">
                            </div>
                            <div class="slider-caption">
                                <div class="slider-title">Image 4</div>
                                <div class="slider-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                    sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-10  col-lg-8">
                <div class="card card-primary">
                    <div class="card">
                        <div class="card-header">
                            <h4>Seputar Berita Pacitan</h4>
                        </div>
                        <div class="card-body">
                            <div class="row" style="display: flex; justify-content: center">
                                <img alt="image" src="../assets/img/pacitan/pacitan-4.png" class="image-resize">
                                <h4 style="padding: 10px">Pusbakor : Perilaku Usaha Berbasis Titik Koordinat</h4>
                                <div class="col" width="50px">
                                    <p>Usaha Mikro, Kecil dan Menengah (UMKM) memiliki peran yang penting dan strategis
                                        dalam membangun perekonomian nasional. UMKM terus meningkat dari tahun ke tahun yang
                                        terbukti dalam menyerap tenaga kerja yang besar dan mampu meningkatkan pendapatan
                                        masyarakat. Oleh karena itu, keberadaan UMKM cukup dominan dalam perekonomian
                                        Indonesia (Sarifah, 2019).
                                        Keberadaan UMKM di Indonesia berdasarkan sumber data Kementerian Koperasi dan Usaha
                                        Kecil dan Menengah (Kemenkop UKM) melaporkan total UMKM di Indonesia mencapai 20,76
                                        juta unit .usaha pada tahun 2022. Jumlah itu sudah meningkat 26,6% dibandingkan pada
                                        tahun 2021 yang sebanyak 16,4 juta UMKM. Berdasarkan data tersebut dapat diketahui
                                        bahwa UMKM berkembang dengan pesat.
                                        Berkembangnya UMKM di Indonesia menimbulkan banyak pesaing muncul bagi pengusaha
                                        UMKM yang tidak diketahui jumlahnya. Dengan ketidak tahuannya mengenai jumlah
                                        pesaing, maka pengusaha bisa saja tidak mencapai tujuan jangka panjangnya yang dapat
                                        mengakibatkan kerugian bagi pengusaha (Yuliaty, 2020).
                                        Akibat ketidaktahuan jumlah pesaing dirasakan oleh hampir seluruh pengusaha UMKM,
                                        salah satunya Kabupaten Pacitan, Jawa Timur. Untuk mengatasi akibat dari
                                        berkembangnya UMKM, maka pengusaha harus mengetahui jumlah pesaing di sekitarnya.
                                        Oleh karena itu, Bupati Kabupaten Pacitan Indrata Nur Bayuaji, S.S ingin membuat
                                        sistem untuk UMKM Kabupaten Pacitan, sehingga melakukan akad kerja dengan Politeknik
                                        Negeri Malang dan Akademi Komunitas Negeri Pacitan untuk membuat sebuah sistem
                                        berbasis website dan mobile yang digunakan untuk membantu pengusaha dan Dinas PMPTSP
                                        Kabupaten Pacitan dalam mengetahui jumlah UMKM di setiap kelurahan dan kecamatan
                                        Kabupaten Pacitan dengan menggunakan titik koordinat sebagai pemetaan dan grafik.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="card" style="display: none">
                        <div class="card-header">
                            <h4>Table</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3  col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Bar Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="barChartCanvas"></canvas>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Pie Chart</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="pieChartCanvas"></canvas>
                    </div>
                </div>
            </div>


        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h4>Map Pacitan</h4>
            </div>
            <div class="card-body" id="render-map" style="height: 500px;width: 100%; z-index: 1;">
            </div>
        </div>
    </section>
@endsection
@push('customStyle')
    <link rel="stylesheet" href="/assets/css/select2.min.css">
    <link rel="stylesheet" href="/assets/css/owl_carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/css/owl_carousel/owl.theme.default.min.css">

    <script>
        window.addEventListener('DOMContentLoaded', function() {
            const mapElement = document.getElementById("render-map")

            const defaultCoord = [-8.1115339, 111.1627972]
            map = L.map(mapElement)
            const osmTileUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
            const attrib = 'Leaflet with <a href="https://academy.byidmore.com">Id More Academy<a>'
            const osmTile = new L.TileLayer(osmTileUrl, {
                minZoom: 2,
                attribution: attrib
            })
            map.setView(new L.LatLng(defaultCoord[0], defaultCoord[1]), 10)
            map.addLayer(osmTile)
            const markers = {}

            restaurantIcon = L.icon({
                iconUrl: '{{ asset('assets/img/restaurant-icon.png') }}',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            })

            BookIcon = L.icon({
                iconUrl: '{{ asset('assets/img/book-icon.png') }}',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            })

            HotelIcon = L.icon({
                iconUrl: '{{ asset('assets/img/hotel-icon.png') }}',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            })

            GedungIcon = L.icon({
                iconUrl: '{{ asset('assets/img/gedung-icon.png') }}',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            })

            ShopingIcon = L.icon({
                iconUrl: '{{ asset('assets/img/shoping-icon.png') }}',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            })

            PantaiIcon = L.icon({
                iconUrl: '{{ asset('assets/img/beach-icon.png') }}',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [0, -32]
            })

            let markersData = [];
            const companies = [];
fetch('{{ url('/api/visitormap') }}')
    .then(response => response.json())
    .then(responseData => {
        if (Array.isArray(responseData.data)) {
            const markersData = responseData.data;

            addGeoJsonLayer('assets/js/pacitanJson.json', pacitanLayer, markersData);
            addGeoJsonLayer('assets/js/pringkukuJson.json', pringkukuLayer, markersData);
            addGeoJsonLayer('assets/js/nawanganJson.json', nawanganLayer, markersData);
            addGeoJsonLayer('assets/js/donorojoJson.json', donorojoLayer, markersData);
            addGeoJsonLayer('assets/js/keboagungJson.json', keboagungLayer, markersData);
            addGeoJsonLayer('assets/js/punungJson.json', punungLayer, markersData);
            addGeoJsonLayer('assets/js/arjosariJson.json', arjosariLayer, markersData);
            addGeoJsonLayer('assets/js/sudimoroJson.json', sudimoroLayer, markersData);
            addGeoJsonLayer('assets/js/tulakanJson.json', tulakanLayer, markersData);
            addGeoJsonLayer('assets/js/tegalomboJson.json', tegalomboLayer, markersData);
            addGeoJsonLayer('assets/js/bandarJson.json', bandarLayer, markersData);
            addGeoJsonLayer('assets/js/ngadirejoJson.json', ngadirejoLayer, markersData);
        } else {
            console.error('Data is not an array');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });

    function countCompaniesInArea(areaData, companies) {
    let count = 0;

    for (const company of companies) {
        if (company.longitude && company.latitude) {
            const point = turf.point([parseFloat(company.longitude), parseFloat(company.latitude)]);

            if (turf.booleanPointInPolygon(point, areaData.geometry)) {
                count++;

            } else {

            }
        } else {

        }
    }
    return count;
}



function updateStyle(areaData, companies) {
    const count = countCompaniesInArea(areaData, companies);

    let fillColor;
    if (count > 50) {
        fillColor = '#9384D1';
    } else if (count > 35) {
        fillColor = '#C9A7EB';
    } else if (count == 15) {
        fillColor = '#ECC9EE';
    } else {
        fillColor = '#FFDCB6';
    }

    return {
        color: 'blue',
        weight: 2,
        opacity: 0.7,
        fillColor: fillColor,
        fillOpacity: 0.3
    };
}


            let icon

            let existingMarker
            let marker;
            let makerss;
            const restaurantMarkers = L.layerGroup();

            const bookMarkers = L.layerGroup();
            const hotelMarkers = L.layerGroup();
            const gedungMarkers = L.layerGroup();
            const shopingMarkers = L.layerGroup();
            const pantaiMarkers = L.layerGroup();
            const noIconMarkers = L.layerGroup();

            const pacitanLayer = L.layerGroup();
            const pringkukuLayer = L.layerGroup();
            const nawanganLayer = L.layerGroup();
            const donorojoLayer = L.layerGroup();
            const keboagungLayer = L.layerGroup();
            const punungLayer = L.layerGroup();
            const arjosariLayer = L.layerGroup();
            const sudimoroLayer = L.layerGroup();
            const tulakanLayer = L.layerGroup();
            const tegalomboLayer = L.layerGroup();
            const bandarLayer = L.layerGroup();
            const ngadirejoLayer = L.layerGroup();

            function toggleAllLayers(enable) {
                const layers = [
                    pacitanLayer,
                    pringkukuLayer,
                    nawanganLayer,
                    donorojoLayer,
                    keboagungLayer,
                    punungLayer,
                    arjosariLayer,
                    sudimoroLayer,
                    tulakanLayer,
                    tegalomboLayer,
                    bandarLayer,
                    ngadirejoLayer,
                ];

                layers.forEach(layer => {
                    if (enable) {
                        layer.addTo(map);
                    } else {
                        layer.removeFrom(map);
                    }
                });
            }

            const toggleAllControl = L.Control.extend({
                options: {
                    position: 'topleft'
                },

                onAdd: function(map) {
                    const container = L.DomUtil.create('div',
                        'leaflet-bar leaflet-control leaflet-control-custom');

                    const img = document.createElement('img');
                    img.src =
                        '../assets/img/pacitan/collor-pallet.png';
                    img.style.width = '100%';
                    img.style.height = '100%';
                    container.appendChild(img);


                    container.style.backgroundColor = 'white';
                    container.style.width = '250px';
                    container.style.height = '35px';
                    container.style.textAlign = 'center';
                    container.style.lineHeight = '10px';
                    container.style.cursor = 'pointer';

                    container.onclick = function() {
                        // Cek apakah layer pertama (pacitanLayer) ada di peta untuk menentukan apakah layer aktif atau tidak
                        const enable = !map.hasLayer(pacitanLayer);
                        toggleAllLayers(enable);
                    };

                    return container;
                }
            });

            map.addControl(new toggleAllControl());

            fetch('{{ url('/api/map') }}')
                .then(response => response.json())
                .then(responseData => {
                    if (Array.isArray(responseData.data)) {
                        responseData.data.forEach(marker => {
                            var latitude = marker.latitude;
                            var longitude = marker.longtitude;
                            var kbli = marker.kbli;

                            companies.push({
                                latitude: latitude,
                                longitude: longitude,
                                kbli: kbli,
                            });

                            if (!latitude || !longitude) {
                                return;
                            }

                            if (["56102", "10779", "11040", "10391", "10794", "10792", "10799", "10399",
                                    "10710", "10761",
                                    "21022", "10772", "56103", "56304", "01261", "10212", "10793",
                                    "10740", "56101", "56303",
                                    "10750",
                                    "11090", "01461", "56109", "47991", "47249", "46339", "56301"
                                ].includes(kbli)) {
                                icon = restaurantIcon;
                            } else if (["85133", "85132", "85139", "85491", "85492", "85121", "85220",
                                    "85493", "85497",
                                    "85498", "85134", "85321", "85322", "85240", "85500", "85420",
                                    "85495", "85122", "85440",
                                    "85142", "85141", "85499",
                                    "85410"
                                ].includes(kbli)) {
                                icon = BookIcon;
                            } else if (["55120", "55110", "55194"].includes(kbli)) {
                                icon = HotelIcon;
                            } else if (["41016", "41015", "31001", "82301", "14111", "16299", "16299",
                                    "10631", "10330",
                                    "16101",
                                ].includes(kbli)) {
                                icon = GedungIcon;
                            } else if (["47612", "47630", "47591", "47592", "47241", "47212", "47213",
                                    "47219", "47411",
                                    "01285", "47420", "47752",
                                    "47762", "47611", "47599", "47112", "45302", "47711", "47301",
                                    "47521", "47524", "47526",
                                    "47796", "47793",
                                    "47111", "47725", "47243", "47242", "47215", "47721", "47772",
                                    "45104", "45404", "47530",
                                    "47192", "47529", "47528",
                                    "47597", "47919", "47772", "47881", "47913", "47415", "46100",
                                    "47912", "47913", "47303",
                                    "47211", "47754", "47741", "47511",
                                    "47245", "47243", "47593", "47530", "47882", "47216", "47789",
                                    "47999", "47753", "47761",
                                    "47414", "47111", "47724", "47735", "47920", "47914", "47214",
                                    '47733'
                                ].includes(kbli)) {
                                icon = ShopingIcon;
                            } else if (["93224", "30112"].includes(kbli)) {
                                icon = PantaiIcon;
                            } else {
                                icon = null;
                            }

                            var customIcon = icon ? icon : L.icon({
                                iconUrl: '{{ asset('assets/img/user.png') }}',
                                iconSize: [32, 32],
                                iconAnchor: [16, 32],
                                popupAnchor: [0, -32]
                            });

                            var newMarker = L.marker([latitude, longitude], {
                                icon: customIcon
                            }).on('click', function() {
                                fetch('/api/popup/' + marker.id)
                                    .then(response => response.json())
                                    .then(data => {
                                        var alamat = data.alamat !== undefined ? data
                                            .alamat : "Tidak ada data";
                                        var kbli = data.kbli !== undefined ? data.kbli :
                                            "Tidak ada data";
                                        var perusahaan = data.nama_perusahaan !==
                                            undefined ? data.nama_perusahaan :
                                            "Tidak ada data";
                                        var pengusaha = data.nama_pengusaha !==
                                            undefined ? data.nama_pengusaha :
                                            "Tidak ada data";
                                        var uraian_jenis_perusahaan = data
                                            .nama_uraian_jenis_perusahaan !== undefined ?
                                            data.nama_uraian_jenis_perusahaan :
                                            "Tidak ada data";
                                        var uraian_skala_usaha = data
                                            .nama_uraian_skala_usaha !== undefined ? data
                                            .nama_uraian_skala_usaha : "Tidak ada data";
                                        var uraian_resiko_proyek = data
                                            .nama_uraian_resiko_proyek !== undefined ?
                                            data.nama_uraian_resiko_proyek :
                                            "Tidak ada data";
                                        var judul_kbli = data.judul_kbli !== undefined ?
                                            data.judul_kbli : "Tidak ada data";
                                        var sektor = data.sektor !== undefined ? data
                                            .sektor : "Tidak ada data";
                                        var gambars;
                                        var additionalImages = '';
                                        if (data.gambar !== undefined) {
                                            var starredImage = data.gambar.find(img => img
                                                .star === "1");
                                            if (starredImage !== undefined) {
                                                gambars = starredImage.path;
                                            } else {
                                                gambars = "/assets/img/default.jpg";
                                            }

                                            var otherImages = data.gambar.filter(img => img
                                                .star === "0");
                                            additionalImages = otherImages.map(img =>
                                                '<img src="' + baseUrl + img.path +
                                                '" style="width:100px;height:100px;display:block;margin:0 auto;"><br>'
                                            ).join('');
                                        } else {
                                            gambars = "/assets/img/default.jpg";
                                        }
                                        var baseUrl = '{{ url('') }}';




                                        var content =
                                            '<img src="' + baseUrl + gambars +
                                            '" style="width:100px;height:100px;display:block;margin:0 auto;"><br>' +
                                            additionalImages +
                                            '<b>Nama Perusahaan:</b> ' + perusahaan +
                                            '<br>' +
                                            '<b>Nama Pengusaha:</b> ' + pengusaha + '<br>' +
                                            '<b>Alamat:</b> ' + alamat + '<br>' +
                                            '<b>KBLI:</b> ' + kbli + ' - ' + judul_kbli +
                                            '-' + sektor + '<br>' +
                                            '<b>Uraian Jenis Perusahaan:</b> ' +
                                            uraian_jenis_perusahaan + '<br>' +
                                            '<b>Uraian Skala Usaha:</b> ' +
                                            uraian_skala_usaha + '<br>' +
                                            '<b>Uraian Resiko Proyek:</b> ' +
                                            uraian_resiko_proyek;

                                        newMarker.bindPopup(content).openPopup();
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                            }).addTo(map);


                            if (icon === restaurantIcon) {
                                restaurantMarkers.addLayer(newMarker);
                            } else if (icon === BookIcon) {
                                bookMarkers.addLayer(newMarker);
                            } else if (icon === HotelIcon) {
                                hotelMarkers.addLayer(newMarker);
                            } else if (icon === GedungIcon) {
                                gedungMarkers.addLayer(newMarker);
                            } else if (icon === ShopingIcon) {
                                shopingMarkers.addLayer(newMarker);
                            } else if (icon === PantaiIcon) {
                                pantaiMarkers.addLayer(newMarker);
                            } else {
                                noIconMarkers.addLayer(newMarker);
                            }
                        });
                    } else {
                        console.error('Data is not an array');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });



function addGeoJsonLayer(url, layerGroup, companies) {
    fetch(url)
        .then(response => response.json())
        .then(data => {
            const geoJsonLayer = L.geoJSON(data, {
                style: (areaData) => updateStyle(areaData, companies)
            });
            geoJsonLayer.addTo(layerGroup);
        })
        .catch(error => console.error(error));
}

            // let companiess = [];

            addGeoJsonLayer('assets/js/pacitanJson.json', pacitanLayer, markersData);
            addGeoJsonLayer('assets/js/pringkukuJson.json', pringkukuLayer, markersData);
            addGeoJsonLayer('assets/js/nawanganJson.json', nawanganLayer, markersData);
            addGeoJsonLayer('assets/js/donorojoJson.json', donorojoLayer, markersData);
            addGeoJsonLayer('assets/js/keboagungJson.json', keboagungLayer, markersData);
            addGeoJsonLayer('assets/js/punungJson.json', punungLayer, markersData);
            addGeoJsonLayer('assets/js/arjosariJson.json', arjosariLayer, markersData);
            addGeoJsonLayer('assets/js/sudimoroJson.json', sudimoroLayer, markersData);
            addGeoJsonLayer('assets/js/tulakanJson.json', tulakanLayer, markersData);
            addGeoJsonLayer('assets/js/tegalomboJson.json', tegalomboLayer, markersData);
            addGeoJsonLayer('assets/js/bandarJson.json', bandarLayer, markersData);
            addGeoJsonLayer('assets/js/ngadirejoJson.json', ngadirejoLayer, markersData);

            const overlayMaps = {
                "Kecamatan Pacitan": pacitanLayer,
                "Kecamatan Pringkuku": pringkukuLayer,
                "Kecamatan Nawangan": nawanganLayer,
                "Kecamatan Donorojo": donorojoLayer,
                "Kecamatan Keboagung": keboagungLayer,
                "Kecamatan Punung": punungLayer,
                "Kecamatan Arjosari": arjosariLayer,
                "Kecamatan Sudimoro": sudimoroLayer,
                "Kecamatan Tulakan": tulakanLayer,
                "Kecamatan Tegalombo": tegalomboLayer,
                "Kecamatan Bandar": bandarLayer,
                "Kecamatan Ngadirejo": ngadirejoLayer
            };

            for (let layer in overlayMaps) {
                overlayMaps[layer].addTo(map);
            }
            L.control.layers(null, overlayMaps).addTo(map);


            // noIconMarkers.addTo(map);


            map.addLayer(restaurantMarkers);
            // console.log('restaurantMarkers added to map:', map.hasLayer(restaurantMarkers));


            map.addLayer(bookMarkers);
            // console.log('bookMarker added to map:', map.hasLayer(bookMarkers));

            map.addLayer(hotelMarkers);
            // console.log('hotelMarker added to map:', map.hasLayer(hotelMarkers));
            map.addLayer(gedungMarkers);
            // console.log('bookMarker added to map:', map.hasLayer(gedungMakers));
            map.addLayer(shopingMarkers);
            map.addLayer(pantaiMarkers);

            map.addLayer(noIconMarkers);


            // console.log('bookMarkers added to map:', map.hasLayer(pantaiMakers));


            console.log('restaurantMarkers:', restaurantMarkers.getLayers().length);
            console.log('bookMarkers:', bookMarkers.getLayers().length);
            console.log('icon:', icon);

            const layerControl = L.control.layers({}, {});

            const allMarkers = L.layerGroup([restaurantMarkers, gedungMarkers, hotelMarkers, shopingMarkers,
                pantaiMarkers, bookMarkers, noIconMarkers
            ]).addTo(map);

            const restaurantMarker = L.layerGroup([restaurantMarkers]).addTo(map);


            const bookMarker = L.layerGroup([bookMarkers]).addTo(map);

            const gedungMarker = L.layerGroup([gedungMarkers]).addTo(map);


            const hotelMarker = L.layerGroup([hotelMarkers]).addTo(map);

            const shopingMarker = L.layerGroup([shopingMarkers]).addTo(map);

            const pantaiMarker = L.layerGroup([pantaiMarkers]).addTo(map);


            const noIconMarker = L.layerGroup([noIconMarkers]).addTo(map);





            if (restaurantMarker.getLayers().length > 0) {
                layerControl.addOverlay(restaurantMarker, "Tempat Makan", {
                    collapsed: true,
                    layerGroup: true,
                    icon: restaurantIcon,
                });
            }

            if (bookMarker.getLayers().length > 0) {
                layerControl.addOverlay(bookMarker, "Pendidikan", {
                    collapsed: true,
                    layerGroup: true,
                    icon: BookIcon,
                });
            }

            if (hotelMarker.getLayers().length > 0) {
                layerControl.addOverlay(hotelMarker, "Penginapan", {
                    collapsed: true,
                    layerGroup: true,
                    icon: HotelIcon,
                });
            }

            if (gedungMarker.getLayers().length > 0) {
                layerControl.addOverlay(gedungMarker, "Perusahaan", {
                    collapsed: true,
                    layerGroup: true,
                    icon: GedungIcon,
                });
            }

            if (shopingMarker.getLayers().length > 0) {
                layerControl.addOverlay(shopingMarker, "Belanjaan", {
                    collapsed: true,
                    layerGroup: true,
                    icon: ShopingIcon,
                });
            }

            if (pantaiMarker.getLayers().length > 0) {
                layerControl.addOverlay(pantaiMarker, "Pantai", {
                    collapsed: true,
                    layerGroup: true,
                    icon: PantaiIcon,
                });
            }

            if (allMarkers.getLayers().length > 0) {
                layerControl.addOverlay(allMarkers, "All Markers", {
                    collapsed: true,
                    layerGroup: true,
                });

            }

            if (noIconMarker.getLayers().length > 0) {
                layerControl.addOverlay(noIconMarker, "No Icon Markers", {
                    collapsed: true,
                    layerGroup: true
                });
            }

            if (layerControl._layers.length > 0) {
                layerControl.addTo(map);


            }

        });
    </script>
@endpush

@push('customPlugin')
@endpush


@push('customScript')
    <script src="/assets/js/modules/owl_crousel.min.js"></script>
    <script src="/assets/js/page/modules-slider.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var themeColors = [
            '#575fcf', '#34bfa3', '#f4516c', '#ffb822', '#36a3f7',
            '#fb9678', '#a092f1', '#f3c200', '#f96868', '#8d6e63',
            '#63ED7A', '#191D21', '#E3EAEF', '#6777EF'
        ];
        var pieChartCanvas = document.getElementById("pieChartCanvas").getContext("2d");

        fetch('{{ url('/api/chartdata') }}')
            .then(response => response.json())
            .then(responseData => {
                var labels = responseData.chartData.map(function(item) {
                    return item.nama_kecamatan;
                });
                var data = responseData.chartData.map(function(item) {
                    return item.jumlah_kbliperusahaan;
                });

                // console.log(data);

                new Chart(pieChartCanvas, {
                    type: "pie",
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: generateRandomColors(labels.length),
                            borderWidth: 4,
                        }],
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'bottom',
                        },
                    }
                });

                // Here is where you can use responseData.total
                // console.log('Total:', responseData.total);
            })
            .catch(error => {
                console.error('Error:', error);
            });

        function generateRandomColors(length) {
            var colors = [];
            var usedColors = [];

            for (var i = 0; i < length; i++) {
                var randomIndex = Math.floor(Math.random() * themeColors.length);
                var color = themeColors[randomIndex];

                while (usedColors.includes(color)) {
                    randomIndex = Math.floor(Math.random() * themeColors.length);
                    color = themeColors[randomIndex];
                }

                colors.push(color);
                usedColors.push(color);
            }

            return colors;
        }
    </script>

    <script>
        var themeColors = [
            '#575fcf', '#34bfa3', '#f4516c', '#ffb822', '#36a3f7',
            '#fb9678', '#a092f1', '#f3c200', '#f96868', '#8d6e63',
            '#63ED7A', '#191D21', '#E3EAEF', '#6777EF'
        ];
        var barChartCanvas = document.getElementById("barChartCanvas").getContext("2d");

        fetch('{{ url('/api/chartdata') }}')
            .then(response => response.json())
            .then(responseData => {
                var labels = responseData.chartData.map(function(item) {
                    return item.nama_kecamatan;
                });
                var data = responseData.chartData.map(function(item) {
                    return item.jumlah_kbliperusahaan;
                });

                // console.log(data);

                new Chart(barChartCanvas, {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Perusahaan dan Pengusaha',
                            data: data,
                            backgroundColor: generateRandomColors(labels.length),
                            borderWidth: 4,
                        }],
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'bottom',
                        },
                    }
                });

                // Here is where you can use responseData.total
                // console.log('Total:', responseData.total);
            })
            .catch(error => {
                console.error('Error:', error);
            });

        function generateRandomColors(length) {
            var colors = [];
            var usedColors = [];

            for (var i = 0; i < length; i++) {
                var randomIndex = Math.floor(Math.random() * themeColors.length);
                var color = themeColors[randomIndex];

                while (usedColors.includes(color)) {
                    randomIndex = Math.floor(Math.random() * themeColors.length);
                    color = themeColors[randomIndex];
                }

                colors.push(color);
                usedColors.push(color);
            }

            return colors;
        }
    </script>


    <script></script>
@endpush
