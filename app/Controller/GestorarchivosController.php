<?php

// Sustituir el componente Unificacion

class Lector
{

    private $clavealmacenamiento;

    const CLAVEALMACENAMIENTO='GestorArchivos';

    public function __construct($clave)
    {

        $this->clavealmacenamiento = $clave;

    }

    public function __invoke($clave)
    {
        return Configure::read($this->clavealmacenamiento . '.' . $clave);
    }

    public static function crear() {
        return new Lector(self::CLAVEALMACENAMIENTO);
    }

}

class Escritor
{

    private $clavealmacenamiento;

    const CLAVEALMACENAMIENTO='GestorArchivos';

    public function __construct($clave)
    {

        $this->clavealmacenamiento = $clave;

    }

    public function __invoke($clave,$valor)
    {
        return Configure::write($this->clavealmacenamiento . '.' . $clave,$valor);
    }

    public static function crear() {
        return new Escritor(self::CLAVEALMACENAMIENTO);
    }

}

class GestorarchivosController extends AppController
{
    public $helpers= array('Ga');
    public $components=array('Unificacion','FuncionesGestorArchivos');
    public $layout= null;

    const ERROR_APERTURA_DIRECTORIO=-1;
    const ERROR_LECTURA_DIRECTORIO=-2;
    const LECTURA_CORRECTA=1;
    const CLAVEALMACENAMIENTO='GestorArchivos';

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

        $allow = null;$admin = null;
        $this->determinarPermisos($allow, $admin);

        $r = Lector::crear();   //equivale a self::read
        $w = Escritor::crear(); //equivale a self::write


        //Comprobacion de la existencia de un parametro pagina
        //si no se pasaba como parametro o tiene muchos parámetros la llamada se obtiene Globalmente
        self::actualizarEstado($this->params);


        if ($pagina != null) $w('pagina', $pagina);


        $pagina=$r('pagina'); // se emplea mas adelante, al escribir la lista


        // traducir el alias y guardar la ruta real
        // si hay error mostrar una página de error
        $home_dir = self::obtenerRutaDirectorio($pagina);

        if ($home_dir == null) {
            $mensaje = "Directorio inválido o no accesible";
            $this->paginaError($mensaje);
            return ;

        }
       // self::write('home_dir', $home_dir);
        $w('home_dir', $home_dir);


        $mensajes =$r('mensajes');
        $mensajes_error =$r('mensajes_error');



        // TODO Comprobar, dir se va actualizando
        // dir se habra leido de los parametros
        $dir = $r('dir');
        $dir_up = dirname($dir);

        if ($dir_up == ".") $dir_up = "";

        // archivos que no se muestran, expresion regular
        $no_access = $r('no_access');
        //mostrar archivos ocultos boolean
        $show_hidden = $r('show_hidden');

        if (!$this->FuncionesGestorArchivos->get_show_item($dir_up, basename($dir), $no_access, $show_hidden)) {
            $mensaje = $dir . " : " . $mensajes_error["accessdir"];
            $this->paginaError($mensaje);
            return;
        }

        //para construir las rutas en los links url/aplicacion/controlador
        $script_name = $r('script_name');
        //script que descarga el archivo
        $script_servir_archivo = $r('script_servir_archivo');

        // campo por el que se ordena
        $order = $r('order'); // se usa después de la lectura, al escribir la barra de herramientas
        // si se ordena en orden creciente o decreciente
        $srt = $r('srt'); // se usa después de la lectura, al escribir la barra de herramientas
        // algunos tipos mimes
        $super_mimes = $r('super_mimes');
        //otros tipos mimes
        $used_mime_types = $r('used_mime_types');
        //formato fecha
        $date_fmt = $r('date_fmt');
        //tipos editables
        $editable_ext = $r('editable_ext');

        /* Lee el directorio  y deja el resultado en las referencias dir_list, file_list, etc
se le pasa la ruta real  a home_dir, no el alias*/

