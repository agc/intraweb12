<?php
class FuncionesGestorArchivosComponent extends Component {

    const ERROR_APERTURA_DIRECTORIO=-1;
    const ERROR_LECTURA_DIRECTORIO=-2;
    const LECTURA_CORRECTA=1;

    function get_abs_dir($home_dir,$dir) {

        if($dir!="") $home_dir.="/".$dir;
        return $home_dir;
    }

// obtener ruta absoluta del archivo $item
// que se encuentra en el  $home_dir\$sub_dir

    function get_abs_item($home_dir,$dir, $item) {
        return $this->get_abs_dir($home_dir,$dir)."/".$item;
    }

    function get_rel_item($dir,$item) {		// get file relative from home
        if($dir!="") return $dir."/".$item;
        else return $item;
    }

//devuelve falso si el nombre del archivo comienza por .
// o si es un directorio con nombre . � ..
// y la opci�n de mostrar ocultos vale false

    function get_show_item($dir, $item,$archivos_no_accesibles="",$mostrar_ocultos=false) {		// show this file?
        if($item == "." || $item == ".." ||
            (substr($item,0,1)=="." && $mostrar_ocultos==false)) return false;

        if($archivos_no_accesibles!="" && @eregi($archivos_no_accesibles,$item)) return false;

        if($mostrar_ocultos==false) {
            $dirs=explode("/",$dir);
            foreach($dirs as $i) if(substr($i,0,1)==".") return false;
        }

        return true;
    }



    function get_mime_type($home_dir,$dir, $item, $query,$super_mimes,$used_mime_types) {	// get file's mimetype
        if($this->get_is_dir($home_dir,$dir, $item)) {			// directory
            $mime_type	= $super_mimes["dir"][0];
            $image		= $super_mimes["dir"][1];

            if($query=="img") return $image;
            else return $mime_type;
        }
        // mime_type
        foreach($used_mime_types as $mime) {
            list($desc,$img,$ext)	= $mime;
            if(@eregi($ext,$item)) {
                $mime_type	= $desc;
                $image		= $img;
                if($query=="img") return $image;
                else return $mime_type;
            }
        }
        //is_executable est� disponible en windows a partir de php 5.0
        if((function_exists("is_executable") &&
            @is_executable($this->get_abs_item($home_dir,$dir,$item))) ||
            @eregi($super_mimes["exe"][2],$item))
        {						// executable
            $mime_type	= $super_mimes["exe"][0];
            $image		= $super_mimes["exe"][1];
        } else {					// unknown file
            $mime_type	= $super_mimes["file"][0];
            $image		= $super_mimes["file"][1];
        }

        if($query=="img") return $image;
        else return $mime_type;
    }

    function get_is_file($home_dir,$dir, $item) {		// can this file be edited?
        return @is_file($this->get_abs_item($home_dir,$dir,$item));
    }
//------------------------------------------------------------------------------
    function get_is_dir($home_dir,$dir, $item) {		// is this a directory?
        return @is_dir($this->get_abs_item($home_dir,$dir,$item));
    }



    function get_file_size($home_dir,$dir, $item) {		// file size
        return @filesize($this->get_abs_item($home_dir,$dir, $item));
    }

    function get_file_date($home_dir,$dir, $item) {		// file date
        return @filemtime($this->get_abs_item($home_dir,$dir, $item));
    }

    function get_file_perms($home_dir,$dir,$item) {		// file permissions
        return @decoct(@fileperms($this->get_abs_item($home_dir,$dir,$item)) & 0777);
    }

    function get_is_editable($home_dir,$dir, $item,$editable_ext) {		// is this file editable?
        if(!$this->get_is_file($home_dir,$dir, $item)) return false;
        foreach($editable_ext as $pat) if(@eregi($pat,$item)) return true;
        return false;
    }

    function make_link_download($opciones,$_dir,$_item) {
        $link=$opciones['script_servir_archivo']."/?pagina=".$opciones['pagina']."&documento=/".$_dir."/".$_item;
        return $link;
    }

    function make_link_ver($opciones,$_dir,$_order=NULL,$_srt=NULL) {
        $link=$opciones["script_name"]."/ver"."?pagina=".$opciones["pagina"];
        if($_dir!=NULL) $link.="&dir=".urlencode($_dir);
        if($_order==NULL) $_order=$opciones["order"];
        if($_order!=NULL) $link.="&order=".$_order;
        if($_srt==NULL) $_srt=$opciones["srt"];
        if($_srt!=NULL) $link.="&srt=".$_srt;

        return $link;
    }


    function make_link($opciones,$_action,$_dir,$_item=NULL,$_order=NULL,$_srt=NULL) {
        // make link to next page
        //cambiar por opciones donde s�lo se pase lo necesario
        if($_action=="" || $_action==NULL) $_action="ver";
        if($_dir=="") $_dir=NULL;
        if($_item=="") $_item=NULL;
        if($_order==NULL) $_order=$opciones["order"];
        if($_srt==NULL) $_srt=$opciones["srt"];


        $link=$opciones["script_name"]."/".$_action;
        if ($_action=="ver") $link.="?pagina=".$opciones["pagina"];
        if ($_action=="download")
            $link=$opciones['script_servir_archivo']."/?pagina=".$opciones['pagina'];
        if($_dir!=NULL) $link.="&dir=".urlencode($_dir);
        if($_item!=NULL) $link.="&item=".urlencode($_item);
        if($_order!=NULL) $link.="&order=".$_order;
        if($_srt!=NULL) $link.="&srt=".$_srt;



        return $link;
    }


