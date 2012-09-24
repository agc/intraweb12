_menuCloseDelay=500           // The time delay for menus to remain visible on mouse out
_menuOpenDelay=150            // The time delay before menus open on mouse over
_subOffsetTop=25              // Sub menu top offset
_subOffsetLeft=-15            // Sub menu left offset



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
subimage="/intraweb3/img/arrow.gif";
subimagepadding="2";
overfilter="Fade(duration=0.2);Alpha(opacity=90);Shadow(color='#777777', Direction=135, Strength=5)";
outfilter="randomdissolve(duration=0.3)";
}

//*************************** Nivel cero ********************************************

with(milonic=new menuname("Main Menu")){
style=menuStyle;
top=105;
left=17;
alwaysvisible=1;
orientation="horizontal";
/*aI("text=Principal;url=paginas.php;status=Regresar a la p�gina principal;");*/
aI("text=Intraweb;showmenu=principal;");
aI("text=El Centro;showmenu=elcentro;");
aI("text=Informaci�n;showmenu=informacion;");
aI("text=Instrucciones;showmenu=instrucciones;");
aI("text=Impresos y Modelos;showmenu=impresosymodelos;");
aI("text=Sistema de Gesti�n;showmenu=sistemagestion;");
}
//  dos modos     principal/ver/<nombre> � /<nombre aplicacion>/ver/<nombrepagina>
//                        gestorarchivos/ver/<nombre> �  /nombre_aplicacion/<gestorarchivos>/ver/<nombrepropio>


// ****************** Primer Nivel *****************************************
with(milonic=new menuname("principal")){
style=menuStyle;
overflow="scroll";
aI("text=P�gina Principal;url=/intraweb3/principal/;status=Regresar a la p�gina principal;");
aI("text=Explorador de archivos;url=../explorador/;status=Ir al explorador de archivos;");
}

with(milonic=new menuname("elcentro")){
style=menuStyle;
overflow="scroll";
aI("text=Departamentos;showmenu=departamentos;");
aI("text=Equipo Directivo;showmenu=equipodirectivo;");
//aI("text=�rganos de gobierno;showmenu=organosgobierno;");
aI("text=Ense�anza-aprendizaje;showmenu=ensenanzaaprendizaje;");
aI("text=Cuaderno del profesor;url=/intraweb3/principal/ver/cuadernoprofesor;");
//aI("text=Responsable de calidad;showmenu=sistemagestion;");
aI("text=Recursos y servicios;showmenu=recursosservicios;");
aI("text=Normativa y Doc.Oficial;url=/intraweb3/principal/ver/normativadocoficial;");
aI("text=Direcciones de inter�s;url=/intraweb3/principal/servirarchivo/?documento=/direccionesinteres/index.htm;");
}

with(milonic=new menuname("informacion")){
style=menuStyle;
aI("text=Aspectos generales del Centro;showmenu=informacioncentro;"); 
aI("text=Horarios y Calendarios;showmenu=informacionhorarioscalendarios;"); 
aI("text=Planes y criterios;showmenu=planificacion;"); 
aI("text=Profesorado;showmenu=informacionprofesores;"); 
aI("text=Grupos de alumnos;showmenu=cursosgrupos;"); 
aI("text=Claustro, CCP y Consejo Escolar;showmenu=claustroccpconsejo;"); 
aI("text=Resultados;showmenu=resultados;"); 
aI("text=Normativa;showmenu=legislacion;");
}



with(milonic=new menuname("instrucciones")){
style=menuStyle;
aI("text=Instrucciones diversas;showmenu=instruccionesgenerales;");
aI("text=Guardias;showmenu=instruccionesguardias;");
aI("text=Aulas(Desdobles, inform�tica..) y Biblioteca;showmenu=instruccionesaulasybiblioteca;");
aI("text=Reprograf�a;showmenu=instruccionesreprografia;");
}

with(milonic=new menuname("impresosymodelos")){
style=menuStyle;
aI("text=Informes sobre alumnado;showmenu=informesalumnado;");
aI("text=Otros informes sobre Alumnado;showmenu=informesalumnadootros;");
aI("text=Modelos;showmenu=modelos;");
aI("text=Permisos profesorado;showmenu=permisos;");
aI("text=Varios;showmenu=informesvarios;");
aI("text=Documento Sugerencias, quejas y reclamaciones;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=documentosqr;");
}