        $opciones = array($no_access, $show_hidden, $order, $srt, $super_mimes, $used_mime_types);

        $resultado =
            $this->FuncionesGestorArchivos->make_tables(
                $home_dir,
                $dir,
                $opciones,
                $dir_list,
                $file_list,
                $tot_file_size,
                $num_items
            );

        // las variables no están definidas, pero como se han definido como referencias son completadas dentro

        if ($resultado == GestorarchivosController::ERROR_APERTURA_DIRECTORIO) {

            $this->paginaError($dir . ": " . $mensajes_error["opendir"]);
            return;

        }
        if ($resultado == GestorarchivosController::ERROR_LECTURA_DIRECTORIO) {

            $this->paginaError($dir . ": " . $mensajes_error["readdir"]);
            return;
        }
        if ($resultado == GestorarchivosController::LECTURA_CORRECTA) {

            $espacio_libre = $this->FuncionesGestorArchivos->obtener_espacio_libre($home_dir, $dir);
            $espacio_total = $this->FuncionesGestorArchivos->parse_file_size($tot_file_size);

            // estas variables se pasan a la vista $this->set extrayendo sus valores de Configure
            //TODO cuando funcione usar pasar a vista

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

            /* información usada en la barra de herramientas del gestorarchivos
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
            $enlace2b = $this->FuncionesGestorArchivos->make_link_ver($opciones, $dir, "name", $new_srt);
            $new_srt = ($order == "size" ? $contrario_srt : "yes");

            $enlace3b = $this->FuncionesGestorArchivos->make_link_ver($opciones, $dir, "size", $new_srt);
            $new_srt = ($order == "type" ? $contrario_srt : "yes");

            $enlace4b = $this->FuncionesGestorArchivos->make_link_ver($opciones, $dir, "type", $new_srt);
            $new_srt = ($order == "mod" ? $contrario_srt : "yes");

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

            $this->set('info_items', $info_items);
            $this->render('listado', null);

        }
        //Fin LECTURA_CORRECTA











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
                //TODO si el archivo xml de alias tiene encoding ISO es necesario
                return   utf8_decode($dirbase.$ruta_relativa);
               // return   $dirbase.$ruta_relativa;
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
    // la mayoria no se usan, se ha sustituido por objetos callables
    // para reducir la escritura



    private  function actualizarEstado($parametros)
    {
        //aqui se guarda el alias
        //la ruta completa se guarda en el controlador


        if (array_key_exists('pagina',$parametros['url'])) {
            $pagina=$parametros['url']['pagina'];
            $this->write('pagina',$pagina);
        }

        $dir="";
        if (isset($parametros['url']['dir']))  {
            $dir=stripslashes($parametros['url']['dir']);
            if ($dir==".") $dir="";

        }
        $this->write("dir",$dir);



        // Get Sort
        if (array_key_exists('order',$parametros['url'])) {
            $order=stripslashes($parametros['url']['order']);
            if ($order=="") $order="name";

        }
        else
            $order="name";

        $this->write('order',$order);

        if (array_key_exists('srt',$parametros['url'])) {
            $srt=stripslashes($parametros['url']['srt']);
            if ($srt=="") $srt="yes";

        } else $srt="yes";

        $this->write('srt',$srt);




    }


    private function determinarPermisos(&$allow,&$admin)
    {
        $permisos=$this->read('permissions');
        $allow=($permisos&01)==01;
        $admin=((($permisos&04)==04) || (($permisos&02)==02));
    }


    private function write($name, $value)
    {

        Configure::write(self::CLAVEALMACENAMIENTO.'.'.$name,$value);

    }

    private function read($name = null)
    {
        return Configure::read(self::CLAVEALMACENAMIENTO.'.'.$name);
    }

    private  function del($name)
    {
        Configure::delete(self::CLAVEALMACENAMIENTO.'.'.$name);
    }

    private   function check($name)
    {
        if ($this->read($name) != null) return true;
        else
            return false;

    }

}
