<html >
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

	<?php
          echo $this->fetch('script');
          echo $this->fetch('css');
     ?>

<style type="text/css" media="screen, print, projection">
html,
body {
	margin:0;
	padding:0;
	color:#000;
	background:#fff;
}
#body {
    width:1000px;
    margin:0 auto;
    //background:#ddd;
}

#header {
    padding:20px;
    //background:#fdd;
}
#content-1 {
    float:left;
    width:120px;
    padding:50px;
   // background:#bfb;
}

#content-2 {
    float:right;
    width:720px;
}
#content-2-1 {
    float:left;
    width:400px;
    padding:5px;
    margin-left:-70px;
   //  background:#ddf;
}
#content-2-2 {
    float:right;
    width:200px;
    padding:10px;
    //background:#dff;
}
#footer {
    clear:both;
    padding:10px;
    background:#ff9;
}







#content-2 {
    float:right;
    width:720px;
}



</style>

<title>
<?php echo $title_for_layout?>
</title>
</head>
<body>

<div id="body">
    <div id="header"><?php echo $this->fetch('menuprincipal'); ?></div>
    <div id="main">
        <div id="content-1"><?php echo $this->fetch('sliders'); ?></div>
        <div id="content-2">
            <div id="content-2-1"><?php echo $this->fetch('content');?></div>
            <div id="content-2-2"><?php echo $columnalateral; ?> </div>
        </div>
    </div>
    <div id="footer"><?php echo $this->Pie->mostrar(); ?></div>
</div>



</body>
</html>