with(milonic=new menuname("sistemagestion")){
style=menuStyle;
//aI("text=Sistemas de Gesti�n.Diagramas de flujo;url=paginas.php?pagina=sistemasgestion;");
//aI("text=Documentaci�n del Sistema de Gesti�n;url=paginas.php?pagina=documentacionsistemagestion;");
aI("text=Documentaci�n del Sistema de Gesti�n;url=/intraweb3/gestorarchivos/ver/docgestion;");
//aI("text=Informaci�n;url=paginas.php?pagina=informacioncalidad;");
//aI("text=Resultados;url=paginas.php?pagina=resultadoscalidad;");
//aI("text=Resultados Encuesta de Satisfacci�n;url=paginas.php?pagina=resultadosencuestasatisfaccion;");
}

//********************************************** Segundo Nivel ***********************************************************

//  El Centro 

with(milonic=new menuname("departamentos")){
style=menuStyle;
aI("text=Alem�n;url=/intraweb3/gestorarchivos/ver&pagina=progaleman;");
aI("text=Ciencias Naturales;url=/intraweb3/gestorarchivos/ver&pagina=progciencias;");
aI("text=Ciencias Sociales;url=/intraweb3/gestorarchivos/ver/progcienciassociales;");
aI("text=Coordinaci�n de la acci�n tutorial;url=/intraweb3/gestorarchivos/ver/coordinacionacciontutorial;");
aI("text=Dibujo;url=/intraweb3/gestorarchivos/ver/progdibujo;");
aI("text=Econom�a;url=/intraweb3/gestorarchivos/ver/progeconomia;");
aI("text=Educaci�n F�sica;url=/intraweb3/gestorarchivos/ver/progeducacionfisica;");
aI("text=Euskera;url=/intraweb3/gestorarchivos/ver/progeuskera;");
aI("text=Filosof�a;url=/intraweb3/gestorarchivos/ver/progfilosofia;");
aI("text=F�sica y Qu�mica;url=/intraweb3/gestorarchivos/ver/progfisicaquimica;");
aI("text=Franc�s;url=/intraweb3/gestorarchivos/ver/progfrances;");
aI("text=Griego;url=/intraweb3/gestorarchivos/ver/proggriego;");
aI("text=Ingl�s;url=/intraweb3/gestorarchivos/ver/progingles;");
aI("text=Lat�n;url=/intraweb3/gestorarchivos/ver/proglatin;");
aI("text=Lengua;url=/intraweb3/gestorarchivos/ver/proglengua;");
aI("text=Matem�ticas;url=/intraweb3/gestorarchivos/ver/progmatematicas;");
aI("text=M�sica;url=/intraweb3/gestorarchivos/ver/progmusica;");
aI("text=Orientaci�n;url=/intraweb3/gestorarchivos/ver/progorientacion;");
aI("text=Religi�n;url=/intraweb3/gestorarchivos/ver/progreligion;");
aI("text=Tecnolog�a;url=/intraweb3/gestorarchivos/ver/progtecnologia;");
}

with(milonic=new menuname("equipodirectivo")){
style=menuStyle;
aI("text=Direcci�n;url=/intraweb3/principal/ver/direccion;");
aI("text=Direcci�n2;url=/intraweb3/gestorarchivos/ver/direccionpublico;");
aI("text=Jefatura Estudios;url=/intraweb3/principal/ver/jefaturaestudios;");
aI("text=Secretar�a;url=/intraweb3/principal/ver/secretaria;");
aI("text=Vicedirecci�n;url=/intraweb3/principal/ver/vicedireccion;");
}

with(milonic=new menuname("ensenanzaaprendizaje")){
style=menuStyle;
aI("text=Documentos para el profesorado;url=/intraweb3/principal/ver/documentosprofesorado;");
//aI("text=Resultados;url=paginas.php?pagina=resultados;");
aI("text=Especificaciones de los cursos;url=/intraweb3/principal/ver/especificacionescursos;");
}



with(milonic=new menuname("recursosservicios")){
style=menuStyle;
aI("text=Biblioteca;url=/intraweb3/principal/ver/biblioteca;");
aI("text=Actividades extraescolares;url=/intraweb3/principal/ver/actividadesextraescolares;");
aI("text=Teatro;url=/intraweb3/principal/ver/teatro;");
}

// ********
// Informacion

with(milonic=new menuname("informacioncentro")){
style=menuStyle;
aI("text=Proyecto-Misi�n del Centro;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=proyectomisiondelcentro;");
aI("text=Estructura y funcionamiento del Centro ;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=estructurafuncionamientodelcentro;");
aI("text=Oferta educativa ;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=ofertaeducativa;");
aI("text=Plano del Centro;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=planodelcentro;");
aI("text=Horario,gu�a y fondos de biblioteca;url=/intraweb3/principal/ver/biblioteca;");
}

