<?php
$this->extend('/Comun/layoutdocumentos_nuevo');

$this->start('menuprincipal');

    $nombreaplicacion=Configure::read("AplicacionWeb.nombre");
    echo $this->element('Documentos/elementoMenu',array("nombreaplicacion"=>$nombreaplicacion));

$this->end();



$this->start('sliders');

   echo $this->element("Documentos/elementosliders",null);


$this->end();


      $this->Html->script('intraweb2/jquery-1.8.1-min',array('inline'=>false));
      $this->Html->script('intraweb2/jquery-ui',array('inline'=>false));

      $this->Html->script('intraweb2/jquery.hoveraccordion',array('inline'=>false));

      $this->Html->css('intraweb/base',false,array('inline'=>false));
      $this->Html->css('intraweb/trescolumnas',false,array('inline'=>false));
      $this->Html->css('intraweb/hoveraccordion',false,array('inline'=>false));
      $this->Html->css('Menu/menu',false,array('inline'=>false));





?>


           <div style="margin-top:0px;" >
           <h2 id="cabeceracentral">&nbsp;</h2>
          <img src="<?php echo Helper::url('/').'img/intraweb/edificio-insti-mosaico-optima.jpg' ?>" width="500px">

           <p>&nbsp;</p>
           <div align="center">
             <form>
                 <input type="SUBMIT" 
                        value=" Aver&iacute;as inform&aacute;ticas "
                        onclick="window.open('http://localhost:8080/servicios')"
                        onMouseOver="this.style.cursor='hand';" >

            </form>
        </div>
        </div>





