var map;
var faisalabad = {lat: -32.3209812, lng: -58.0799678};
var marcadores = [];
var infoWindows = [];
var marcador = null;
var ultimoInfoWindows = null;
var marker;
var numero=0;
var circuito=0;

function agregarVolqueta(nro,lat,long,fecha,estadoF,estadoC,circuito){
    marcadores.push([nro,lat,long,fecha,estadoF,estadoC,circuito]);
}

function mostrarVolquetas(circuito){
    console.log(circuito);

    $.ajax({
        url: '/volquetado/logica/manejadorAltaVolqueta.php',
        type: 'POST',
        data: {
            accion:"listarVolquetas",
            circuito:circuito
        },
        success: function(response){
            var data = JSON.parse(response);
            marcadores=[];
            for (var i = 0; i < data.length; i++) {
                console.log(data[i].nro);
                agregarVolqueta(data[i].nro,data[i].lat,data[i].long,data[i].fechaIngreso,data[i].estadoFisico,data[i].estadoContenido, data[i].circuito);   
            }
            initMap();
        }});
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
        faisalabad=evento.latLng;
        $('#myModal').modal();
    });


    let i;
    for(i=0;i<marcadores.length;i++){
        infoWindows.push( new google.maps.InfoWindow({title:marcadores[i][0],content:'Circuito: ' + marcadores[i][6]+ '<br> Numero: '+ marcadores[i][0]+ '<br> Estado físico: '+ marcadores[i][4]+'<br><button onclick=eliminar("'+marcadores[i][0]+','+marcadores[i][6]+'")>Eliminar</button>'}));
        marker= new google.maps.Marker({
            position: new google.maps.LatLng(marcadores[i][1],marcadores[i][2]),
            title:marcadores[i][0],
            icon:{
                url: "../Imagenes/volqueta.png",
                scaledSize: new google.maps.Size(29,35)
            },
            map: map
        });

        marker.addListener('click',function(){
            console.log('///////////////////////////');
            clickVolqueta(this);
        });
        marker.addListener('dblclick',function(){
            eliminarVolqueta(this);
        });

    }
}

function eliminar(info){
    var datos = info.split(",");
    console.log(datos[0]);
    console.log(datos[1]);
    $.ajax({
        url: '/volquetado/logica/manejadorAltaVolqueta.php',
        type: 'POST',
        data: {
            accion:"eliminarVolqueta",
            numero:datos[0],
            circuito:datos[1]
        },
        success: function(response){
            console.log(response);
            if(response==1){
                console.log('borrada');
                location.reload();
            }else if(response==0){
                console.log('error');
            }
        },
        error: function(response){
            console.log(response);
        }
    });
    

}
function myLocation(){
 if ("geolocation" in navigator){
    navigator.geolocation.getCurrentPosition(function(position){ 
        var pos = {lat: position.coords.latitude, lng: position.coords.longitude};
        map.panTo(pos);
    });
}

};
