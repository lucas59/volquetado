var map;
var faisalabad = {lat: -32.3209812, lng: -58.0799678};
var marcadores = [];
var infoWindows = [];
var marcador = null;
var ultimoInfoWindows = null;

function agregarVolqueta(nro,lat,long,fecha,estadoF,estadoC,circuito){
    marcadores.push([nro,lat,long,fecha,estadoF,estadoC,circuito]);
}

function clickVolqueta(volqueta){
    for(let info of infoWindows){
        if( info.title == volqueta.title){
            if(ultimoInfoWindows != null)
                ultimoInfoWindows.close();
            info.open(map,volqueta);
            ultimoInfoWindows = info;
        }
    }
}

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 20,
        center: faisalabad,
        disableDefaultUI: true,
        styles:[
        {
            "featureType": "administrative",
            "elementType": "geometry",
            "stylers": [
            {
                "visibility": "off"
            }
            ]
        },
        {
            "featureType": "landscape",
            "stylers": [
            {
                "visibility": "off"
            }
            ]
        },
        {
            "featureType": "poi",
            "stylers": [
            {
                "visibility": "off"
            }
            ]
        },
        {
            "featureType": "poi.medical",
            "stylers": [
            {
                "visibility": "on"
            },
            {
                "weight": 5
            }
            ]
        },
        {
            "featureType": "transit",
            "stylers": [
            {
                "visibility": "off"
            }
            ]
        }
        ]
    });
    
    let i;
    for(i=0;i<marcadores.length;i++){
        infoWindows.push( new google.maps.InfoWindow({title:marcadores[i][0],content:'Circuito: ' + marcadores[i][6].toString()+ '<br> Numero: '+ marcadores[i][0].toString()}));
        new google.maps.Marker({
            position: new google.maps.LatLng(marcadores[i][1],marcadores[i][2]),
            title:marcadores[i][0].toString(),
            icon:{
                url: "../Imagenes/volqueta.png",
                scaledSize: new google.maps.Size(24,30)
            },
            map: map
        }).addListener("click",function(){
            clickVolqueta(this);
        });
    } 

    if(navigator.geolocation) //si acepta la geolocalizacion
    {
        navigator.geolocation.getCurrentPosition(function(position) 
        {
            var pos = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);//generamos una nueva pocision en 
            //formato  latitude,longitude

     var goldStar = {//creamos las propiedades para un nuevo marcador
        path: google.maps.SymbolPath.CIRCLE,
        strokeColor: '#b1c2ef',
        fillColor: '#395dbd',
        fillOpacity: .9,
        strokeWeight: 5,
        scale: 13,
    };
    var marker = new google.maps.Marker({//creamos un nuevo marcador con las propiedades de goldstar
            position: pos,//lo pocisionamos con alguna ubicacion
            icon: goldStar,//con las propiedades previemente creadas
            draggable: true,//le dmos la propiedad de arrastrar el marcador
            animation: google.maps.Animation.DROP,//propiedad de animacion
            map: map,
        });
    
    map.setCenter(pos);//pocisionamos el marcador en el centro


    }, function() //excepciones
    {
      handleNoGeolocation(true);
  });
    } 
    else 
    {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
}
}