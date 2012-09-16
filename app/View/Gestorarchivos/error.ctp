
<?php
   echo $this->Ga->header("Página de error",$titulo,$charset,'es',$text_dir,$version);
   echo $this->Ga->show_error($error,$error_back);
   echo $this->Ga->footer($version);
?>