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
            console.log(response);   
            var len = response.length;
            for(var i=0; i<len; i++){
                var numero = response[i].nro;
                var circuito = response[i].circuito;
                console.log(numero);
            }

        }});
}



    /*
    marcadores=[];
    console.log(volquetas);
    if(circuito==='Todos'){
        for ($i = 0; $i < volquetas.length; $i++) {
            agregarVolqueta($volquetas[$i][0],$volquetas[$i][1], $volquetas[$i][2],$volquetas[$i][3] , $volquetas[$i][4],$volquetas[$i][5], $volquetas[$i][6]);
        }
    }else{
        for ($i = 0; $i < volquetas.length; $i++) {
            //console.log(volquetas[$i]['nro']);
            if(volquetas[$i]['circuito']==circuito){
                agregarVolqueta(volquetas[$i]['nro'],volquetas[$i]['lat'], volquetas[$i]['log'],volquetas[$i]['fecha'] , volquetas[$i]['estadoF'],volquetas[$i]['estadoC'], volquetas[$i]['circuito']);
            }
        }
    } 
    initMap();
    //console.log(marcadores);*/

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


    function eliminarVolqueta(volqueta){
        var numero = volqueta.title;
        var lat = volqueta.getPosition().lat();
        var lng = volqueta.getPosition().lng();
        console.log(numero);
        console.log(lat);
        console.log(lng);

        $.ajax({
            url: '/volquetado/logica/manejadorAltaVolqueta.php',
            type: 'POST',
            data: {
                accion:"eliminarVolqueta",
                numero:numero,
                lat:lat,
                long:lng
            },
            success: function(response){
                console.log(response);
                if(response.localeCompare("borrada")){
                /*$("#numero").text="";
                $("#myModal").modal('hide');
                $("#modalRetornoExito").modal();*/
                console.log('borrada');
                location.reload();
            }else if(response.localeCompare("error")){
                console.log('error');
            }
        },
        error: function(response){
                        //console.log(response);
                    }
                });
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
        infoWindows.push( new google.maps.InfoWindow({title:marcadores[i][0],content:'Circuito: ' + marcadores[i][6]+ '<br> Numero: '+ marcadores[i][0]+ '<br> Estado físico: '+ marcadores[i][4]/*+'<br><button onclick=\"eliminar('+marcadores[i][0]+','+marcadores[i][6]+')\"(>Eliminar</button>'*/}));
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

function myLocation(){
   if ("geolocation" in navigator){
    navigator.geolocation.getCurrentPosition(function(position){ 
        var pos = {lat: position.coords.latitude, lng: position.coords.longitude};
        map.panTo(pos);
    });
}

};
