var map;
var faisalabad = {lat: -32.3209812, lng: -58.0799678};
var marcadores = [];
var infoWindows = [];
var marcador = null;
var ultimoInfoWindows = null;
var watchId;
let ultimaLatitud ;
let ultimaLongitud;
var reportesRealizados=[];

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
        infoWindows.push(marcadores[i][0],marcadores[i][6]);
        new google.maps.Marker({
            position: new google.maps.LatLng(marcadores[i][1],marcadores[i][2]),
            numero:marcadores[i][0].toString(),
            circuito:marcadores[i][6].toString(),
            icon:{
                url: "../Imagenes/volqueta.png",
                scaledSize: new google.maps.Size(24,30)
            },
            map: map
        }).addListener("click",function(){
            clickVolqueta(this);
        });
    } 

}

$("document").ready(function(){
    //setInterval('refrescar()',4000);
    initGeolocation();
});

//****************************************************

var map; 
function initGeolocation() {
    if(watchId){
       navigator.geolocation.clearWatch(watchID);
       watchID = null;
   }
   if (navigator && navigator.geolocation) {
    watchId = navigator.geolocation.watchPosition(successCallback, 
      errorCallback,
      {enableHighAccuracy:true,timeout:Infinity,maximumAge:0});

} else {
  console.log('Geolocation is not supported');
}
}

function errorCallback() {}

function successCallback(position) {

    var myLatlng = new google.maps.LatLng(position.coords.latitude.toFixed(8), position.coords.longitude.toFixed(8));
   console.log(position.coords.latitude);
   console.log(position.coords.longitude.toFixed(8));
   var mapOtn={
    zoom:10,
    center:myLatlng,
    mapTypeId:google.maps.MapTypeId.ROAD
};
var Pmap=document.getElementById("map");

//var map=new google.maps.Map(Pmap, mapOtn);
addMarker(map, myLatlng,position.coords.latitude, position.coords.longitude);

}
function addMarker(map, myLatlng,lat,long){
     var goldStar = {//creamos las propiedades para un nuevo marcador
        path: google.maps.SymbolPath.CIRCLE,
        strokeColor: '#b1c2ef',
        fillColor: '#395dbd',
        fillOpacity: .9,
        strokeWeight: 5,
        scale: 13,
    };
     var marker = new google.maps.Marker({//creamos un nuevo marcador con las propiedades de goldstar
            position: myLatlng,//lo pocisionamos con alguna ubicacion
            icon: goldStar,//con las propiedades previemente creadas
            map: map,
        });
     map.panTo(myLatlng);
     marker.setPosition(myLatlng);
     ultimaLatitud=lat;
     ultimaLongitud=long;
 }

 function agregarVolqueta(nro,lat,long,fecha,estadoF,estadoC,circuito){
    marcadores.push([nro,lat,long,fecha,estadoF,estadoC,circuito]);
}


function clickVolqueta(volqueta){
    console.log(volqueta.circuito);
    console.log(volqueta.numero);
    $('#modalReporte').modal();
    document.getElementById('circuito').value=volqueta.circuito;
    document.getElementById('numero').value=volqueta.numero;

}

$("#buscame").click(function(){
    console.log('asdasd');
    if ("geolocation" in navigator){
        navigator.geolocation.getCurrentPosition(function(position){ 
            var pos = {lat: position.coords.latitude, lng: position.coords.longitude};
            map.panTo(pos);
            addMarker(map,pos);
        });
    }   
});


function nuevoReporte(){
    console.log("llegoo");
    var circuito = document.getElementById('circuito').value;
    var numero = document.getElementById('numero').value;
    var estadoFisico=document.getElementById('estadoF').value;
    var estadoContenido=document.getElementById('estadoC').value;
    var residuosFuera=document.getElementById('residuos').checked;
    if(reportar(circuito,numero,estadoFisico,estadoContenido,residuosFuera)){

    }else{


        $.ajax({
            url: '/volquetado/logica/reportar.php',
            type: 'POST',
            data: {
                accion:"reportar",
                numero:numero,
                circuito:circuito,
                estadoContenido:estadoContenido,
                estadoFisico:estadoFisico,
                nota:"",
                inspeccionado:"0",
                residuo:residuosFuera
            },
            success: function(response){
                console.log(response);
                if(response.localeCompare("1")){ 
                    console.log("exito");
                }else{
                    console.log("noexito");
                }
            }
        }); 

    }
}

function reportar(circuito,numero,estadoF,estadoC,residuos){
    if(verificarReporte(numero)){
        console.log("reporte ya realizado");
    }else{

    }
}

function verificarReporte(numero){
    if(reportesRealizados.includes(numero)){
        return true;
    }else{
        return false;
    }    
}