with(milonic=new menuname("informacionhorarioscalendarios")){
style=menuStyle;
aI("text=Calendario escolar;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=calendarioescolar;");
aI("text=Horario general del centro;url=/intraweb3/principal/servirarchivo/?pagina=jefaturaestudios&documento=horariogeneralcentro;");
aI("text=Horario personal del profesorado;url=/intraweb3/principal/servirarchivo/?pagina=jefaturaestudios&documento=horariopersonalprofesorado;");
aI("text=Horario de aulas de desdobles;url=/intraweb3/principal/ver/aulasespeciales;");
aI("text=Horario,gu�a y fondos de biblioteca;url=/intraweb3/principal/ver/biblioteca;");
}



with(milonic=new menuname("planificacion")){
style=menuStyle;
aI("text=Evaluaci�n, proceso y documentos ;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=evaluacionprocesodocumentos;");
aI("text=Plan general de actividades complementarias ;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=planactividadescomplementarias;");
aI("text=Plan de evacuaci�n del centro;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=planevacuacion;");
aI("text=Aulas de desdobles por curso y departamento;url=/intraweb3/principal/servirarchivo/?pagina=jefaturaestudios&documento=desdobleporcursodepartamento;");
aI("text=Criterios para interpretar o definir los indicadores de conformidad de los cursos;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=criteriosindicadoresconformidad;");
}

with(milonic=new menuname("informacionprofesores")){
style=menuStyle;
aI("text=Profesores de los departamentos did�cticos ;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=personaldocente;");

aI("text=Relaci�n de tutores y tutoras ;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=relaciontutores;");
aI("text=Relaci�n de Profesores por grupo y nivel;url=/intraweb3/principal/servirarchivo/?pagina=jefaturaestudios&documento=profesoresgruponivel;");
aI("text=Permisos retribuidos ;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=permisosretribuidos;");
}

with(milonic=new menuname("cursosgrupos")){
style=menuStyle;
aI("text=Listas de cursos;url=/intraweb3/gestorarchivos/ver/grupos;");
aI("text=C�lculo de % clases impartidas;url=/intraweb3/gestorarchivos/ver/grupos;");

}
with(milonic=new menuname("claustroccpconsejo")){
style=menuStyle;
//aI("text=Convocatoria y actas del Claustro;url=paginas.php?pagina=claustro;");
aI("text=Convocatoria y actas del Claustro;url=/intraweb3/gestorarchivos/ver/actasclaustro;");
aI("text=Convocatoria y actas de la CCP;url=/intraweb3/gestorarchivos/ver/actasccp;");
aI("text=Convocatoria y actas del Consejo Escolar;url=/intraweb3/gestorarchivos/ver/actasconsejo;");
//aI("text=Convocatoria y actas de la CCP;url=paginas.php?pagina=ccp;");
//aI("text=Convocatoria y actas del Consejo Escolar;url=paginas.php?pagina=consejoescolar;");
}

with(milonic=new menuname("resultados")){
style=menuStyle;
aI("text=Resultados acad�micos;url=/intraweb3/gestorarchivos/ver/resulacademicos;");
aI("text=Resultados de encuestas;url=/intraweb3/gestorarchivos/ver/resulencuestas;");
aI("text=Resultados de procesos;url=/intraweb3/gestorarchivos/ver/resulprocesos;");
}
with(milonic=new menuname("legislacion")){
style=menuStyle;
aI("text=Normativa y documentaci�n oficial;url=/intraweb3/principal/ver/normativadocoficial;");
}

// Instrucciones

with(milonic=new menuname("instruccionesgenerales")){
style=menuStyle;
aI("text=Instr. para la acogida del personal;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=acogidapersonal;");
aI("text=Instr. y proceso para regular la convivencia;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=normasconvivencia;");
aI("text=Instr. para la utilizaci�n de servicios,espacios y materiales comunes ;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=serviciosespacioscomunes;");
aI("text=Instr. para la Evaluaci�n. Proceso y documentos ;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=evaluacionprocesodocumentos;");
aI("text=Instr. para calibrar el sistema de puntuaci�n del profesorado ;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=calibracion;");
aI("text=Instr. para organizar actividades complementarias extraescolares;url=/intraweb3/principal/servirarchivo/?pagina=vicedireccion&documento=criteriosaces;");
aI("text=Instr. para la evacuaci�n del centro;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=planevacuacion;");
}

with(milonic=new menuname("instruccionesguardias")){
style=menuStyle;

aI("text=Instr. para el servicio de guardia;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=instruccionesguardias;");
aI("text=Servicio de guardia de recreo ;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=planvigilanciarecreo;");
aI("text=Guardia de 1� y 4� hora;url=/intraweb3/principal/servirarchivo/?pagina=jefaturaestudios&documento=guardias1y4hora;");
aI("text=Estudio Asistido;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=estudioasistido;");

}

