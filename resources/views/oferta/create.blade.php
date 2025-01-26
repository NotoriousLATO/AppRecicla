@extends('layouts.app')

@section('content')
@include('partials.ofertas-styles')
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Oferta de Reciclaje</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDX8c0ulrUE5aUsefFR-EXM1NQlIAa8QyU&callback=initMap&libraries=&v=weekly" async></script>

    <script>
        let map;
        let marker;
        let geocoder;
        let mapClickable = false;

        function initMap() {
            const mapOptions = {
                center: {
                    lat: -17.7833,
                    lng: -63.1825
                },
                zoom: 12,
            };

            map = new google.maps.Map(document.getElementById('map'), mapOptions);
            geocoder = new google.maps.Geocoder();

            marker = new google.maps.Marker({
                map: map,
                draggable: true,
                position: map.getCenter(),
                visible: false,
            });

            google.maps.event.addListener(marker, 'dragend', function() {
                const position = marker.getPosition();
                document.getElementById('latitud').value = position.lat();
                document.getElementById('longitud').value = position.lng();

                geocodeLatLng(position, function(address) {
                    document.getElementById('ubicacion').value = address;
                });
            });

            google.maps.event.addListener(map, 'click', function(event) {
                if (mapClickable) {
                    const position = event.latLng;
                    marker.setPosition(position);
                    marker.setVisible(true);
                    document.getElementById('latitud').value = position.lat();
                    document.getElementById('longitud').value = position.lng();
                    geocodeLatLng(position, function(address) {
                        document.getElementById('ubicacion').value = address;
                    });
                }
            });
        }

        function enableMapSelection() {
            mapClickable = true;
            document.getElementById('select-button').disabled = true;
            document.getElementById('map').style.height = "400px";
        }

        function geocodeLatLng(latLng, callback) {
            geocoder.geocode({
                'location': latLng
            }, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        const address = results[0].formatted_address;
                        callback(address);
                        updateLocationDropdown(address);
                    } else {
                        callback("Dirección no encontrada");
                        updateLocationDropdown("Dirección no encontrada");
                    }
                } else {
                    callback("Geocodificación fallida: " + status);
                    updateLocationDropdown("Error en la geocodificación");
                }
            });
        }

        function updateLocationDropdown(address) {
            const dropdown = document.getElementById('ubicacion');
            dropdown.innerHTML = '';
            const option = document.createElement('option');
            option.value = address;
            option.textContent = address;
            dropdown.appendChild(option);
        }
    </script>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Crear Oferta de Reciclaje</h1>

        <div class="form-container">
            <form action="{{ route('oferta.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" id="latitud" name="latitud" readonly hidden>
                <input type="text" id="longitud" name="longitud" readonly hidden>

                <label for="ubicacion">Ubicación Seleccionada:</label>
                <select id="ubicacion" name="ubicacion" class="address-dropdown" disabled>
                    <option value="">Seleccione una ubicación</option>
                </select>

                <label for="material">Material:</label>
                <select id="material" name="material" required>
                    <option value="">Seleccione un tipo de material reciclable</option>
                    <option value="papel">Papel</option>
                    <option value="carton">Carton</option>
                    <option value="plastico">Plástico</option>
                    <option value="vidrio">Vidrio</option>
                    <option value="metales">Metales</option>
                    <option value="orgánico">Orgánico</option>
                    <option value="electrónico">Electrónico</option>
                </select>

                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="cantidad" required placeholder="Cantidad de producto en Kg">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" required placeholder="Precio ofertado en Bs">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/*">

                <button type="submit">Crear Oferta</button>
            </form>
        </div>

        <div class="form-container button-container">
            <button id="select-button" onclick="enableMapSelection()">Seleccionar en el mapa</button>
        </div>

        <div class="form-container button-container">
            <button onclick="window.history.back();" class="btn btn-danger">Cancelar</button>
        </div>

        <div class="map-container">
            <div id="map" style="height: 400px;"></div>
        </div>
    </div>
</body>

</html>
@endsection