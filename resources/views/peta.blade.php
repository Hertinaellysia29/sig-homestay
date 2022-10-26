@extends('layouts.main')

@section('container')
<div class="container">
  <div class="mt-5 mb-5" style="padding-top: 50px">
    <h1 class="line-title">Peta</h1>
  </div>
  <!-- Map -->
  <section class="py-0" id="home-map">
    <div class="container-fluid">
      <div class="row">
        <form action="">
          @csrf
          <div class="row">
            <div class="col-lg-3">

            </div>
            <div class="col-lg-6">
              <div class="row">
                <div class="col-lg-6">
                    <select class="form-select" name="" id="source">
                        <option hidden>Cari Homestay Berdasarkan..</option>
                        <option value="current_location">Lokasi saat ini</option>
                        <option value="wisata">Wisata</option>
                        {{-- @foreach ($category as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach --}}
                    </select>
                </div>
                <div class="col-lg-6">
                    <select class="form-select" name="source2" id="source2">
                      <option hidden>***</option>
                    </select>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="container-fluid justify-content-center">
        <div class="mt-3 mb-4" id="map" style="width: 100%; height: 600px;"></div>
      </div>
    </div>
</div>

<script>
  // form source map
  $('#source').on('change', function() {
      var source = $(this).val();
      // alert(source);
      if(source === 'wisata') {
          $.ajax({
              url: '/wisata/json',
              type: "GET",
              data : {"_token":"{{ csrf_token() }}"},
              dataType: "json",
              success:function(data)
              {
                if(data){
                    $('#source2').empty();
                    $('#source2').append('<option hidden>Pilih Wisata</option>'); 
                    $.each(data, function(key, wisata){
                        $('select[name="source2"]').append('<option value="wisata-'+ wisata.id +'">' + wisata.nama+ '</option>');
                    });
                }else{
                    $('#source2').empty();
                }
              }
          });
      }else{
        $('#source2').empty();
        $('#source2').append('<option hidden>Pilih Jarak</option>'); 
          $('select[name="source2"]').append('<option value="jarak-1">1KM</option>');
          $('select[name="source2"]').append('<option value="jarak-2">2KM</option>');
          $('select[name="source2"]').append('<option value="jarak-3">3KM</option>');
          $('select[name="source2"]').append('<option value="jarak-4">4KM</option>');
          $('select[name="source2"]').append('<option value="jarak-5">5KM</option>');
          $('select[name="source2"]').append('<option value="jarak-semua">Semua</option>');
      }
  });



  // Leaflet map
  var cities = L.layerGroup();

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

  var baseLayers = {
    'OpenStreetMap': osm,
    'Streets': streets
  };

  var layerControl = L.control.layers(baseLayers).addTo(map);

  var satellite = L.tileLayer(mbUrl, {id: 'mapbox/satellite-v9', tileSize: 512, zoomOffset: -1, attribution: mbAttr});
  layerControl.addBaseLayer(satellite, 'Satellite');

  var homestayIcon = L.icon({
      iconUrl: '/storage/home-icon.png',
      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
      iconSize:     [60, 70], // size of the icon
      shadowSize:   [37, 43], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      shadowAnchor: [4, 62],  // the same for the shadow
      popupAnchor:  [8, -85] // point from which the popup should open relative to the iconAnchor
      // iconSize:     [38, 95], // size of the icon
      // shadowSize:   [50, 64], // size of the shadow
      // iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      // shadowAnchor: [4, 62],  // the same for the shadow
      // popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
  });

  var userIcon = L.icon({
      iconUrl: '/storage/user-location.png',
      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
      iconSize:     [55, 75], // size of the icon
      shadowSize:   [37, 43], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      shadowAnchor: [4, 62],  // the same for the shadow
      popupAnchor:  [8, -85] // point from which the popup should open relative to the iconAnchor
  });

  var wisataIcon = L.icon({
      iconUrl: '/storage/icon-wisata.png',
      shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
      iconSize:     [55, 75], // size of the icon
      shadowSize:   [37, 43], // size of the shadow
      iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
      shadowAnchor: [4, 62],  // the same for the shadow
      popupAnchor:  [8, -85] // point from which the popup should open relative to the iconAnchor
  });

  // TODO KALO PILIHAN NYA WISATA, BUAT ICON WISATA DAN SET ITU SEBAGAI CENTER NYA

  function initMap(){

    // Start fresh
    cities.clearLayers();

    $.getJSON('homestay/json', function(data){
      console.log( "ready!" );
      var marker, popupContent;
      $.each(data, function(index){
        var image = data[index].foto.split('||');
        var arr = data[index].koordinat_lokasi.split(',');
        if (arr.length < 2) {
          return false;
        }
        if (isNaN(arr[0]) || isNaN(arr[1])){
          return false;
        }
        marker = L.marker([arr[0],arr[1]], {icon: homestayIcon}).addTo(cities);
        var deskripsi = data[index].deskripsi
        var trimmedString = deskripsi.substr(0, 10);
        trimmedString = trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")))
        marker.bindPopup(`<div class="card" style="width: 18rem;border:0px;">
        <img src="storage/`+image[0]+`" class="card-img-top" alt="...">
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
  }

  initMap();

  // form source map
  $('#source2').on('change', function() {
      var val = $(this).val();
      var opt = val.split('-');
      if (opt[0] == 'wisata'){
        var originLatLong = "";
        // Start fresh
        var newBounds = L.latLngBounds()

        cities.clearLayers();

        $.getJSON('wisata/detail/json/'+opt[1]+'', function(data){
          originLatLong = data.koordinat_lokasi;
          var marker, popupContent;
          var arr = data.koordinat_lokasi.split(',');
          wisataMarker = L.marker([arr[0],arr[1]], {icon: wisataIcon}).addTo(cities);
          var deskripsi = data.deskripsi
          var trimmedString = deskripsi.substr(0, 10);
          trimmedString = trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")))
          wisataMarker.bindPopup(`<div class="card" style="width: 18rem;border:0px;">
          <img src="storage/`+data.foto+`" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">`+data.nama+`</h5>
            <p class="card-text">`+trim_words(stripHtml(deskripsi), 15)+`...</p>
            <a href="/wisata/`+data.id+`" class="btn btn-outline-primary">Lihat Detail</a>
          </div>
          </div>`);

          newBounds.extend([arr[0],arr[1]]);
        });

        $.getJSON('homestay/json', function(data){
          console.log( "ready!" );
          var marker, popupContent;
          $.each(data, function(index){
            var image = data[index].foto.split('||');
            var arr = data[index].koordinat_lokasi.split(',');
            if (arr.length < 2) {
              return false;
            }
            if (isNaN(arr[0]) || isNaN(arr[1])){
              return false;
            }
            marker = L.marker([arr[0],arr[1]], {icon: homestayIcon}).addTo(cities);
            var deskripsi = data[index].deskripsi
            var trimmedString = deskripsi.substr(0, 10);
            trimmedString = trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")))
            marker.bindPopup(`<div class="card" style="width: 18rem;border:0px;">
            <img src="storage/`+image[0]+`" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">`+data[index].nama+`</h5>
              <p class="card-text">`+trim_words(stripHtml(deskripsi), 15)+`...</p>
              <a href="/homestay/`+data[index].id+`" class="btn btn-outline-primary">Lihat Detail</a>
              <a href="https://www.google.com/maps/dir/?api=1&origin=`+originLatLong+`&destination=`+data[index].koordinat_lokasi+`" class="btn btn-outline-primary" target="_blank">Rute</a>
            </div>
          </div>`);
              
          // newBounds.extend([arr[0],arr[1]]);
          });
          
          setTimeout(function () {
            map.fitBounds(newBounds);
          }, 1000);

        });

      }
      if (opt[0] == 'jarak'){
        function getLocation() {    
            if(navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(process, positionError);
            }
        }

        function process(position){
          // alert("Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude);

          // Start fresh
          var newBounds = L.latLngBounds()
          cities.clearLayers();
          $dummyLat = '2.341380';
          $dummyLong = '99.088434';
          // 2.341380, 99.088434
          var myLocation = L.marker([$dummyLat,$dummyLong], {icon: userIcon}).bindPopup('Lokasi saya').addTo(cities);
          newBounds.extend([$dummyLat, $dummyLong]);
          $.getJSON('homestay/current-location/json', 
            {
              current_lat: $dummyLat,
              current_long: $dummyLong,
              distance: opt[1]
            }, 
            function(data){
            var marker, popupContent;
            $.each(data, function(index){
              var image = data[index].foto.split('||');
              var arr = data[index].koordinat_lokasi.split(',');
              if (arr.length < 2) {
                return false;
              }
              if (isNaN(arr[0]) || isNaN(arr[1])){
                return false;
              }
              marker = L.marker([arr[0],arr[1]], {icon: homestayIcon}).addTo(cities);
              var deskripsi = data[index].deskripsi
              var trimmedString = deskripsi.substr(0, 10);
              trimmedString = trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")))
              marker.bindPopup(`<div class="card" style="width: 18rem;border:0px;">
              <img src="storage/`+image[0]+`" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title">`+data[index].nama+`</h5>
                <p class="card-text">`+trim_words(stripHtml(deskripsi), 15)+`...</p>
                <a href="/homestay/`+data[index].id+`" class="btn btn-outline-primary">Lihat Detail</a>
                <a href="https://www.google.com/maps/dir/?api=1&origin=`+$dummyLat+`,`+$dummyLong+`&destination=`+data[index].koordinat_lokasi+`" class="btn btn-outline-primary" target="_blank">Rute</a>
              </div>
            </div>`);
                
            newBounds.extend([arr[0],arr[1]]);
            });
            
            setTimeout(function () {
              map.fitBounds(newBounds);
            }, 1000);

          });
        }

        function positionError(error) {
            if(error.PERMISSION_DENIED) alert("Please allow sig homestay website to access your location to use this feature..");
            return
            // hideLoadingDiv()
            // showError('Geolocation is not enabled. Please enable to use this feature')
        }

        getLocation();
      }
  });

  $( document ).ready(function() {
  });


  // Utils
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

</script>
@endsection