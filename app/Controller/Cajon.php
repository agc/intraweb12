<?php

var $name 		= 'Gestorarchivos';
var $uses			=array('Gestorarchivos');
var $components	=array('Configuracion','FuncionesGestorArchivos');
var $helpers		=array('Ga');

const ERROR_APERTURA_DIRECTORIO=-1;
const ERROR_LECTURA_DIRECTORIO=-2;
const LECTURA_CORRECTA=1;


// funci�n auxiliar a partir de un array de nombres, los lee dela clase de configuraci�n
// y los pasa con set a la vista

function __construct(){
parent::__construct();
$dirconf=Configure::read("Directorios.configuracion");
$dirconfgestor=Configure::read("Directorios.configuraciongestorarchivos");


require($dirconfgestor.DS.'es.php');
require($dirconfgestor.DS.'es_mimes.php');
require($dirconfgestor.DS.'mimes.php');
require($dirconf.DS.'gestor_archivos_init.php');
}

function pasar($array) {
foreach($array as $variable):
$this->set($variable,   $this->Configuracion->read($variable));
endforeach;
}

function multiset($array){
foreach($array as $nombre=>$valor):
$this->set($nombre,   $valor);
endforeach;
}



//las variables que se actualizan en el metodo actualizarEstado
// no deben pasarse aqu�, ya que son cambiadas mas adelante
function beforeFilter()
{
// insertar aqu� el c�digo de log de

}


function paginaError($mensaje)
{
$mensajes_error=&$this->Configuracion->read('mensajes_error');
$this->set('titulo',     $mensajes_error["error"]);
$this->set('error',      $mensaje);
$this->set('error_back', $mensajes_error["back"]);
$this->set('charset',    $this->Configuracion->read('charset'));
$this->set('text_dir',    $this->Configuracion->read('text_dir'));
$this->set('version',    $this->Configuracion->read('version'));
$this->render('error',null);
}



