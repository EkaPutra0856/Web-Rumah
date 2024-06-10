<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Dasar Leaflet Js</title>

    <style>
        #peta { height: 680px; }
    </style>

    <!-- CSS Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>

   <!-- Leaflet.js -->
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>

   <!-- Leaflet Geosearch -->
   <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css">
   <script src="https://unpkg.com/leaflet-geosearch@3.1.0/dist/geosearch.umd.js"></script>

   <!-- Leaflet Geosearch Providers -->
   <script src="https://unpkg.com/geosearch/src/js/l.control.geosearch.js"></script>
   <script src="https://unpkg.com/geosearch/src/js/l.geosearch.provider.google.js"></script>
</head>
<body>
    <div id="peta"></div>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const providerOSM = new GeoSearch.OpenStreetMapProvider();

            var leafletMap = L.map('peta', {
                fullscreenControl: true,
                minZoom: 2
            }).setView([-2.5489, 118.0149], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(leafletMap);

            var greenIcon = L.icon({
                iconUrl: 'https://icons.iconarchive.com/icons/icons-land/vista-map-markers/128/Map-Marker-Marker-Outside-{{$color}}-icon.png',
                iconSize: [34, 34],
                iconAnchor: [10, 34],
                popupAnchor: [-10, -34]
            });

            // Tampilkan marker
            @foreach($markers as $marker)
            
                L.marker([{{ $marker['latitude'] }}, {{ $marker['longitude'] }}], {icon: greenIcon}).addTo(leafletMap);
            @endforeach

            // Warna-warna yang akan digunakan secara berulang
            const colors = ['blue', 'red', 'green', 'yellow', 'purple'];
            let colorIndex = 0;

            // Tampilkan polygon
            @foreach($polygons as $polygon)
                var polygon = L.polygon(@json($polygon), {color: colors[colorIndex % colors.length]}).addTo(leafletMap);
                colorIndex++;
            @endforeach

            // Event listener untuk menampilkan lokasi koordinat saat peta diklik
            leafletMap.on('click', function(e) {
                alert("Koordinat: " + e.latlng.lat + ", " + e.latlng.lng);
            });

            const search = new GeoSearch.GeoSearchControl({
                provider: providerOSM,
                style: 'icon',
                searchLabel: 'Klik Pencarian Lokasi',
            });
            leafletMap.addControl(search);
        });
    </script>
    
</body>
</html>
