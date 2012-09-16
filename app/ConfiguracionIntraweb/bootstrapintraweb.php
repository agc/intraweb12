<?php

/* Lectura de un archivo de configuración, en formato ini
Primero debe cargar el paquete
Definimos un reader, archivosini, que buscara los archivos en la  ruta especificada
Leemos el archivo de configuracion
*/

/* el api obliga a que contenga una variable config */

/*  No se puede usar el nombre XmlReader porque colisiona
     con otra clase existente
    el nombre del archivo no puede terminar en xml
*/

define ("DB_LOG","SI"); //el valor es indiferente, lo importante es que esté definido


Configure::write("db_log","no");



$config = array();

$config["Directorios"]=array(
        "configuracion"	=>APP.'ConfiguracionIntraweb',
        "avisos"	   =>"/Users/agc/Sites/Intraweb/intraweb-archivos/avisos",
        "configuraciongestorarchivos"=>APP.'ConfiguracionIntraweb'.DS."gestor_archivos",
        "descargaarchivos"				=>"/Users/agc/Sites/Intraweb/intraweb-archivos/documentos/"
    );

$config["Archivos"]=array(
    "aliasgestorarchivos"=>APP.'ConfiguracionIntraweb'.DS."gestor_archivos".DS."/"."aliasdirectorios.xml");

$dirconf = Configure::read("DirectorioConfiguracion");


App::uses('IniReader', 'Configure');
App::uses('XmlLector', 'Configure');

Configure::config('archivosini', new IniReader($dirconf));
Configure::config('archivosxml', new XmlLector($dirconf));

Configure::load('general.ini', 'archivosini');
Configure::load('prueba', 'archivosxml');

// Debug
//print_r($config);
//print_r( test("db_log","si")? "Definida" : "No definida" );