    function parse_file_size($size) {		// parsed file size
        if($size >= 1073741824) {
            $size = round($size / 1073741824 * 100) / 100 . " GB";
        } elseif($size >= 1048576) {
            $size = round($size / 1048576 * 100) / 100 . " MB";
        } elseif($size >= 1024) {
            $size = round($size / 1024 * 100) / 100 . " KB";
        } else $size = $size . " Bytes";
        if($size==0) $size="-";

        return $size;
    }

    function parse_file_type($home_dir,$dir,$item) {		// parsed file type (d / l / -)
        $abs_item = $this->get_abs_item($home_dir,$dir, $item);
        if(@is_dir($abs_item)) return "d";
        if(@is_link($abs_item)) return "l";
        return "-";
    }

    function parse_file_perms($mode) {		// parsed file permisions
        if(strlen($mode)<3) return "---------";
        $parsed_mode="";
        for($i=0;$i<3;$i++) {
            // read
            if(($mode{$i} & 04)) $parsed_mode .= "r";
            else $parsed_mode .= "-";
            // write
            if(($mode{$i} & 02)) $parsed_mode .= "w";
            else $parsed_mode .= "-";
            // execute
            if(($mode{$i} & 01)) $parsed_mode .= "x";
            else $parsed_mode .= "-";
        }
        return $parsed_mode;
    }

    function parse_file_date($date,$fmt) {		// parsed file date
        return @date($fmt,$date);
    }



    /* hace una lista de archivos combianando las dos que se pasan
        como par�metros
        se usara para combinar las listas de archivos y directorios */

    function make_list($_list1, $_list2,$srt) {
        $list = array();

        if($srt=="yes") {
            $list1 = $_list1;
            $list2 = $_list2;
        } else {
            $list1 = $_list2;
            $list2 = $_list1;
        }

        if(is_array($list1)) {
            while (list($key, $val) = each($list1)) {
                $list[$key] = $val;
            }
        }

        if(is_array($list2)) {
            while (list($key, $val) = each($list2)) {
                $list[$key] = $val;
            }
        }

        return $list;
    }


    /*   funciones php  usadas
      opendir readdir file_exists filesize filemtime is_array asort arsort ksort krsort
     funciones existentes en vendor  funciones_extra
     get_abs_item obtiene la ruta absoluta del archivo
     get_show_item devuelve false si el archivo debe quedar oculto
     get_is_dir true si es un directorio
     get_mime_type
    */

    /* lee el directorio abs_dir/dir y almacena en  las variables por referencia
       dir_list file_list la lista de
       archivos y directorios obtenida, seg�n las opciones que se le pasen
       las cuales hacen referencia al orden, a los ficheros que se deben mostrar ocultos, etc
	   tambi�n devuelve el tama�o total y el n�mero de itemas*/


    function make_tables($abs_dir,$dir,$opciones, &$dir_list, &$file_list, &$tot_file_size, &$num_items)
    {




        list($no_access,$show_hidden,$order,$srt,$super_mimes,$used_mime_types)=$opciones;

        $tot_file_size = $num_items = 0;

        // Abrir directorio
        $handle = @opendir($this->get_abs_dir($abs_dir,$dir));

        if($handle===false) return self::ERROR_APERTURA_DIRECTORIO;

        // Leer directorio
        while(($new_item = readdir($handle))!==false) {
            $abs_new_item = $this->get_abs_item($abs_dir,$dir, $new_item);

            if(!@file_exists($abs_new_item)) return self::ERROR_LECTURA_DIRECTORIO;

            if(!$this->get_show_item($dir, $new_item,$no_access,$show_hidden)) continue;

            $new_file_size = filesize($abs_new_item);
            $tot_file_size += $new_file_size;
            $num_items++;

            if($this->get_is_dir($abs_dir,$dir, $new_item)) {
                if($order=="mod") {
                    $dir_list[$new_item] =@filemtime($abs_new_item);
                } else {	// order == "size", "type" or "name"
                    $dir_list[$new_item] = $new_item;
                }
            } else {
                if($order=="size") {

                    $file_list[$new_item] = $new_file_size;
                } elseif($order=="mod") {
                    $file_list[$new_item] = @filemtime($abs_new_item);
                } elseif($order=="type") {
                    $file_list[$new_item] =$this->get_mime_type($abs_dir,$dir, $new_item, "type",$super_mimes,$used_mime_types);
                } else {	// order == "name"
                    $file_list[$new_item] = $new_item;
                }
            }
        }
        closedir($handle);


        // sort
        if(is_array($dir_list)) {
            if($order=="mod") {
                if($srt=="yes") arsort(&$dir_list);
                else asort(&$dir_list);
            } else {	// order == "size", "type" or "name"
                if($srt=="yes") ksort(&$dir_list);
                else krsort(&$dir_list);
            }
            reset($dir_list);
        }

        // sort
        if(is_array($file_list)) {
            if($order=="mod") {
                if($srt=="yes") arsort($file_list);
                else asort($file_list);
            } elseif($order=="size" || $order=="type") {
                if($srt=="yes") asort($file_list);
                else arsort($file_list);
            } else {	// order == "name"
                if($srt=="yes") ksort($file_list);
                else krsort($file_list);
            }
            reset($file_list);
        }


        return self::LECTURA_CORRECTA;
    }

    function obtener_espacio_libre($abs_dir,$dir){
        if(function_exists("disk_free_space")) {
            $free=$this->parse_file_size(disk_free_space($this->get_abs_dir($abs_dir,$dir)));
        } elseif(function_exists("diskfreespace")) {
            $free=$this->parse_file_size(diskfreespace($this->get_abs_dir($abs_dir,$dir)));
        } else $free="?";
        return $free;
    }
}
?>