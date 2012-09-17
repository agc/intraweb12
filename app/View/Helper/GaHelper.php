<?php
//Gestor Archivos helper GA
//este helper usa muchos elementos, dado que
//es mas sencillo incluir html en un elemento.
// Se puede incluir html plano
// sin necesidad de asignarlo a una variable $out,
//lo que obliga a ir linea a linea, así como cambiar el tipo de comillas

class GaHelper extends AppHelper
{
//Helper usado en la construcción de las páginas del gestor de archivos


    function header($titulo_barra_navegador,$title,$charset,$lenguaje,$text_dir,$version)
    {
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-Type: text/html; charset=".$charset);
        $out= "<HTML lang='$lenguaje' dir='$text_dir'>\n";
        $out.= "<HEAD>\n<meta http-equiv='Content-Type' content='text/html; charset=".$charset."'>\n";
        $out.=  "<title>$titulo_barra_navegador</title>\n";
        $out.= "<LINK href='".$this->webroot."css/gestor_archivos/style.css' rel='stylesheet' type='text/css'>\n";
        $out.= "</HEAD>\n<BODY><center>\n<table border='0' width='100%' cellspacing='0' cellpadding='5'><tbody>\n";
        $out.= "<tr><td class='title'>";
        //falta información sobre el usuario cuando se requiere login
        $out.="$title</td></tr></tbody></table>\n\n";
        return $out; //$this->output($out);
    }

    function show_error($error,$error_back,$extra=NULL) {
        //show_header($GLOBALS["error_msg"]["error"]);

        $out= "<CENTER><BR>$error:<BR><BR>\n";
        $out.="\n<BR><BR><A HREF='javascript:window.history.back()'> $error_back </A>";
        if($extra!=NULL) $out.= " - ".$extra;
        $out.= "<BR><BR></CENTER>\n";
        return $out;
        //show_footer();
        //exit;
    }
    function incluir_javascript($view,$allow) {
       return $view->element('Gestorarchivos/javascript',array("allow"=>$allow));

    }

    function show_listado($view) {
        $out=$view->element('elemento_toolbar');
        $out.=$view->element('elemento_tabla_formulario_archivos');
        return $out;
    }



    /*
    * aunque el elemento se renderice en un Helper no es necesario pasarle un array
    * con las variables que se usan en el elemento, siempre que esas variables se
    * hayan transferido en el controller mediante set
    * Se incluyen estos elementos en el helper para a�adir un nivel intermedio
    * que pueda contener, eventualmente, l�gica aplicable a la presentaci�n
    */

    /*
    * variables usadas
    * pagina_principal,img_dir,enlace1,..,enlace6
    */
    function MostrarElementoToolbarGestor($view){
        $out= $view->element('Gestorarchivos/elementotoolbargestor');
        return $out;
    }

    /*
      *
      *
      * informacion que usa mensajes, order, srt,num_items,espacio_total,espacio_libre, enlace1b.....enlace5b
       dentro del elemento se vuelve a renderizar otro
    */


    function MostrarElementoTablaFormularioArchivosGestor($view){
        $out= $view->element('gestorarchivos/elementotablaformularioarchivosgestor');
        return $out;
    }

    function footer($version) {
        $out="\n<HR><SMALL><A class='title' href='http://www.iesnavarrovilloslada.com' target='_blank'>";
        $out.="Página Web del Instituto </A> - ";
        $out.= "<A href='/aplicaciones/documentos/ver' target='_blank'>Intraweb</A></SMALL>";
        $out.="</center></BODY>\n</HTML>";
        return $out;
    }
}?>