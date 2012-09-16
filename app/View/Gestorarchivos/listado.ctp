
<?php
   /*
      se emplean elementos para mostrar la parte central de la p�gina
      Observaci�n 1
	  el helper tambi�n usa elementos que definen el contenido, por lo que, se podr�a haber
	  sustituido y haber renderizado directamente aqu� dichos elementos, en lugar de hacerlo indirectamente en
	  el helper. Se hace a modo de ejemplo

	  el helper usa elementos, por esa raz�n necesita un par�metro $this

	   el helper contiene un m�todo show_listado($this);  que renderiza los  elementos
	   elemento_toolbar y elemento_tabla_formulario_archivos
       as�, hubiera sido posible
	   echo  $ga->show_listado($this);

	  Observaci�n 2 el elemento usa, a su vez otro elemento
	  Las variables accesibles en la vista son tambi�n accesibles en el elemento, sin necesidad de que se pasen
	  expresamente en el m�todo renderElement



      */




    echo $this->Ga->header($titulo_barra_navegador,$titulo,$charset,'es',$text_dir,$version);

    echo  $this->Ga->incluir_javascript($this,$allow);
   

   
    //echo $this->Ga->MostrarElementoToolbarGestor($this);
    
   
     //echo $ga->MostrarElementoTablaFormularioArchivosGestor($this);
   
   ?>

   <script language="JavaScript1.2" type="text/javascript">
	<!--
		// Uncheck all items (to avoid problems with new items)
		var ml = document.selform;
		var len = ml.elements.length;
		for(var i=0; i<len; ++i) {
			var e = ml.elements[i];
			if(e.name == "selitems[]" && e.checked == true) {
				e.checked=false;
			}
		}
	// -->
</script>
<?php

  echo $this->Ga->footer($version)
?>
