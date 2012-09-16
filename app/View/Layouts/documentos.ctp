<html >
	<head>

	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	
	<?php

	  echo $this->Html->script('intraweb/milonic_src');
	  echo  $this->Html->script('intraweb/mmenudom.js');


      $def_variables=array("aplicacion"=>WWW_ROOT,"definicionmenu"=>$definicionmenu);

      echo $this->element('Documentos/elementodefinicionmenudinamico',$def_variables);

	 echo  $this->Html->script('intraweb/prototype');
	 echo  $this->Html->script('intraweb/scriptaculous');
	 echo  $this->Html->script('intraweb/apple_core');
	 echo  $this->Html->script('intraweb/browserdetect');
	 echo  $this->Html->script('intraweb/event_mixins');
	 echo  $this->Html->script('intraweb/drawers');

	?>
	
	
    		
	
	<script type="text/javascript">
		defaultId = 'a';
	</script>

	<script type="text/javascript" charset="utf-8">
	
		/* SLIDERS */
		var latestSliders = null;
		Event.observe(window, 'load', function() {
			var container = $('latest');
			latestSliders = new AC.SlidingBureau(container);
			var drawers = $$("#latest .drawers>li");
			for (var i = 0; i < drawers.length; i++) {
				var handle = drawers[i].getElementsByClassName('drawer-handle')[0];
				var content = drawers[i].getElementsByClassName('drawer-content')[0];
				var drawer = new AC.SlidingDrawer(content, handle, latestSliders, {
					triggerEvent: 'mouseover', triggerDelay: 120});
				latestSliders.addDrawer(drawer);
			}
			var freeDrawers = function(container) {
				return function() {
					if (!AC.Detector.isIEStrict()) {
						container.setStyle({height: 'auto'});
					}
				}
			}
			setTimeout(freeDrawers(container), 1000);
		});
		
	</script>

	<?php
	  echo $this->Html->css('intraweb/base');
	 //echo $html->css('intraweb/nav');
	 echo $this->Html->css('intraweb/mac');
	 echo $this->Html->css('intraweb/hojaprincipal');
	 ?>
	
	 
    <title>
	<?php echo $title_for_layout?>
	</title>

	</head>
	<body>

	<p>&nbsp;</p>
	
   
	<div id="container">

		<div id="main">		
			<div id="content" class="grid3cola">
			
			<?php
			echo $this->element("Documentos/elementosliders",null);

			  if ($eliminarcolumna=="si"){?>
			     <p><?php echo $content_for_layout ?></p>
			 <?php  }
			   else { 
			   ?>
				<div class="column">
					
					<div id="videos" class="box">
						<h2>Sin columna</h2>
						<p><?php echo $content_for_layout ?></p>
						<div class="boxcap"></div>
					</div>
				</div>
				
				<?php }?>
			
		
		
				 
		<?php 
		if (isset($columnalateral)) {
			echo '<td width="190" bgcolor="#dee7ec">'.$columnalateral."</td>";
		}
		?>	
		
		
		
                               
</div>
</div>
	</div>
	
	
		
	
	<?php echo $this->Pie->mostrar() ?>

	</body>
	</html>