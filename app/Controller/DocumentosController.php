<?php

class DocumentosController extends AppController
{


    // Hay que evitar que se intente usar el modelo Log cuando no esté activada la
    // base de datos

    function __construct() {
        parent::__construct();
        $base=Configure::read('Directorios.configuracion');

        require($base.DS.'definicion_menu.php');


        if (!defined("DB_LOG")) {
            $this->uses = array (
                'Documento'
            );
        } else {
            $this->uses = array (
                'Documento',
                'Log'
            );
        }
    }


}