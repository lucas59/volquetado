<?php 
if(isset(($_GET(['circuito']))){

	$circuito = $_GET("circuito");
	$numero= $_GET("numero");

	echo "<script>console.log(".$numero.");</script>";

}

?>
