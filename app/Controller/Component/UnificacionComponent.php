<?php
class UnificacionComponent extends Component
{

    /* **************************** Funciones generales *****************************/

    private $config;
    const CLAVEALMACENAMIENTO='GestorArchivos';


    function __construct($collection,$settings=array())
    {
        parent::__construct($collection,$settings);
       // $this->config =Configure::read('GestorArchivos');


    }

    public function mostrar(){
         return Configure::read(self::CLAVEALMACENAMIENTO);

    }
   public function write($name, $value)
    {

        Configure::write(self::CLAVEALMACENAMIENTO.'.'.$name,$value);

    }

   public function read($name = null)
    {
        return Configure::read(self::CLAVEALMACENAMIENTO.'.'.$name);
    }
  public  function del($name)
    {
        Configure::delete(self::CLAVEALMACENAMIENTO.'.'.$name);
    }

 public   function check($name)
    {
        if ($this->read($name) != null) return true;
        else
            return false;

    }


    /* ************ Funciones propias  ******************************** */

    /*

       $parametros 
        los parametros que recibe el controlador del request

       Funcionamiento
    buscan informacion sobre
    los parámetros siguientes en el request
        pagina dir order srt
        los almacena
         pagina es el alias del DIRECTORIO
         no la ruta completa,  que se obtendrá  en el controlador

    */
  public  function actualizarEstado($parametros)
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


    function determinarPermisos(&$allow,&$admin)
    {
        $permisos=$this->read('permissions');
        $allow=($permisos&01)==01;
        $admin=((($permisos&04)==04) || (($permisos&02)==02));
    }



}