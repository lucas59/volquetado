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
        zoom: 15,
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

    google.maps.event.addListener(map,"click",function(evento){
        if(marcador!==null){
            marcador.setMap(null);
        }
        marcador = new google.maps.Marker({
            position:evento.latLng,
            map:map,
            icon:{
                url:"../Imagenes/volqueta.png",
                scaledSize:new google.maps.Size(29,35)
            }
        });
        $('#myModal').modal();
    });
    
    let i;
    for(i=0;i<marcadores.length;i++){
        infoWindows.push( new google.maps.InfoWindow({title:marcadores[i][0],content:'Circuito: ' + marcadores[i][6].toString()+ '<br> Numero: '+ marcadores[i][0].toString()}));
        new google.maps.Marker({
            position: new google.maps.LatLng(marcadores[i][1],marcadores[i][2]),
            title:marcadores[i][0].toString(),
            icon:{
                url: "../Imagenes/volqueta.png",
                scaledSize: new google.maps.Size(29,35)
            },
            map: map
        }).addListener("click",function(){
            clickVolqueta(this);
        });
    }   
}