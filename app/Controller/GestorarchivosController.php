<?php
class GestorarchivosController extends AppController
{
    public $helpers= array('Ga');
    public $components=array('Unificacion','FuncionesGestorArchivos');
    public $layout= null;


    public function __construct($collection,$settings=array()){
        parent::__construct($collection,$settings);

        $dirconfgestor=Configure::read("Directorios.configuraciongestorarchivos");

         require($dirconfgestor.DS.'es.php');
         require($dirconfgestor.DS.'es_mimes.php');
         require($dirconfgestor.DS.'mimes.php');
         require($dirconfgestor.DS.'gestor_archivos_init.php');

    }

    public function ver($pagina=null)
    {
        //Comprobacion de la existencia de un parametro pagina
        //si no se pasaba como parametro o tiene muchos parámetros la llamada se obtiene Globalmente
        self::actualizarEstado($this->params);
        if ($pagina != null) self::write('pagina', $pagina);
        $pagina = self::read('pagina');

        // traducir el alias y guardar la ruta real
        // si hay error mostrar una página de error
        $home_dir = self::obtenerRutaDirectorio($pagina);

        if ($home_dir == null) {
            $mensaje = "Directorio inválido o no accesible";
            $this->paginaError($mensaje);
            return ;

        }
        self::write('home_dir', $home_dir);


        $mensajes =self::read('mensajes');
        $mensajes_error =self::read('mensajes_error');



        // TODO Comprobar, dir se va actualizando
        // dir se habra leido de los parametros
        $dir = self::read('dir');
        $dir_up = dirname($dir);

        if ($dir_up == ".") $dir_up = "";

        // archivos que no se muestran, expresion regular
        $no_access = self::read('no_access');
        //mostrar archivos ocultos boolean
        $show_hidden = self::read('show_hidden');

        if (!$this->FuncionesGestorArchivos->get_show_item($dir_up, basename($dir), $no_access, $show_hidden)) {
            $mensaje = $dir . " : " . $mensajes_error["accessdir"];
            $this->paginaError($mensaje);
            return;
        }

        //para construir las rutas en los links url/aplicacion/controlador
        $script_name = self::read('script_name');
        //script que descarga el archivo
        $script_servir_archivo = self::read('script_servir_archivo');

        // campo por el que se ordena
        $order = self::read('order');
        // si se ordena en orden creciente o decreciente
        $srt = self::read('srt');
        // algunos tipos mimes
        $super_mimes = self::read('super_mimes');
        //otros tipos mimes
        $used_mime_types = self::read('used_mime_types');
        //formato fecha
        $date_fmt =self::read('date_fmt');
        //tipos editables
        $editable_ext = self::read('editable_ext');


        $allow = null;$admin = null;
        $this->Unificacion->determinarPermisos(&$allow, &$admin);







        $titulo="XXX";
        //$this->pasar(array("titulo_barra_navegador"));
        $this->pasarAVista("charset","titulo_barra_navegador","version");

        $this->set('titulo',$titulo);
        $this->set('text_dir', $titulo);



        //se pasa a la cabecera para que incluya o no una serie de funciones javascript  de copiar, borrar etc
        // oculta los botones correspondientes a esas operaciones
        $this->set('allow', false);


        $this->render('listado',null);

    }


    // Protected

    // Extrae los valores de las variables del almacenamiento
   //  y las envia a la vista

    protected function pasar($array) {
        foreach($array as $variable):
            $this->set($variable,   $this->Unificacion->read($variable));
        endforeach;
    }

    protected function pasarAVista() {
        $array=func_get_args();
        $this->pasar($array);

}


    protected function multiset($array){
        foreach($array as $nombre=>$valor):
            $this->set($nombre,   $valor);
        endforeach;
    }



    private function obtenerRutaDirectorio($alias) {

        $definicionarchivos=simplexml_load_file(Configure::read("Archivos.aliasgestorarchivos"));
        $dirbase=Configure::read("Directorios.descargaarchivos");

        //construye un array con los elementos pagina del archivo

        foreach($definicionarchivos->pagina as $dir){

            if ($dir['nombre']==$alias) {
                $ruta_relativa=$dir['directorio'];

                if ($dir['ruta']!=null) $dirbase=$dir['ruta'];

                return   utf8_decode($dirbase.$ruta_relativa);
                //return   $dirbase.$ruta_relativa;
            }

        }
        return null;

    }

    private function paginaError($mensaje)
    {
        $mensajes_error = self::read('mensajes_error');

        $this->set('titulo', $mensajes_error["error"]);

        $this->set('error', $mensaje);
        $this->set('error_back', $mensajes_error["back"]);
        $this->set('charset', self::read('charset'));
        $this->set('text_dir', self::read('text_dir'));
        $this->set('version', self::read('version'));

        $this->render('error');



    }

    private function actualizarEstado($array)
    {
        $this->Unificacion->actualizarEstado($array);
    }

    private function write($clave, $valor)
    {
        $this->Unificacion->write($clave, $valor);

    }

    private function read($valor)
    {
        return $this->Unificacion->read($valor);
    }

}
