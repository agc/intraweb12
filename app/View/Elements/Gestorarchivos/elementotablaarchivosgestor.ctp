<?php




if(is_array($info_items)) {


foreach($info_items as $info_item) 
{

   
    
	$es_archivo		= $info_item['es_archivo'];
	$allow		    = $info_item['allow'];
	$link		    = $info_item['link'];
	$img_mime_type  = $info_item['img_mime_type'];
	//$s_item		= utf8_decode( $info_item['s_item']);//lo he añadido para evitar el problema de los carácteres españoles
	$s_item			= $info_item['s_item'];
	$tamano			= $info_item['tamano'];
	$tipo			= $info_item['tipo'];
	$tipo_mime			= $info_item['tipo_mime'];
	$fecha_archivo	= $info_item['fecha_archivo'];
	
	//no usados
	$link_permisos=$info_item['link_permisos'];
	$link_editar  =$info_item['link_editar'];
	$link_download=$info_item['link_download'];
	$es_editable  =$info_item['es_editable'];
?>

	 <TR class="rowdata">

       <TD>

		<!-- EDIT -->

            <TABLE>
		<!-- DOWNLOAD -->
	<?php	if($es_archivo) {
			if($allow) { ?>
				<TD>
				<A HREF="<?php echo $link ?>" >
				<IMG border="0" width="16" height="16" align="ABSMIDDLE"
				src='<?php echo"$img_dir/_download.gif"?>'  ALT="<?php echo $mensajes["downlink"]?>" TITLE="<?php echo $mensajes["downlink"]?>" >
				</A>
				</TD>
		<?php	} else if(!$allow) { ?>
				<TD>
				<IMG border="0" width="16" height="16" align="ABSMIDDLE"
				src='<?php echo"$img_dir/_download.gif"?>' ALT="<?php echo $mensajes["downlink"]?>" TITLE="<?php echo $mensajes["downlink"]?>" >
				</TD>
		<?php	}
		} else { ?>
			<TD>
			<IMG border="0" width="16" height="16" align="ABSMIDDLE\" src='<?php echo"$img_dir/_.gif"?>' ALT="">
			</TD>
		<?php } ?>
                <TD>
        </TABLE>

		</TD>

       <!-- Icon + Link -->
		<TD nowrap>
			<A HREF="<?php echo $link ?>">
			<IMG border="0" width="16" height="16"  align="ABSMIDDLE" src="<?php echo"$img_dir/".$img_mime_type?>" ALT="Hacer click para abrir/descargar">
			<?php echo htmlspecialchars($s_item,ENT_COMPAT,'ISO-8859-1') ?>
		</A>
		</TD>
	<!--  Size  -->
		<TD>
			<?php echo $tamano ?>
		</TD>
	<!--  Type  -->
		<TD>
			<?php echo $tipo_mime ?>
		</TD>
	<!--  Modified  -->
		<TD><?php echo $fecha_archivo ?></TD>

    </TR>
<?php } }?>