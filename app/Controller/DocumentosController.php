<?php

//App::uses('AppController','Controller');

class DocumentosController extends AppController
{

    public $helpers=array('Pie');

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

        $this->layout="documentos";
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

        $this->set("title_for_layout",Configure::read("Sitio.TituloPaginaPrincipal"));

        $this->set("eliminarcolumna","no");

        Cache::write("claveprueba","hola mundo ".CACHE);

        //Lectura del menu

        $base=Configure::read('Directorios.configuracion');
        require($base.DS.'definicion_menu.php');
        $this->set("definicionmenu",$definicion); //no se pueden mandar arrays


        //menu pasa a documentos.ctp que lo envia como variable al elemento de menu

       $this->set('columnalateral', $this->requestAction('/noticias/listado/listanoticias',array('return')));

       //$this->render("index");




    }


}
