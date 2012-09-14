<?php echo "<div id='main'>
      <h1>Intraweb I.E.S. Navarro Villoslada.</h1>
      <b>Error.</b> No es posible encontrar la página solicitada.</div>"; ?>
 <?php $paginas=Configure::read('paginas');
  print_r( Configure::read('paginas'));
  echo("<br>");
  echo $paginas['pagina'][1]['@plantilla'];
  ?>