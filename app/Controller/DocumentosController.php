<?php

//App::uses('AppController','Controller');

class DocumentosController extends AppController
{

    public $helpers=array('Pie');
    public $components=array('ForceDownload');
    public $layout=null;

    private  function test($clave,$valor) {
        return (Configure::read($clave)==$valor);
    }

    public function __construct($collection,$settings=array()) {
        parent::__construct($collection,$settings);



        if (!$this->test("db_log","si")) {
            $this->loadModel('Documento');
        } else {
            $this->loadModel('Documento');
            $this->loadModel('Log');
        }

    }

    function ver($pagina=null){

        //$this->layout="documentos";
        $this->pageTitle = Configure::read("General.titulopaginaprincipal");
        $this->set("eliminarcolumna","no");

        Cache::write("claveprueba","hola mundo ".CACHE);

        if ($pagina==null or $pagina=='home') {
            //el argumento que se pasa al controller listado es el nombre de la vista
            //$this->set('columnalateral', $this->requestAction('/noticias/listado/listanoticias', array('return')));
            //renderiza la vista, sin invocar la acci�n
            $this->render("index");
        }

        else
        {
            $this->viewPath='documentos_subvistas';
            $ruta_archivo=$this->_obtenerNombrePlantilla($pagina);
            if($ruta_archivo==Configure::read("Mensajes.aliasnoencontrado"))
                $ruta_archivo=Configure::read("Vista.errordealias");
            $sin_columna=array("proyectomision","documentosprofesorado","normativadocoficial");
            /*if ($pagina=="proyectomision")
                   $this->set("eliminarcolumna","si");	*/
            if (in_array($pagina,$sin_columna)) $this->set("eliminarcolumna","si");
            $this->render($ruta_archivo);
        }

    }

    public function index($pagina=null){

        // se elimina porque index extiend un Comun
        // $this->layout="documentos";
        $this->layout=null;

        $this->set("title_for_layout",Configure::read("Sitio.TituloPaginaPrincipal"));

        $this->set("eliminarcolumna","no");

        Cache::write("claveprueba","hola mundo ".CACHE);

        //Lectura del menu





        //menu pasa a documentos.ctp que lo envia como variable al elemento de menu

       $this->set('columnalateral', $this->requestAction('/noticias/listado/listanoticias',array('return')));

       $this->render("index_nuevo");




    }

    public function servirarchivo($pagina=null,$documento=null) {

        if (!isset($documento) && !isset($pagina)) {
            if (array_key_exists('documento',$this->params['url'])) {
                $documento=$this->params['url']['documento'];
            }
            else {
                $documento=null;
            }
            if (array_key_exists('pagina',$this->params['url'])) {
                $pagina=$this->params['url']['pagina'];
            }
            else {
                $pagina=null;
            }
        }
        if (isset($this->namedArgs['pagina']))
        {
            $pagina = $this->namedArgs['pagina'];
        }
        if (isset($this->namedArgs['documento']))
        {
            $documento = $this->namedArgs['documento'];
        }

        $ruta=$this->_obtenerRutaArchivo($documento,$pagina);

        $ruta=$this->_arreglarNombre($ruta);

        $this->ForceDownload->forceDownload($ruta);
        exit();
    }

    private function _obtenerRutaArchivo($documento,$pagina="") {

        $definicionarchivos= simplexml_load_file(Configure::read("Archivos.aliasgestorarchivos"));

        $dirbase=Configure::read("Directorios.descargaarchivos");
        /* no se ha definido una p�gina, el documento contiene la ruta completa*/
        if ($pagina=="" || $pagina== null){
            foreach($definicionarchivos->documento as $defarchivo){
                if($documento==(string)$defarchivo['nombre'])
                    // return utf8_decode($dirbase.(string)$defarchivo['ruta']);
                   return $dirbase.(string)$defarchivo['ruta'];
            }
            //return utf8_decode($dirbase.(string)$documento);
            return $dirbase.(string)$documento;

        }else
        {
            /* pagina no es un alias sino el directorio */
            $dirpagina=$pagina;

            foreach($definicionarchivos->pagina as $pag){

                //encuentra la p�gina
                //aqu� hab�a (string)
                if ($pag['nombre']==$pagina){
                    $dirpagina=utf8_decode($pag['directorio']);
                    //encuentra el documento, un alias
                    foreach($pag->documento as $defarchivo){

                        if($documento==(string)$defarchivo['nombre'])
                            //return utf8_decode($dirbase.$dirpagina.(string)$defarchivo['ruta']);
                            return $dirbase.$dirpagina.utf8_decode((string)$defarchivo['ruta']);
                    }
                }


            }
            //no hay alias para el documento, documento es la ruta
            //return utf8_decode($dirbase.$dirpagina.$documento);
            //los espacios funcionan en iexplorer no en mozilla
            return $dirbase.$dirpagina.(string)$documento ;
            //return utf8_decode($dirbase.$dirpagina.(string)$documento) ;
            //return htmlentities($dirbase.$dirpagina.$documento);
        }
        //Nunca se llega aqu�, porque si no existe el alias, se considera como  la ruta real
        return "error imprevisto";

    }

    function _arreglarNombre($ruta){
        //$salida= utf8_decode($ruta);
        $salida=$ruta;

        return $salida;
    }


}
