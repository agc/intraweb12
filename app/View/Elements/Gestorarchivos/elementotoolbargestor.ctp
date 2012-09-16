<?php
// Toolbar
// función make_link definida en vendors/funciones_extra.php
?>
	<BR><TABLE width="95%"><TR>
	<TD><TABLE>
	<TR>
	<TD><A HREF="<?php echo $pagina_a_volver?>">Volver</A></TD>
    <TD>::</TD>
	<TD>::</TD>
	<TD>::</TD>
	<!-- Directorio padre -->
	<TD><A HREF="<?php echo $enlace1?>">
	Directorio anterior <IMG border="0" width="18" height="18" align="ABSMIDDLE" src="<?php echo $img_dir ?>/_up.gif"
	ALT="<?php echo $mensajes['uplink'] ?>" TITLE="<?php echo $mensajes['uplink']?>">
	</A>
	</TD>

	<!-- home -->
	<TD>
	<A HREF="<?php echo $enlace2?>">
	Directorio superior <IMG border="0" width="18" height="18" align="ABSMIDDLE" src="<?php echo $img_dir ?>/_home.gif"
	ALT="<?php echo $mensajes['homelink'] ?>" TITLE="<?php echo $mensajes['homelink']?>">
	</A>
	</TD>
	<!-- reload -->
	<TD>
	<A HREF="javascript:location.reload();">
	Recargar <IMG border="0" width="18" height="18" align="ABSMIDDLE" src="<?php echo $img_dir ?>/_refresh.gif"
	ALT="<?php echo $mensajes['reloadlink'] ?>" TITLE="<?php echo $mensajes['reloadlink']?>">
	</A>
	</TD>
	<!-- search
	<TD>
	<A HREF="<?php echo $enlace3?>">
	<IMG border="0" width="16" height="16" align="ABSMIDDLE" src="<?php echo $img_dir ?>/_search.gif"
	ALT="<?php echo $mensajes['searchlink'] ?>" TITLE="<?php echo $mensajes['searchlink']?>">
	</A>
	</TD>  -->

	<TD>::</TD>
	
   <?php	if ($allow) { ?>
	<TD>
	<A HREF="javascript:Copy();">
	<IMG border="0" width="16" height="16" align="ABSMIDDLE" src="<?php echo $img_dir ?>/_copy.gif"
	ALT="<?php echo $mensajes['reloadlink'] ?>" TITLE="<?php echo $mensajes['copylink']?>">
	</A>
	</TD>
	<TD>
	<A HREF="javascript:Move();">
	<IMG border="0" width="16" height="16" align="ABSMIDDLE" src="<?php echo $img_dir ?>/_move.gif"
	ALT="<?php echo $mensajes['reloadlink'] ?>" TITLE="<?php echo $mensajes['movelink']?>">
	</A>
	</TD>
	<TD>
	<A HREF="javascript:Delete();">
	<IMG border="0" width="16" height="16" align="ABSMIDDLE" src="<?php echo $img_dir ?>/_delete.gif"
	ALT="<?php echo $mensajes['reloadlink'] ?>" TITLE="<?php echo $mensajes['dellink']?>">
	</A>
	</TD>

	<?php } ?>

	<?php if($require_login) { ?>
		<TD>::</TD>
		<!-- ADMIN -->
	<?php	if($admin) { ?>
	        <TD>
			<A HREF="<?php echo $enlace4?>">
			<IMG border="0" width="16" height="16" align="ABSMIDDLE" src="<?php echo $img_dir ?>/_admin.gif"
			ALT="<?php echo $mensajes['adminlink'] ?>" TITLE="<?php echo $mensajes['adminlink']?>">
			</A>
			</TD>

	<?php	} ?>
	    <!-- Logout -->
	    <TD>
			<A HREF="<?php echo $enlace5?>">
			<IMG border="0" width="16" height="16" align="ABSMIDDLE" src="<?php echo $img_dir ?>/_logout.gif"
			ALT="<?php echo $mensajes['logoutlink'] ?>" TITLE="<?php echo $mensajes['logoutlink']?>">
			</A>
		</TD>


<?php	} ?>


	</TR></TABLE></td>

	<?php if($allow) { ?>
		<TD align="right">
		<TABLE>
		<FORM action="<?php echo $enlace6 ?>"  method="post">
		<TR><TD>
		<SELECT name="mktype">
		<option value="file"><?php echo $mimes['file'] ?></option>
		<option value="dir"><?php echo $mimes['dir'] ?></option>
		</SELECT>
		<INPUT name="mkname" type="text" size="15">
		<INPUT type="submit" value="<?php echo $mensajes['btncreate'] ?>" >
		</TD></TR>
		</FORM>
		</TABLE>
		</TD>
	<?php } ?>

	</TR>
	</TABLE>