function ver($pagina=null)
{

    $this->layout = null;

    $allow = null;
    $admin = null;

    $this->Configuracion->actualizarEstado($this->params);

    if ($pagina != null) $this->Configuracion->write('pagina', $pagina);

    $this->Configuracion->determinarPermisos(&$allow, &$admin);


    /* pagina es una alias
    se debe obtener la ruta del directorio home_dir
    Se debe comprobar que es un alias v�lido
    */

    $pagina = $this->Configuracion->read('pagina');

    $home_dir = $this->_obtenerRutaDirectorio($pagina);


    if ($home_dir == null) {
        $mensaje = "Directorio inv�lido o no accesible";
        $this->paginaError($mensaje);
        exit;
    }
    $this->Configuracion->write('home_dir', $home_dir);


    $mensajes =& $this->Configuracion->read('mensajes');
    $mensajes_error =& $this->Configuracion->read('mensajes_error');
    $dir = $this->Configuracion->read('dir');


    $script_name = $this->Configuracion->read('script_name');
    $script_servir_archivo = $this->Configuracion->read('script_servir_archivo');
    $no_access = &$this->Configuracion->read('no_access');
    $show_hidden = &$this->Configuracion->read('show_hidden');
    $order = $this->Configuracion->read('order');
    $srt = $this->Configuracion->read('srt');
    $super_mimes = $this->Configuracion->read('super_mimes');
    $used_mime_types = $this->Configuracion->read('used_mime_types');
    $date_fmt = $this->Configuracion->read('date_fmt');
    $editable_ext = $this->Configuracion->read('editable_ext');


    $dir_up = dirname($dir);
    if ($dir_up == ".") $dir_up = "";

    if (!$this->FuncionesGestorArchivos->get_show_item($dir_up, basename($dir), $no_access, $show_hidden)) {
        $mensaje = $dir . " : " . $mensajes_error["accessdir"];
        $this->paginaError($mensaje);
    }


    /* Lee el directorio  y deja el resultado en las referencias dir_list, file_list, etc
se le pasa la ruta real  a home_dir, no el alias*/

    $opciones = array($no_access, $show_hidden, $order, $srt, $super_mimes, $used_mime_types);


    $resultado =
        $this->FuncionesGestorArchivos->make_tables($home_dir, $dir, $opciones,
            $dir_list, $file_list, $tot_file_size, $num_items);


    if ($resultado == GestorarchivosController::ERROR_APERTURA_DIRECTORIO)

        $this->paginaError($dir . ": " . $mensajes_error["opendir"]);

    elseif ($resultado == GestorarchivosController::ERROR_LECTURA_DIRECTORIO)

        $this->paginaError($dir . ": " . $mensajes_error["readdir"]); elseif ($resultado == GestorarchivosController::LECTURA_CORRECTA) {

        $espacio_libre = $this->FuncionesGestorArchivos->obtener_espacio_libre($home_dir, $dir);
        $espacio_total = $this->FuncionesGestorArchivos->parse_file_size($tot_file_size);

        $this->pasar(array('charset', 'text_dir', 'version', 'home_dir', 'dir', 'mensajes', 'order'));
        $this->pasar(array('srt', 'mimes', 'require_login', 'admin', 'pagina', 'home_url', 'super_mimes'));
        $this->pasar(array('used_mime_types', 'date_fmt', 'editable_ext', 'script_servir_archivo', 'script_name'));
        $this->pasar(array('titulo_barra_navegador', 'img_dir', 'pagina_a_volver'));
//se pasa a la cabecera para que incluya o no una serie de funciones javascript  de copiar etc
//oculta los botones correspondientes a esas operaciones
        $this->set('allow', false);

        $this->set('dir_up', $dir_up);
        $this->set('espacio_libre', $espacio_libre);
        $this->set('tot_file_size', $tot_file_size);
        $this->set('espacio_total', $espacio_total);
        $this->set('num_items', $num_items);


        $s_dir = $dir;
        if (strlen($s_dir) > 50) $s_dir = "..." . substr($s_dir, -47);

        $titulo = $mensajes["actdir"] . ": " . $pagina . " /" . $this->FuncionesGestorArchivos->get_rel_item("", $s_dir);
        $this->set('titulo', $titulo);

        /* informaci�n usada en la barra de herramientas del gestorarchivos
        se pasa a la vista, de ahi a un helper y de ahi a un elemento
        */

        $opciones = array("order" => $order, "srt" => $srt, "script_name" => $script_name, "home_dir" => $home_dir, "pagina" => $pagina);

        $enlace1 = $this->FuncionesGestorArchivos->make_link($opciones, "ver", $dir_up, NULL);
        $enlace2 = $this->FuncionesGestorArchivos->make_link($opciones, "ver", NULL, NULL);
        $enlace3 = $this->FuncionesGestorArchivos->make_link($opciones, "search", $dir, NULL);
        $enlace4 = $this->FuncionesGestorArchivos->make_link($opciones, "admin", $dir, NULL);
        $enlace5 = $this->FuncionesGestorArchivos->make_link($opciones, "logout", NULL, NULL);
        $enlace6 = $this->FuncionesGestorArchivos->make_link($opciones, "mkitem", $dir, NULL);


        $this->multiset(array('enlace1' => $enlace1, 'enlace2' => $enlace2, 'enlace3' => $enlace3, 'enlace4' => $enlace4, 'enlace5' => $enlace5, 'enlace6' => $enlace6));


//informaci�n usada en la visualizaci�n de la lista de archivos y directorios

        $opciones = array("order" => $order,
            "srt" => $srt,
            "script_name" => $script_name,
            "script_servir_archivo" => $script_servir_archivo,
            "pagina" => $pagina);

        if ($srt == "yes") {
            $contrario_srt = "no";

        } else {
            $contrario_srt = "yes";

        }
        $enlace1b = $this->FuncionesGestorArchivos->make_link($opciones, "post", $dir, NULL);
        $new_srt = ($order == "name" ? $contrario_srt : "yes");
        $enlace2b = $this->FuncionesGestorArchivos->make_link_ver($opciones, $dir, "name", $new_srt); // make_link($opciones,"list",$dir,NULL, "name",$new_srt);
        $new_srt = ($order == "size" ? $contrario_srt : "yes");
//$enlace3=make_link($opciones,"list",$dir,NULL, "size",$new_srt);
        $enlace3b = $this->FuncionesGestorArchivos->make_link_ver($opciones, $dir, "size", $new_srt);
        $new_srt = ($order == "type" ? $contrario_srt : "yes");
//$enlace4=make_link($opciones,"list",$dir,NULL, "type",$new_srt);
        $enlace4b = $this->FuncionesGestorArchivos->make_link_ver($opciones, $dir, "type", $new_srt);
        $new_srt = ($order == "mod" ? $contrario_srt : "yes");
//$enlace5=make_link($opciones,"list",$dir,NULL, "mod", $new_srt);
        $enlace5b = $this->FuncionesGestorArchivos->make_link_ver($opciones, $dir, "mod", $new_srt);

        $this->multiset(array('enlace1b' => $enlace1b, 'enlace2b' => $enlace2b, 'enlace3b' => $enlace3b, 'enlace4b' => $enlace4b, 'enlace5b' => $enlace5b));

        /*
        * Despu�s de leer la lista de archivos y directorios
        * se procesa para crear la informaci�n necesaria para la pagina web
        */
        $lista_ordenada_total = $this->FuncionesGestorArchivos->make_list($dir_list, $file_list, $srt);

        if (is_array($lista_ordenada_total)) {

            $opciones = array("order" => $order,
                "srt" => $srt,
                "script_name" => $script_name,
                "script_servir_archivo" => $script_servir_archivo,
                "home_dir" => $home_dir,
                "pagina" => $pagina);
            $info_items = array();

            /*
            * item es el nombre del archivo o directorio
            * en cada paso se debe formar la ruta completa para obtener informaci�n adicional
            *
            */
            foreach ($lista_ordenada_total as $key => $item) {


                $info_item = array();
                $target = "";
                $abs_item = $this->FuncionesGestorArchivos->get_abs_item($home_dir, $dir, $key);

                if (is_dir($abs_item)) {
                    $link = $this->FuncionesGestorArchivos->make_link($opciones, "ver", $this->FuncionesGestorArchivos->get_rel_item($dir, $key), NULL);
                    $info_item['tipo'] = 'directorio';

                } else {
                    $link = $this->FuncionesGestorArchivos->make_link_download($opciones, $dir, $key); //"$home_url/".get_rel_item($dir, $item);
                    $target = "_blank";
                    $info_item['tipo'] = 'archivo';
                }

                $info_item['link'] = $link;
                $info_item['target'] = 'target';

                $img_mime_type = $this->FuncionesGestorArchivos->get_mime_type($home_dir, $dir, $key, "img", $super_mimes, $used_mime_types);
                $tipo_mime = $this->FuncionesGestorArchivos->get_mime_type($home_dir, $dir, $key, "type", $super_mimes, $used_mime_types);
                $s_item = $key;
                if (strlen($s_item) > 50)
                    $s_item = substr($s_item, 0, 47) . "...";

                $tamano = $this->FuncionesGestorArchivos->parse_file_size($this->FuncionesGestorArchivos->get_file_size($home_dir, $dir, $key));

                $fecha_archivo = $this->FuncionesGestorArchivos->parse_file_date($this->FuncionesGestorArchivos->get_file_date($home_dir, $dir, $key), $date_fmt);
                $link_permisos = $this->FuncionesGestorArchivos->make_link($opciones, "chmod", $dir, $key);
                $link_editar = $this->FuncionesGestorArchivos->make_link($opciones, "edit", $dir, $key);
                $link_download = $this->FuncionesGestorArchivos->make_link_download($opciones, $dir, $key);
                $info_permisos = $this->FuncionesGestorArchivos->parse_file_type($home_dir, $dir, $key) . $this->FuncionesGestorArchivos->parse_file_perms($this->FuncionesGestorArchivos->get_file_perms($home_dir, $dir, $key));
                $es_editable = $this->FuncionesGestorArchivos->get_is_editable($home_dir, $dir, $key, $editable_ext);
                $es_archivo = $this->FuncionesGestorArchivos->get_is_file($home_dir, $dir, $key);
                $allow = true;

                $info_item['img_mime_type'] = $img_mime_type;
                $info_item['tipo_mime'] = $tipo_mime;
                $info_item['s_item'] = $s_item;
                $info_item['tamano'] = $tamano;
                $info_item['fecha_archivo'] = $fecha_archivo;
                $info_item['link_permisos'] = $link_permisos;
                $info_item['link_editar'] = $link_editar;
                $info_item['link_download'] = $link_download;
                $info_item['info_permisos'] = $info_permisos;
                $info_item['es_editable'] = $es_editable;
                $info_item['es_archivo'] = $es_archivo;
                $info_item['allow'] = $allow;
                $info_items[] = $info_item;

            }
        }

       //FIN IF

        $this->set('info_items', $info_items);
        $this->render('listado', null);

    }


//list_dir($GLOBALS["dir"]);
//invocar el modelo para que obtenga los archivos
}

// fin de ver


function error(){
$this->layout=null;
$mensajes_error=&$this->Configuracion->read('mensajes_error');
$this->paginaError($mensajes_error["opendir"]);


}

function _obtenerRutaDirectorio($alias) {
$definicionarchivos=
simplexml_load_file(Configure::read("Archivos.aliasgestorarchivos"));



$dirbase=Configure::read("Directorios.descargaarchivos");

foreach($definicionarchivos->pagina as $dir){
if ($dir['nombre']==$alias) {
$ruta_relativa=$dir['directorio'];

if ($dir['ruta']!=null) $dirbase=$dir['ruta'];
return   utf8_decode($dirbase.$ruta_relativa);
}

}
return null;

}