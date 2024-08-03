@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">
            Xarita
        </h5>

        <div class="table-responsive text-nowrap">
            <div id="map" style="width: 100%; height: 600px"></div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('mapAssets/leaflet.js') }}"></script>
    <script>
        // Initialize the map
        var map = L.map('map').setView([41.55, 60.63333], 11);

        // Set up the OSM layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        var dealerIcon = L.icon({
            iconUrl: 'locationIcon1.png',
            iconSize: [38, 38],
            iconAnchor: [18, 38],
            popupAnchor: [0, -35]
        })
        var agentIcon = L.icon({
            iconUrl: 'locationIcon2.png',
            iconSize: [38, 38],
            iconAnchor: [18, 38],
            popupAnchor: [0, -35]
        })
        var cashierIcon = L.icon({
            iconUrl: 'locationIcon3.png',
            iconSize: [38, 38],
            iconAnchor: [18, 38],
            popupAnchor: [0, -35]
        })
        var inactiveIcon = L.icon({
            iconUrl: 'locationIcon4.png',
            iconSize: [38, 38],
            iconAnchor: [18, 38],
            popupAnchor: [0, -35]
        })

        function fetchPoints() {
            fetch('/markers')
                .then(response => response.json())
                .then(data => {
                    var markers = [];

                    // Add new points with custom icons to the map
                    data.forEach(point => {
                        var icon;
                        if (point.type === 'dealer') {
                            icon = dealerIcon;
                        } else if (point.type === 'agent') {
                            icon = agentIcon;
                        } else {
                            icon = cashierIcon;
                        }

                        var marker = L.marker([point.latitude, point.longitude], {
                            icon: icon
                        })
                            .bindPopup(point.name)
                            .addTo(map);

                        markers.push(marker);
                    });
                })
                .catch(error => console.error('Error fetching points:', error));
        }

        fetchPoints();
        setInterval(fetchPoints, 10000);

    </script>
@endpush
