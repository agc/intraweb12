<script language="JavaScript">
// Definición del menu principal. Es un archivo php que genera un archivo javascript


_menuCloseDelay=500           // The time delay for menus to remain visible on mouse out
_menuOpenDelay=150            // The time delay before menus open on mouse over
_subOffsetTop=45              // Sub menu top offset
_subOffsetLeft=50           // Sub menu left offset

 

with(menuStyle=new mm_style()){
onbgcolor="#4F8EB6";
oncolor="#ffffff";
offbgcolor="#DCE9F0";
offcolor="#515151";
bordercolor="#296488";
borderstyle="solid";
borderwidth=1;
separatorcolor="#2D729D";
separatorsize="1";
padding=5;
fontsize="95%";
fontstyle="normal";
fontfamily="Verdana, Tahoma, Arial";
pagecolor="black";
pagebgcolor="#82B6D7";
headercolor="#000000";
headerbgcolor="#ffffff";
subimage="/intraweb12/img/intraweb/arrow.gif";
subimagepadding="2";
overfilter="Fade(duration=0.2);Alpha(opacity=90);Shadow(color='#777777', Direction=135, Strength=5)";
outfilter="randomdissolve(duration=0.3)";

}

// 0

with(milonic=new menuname("Main Menu")){
style=menuStyle;
top=10;
left=2;
alwaysvisible=1;
orientation="horizontal";

aI("text=Intraweb;showmenu=principal;");
aI("text=El Centro;showmenu=elcentro;");
aI("text=Instrucciones;showmenu=instrucciones;");
aI("text=Impresos y Modelos;showmenu=impresosymodelos;");
aI("text=Resultados e Informaciones;showmenu=informacion;");
}
//  dos modos     principal/ver/<nombre>  /<nombre aplicacion>/ver/<nombrepagina>
//                        gestorarchivos/ver/<nombre>  /nombre_aplicacion/<gestorarchivos>/ver/<nombrepropio>
<?php
 $menu=explode("\n",$definicionmenu);

while($item=array_shift($menu)){
   $item=trim($item);
   if ($item[0]=="#"):
    continue;
   endif;

   if (substr($item,0,5)=="BEGIN"){
      //$definicion=trim(array_shift($menu));
      $linea=explode(" ",$item);
      $definicion=trim($linea[1]);
      echo 'with(milonic=new menuname("',$definicion,'")){ style=menuStyle; ';
     }
     elseif (substr($item,0,3)=="END"){
     echo "} ";
     }
     elseif (strpos($item,"|")!=false){
     $linea=explode("|",$item);
      $texto=$linea[0];
      $definicion=trim($linea[1]); 
      echo 'aI("text=',$texto,';url=',$definicion,';");';
      }
       elseif(strpos($item,"*")!=false){
      $linea=explode("*",$item);
      $texto=$linea[0];
      $definicion=trim($linea[1]); 
       echo 'aI("text=',$texto,';showmenu=',$definicion,';");';
       }
     }
?>
drawMenus();

</script>