with(milonic=new menuname("instruccionesaulasybiblioteca")){
style=menuStyle;
aI("text=Estudio Asistido;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=estudioasistido;");
aI("text=Aulas de Desdoble ;url=/intraweb3/principal/servirarchivo/?pagina=jefaturaestudios&documento=auladesdoble;");
aI("text=Aula de Inform�tica;url=/intraweb3/principal/servirarchivo/?pagina=jefaturaestudios&documento=aulainformatica;");
aI("text=Instr. para el uso de la biblioteca;url=/intraweb3/principal/servirarchivo/?pagina=biblioteca&documento=normasbiblioteca;");
}

with(milonic=new menuname("instruccionesreprografia")){
style=menuStyle;
aI("text=Instr. para el profesorado sobre el servicio de reprograf�a;url=/intraweb3/principal/servirarchivo/?pagina=secretaria&documento=instruccionesreprografia;");
aI("text=Instr. para la impresi�n y copia de documentos ;url=/intraweb3/principal/servirarchivo/?pagina=secretaria&documento=instruccionesfotocopiadora;");
}

with(milonic=new menuname("informesalumnado")){
style=menuStyle;
aI("text=Informe individual 1�/2� Eval.;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=informeindividual;");
aI("text=Informe individual agrup. espec�fico.;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=informeindividualagrupamiento;");
aI("text=Encuesta satisfacci�n del alumnado.;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=encuestasatisfaccionalumnado;");
aI("text=Areas/materias no superadas final de cursos;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=areasnosuperadas;");
aI("text=Consejo orientador 4� ESO;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=consejoorientador;");
aI("text=Actas de evaluaci�n por grupo;showmenu=actasevaluacion;");
}

with(milonic=new menuname("informesalumnadootros")){
style=menuStyle;
aI("text=Atenci�n de las clases profesorado ausente;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=fichaguardias;");
aI("text=Informe individual para el tutor;url=/intraweb3/principal/servirarchivo/?pagina=varios&documento=informeparaeltutor;");
aI("text=Comunicado de falta de disciplina;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=normasconvivencia;");
}

with(milonic=new menuname("modelos")){
style=menuStyle;
aI("text=Seguimiento Program. Did�cticas;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=seguimientoprogramaciones;");
aI("text=Seguimiento Plan Departamental;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=seguimientoplandepartamental;");
aI("text=Examen;url=/intraweb3/principal/servirarchivo/?pagina=varios&documento=modeloexamen;");
aI("text=Acta(reuniones);url=/intraweb3/principal/servirarchivo/?pagina=varios&documento=modeloacta;");
aI("text=Orden del d�a(reuniones);url=/intraweb3/principal/servirarchivo/?pagina=varios&documento=modeloordendia;");
aI("text=Memoria final;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=memoriafinal;");

}

with(milonic=new menuname("permisos")){
style=menuStyle;
aI("text=Solicitud;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=solicitudpermiso;");
aI("text=Justificaci�n de la ausencia;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=justificacionausencia;");
aI("text=Atenci�n de las clases profesorado ausente;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=fichaguardias;");
}

with(milonic=new menuname("informesvarios")){
style=menuStyle;
aI("text=Hoja de pedido (m�s de 150 euros);url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=pedidomasde150;");
aI("text=Plantilla para elaborar el inventario;url=/intraweb3/principal/servirarchivo/?pagina=/secretaria&documento=/FICHA recogida de DATOS PARA EL INVENTARIO.doc;");
aI("text=Solicitud uso de instalaciones;url=/intraweb3/principal/servirarchivo/?pagina=calidad&documento=solicitudusoinstalaciones;");
aI("text=Propuesta de actividades complementarias;url=/intraweb3/principal/servirarchivo/?pagina=cuadernodelprofesor&documento=/CP14_Extraescolares.doc;");
aI("text=Impreso materias selectividad;url=/intraweb3/principal/servirarchivo/?pagina=jefaturaestudios&documento=/Selectividad.doc;");

}

// *** tercer nivel
with(milonic=new menuname("actasevaluacion")){
style=menuStyle;
aI("text=Instrucciones 1;url=/intraweb3/principal/ver/aaa;");
}




// est� deshabilitado

with(milonic=new menuname("enlaces")){
style=menuStyle;
aI("text=Enlaces 1;url=paginas.php?pagina=;");
}


// est� deshabiltado
with(milonic=new menuname("organosgobierno")){
style=menuStyle;
aI("text=Claustro;url=paginas.php?pagina=claustro;");
aI("text=Consejo Escolar;url=paginas.php?pagina=consejoescolar;");
aI("text=CCP;url=paginas.php?pagina=ccp;");
}



drawMenus();
