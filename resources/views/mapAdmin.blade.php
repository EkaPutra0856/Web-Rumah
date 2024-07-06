<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Dasar Leaflet Js</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


    <style>
        #peta {
            height: 680px;
            z-index: 1;
        }

        /* CSS for sidebar */
        .sidebar {
            font-family: sans-serif;
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 3;
            top: 0;
            right: 0;
            background-color: #fff;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 20px;
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

       

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 2;
            display: none;
        }

        /* CSS for legend container */
        .legend-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: white;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            z-index: 2;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .legend-item img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }
        .region-list {
        list-none;
        padding: 0;
        margin: 0;
        max-height: 150px; /* Tinggi maksimum daftar */
        overflow-y: auto; /* Membuat daftar scrollable */
    }

    .region-list li {
        padding: 10px;
        border-bottom: 1px solid #ccc;
        display: flex;
        align-items: center;
    }

    .region-list li img {
        max-width: 50px; /* Sesuaikan dengan ukuran yang diinginkan */
        height: auto;
        margin-left: auto; /* Posisikan gambar di sebelah kanan */
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
    <a href="javascript:void(0)" onclick="closeNav()">×</a>
    <a href="/dashboard-adminwilayah">Dashboard</a>
    <a href="/rumah">Rumah</a>
    <a href="/kk">KK</a>
</div>




    <!-- Open button -->
    <button class="fixed top-2 right-2 z-40 px-4 py-2 bg-blue-500 text-white border border-gray-300 rounded shadow hover:bg-whitesmoke" onclick="toggleNav()">
        ☰ Menu
    </button>
    
    <!-- Overlay -->
    <div id="overlay" class="overlay" onclick="closeNav()"></div>

    <!-- Legend Container -->
    <div class="legend-container">
        <div class="legend-item">
            <img src="https://icons.iconarchive.com/icons/icons-land/vista-map-markers/128/Map-Marker-Marker-Outside-Chartreuse-icon.png" alt="Sehat">
            <span>Rumah Sehat</span>
        </div>
        
        <div class="legend-item">
            <img src="https://icons.iconarchive.com/icons/icons-land/vista-map-markers/128/Map-Marker-Marker-Outside-Pink-icon.png" alt="Tidak Layak">
            <span>Rumah Tidak Layak</span>
        </div>
    </div>
 <!-- Button to open the popup -->
 <button id="showPopupBtn" class="fixed bottom-2 left-2 z-10 px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600">
    Show Regions
</button>

 <!-- Popup container -->
 <div id="regionPopup" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); z-index: 1001; border-radius: 10px;">
    <div class="flex justify-end mb-4 p-3 w-full py-2 px-4">
        <h2 class="text-3xl font-bold">Daftar Kelurahan/Desa</h2>

    </div>
     {{-- <div class="flex justify-end mb-4 p-3">
        <form action="{{ url('/search-kelurahan_desa') }}" method="GET" class="flex items-center">
            <input type="text" name="query" placeholder="Search kelurahan/desa..."
                   class="w-full py-2 px-4 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-md">
                Search
            </button>
        </form>
    </div> --}}
     <ul id="regionList" class="region-list"></ul>
     <button class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Close
    </button>
    
 </div>
 <!-- Overlay -->
 <div id="regionOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000;" onclick="closeRegionPopup()"></div>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        // Function to open the region popup
        function showRegionPopup() {
            document.getElementById('regionPopup').style.display = 'block';
            document.getElementById('regionOverlay').style.display = 'block';
            loadRegions();
        }

        // Function to close the region popup
        function closeRegionPopup() {
            document.getElementById('regionPopup').style.display = 'none';
            document.getElementById('regionOverlay').style.display = 'none';
        }

        // Event listener for the button
        document.getElementById('showPopupBtn').addEventListener('click', showRegionPopup);

        // Function to load regions from the database and display them in the popup
         // Function to open the region popup
         function showRegionPopup() {
            document.getElementById('regionPopup').style.display = 'block';
            document.getElementById('regionOverlay').style.display = 'block';
            loadRegions();
        }

        // Function to close the region popup
        function closeRegionPopup() {
            document.getElementById('regionPopup').style.display = 'none';
            document.getElementById('regionOverlay').style.display = 'none';
        }

        // Event listener for the button
        document.getElementById('showPopupBtn').addEventListener('click', showRegionPopup);
        
        function loadRegions() {
    fetch('/api/regions')
        .then(response => response.json())
        .then(data => {
            const regionList = document.getElementById('regionList');
            regionList.innerHTML = ''; // Hapus daftar yang ada sebelumnya

            data.forEach(region => {
                const li = document.createElement('li');
                li.textContent = region.kelurahan_desa;
                
                // Buat elemen gambar dengan gambar tetap dari storage/images/searchimage.jpeg
                const img = document.createElement('img');
                img.src = '/storage/images/searchicon.jpg'; // Path ke gambar tetap di dalam public/storage/
                img.alt = region.kelurahan_desa;
                img.title = region.kelurahan_desa;
                img.style.maxWidth = '50px'; // Sesuaikan dengan ukuran yang diinginkan

                 // Add click event to the image
    img.addEventListener('click', function() {
        closeRegionPopup(); // Close the popup
        moveToCoordinates(region.id); // Move to coordinates associated with region id
    });
                li.appendChild(img);

                regionList.appendChild(li);
            });
        })
        .catch(error => {
            console.error('Error fetching regions:', error);
        });
}



        document.addEventListener('DOMContentLoaded', function () {
            const providerOSM = new GeoSearch.OpenStreetMapProvider();

            var leafletMap = L.map('peta', {
        fullscreenControl: true,
        minZoom: 2
    }).setView([-7.150975, 110.140259], 8); // Koordinat Jawa Tengah

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
                    // copyButton.innerText = 'Copy';
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

            // Tampilkan marker
            @foreach ($markers as $marker)
                var iconMark
                console.log("{{ $marker['status'] }}")
                if ("{{ $marker['status'] }}" == "Sehat") {
                    iconMark = createIconMarker("Chartreuse")
                } else {
                    iconMark = createIconMarker("Pink")
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

    leafletMap.getContainer().addEventListener('contextmenu', function (e) {
        e.preventDefault();
    });

    leafletMap.on('click', function (e) {
        leafletMap.setView(e.latlng, leafletMap.getZoom() + 1);
    });

    const search = new GeoSearch.GeoSearchControl({
        provider: providerOSM,
        style: 'icon',
        searchLabel: 'Klik Pencarian Lokasi',
    });
    leafletMap.addControl(search);

    function moveToCoordinates(regionId) {
        fetch(`/api/coordinates/${regionId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.latitude && data.longitude) {
                    leafletMap.setView([data.latitude, data.longitude], 15);
                } else {
                    console.error('Coordinates not found for region id:', regionId);
                }
            })
            .catch(error => {
                console.error('Error fetching coordinates:', error);
            });
    }

    window.moveToCoordinates = moveToCoordinates;
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
