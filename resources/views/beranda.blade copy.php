@extends('layouts.main')

@section('container')

<header>
  <div class="container-fluid h-100" style="">
    <div class="row h-100 align-items-center">
      <div class="col-lg-6 h-100 align-items-center text-center">
        <p class="header-text mb-2" style="font-family: fantasy;">HORAS...</p>
        <p class="text-dark fs-2 mt-3" style="font-size:1.50rem;font-weight:300;color: #000b5b !important; font-family: initial;">Selamat datang di Sistem Informasi Geografis Pemetaan Lokasi Homestay Se-Kecamatan Balige</p>
        <p class="lead text-mute fs-3 mt-4" style="color: #02032d;font-family: cursive;">"Membantu anda mencari homestay dengan cepat dan tepat"</p>
        <p>
          <a href="#home-map" class="btn btn-outline-danger mt-3" style="font-size: large;font-style: bold;;border-color: #e1473e;"><b>Cari Homestay</b></a>
        </p>
      </div>
      <div class="col-lg-6">
        <div class="hero">

        </div>
      </div>
    </div>
  </div>
</header>
    
<!-- Full Page Image Header with Vertically Centered Content -->
{{-- <header class="hero">
  <div class="container h-100">
    <div class="row h-100 align-items-center">
      <div class="col-12 text-center">
        <div class="row py-lg-8">
          <div class="col-lg-8 col-md-10 mx-auto">
            <h1 class="header-text">HORAS...</h1>
            <p class="text-dark fs-2" style="font-size:1.50rem;font-weight:300;color: #000b5b !important">Selamat datang di Sistem Informasi Geografis Pemetaan Lokasi Homestay Se-Kecamatan Balige</p>
            <p class="lead text-mute fs-3" style="font-style: italic; color: #02032d;">"Membantu anda mencari homestay dengan cepat dan tepat"</p>
            <p>
              <a href="#" class="btn btn-outline-info" style="font-size: large;font-style: bold;"><b>Cari Homestay</b></a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</header> --}}

<!-- Page Content -->
<section class="py-5" id="home-map">
  <div class="container-fluid">
    <h2 class="fw-light fs-4">Cari Berdasarkan: </h2>
    <div class="mt-3" id="map" style="width: 100%; height: 600px;"></div>
  </div>
</section>

<script>
  var cities = L.layerGroup();

  var greenIcon = L.icon({
      iconUrl: '/storage/placeholder.png',
      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
      iconSize:     [60, 75], // size of the icon
      shadowSize:   [37, 43], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      shadowAnchor: [4, 62],  // the same for the shadow
      popupAnchor:  [8, -85] // point from which the popup should open relative to the iconAnchor
  });

  var myLocationIcon = L.icon({
      iconUrl: '/storage/home-address.png',
      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
      iconSize:     [60, 75], // size of the icon
      shadowSize:   [37, 43], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      shadowAnchor: [4, 62],  // the same for the shadow
      popupAnchor:  [8, -85] // point from which the popup should open relative to the iconAnchor
  });

  var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>';
  var mbUrl = 'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
 
  var streets = L.tileLayer(mbUrl, {id: 'mapbox/streets-v11', tileSize: 512, zoomOffset: -1, attribution: mbAttr});

  var osm = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
      maxZoom: 18,
      subdomains:['mt0','mt1','mt2','mt3']
  });

  var map = L.map('map', {
    // center: [0.19420032063861847, 101.0234399839772],
    // zoom: 5,
    layers: [osm, cities]
  });

  var bounds = L.latLngBounds()

  function stripHtml(html)
  {
    let tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
  }

  function trim_words(theString, numWords) {
    expString = theString.split(/\s+/,numWords);
    theNewString=expString.join(" ");
    return theNewString;
  }

  $( document ).ready(function() {
   

    $.getJSON('homestay/json', function(data){
      console.log( "ready!" );
      var marker, popupContent;

      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position){
          //   alert("Latitude: " + position.coords.latitude + 
          // "<br>Longitude: " + position.coords.longitude);
          var myLocation = L.marker([position.coords.latitude,position.coords.longitude], {icon: myLocationIcon}).bindPopup('My Location').addTo(cities);
          bounds.extend([position.coords.latitude, position.coords.longitude]);
        });
        } else { 
          alert("Geolocation is not supported by this browser.");
        }

      $.each(data, function(index){
        var arr = data[index].koordinat_lokasi.split(',');
        marker = L.marker([arr[0],arr[1]], {icon: greenIcon}).addTo(cities);
        var deskripsi = data[index].deskripsi
        var trimmedString = deskripsi.substr(0, 10);
        trimmedString = trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")))
        marker.bindPopup(`<div class="card" style="width: 18rem;border:0px;">
        <img src="storage/`+data[index].foto+`" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">`+data[index].nama+`</h5>
          <p class="card-text">`+trim_words(stripHtml(deskripsi), 15)+`...</p>
          <a href="/homestay/`+data[index].id+`" class="btn btn-outline-primary">Lihat Detail</a>
        </div>
      </div>`);
          
       bounds.extend([arr[0],arr[1]]);

      });
      
      setTimeout(function () {
        map.fitBounds(bounds);
      }, 1000);

    });
  });
  
  var baseLayers = {
    'OpenStreetMap': osm,
    'Streets': streets
  };

  var layerControl = L.control.layers(baseLayers).addTo(map);

  var satellite = L.tileLayer(mbUrl, {id: 'mapbox/satellite-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr});
  layerControl.addBaseLayer(satellite, 'Satellite');
</script>

@endsection