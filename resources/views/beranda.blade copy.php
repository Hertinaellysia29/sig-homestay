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

<!-- Map -->
<section class="py-5" id="home-map">
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
    <div class="mt-5" id="map" style="width: 100%; height: 600px;"></div>
  </div>
</section>

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
          $('select[name="source2"]').append('<option value="jarak-3">3KM</option>');
          $('select[name="source2"]').append('<option value="jarak-5">5KM</option>');
          $('select[name="source2"]').append('<option value="jarak-8">8KM</option>');
          $('select[name="source2"]').append('<option value="jarak-10">10KM</option>');
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

  // TODO KALO PILIHAN NYA WISATA, BUAT ICON WISATA DAN SET ITU SEBAGAI CENTER NYA

  function initMap(it){
    // Start fresh
    cities.clearLayers();

    $.getJSON('homestay/json', function(data){
      console.log( "ready!" );
      var marker, popupContent;
      // if (navigator.geolocation) {
      //   navigator.geolocation.getCurrentPosition(function(position){
      //     //   alert("Latitude: " + position.coords.latitude + 
      //     // "<br>Longitude: " + position.coords.longitude);
      //     var myLocation = L.marker([position.coords.latitude,position.coords.longitude], {icon: myLocationIcon}).bindPopup('My Location').addTo(cities);
      //     bounds.extend([position.coords.latitude, position.coords.longitude]);
      //   });
      //   } else { 
      //     alert("Geolocation is not supported by this browser.");
      //   }
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
       if (it == index + 1) {
          return false;
        } 
      });
      
      setTimeout(function () {
        map.fitBounds(bounds);
      }, 1000);

    });
  }

  initMap(10);

  // form source map
  $('#source2').on('change', function() {
      var val = $(this).val();
      var opt = val.split('-');
      if (opt[0] == 'wisata'){
        initMap(2);
      }
      if (opt[0] == 'jarak'){
        alert(opt[1]);
      }
      // if(source === 'wisata') {
      //     $.ajax({
      //         url: '/wisata/json',
      //         type: "GET",
      //         data : {"_token":"{{ csrf_token() }}"},
      //         dataType: "json",
      //         success:function(data)
      //         {
      //           if(data){
      //               $('#source2').empty();
      //               $('#source2').append('<option hidden>Pilih Wisata</option>'); 
      //               $.each(data, function(key, wisata){
      //                   $('select[name="source2"]').append('<option value="wisata-'+ wisata.id +'">' + wisata.nama+ '</option>');
      //               });
      //           }else{
      //               $('#source2').empty();
      //           }
      //         }
      //     });
      // }else{
      //   $('#source2').empty();
      //   $('#source2').append('<option hidden>Pilih Jarak</option>'); 
      //     $('select[name="source2"]').append('<option value="jarak-1">1KM</option>');
      //     $('select[name="source2"]').append('<option value="jarak-3">3KM</option>');
      //     $('select[name="source2"]').append('<option value="jarak-5">5KM</option>');
      //     $('select[name="source2"]').append('<option value="jarak-8">8KM</option>');
      //     $('select[name="source2"]').append('<option value="jarak-10">10KM</option>');
      //     $('select[name="source2"]').append('<option value="jarak-semua">Semua</option>');
      // }
  });

  $( document ).ready(function() {
    // $.getJSON('homestay/json', function(data){
    //   console.log( "ready!" );
    //   var marker, popupContent;

    //   if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(function(position){
    //       //   alert("Latitude: " + position.coords.latitude + 
    //       // "<br>Longitude: " + position.coords.longitude);
    //       var myLocation = L.marker([position.coords.latitude,position.coords.longitude], {icon: myLocationIcon}).bindPopup('My Location').addTo(cities);
    //       bounds.extend([position.coords.latitude, position.coords.longitude]);
    //     });
    //     } else { 
    //       alert("Geolocation is not supported by this browser.");
    //     }

    //   $.each(data, function(index){
    //     var arr = data[index].koordinat_lokasi.split(',');
    //     marker = L.marker([arr[0],arr[1]], {icon: greenIcon}).addTo(cities);
    //     var deskripsi = data[index].deskripsi
    //     var trimmedString = deskripsi.substr(0, 10);
    //     trimmedString = trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")))
    //     marker.bindPopup(`<div class="card" style="width: 18rem;border:0px;">
    //     <img src="storage/`+data[index].foto+`" class="card-img-top" alt="...">
    //     <div class="card-body">
    //       <h5 class="card-title">`+data[index].nama+`</h5>
    //       <p class="card-text">`+trim_words(stripHtml(deskripsi), 15)+`...</p>
    //       <a href="/homestay/`+data[index].id+`" class="btn btn-outline-primary">Lihat Detail</a>
    //     </div>
    //   </div>`);
          
    //    bounds.extend([arr[0],arr[1]]);

    //   });
      
    //   setTimeout(function () {
    //     map.fitBounds(bounds);
    //   }, 1000);

    // });
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