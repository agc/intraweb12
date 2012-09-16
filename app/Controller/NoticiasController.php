<?php
class NoticiasController extends AppController
{


    //el layout no se usa cuando se invoca con requestAction
    //public $layout = 'cajalateralnoticias';

    public $components=Array("Avisos");


    function listado($plantilla=null)
    {
        $this->layout="cajalateralnoticias";
        $cajas = array();
        $dir_avisos=Configure::read("Directorios.avisos");
        $lista_archivos=$this->Avisos->obtenerListaArchivos($dir_avisos);

        foreach($lista_archivos as $archivo) {

            $aviso_array=$this->Avisos->leerAviso($archivo);

            $cajas[]=new Caja($aviso_array[0],$aviso_array[1]);

        }

        $this->set('noticias',$cajas);

       if (!is_null($plantilla)) $this->render($plantilla);
    }
}

