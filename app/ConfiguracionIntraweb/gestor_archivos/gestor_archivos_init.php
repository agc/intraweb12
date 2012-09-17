<?php

    $GLOBALS['__GET']		=&$_GET;
	$GLOBALS['__POST']		=&$_POST;
	$GLOBALS['__SERVER']	=&$_SERVER;
	$GLOBALS['__FILES']		=&$_FILES;

	//$GLOBALS["script_name"] = "http://".$GLOBALS['__SERVER']['HTTP_HOST'].$GLOBALS['__SERVER']["PHP_SELF"];


   //Se define un componente que realiza el acceso a esta variable



   $_conf=array('version' => "2.3");


   $_conf["titulo_barra_navegador"]= "I.E.S. Navarro Villoslada Intraweb";
  
   
   $_conf["controlador"]    =   "gestorarchivos";

   
    $_conf["home_url"]       =  $this->webroot; // "http://".$GLOBALS['__SERVER']['HTTP_HOST']."/".WEBROOT_DIR;

    $_conf["pagina_a_volver"] 	   = $_conf["home_url"]."documentos";  //."/"."ver";

    //$_conf["img_dir"] 			   = $_conf["home_url"]."/".'img'.'/gestorarchivos';

   $_conf["img_dir"] 			   = $this->webroot.'img'.'/gestorarchivos';

   $_conf["script_name"]	=  "http://".$GLOBALS['__SERVER']['HTTP_HOST']."/".WEBROOT_DIR."/"."gestorarchivos";
																				//http://localhost/aplicaciones/gestorarchivos
    
   $_conf["script_name"]	=   $_conf["home_url"]."/".$_conf["controlador"];
   $_conf["script_servir_archivo"]=  $_conf["home_url"]."/"."documentos/servirarchivo";


   $_conf['db_log']			= false;
   $_conf['require_login']	= false;
   $_conf["admin"]			= false;

  

   $_conf["pagina"]			 =   "blog" ;    //pagina es el alias del home_dir
   $_conf["home_dir"] 		 =   "se lee de configarchivos.xml";

   $_conf["show_hidden"] 	 = 	false;       //definible por usuarios
   //los archivos o directorios que cumplen la e.regular est�n ocultos

   $_conf["no_access"] 		= 	"^\.ht";    //definible por usuarios
   $_conf["permissions"] 	= 	7;			//definible por usuarios
   // subdirectorio dentro de home_dir modificable en tiempo de ejecución
   $_conf["dir"]			= "";
   // campo por el que se ordena el listado modificable en tiempo de ejecuci�n
   $_conf["order"]			= "name";
   //sentido de ordenación yes=up creciente decreciente  modificable en tiempo de ejecución
   $_conf["srt"]			= "yes";





   //se debe cambiar la implementaci�n usando desde el principio $_conf[]

//definidos en  es.php es_mimes.php incluido antes que éste
   $_conf["mensajes"]       = $GLOBALS["messages"];
   $_conf["mensajes_error"] = $GLOBALS["error_msg"];
   $_conf["mimes"]          = $GLOBALS["mimes"];
   $_conf["super_mimes"]	= $GLOBALS["super_mimes"];
   $_conf["used_mime_types"]= $GLOBALS["used_mime_types"];
   $_conf["editable_ext"]   = $GLOBALS["editable_ext"];

   $_conf["charset"]			= $GLOBALS["charset"];
   $_conf["text_dir"] 			= "ltr"; // ('ltr' for left to right, 'rtl' for right to left)
   $_conf["date_fmt"] 			= "Y/m/d H:i";



   Configure::write('GestorArchivos',$_conf);

   unset($_conf);




?>