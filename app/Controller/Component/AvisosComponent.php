<?php
App::uses('Component','Controller');

class Caja
{
    public $titulo,$texto;
    
    function Caja($titulo, $texto)
    {
        $this->titulo= $titulo;
        $this->texto = $texto;
    }
};
class AvisosComponent extends Component {

		public function obtenerListaArchivos($directorio)
		{
	    
	    $f_types=array("txt");
		
		$dir=opendir($directorio);
		$lista_archivos=array();
		while ($file=readdir($dir))
		{
			if ($file != "." && $file != "..")
			{
			    $extension=substr($file,-3);
				for($x=0;$x < count($f_types); $x++)
				  if($extension == $f_types[$x])
					{
					  $lista_archivos[]=$directorio."/".$file;
					}
			}
		}
			return $lista_archivos;
		}
	   public  function obtenerLineasArchivo($archivo)
	   {
		$lineas=array();
		  $f = fopen($archivo, "r");
		  while (!feof($f)) {
			$linea = fgets($f);
			$lineas[]=$linea;
	      }
		  return $lineas;
	   }


	  public   function leerAviso($archivo)
	   {
		$lineas=$this->obtenerLineasArchivo($archivo);
		$titulo=array_shift($lineas);
		$cuerpo=implode("<br>",$lineas);
		$resultado=array();
		$resultado[]=$titulo;
		$resultado[]=$cuerpo;
		return $resultado;
	
	   }
	
}

?>