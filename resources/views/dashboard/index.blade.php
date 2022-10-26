@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-1 border-bottom">
        <h1 class="h2"> Selamat Datang, {{ auth()->user()->name }}</h1>
    </div>
    @if (auth()->user()->role == 'admin')
    <div class="row mt-4">
        <div class="col-sm-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
            <h5 class="card-title">{{ $totalHomestay ?? "0" }}</h5>
            <p class="card-text">Data Homestay</p>
            <a href="/dashboard/homestay" class="btn btn-light">Lihat detail..</a>
            </div>
        </div>
        </div>
        <div class="col-sm-3">
        <div class="card">
            <div class="card-body text-dark bg-warning">
            <h5 class="card-title">{{ $totalUser ?? "0" }}</h5>
            <p class="card-text">Data User</p>
            <a href="/dashboard/user" class="btn btn-light">Lihat detail..</a>
            </div>
        </div>
        </div>
        <div class="col-sm-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                <h5 class="card-title">{{ $totalWisata ?? "0" }}</h5>
                <p class="card-text">Data Wisata</p>
                <a href="/dashboard/wisata" class="btn btn-light">Lihat detail..</a>
                </div>
            </div>
            </div>
            <div class="col-sm-3">
            <div class="card text-dark bg-info">
                <div class="card-body">
                <h5 class="card-title">{{ $totalDesa ?? "0" }}</h5>
                <p class="card-text">Data Desa</p>
                <a href="/dashboard/desa" class="btn btn-light">Lihat detail..</a>
                </div>
            </div>
        </div>
    </div>
    @endif  

    <!-- Map -->
{{-- <section class="mb-5" id="home-map"> --}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 mt-5 border-bottom">
        <h3 class="h3"> Peta Homestay </h3>
    </div>
      <div class="mb-3" id="map" style="width: 100%;height: 600px;position: sticky;"></div>
    </div>
  {{-- </section> --}}
  
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
  
    $( document ).ready(function() {
      $.getJSON('dashboard/homestay/json', function(data){
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
          var image = data[index].foto.split('||');
          var arr = data[index].koordinat_lokasi.split(',');
          if (arr.length < 2) {
            return false;
          }
          if (isNaN(arr[0]) || isNaN(arr[1])){
            return false;
          }
          marker = L.marker([arr[0],arr[1]], {icon: greenIcon}).addTo(cities);
          var deskripsi = data[index].deskripsi
          var trimmedString = deskripsi.substr(0, 10);
          trimmedString = trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")))
          marker.bindPopup(`<div class="card" style="width: 18rem;border:0px;">
          <img src="storage/`+image[0]+`" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">`+data[index].nama+`</h5>
            <p class="card-text">`+trim_words(stripHtml(deskripsi), 15)+`...</p>
            <a href="/dashboard/homestay/`+data[index].id+`" class="btn btn-outline-primary">Lihat Detail</a>
          </div>
        </div>`);
            
         bounds.extend([arr[0],arr[1]]);
  
        });
        
        setTimeout(function () {
          map.fitBounds(bounds);
        }, 1000);
  
      });
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