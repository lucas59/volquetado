var map;
var faisalabad = {lat: -32.3209812, lng: -58.0799678};
var marcadores = [];
var infoWindows;
var marcador = null;

function agregarVolqueta(nro,lat,long,fecha,estado){
    marcadores.push([nro,lat,long,fecha,estado]);
}

function clickVolqueta(volqueta){
    infoWindows.open(map,volqueta);
}

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: faisalabad,
        disableDefaultUI: true
    });

    google.maps.event.addListener(map,"click",function(evento){
        if(marcador!==null){
            marcador.setMap(null);
        }

        marcador = new google.maps.Marker({
            position:evento.latLng,
            map:map,
            /*
            ,icon:{
                url:"",
                scaledSize:new google.maps.Size(29,35)
            }*/
        });
        $('#myModal').modal();
    });



    for(var i=0;i<marcadores.length;i++){
        infoWindows=new google.maps.InfoWindow({
           content:marcadores[i][0].toString() 
       });
        new google.maps.Marker({
            position: new google.maps.LatLng(marcadores[i][1],marcadores[i][2]),
            title:marcadores[i][0].toString(),
        /*icon:{
            url: "",
            scaledSize: new google.maps.Size(29,35)
        },*/
        map: map
    }).addListener("click",function(){
        clickVolqueta(this);
    });
}   


 //  addYourLocationButton(map, myMarker);
}

function ingresarVolqueta(){
    var circuito = document.getElementById("circuito").value;
    var numero = document.getElementById("numero").value;
    $.ajax({
        url: '../logica/volquetas.php',
        type: 'GET',
        async: true,
        data: {
            funcion:'agregar',
            numero:numero,
            circuito:circuito,
            lat:marcador.getPosition().lat(),
            long:marcador.getPosition().lng()
        },
            success: function(data){
                if(data==true){
                    console.log('exito')
                }else{
                    console.log('faiilll')
                }
            }
        });
}