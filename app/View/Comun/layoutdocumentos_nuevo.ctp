<html >
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

	<?php
          echo $this->fetch('script');
          echo $this->fetch('css');
     ?>



<title>
<?php echo $title_for_layout?>
</title>

<script type="text/javascript">


$(document).ready(function(){

   $('#example2').hoverAccordion({
                   keepHeight:true,
                   activateItem: 1,
                   speed: 400
               });
    $('#example2').children('li:first').addClass('firstitem');
    $('#example2').children('li:last').addClass('lastitem');
});
</script>

</head>
<body>

<div id="body">
    <div id="header"><?php echo $this->fetch('menuprincipal'); ?></div>
    <div id="main">
        <div id="content-1"><?php echo $this->fetch('sliders'); ?></div>
        <div id="content-2" >
            <div id="content-2-1" style="border-style:solid; border-width:1px;"><?php echo $this->fetch('content');?></div>
            <div id="content-2-2" style="border-style:solid; border-width:1px;"><?php echo $columnalateral; ?> </div>
        </div>
    </div>
    <div id="footer"><?php echo $this->Pie->mostrar(); ?></div>
</div>



</body>
</html>

