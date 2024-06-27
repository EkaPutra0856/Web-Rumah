<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Dasar Leaflet Js</title>

    <style>
        #peta {
            height: 680px;
            z-index: 1;
        }

        /* CSS for sidebar */
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 2;
            top: 0;
            right: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #f1f1f1;
        }

        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #111;
            color: white;
            padding: 10px 15px;
            border: none;
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 3;
        }

        .openbtn:hover {
            background-color: #444;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
            display: none;
        }
    </style>

    <!-- CSS Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin="" />

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

    <!-- Sidebar -->
    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
    </div>

    <!-- Open button -->
    <button class="openbtn" onclick="toggleNav()">☰ Open Sidebar</button>

    <!-- Overlay -->
    <div id="overlay" class="overlay" onclick="closeNav()"></div>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const providerOSM = new GeoSearch.OpenStreetMapProvider();

            var leafletMap = L.map('peta', {
                fullscreenControl: true,
                minZoom: 2
            }).setView([-2.5489, 118.0149], 5);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(leafletMap);

            function createIconMarker(color) {
                return L.icon({
                    iconUrl: `https://icons.iconarchive.com/icons/icons-land/vista-map-markers/128/Map-Marker-Marker-Outside-${color}-icon.png`,
                    iconSize: [34, 34],
                    iconAnchor: [10, 34],
                    popupAnchor: [-10, -34]
                });
            }

            // Tampilkan marker
            @foreach ($markers as $marker)
                var iconMark;
            if ("{{ $marker['status'] }}" == "Sehat") {
                iconMark = createIconMarker("Chartreuse");
            } else {
                iconMark = createIconMarker("Pink");
            }

            L.marker([{{ $marker['latitude'] }}, {{ $marker['longitude'] }}], {
                icon: iconMark
            }).addTo(leafletMap);
            @endforeach

            // Warna-warna yang akan digunakan secara berulang
            const colors = ['blue', 'red', 'green', 'yellow', 'purple'];
            let colorIndex = 0;

            // Tampilkan polygon
            @foreach ($polygons as $polygon)
                var polygon = L.polygon(@json($polygon), {
                    color: colors[colorIndex % colors.length]
                }).addTo(leafletMap);
            colorIndex++;
            @endforeach

            let rightClickMarker;

// Function to show custom alert
function showAlert(message, lat, lng) {
    // Create the alert container if it doesn't exist
    if (!document.getElementById('customAlert')) {
        const alertContainer = document.createElement('div');
        alertContainer.id = 'customAlert';
        alertContainer.style.position = 'fixed';
        alertContainer.style.top = '50%';
        alertContainer.style.left = '50%';
        alertContainer.style.transform = 'translate(-50%, -50%)';
        alertContainer.style.backgroundColor = 'white';
        alertContainer.style.padding = '20px';
        alertContainer.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.5)';
        alertContainer.style.zIndex = 1001;
        alertContainer.style.borderRadius = '25px';

        const alertMessage = document.createElement('p');
        alertMessage.id = 'alertMessage';
        alertContainer.appendChild(alertMessage);

        const copyButton = document.createElement('button');
        copyButton.innerText = 'Copy';
        copyButton.style.marginTop = '10px';
        copyButton.style.marginLeft = '160px';
        
        copyButton.addEventListener('click', function () {
            const textToCopy = `${lat},  ${lng}`;
            navigator.clipboard.writeText(textToCopy).then(() => {
                closeAlert();
            });
        });

        alertContainer.appendChild(copyButton);
        document.body.appendChild(alertContainer);

        // Create the overlay if it doesn't exist
        if (!document.getElementById('alertOverlay')) {
            const overlay = document.createElement('div');
            overlay.id = 'alertOverlay';
            overlay.style.position = 'fixed';
            overlay.style.top = 0;
            overlay.style.left = 0;
            overlay.style.width = '100%';
            overlay.style.height = '100%';
            overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
            overlay.style.zIndex = 1000;
            document.body.appendChild(overlay);

            // Close alert when clicking on the overlay
            overlay.addEventListener('click', closeAlert);
        }
    }

    // Set the message and show the alert
    document.getElementById('alertMessage').innerText = message;
    document.getElementById('customAlert').style.display = 'block';
    document.getElementById('alertOverlay').style.display = 'block';
}

// Function to close the custom alert
function closeAlert() {
    document.getElementById('customAlert').style.display = 'none';
    document.getElementById('alertOverlay').style.display = 'none';
}

// Event listener untuk menampilkan lokasi koordinat dan menambahkan marker saat peta diklik kanan
leafletMap.on('contextmenu', function (e) {
    if (rightClickMarker) {
        leafletMap.removeLayer(rightClickMarker);
    }

    rightClickMarker = L.marker([e.latlng.lat, e.latlng.lng], {
        icon: createIconMarker("Azure")
    }).addTo(leafletMap);
    showAlert("Koordinat: " + e.latlng.lat + ", " + e.latlng.lng, e.latlng.lat, e.latlng.lng);
});


            // Prevent default right-click menu
            leafletMap.getContainer().addEventListener('contextmenu', function (e) {
                e.preventDefault();
            });

            // Event listener untuk zoom saat peta diklik kiri
            leafletMap.on('click', function (e) {
                leafletMap.setView(e.latlng, leafletMap.getZoom() + 1);
            });

            const search = new GeoSearch.GeoSearchControl({
                provider: providerOSM,
                style: 'icon',
                searchLabel: 'Klik Pencarian Lokasi',
            });
            leafletMap.addControl(search);
        });

        function toggleNav() {
            var sidebar = document.getElementById("mySidebar");
            var overlay = document.getElementById("overlay");
            if (sidebar.style.width === "250px") {
                closeNav();
            } else {
                openNav();
            }
        }

        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("overlay").style.display = "block";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("overlay").style.display = "none";
        }
    </script>

</body>

</html>
