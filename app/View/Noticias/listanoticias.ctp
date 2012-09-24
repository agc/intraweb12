
<span style="padding-left:50px">
<?php echo $this->Html->image('intraweb/anagramaazul.jpg', array('alt'=>"I.E.S Navarro Villoslada","width"=>"80px"));?>
</span>
<?php $altura=150*count($noticias); ?>
<div class="column last sidebar">
		<div id="whymac" class="box" style="height:<?php echo $altura?>px;width:180px">
		 <h2 id="cabeceranoticias">&nbsp;</h2><!-- no borrar -->
<?php  


foreach($noticias as $noticia) {
echo $this->element('Noticias/elementocajanoticia',array("titulocaja" => $noticia->titulo,"textocaja"=>$noticia->texto));
} 
?>				
<div class="boxcap"></div>
</div><!--/whymac-->
				
</div><!--/column.first-->