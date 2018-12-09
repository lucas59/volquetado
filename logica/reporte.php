<?php 
/**
 * 

 */
class reporte 
{	
	private $id;
	private $circuito;
	private $nro;
	private $fecha;
	private $estadoFisico;
	private $estadoContenido;
	private $nota;
	private $contenidoFuera;
	private $inspeccionado;
	function __construct($circuito, $nro, $fecha, $estadoFisico, $estadoContenido, $nota, $contenidoFuera,$inspeccionado) {
		$this->circuito = $circuito;
		$this->nro = $nro;
		$this->fecha = $fecha;
		$this->estadoFisico = $estadoFisico;
		$this->estadoContenido = $estadoContenido;
		$this->nota = $nota;
		$this->contenidoFuera = $contenidoFuera;
		$this->inspeccionado=$inspeccionado;

	}

	function getId() {
		return $this->id;
	}

	function getCircuito() {
		return $this->circuito;
	}

	function getNro() {
		return $this->nro;
	}

	function getFecha() {
		return $this->fecha;
	}

	function getEstadoFisico() {
		return $this->estadoFisico;
	}

	function getEstadoContenido() {
		return $this->estadoContenido;
	}

	function getNota() {
		return $this->nota;
	}

	function getContenidoFuera() {
		return $this->contenidoFuera;
	}


	function getInspeccion() {
		return $this->inspeccionado;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setCircuito($circuito) {
		$this->circuito = $circuito;
	}

	function setNro($nro) {
		$this->nro = $nro;
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function setEstadoFisico($estadoFisico) {
		$this->estadoFisico = $estadoFisico;
	}

	function setEstadoContenido($estadoContenido) {
		$this->estadoContenido = $estadoContenido;
	}

	function setNota($nota) {
		$this->nota = $nota;
	}

	function setContenidoFuera($contenidoFuera) {
		$this->contenidoFuera = $contenidoFuera;
	}

	function setInspeccion($inspeccionado) {
		$this->inspeccionado = $inspeccionado;
	}
	public function listarVolquetaSinInspeccionar($circuito){
		$reportes=[];
		$consulta = DB::conexion()->prepare("select * from historiavolquetas as hvv where fecha IN (select MAX(fecha) from historiavolquetas as hv where hv.circuito=hvv.circuito and hv.nro=hvv.nro)  and circuito = ? GROUP BY nro ORDER BY fecha DESC");
		$consulta->bind_param("s",$circuito);
		$consulta->execute();
		$resultado = $consulta->get_result();
       while ($fila = $resultado->fetch_object()) { //fetch_object devuelve el resultado 
       	$reporte = new reporte($fila->circuito,$fila->nro,$fila->fecha,$fila->estadoFisico,$fila->estadoContenido,$fila->nota,$fila->contenidoFuera,$fila->inspeccionado);
       	$reportes[] = $reporte;
       }
       return $reportes;
   }

   public function agregarReporte($circuito,$numero,$fecha, $estadoFisico, $estadoContenido, $nota, $residuosFuera, $inspeccionado){
   	$basuraFuera;
   	if($residuosFuera=="true"){
   		$basuraFuera="1";
   	}else{
   		$basuraFuera="0";
   	}
   	echo "<script>console.log(".$basuraFuera.");</script>";

   	$consulta = DB::conexion()->prepare("INSERT INTO `historiavolquetas` (`id`, `circuito`, `nro`, `fecha`, `estadoFisico`, `estadoContenido`, `nota`, `contenidoFuera`, `inspeccionado`) VALUES (NULL,?,?,?,?,?,?,?,1);");
   	$consulta->bind_param('ssssssi',$circuito,$numero,$fecha, $estadoFisico, $estadoContenido, $nota,$basuraFuera);
   	if($consulta->execute()){
   		$actualizar=DB::conexion()->prepare("UPDATE `volquetas` SET `estadoFisico` = ?, `estadoContenido` = ? WHERE `volquetas`.`circuito` = ? and `volquetas`.`nro` = ?;");
   		$actualizar->bind_param('ssss',$estadoFisico,$estadoContenido,$circuito,$numero);
   		if($actualizar->execute()){
   			return true;	
   		}	
   	}else{
   		return false;
   	}
   }

   public function nuevoReporte($circuito,$numero,$fecha, $estadoFisico, $estadoContenido, $nota, $residuosFuera, $inspeccionado){
   	$basuraFuera;
   	if($residuosFuera=="true"){
   		$basuraFuera="1";
   	}else{
   		$basuraFuera="0";
   	}
   	echo "<script>console.log(".$basuraFuera.");</script>";

   	$consulta = DB::conexion()->prepare("INSERT INTO `historiavolquetas` (`id`, `circuito`, `nro`, `fecha`, `estadoFisico`, `estadoContenido`, `nota`, `contenidoFuera`, `inspeccionado`) VALUES (NULL,?,?,?,?,?,?,?,?);");
   	$consulta->bind_param('sssssssi',$circuito,$numero,$fecha, $estadoFisico, $estadoContenido, $nota,$basuraFuera,$inspeccionado);
   	if($consulta->execute()==true){
   		$actualizar=DB::conexion()->prepare("UPDATE `volquetas` SET `estadoFisico` = ?, `estadoContenido` = ? WHERE `volquetas`.`circuito` = ? and `volquetas`.`nro` = ?;");
   		$actualizar->bind_param('ssss',$estadoFisico,$estadoContenido,$circuito,$numero);
   		if($actualizar->execute()){
   			return true;	
   		}
   	}else{
   		return false;
   	}
   }



   public function aceptarReporte($circuito,$numero,$estadoContenido,$estadoFisico,$residuos){
   	if($residuos=="true"){
   		$contenidoFuera="1";
   	}else{
   		$contenidoFuera="0";
   	}
   	echo "console.log(".$contenidoFuera.")";
   	$fecha = new DateTime();
   	$nota = "";
   	$fecha2=$fecha->format('Y-m-d H:i:s');
   	$consulta = DB::conexion()->prepare("INSERT INTO `historiavolquetas` (`id`, `circuito`, `nro`, `fecha`, `estadoFisico`, `estadoContenido`, `nota`, `contenidoFuera`, `inspeccionado`) VALUES (NULL,?,?,?,?,?,?,?,1);");
   	$consulta->bind_param('ssssssi',$circuito,$numero,$fecha2, $estadoFisico, $estadoContenido,$nota,$contenidoFuera);
   	if($consulta->execute()){
   		return true;
   	}else{
   		return false;
   	}
   }
}