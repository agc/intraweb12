<?php


/* si se ha establecido que el campo de ordenacion es $valor
   se mostrará una flecha en la cabecera
*/

function mostrarFlecha(&$campo_orden,$valor,$html_imagen) {
	if ($campo_orden==$valor) return $html_imagen;
	else return "";
}


$_img = "&nbsp;<IMG width=\"10\" height=\"10\" border=\"0\" align=\"ABSMIDDLE\" src=\"$img_dir/";
if($srt=="yes") {
		
		$_img .= "_arrowup.gif\" ALT=\"^\">";
	} else {
	
		$_img .= "_arrowdown.gif\" ALT=\"v\">";
	}
?>


<TABLE WIDTH="95%">
<FORM name="selform" method="POST" action="<?php echo $enlace1b ?>" >
	<INPUT type="hidden" name="do_action">
	<INPUT type="hidden" name="first" value="y">

	<!-- Cabeceras de la tabla -->
	<TR><TD colspan="7"><HR></TD></TR> <!-- linea horizontal -->
	<!--linea de rótulos -->
	<TR>

	<TD WIDTH="14%" class="header">
	<B><?php echo $mensajes['actionheader'] ?></B>
	</TD>
	<!-- Eliminado del original checkboxes -->

   <TD WIDTH="44%" class="header">
    <B>
	<A href="<?php echo $enlace2b ?>"><?php echo $mensajes['nameheader'] ?><?php echo mostrarFlecha($order,"name",$_img) ?></A>
	</B>
   </TD>
	<TD WIDTH="10%" class="header">
	<B>
	<A href="<?php echo $enlace3b ?>"><?php echo $mensajes['sizeheader'] ?><?php echo mostrarFlecha($order,"size",$_img) ?></A>
	</B>
	</TD>
	<TD WIDTH="16%" class="header">
	<B>
	<A href="<?php echo $enlace4b ?>"><?php echo $mensajes['typeheader'] ?><?php echo mostrarFlecha($order,"type",$_img) ?></A>
	</B>
	</TD>

	<TD WIDTH="14%" class="header">
	<B>
	<A href="<?php echo $enlace5b ?>"><?php echo $mensajes['modifheader'] ?><?php echo mostrarFlecha($order,"mod",$_img) ?></A>
	</B>
	</TD>


	<!-- cabecera permisos, no enlace -->
	<!-- ELIMINADO DEL ORIGINAL permisos -->
	<!-- CAMBIADO DEL ORIGINAL acciones al principio -->

	</TR>
	<TR><TD colspan="7"><HR></TD></TR> <!--  otra linea horizontal -->

	<?php

	echo $this->renderElement('gestorarchivos/elementotablaarchivosgestor');

	?>

	<!-- muestra número de items y tamaño total archivos -->

	<TR>
	<TD colspan="7"><HR></TD></TR><TR> <!--  otra linea horizontal -->

	<TD class="header"></TD>
	<TD class="header">
	<?php echo "$num_items ". $mensajes['miscitems']." (".$mensajes['miscfree']." : $espacio_libre )" ?></TD>
	<TD class="header"><?php echo $espacio_total?></TD>
	<TD class="header"></TD>
	<TD class="header"></TD>
	<TD class="header"></TD>
	<TD class="header"></TD>
	</TR>
	<TR><TD colspan="7"><HR></TD></TR><!--  otra linea horizontal -->
	</FORM>
	</TABLE>
