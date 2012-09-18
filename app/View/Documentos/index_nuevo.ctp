<?php
$this->extend('/Comun/layoutdocumentos_nuevo');
$this->start('menuprincipal');

    echo $this->element('Documentos/elementojMenu');

$this->end();

$this->start('sliders');
    echo "<div>dddddfdfdf</div>";
   //echo $this->element("Documentos/elementosliders",null);

$this->end();

      $this->Html->script('jquery-1.8.1-min',array('inline'=>false));
      $this->Html->script('jMenu/jquery-ui',array('inline'=>false));

      $this->Html->script('jMenu/jMenu.jquery',array('inline'=>false));



      $this->Html->css('jMenu/jMenu.jquery',false,array('inline'=>false));

	  //$this->Html->css('intraweb/base',false,array('inline'=>false));
      //$this->Html->css('intraweb/nav',false,array('inline'=>false));
      //$this->Html->css('intraweb/mac',false,array('inline'=>false));
      //$this->Html->css('intraweb/hojaprincipal',false,array('inline'=>false));

?>
<script type="text/javascript">
$(document).ready(function(){
// simple jMenu plugin called
    $("#jMenu").jMenu(

    {
    ulWidth : 'auto',
    effects : {
    effectSpeedOpen : 300,
    effectTypeClose : 'slide'
    },
    animatedText : false
    }
    );

});
</script>

           <div style="margin-top:30px;" >
           <?php //echo $this->element('Documentos/elementojMenu');?>
          <img src="<?php echo Helper::url('/').'img/intraweb/edificio-insti-mosaico-optima.jpg' ?>" width="550px">

           <p>&nbsp;</p>
           <div align="center">
             <form>
                 <input type="SUBMIT" value=" Aver&iacute;as inform&aacute;ticas "
                                       onclick="window.open('http://localhost:8080/servicios')"
                                        onMouseOver="this.style.cursor='hand';" >

            </form>
        </div>
        </div>





