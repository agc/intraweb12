<?php
class FuncionesGestorArchivosComponent extends Component {

//devuelve falso si el nombre del archivo comienza por .
// o si es un directorio con nombre .  ..
// y la opción de mostrar ocultos vale false

    function get_show_item($dir, $item,$archivos_no_accesibles="",$mostrar_ocultos=false) {

        // es .  .. o un archivo oculto .nombre  cuando la opcion es false
        if($item == "." || $item == ".." || (substr($item,0,1)=="." && $mostrar_ocultos==false)) return false;

        // si encaja con el pattern de los no accesibles
        if($archivos_no_accesibles!="" && @eregi($archivos_no_accesibles,$item)) return false;

        if($mostrar_ocultos==false) {
            $dirs=explode("/",$dir);
            foreach($dirs as $i) if(substr($i,0,1)==".") return false;
        }

        return true;
    }
}