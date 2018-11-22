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
		$consulta = DB::conexion()->prepare("select * from historiavolquetas as hvv where fecha IN (select MAX(fecha) from historiavolquetas as hv where hv.circuito=hvv.circuito and hv.nro=hvv.nro)  and circuito = ? and inspeccionado=0 GROUP BY nro ORDER BY fecha DESC");
		$consulta->bind_param("s",$circuito);
		$consulta->execute();
		$resultado = $consulta->get_result();
       while ($fila = $resultado->fetch_object()) { //fetch_object devuelve el resultado 
       	$reporte = new reporte($fila->circuito,$fila->nro,$fila->fecha,$fila->estadoFisico,$fila->estadoContenido,$fila->nota,$fila->contenidoFuera,$fila->inspeccionado);
       	$reportes[] = $reporte;
       }
       return $reportes;
   }
}
?>