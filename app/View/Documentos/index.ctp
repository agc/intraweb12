<?php
$this->extend('/Comun/layoutdocumentos');
$this->start('menuprincipal');

   $def_variables=array("aplicacion"=>WWW_ROOT,"definicionmenu"=>$definicionmenu);
   echo $this->element('Documentos/elementodefinicionmenudinamico',$def_variables);

$this->end();

$this->start('sliders');
   echo $this->element("Documentos/elementosliders",null);
$this->end();

      $this->Html->script('intraweb/milonic_src',array('block'=>'scriptarriba'));
	  $this->Html->script('intraweb/mmenudom.js',array('block'=>'scriptarriba'));

      $this->Html->script('intraweb/prototype',array('inline'=>false));
      $this->Html->script('intraweb/scriptaculous',array('inline'=>false));
	  $this->Html->script('intraweb/apple_core',array('inline'=>false));
	  $this->Html->script('intraweb/browserdetect',array('inline'=>false));
	  $this->Html->script('intraweb/event_mixins',array('inline'=>false));
	  $this->Html->script('intraweb/drawers',array('inline'=>false));
	  $this->Html->script('intraweb/codigosliders',array('inline'=>false));

	  $this->Html->css('intraweb/base',false,array('inline'=>false));
      $this->Html->css('intraweb/nav',false,array('inline'=>false));
      $this->Html->css('intraweb/mac',false,array('inline'=>false));
      $this->Html->css('intraweb/hojaprincipal',false,array('inline'=>false));

?>


				<div class="column">

					<div id="videos" class="box">
						<h2>Sin columna</h2>
						<div align="center">
						<p></p>
                        <img src="<?php echo Helper::url('/').'img/intraweb/edificio-insti-mosaico-optima.jpg' ?>" width="550px">
                        <p>
						</FORM>
                            <form>
                                <input type="SUBMIT" value=" Aver&iacute;as inform&aacute;ticas "
                                       onclick="window.open('http://localhost:8080/servicios')"
                                        onMouseOver="this.style.cursor='hand';"
                                         >

                                        </form>
                        </p>

                        </div>
						<div class="boxcap"></div>
					</div>
				</div>

<?php

			echo '<td width="190" bgcolor="#dee7ec">'.$columnalateral."</td>";


?>