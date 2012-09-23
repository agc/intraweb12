<html >
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><?php
          echo $this->fetch('scriptarriba');
          echo $this->fetch('menuprincipal');
          echo $this->fetch('script');
          echo $this->fetch('css');
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
		         echo $this->fetch('sliders');
			 echo $this->fetch('content');
			 ?>
		</div>
       </div>
   </div>

	<?php echo $this->Pie->mostrar() ?>
</body>
</html>