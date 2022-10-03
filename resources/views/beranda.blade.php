@extends('layouts.main')

@section('container')
  
  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">HORAS...</h1>
        <p class="text-dark" style="font-size:1.50rem;font-weight:300;">Selamat datang di Sistem Informasi Geografis Pemetaan Lokasi Homestay Se-Kecamatan Balige</p>
        <p class="lead text-mute" style="font-style: italic">"Membantu anda mencari homestay dengan cepat dan tepat"</p>
        <p>
          <a href="#" class="btn btn-primary my-2">Cari Homestay</a>
        </p>
      </div>
    </div>
  </section>

  <div class="container py-5 bg-light">
    <h1>PETA</h1>
    <div id="map" style="width: 100%; height: 400px;"></div>
  </div>
  <script>

    var map = L.map('map').setView([2.3467817056973135, 99.07507026414922], 17);
  
    var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
  
    var marker = L.marker([2.3467817056973135, 99.07507026414922]).addTo(map)
      .bindPopup('<b>Hello world!</b><br />I am a popup.').openPopup();
  
    // var circle = L.circle([51.508, -0.11], {
    //   color: 'red',
    //   fillColor: '#f03',
    //   fillOpacity: 0.5,
    //   radius: 500
    // }).addTo(map).bindPopup('I am a circle.');
  
    // var polygon = L.polygon([
    //   [51.509, -0.08],
    //   [51.503, -0.06],
    //   [51.51, -0.047]
    // ]).addTo(map).bindPopup('I am a polygon.');
  
  
    // var popup = L.popup()
    //   .setLatLng([51.513, -0.09])
    //   .setContent('I am a standalone popup.')
    //   .openOn(map);
  
    function onMapClick(e) {
      popup
        .setLatLng(e.latlng)
        .setContent('You clicked the map at ' + e.latlng.toString())
        .openOn(map);
    }
  
    map.on('click', onMapClick);
  
  </script>
  {{-- <script>
    var map = L.map('map').setView([2.3467817056973135, 99.07507026414922], 16);

    var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      });

    // var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //   maxZoom: 19,
    //   attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    // }).addTo(map);

    // L.esri.basemapLayer('StreetsRelief').addTo(map);
    // L.gridLayer.googleMutant({ type: 'roadmap' }).addTo(map);


    var marker = L.marker([2.3469256, 99.0734566]).addTo(map)
      .bindPopup('<b>Hello world!</b><br />I am Blessing Homestay.').openPopup();

    // var circle = L.circle([51.508, -0.11], {
    //   color: 'red',
    //   fillColor: '#f03',
    //   fillOpacity: 0.5,
    //   radius: 500
    // }).addTo(map).bindPopup('I am a circle.');

    // var polygon = L.polygon([
    //   [51.509, -0.08],
    //   [51.503, -0.06],
    //   [51.51, -0.047]
    // ]).addTo(map).bindPopup('I am a polygon.');


    // var popup = L.popup()
    //   .setLatLng([51.513, -0.09])
    //   .setContent('I am a standalone popup.')
    //   .openOn(map);

    function onMapClick(e) {
      popup
        .setLatLng(e.latlng)
        .setContent('You clicked the map at ' + e.latlng.toString())
        .openOn(map);
    }

    map.on('click', onMapClick);

  </script> --}}

  {{-- <script>
    var cities = L.layerGroup();
    // 2.3467817056973135, 99.07507026414922
    var mElysha = L.marker([2.3467817056973135, 99.07507026414922]).bindPopup('Elysha Homestay').addTo(cities);
    var mBlessing = L.marker([2.3469256, 99.0734566]).bindPopup('Blessing Homestay').addTo(cities);
    var mYabela = L.marker([2.3466656, 99.074509]).bindPopup('Yabela Homestay').addTo(cities);
    var mMartahan = L.marker([2.3464245, 99.0743959]).bindPopup('Martahan Homestay').addTo(cities);
  
    var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
    var mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
   
    var streets = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr});
  
    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });
  
    var map = L.map('map', {
      center: [2.347313, 99.0744523],
      zoom: 18,
      layers: [osm, cities]
    });
  
    var baseLayers = {
      'OpenStreetMap': osm,
      'Streets': streets
    };
  
    var overlays = {
      'Cities': cities
    };
  
    var layerControl = L.control.layers(baseLayers, overlays).addTo(map);
    var crownHill = L.marker([39.75, -105.09]).bindPopup('This is Crown Hill Park.');
    var rubyHill = L.marker([39.68, -105.00]).bindPopup('This is Ruby Hill Park.');
  
    var parks = L.layerGroup([crownHill, rubyHill]);
  
    var satellite = L.tileLayer(mbUrl, {id: 'mapbox/satellite-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr});
    layerControl.addBaseLayer(satellite, 'Satellite');
    layerControl.addOverlay(parks, 'Parks');
  </script> --}}

@endsection