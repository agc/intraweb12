<?php

// La definici�n se almacena en una variable "global"
// esta variable es procesada en elementodefinicionmenu.ctp
// este archivo se carga en el controlador de Documentos

$aplicacion=Configure::read('AplicacionWeb.nombre');
$verarchivo="$aplicacion".Configure::read('AplicacionWeb.verarchivo');;
$servirarchivo="$aplicacion".Configure::read('AplicacionWeb.servirarchivo');;
$verdocumento="$aplicacion".Configure::read('AplicacionWeb.verdocumento');;




//Uso de heredoc

// no se permiten lineas en blanco dentro de la definici�n
// comentarios se comienza la linea por #
//<espacio> designa ex�ctamente un espacio
// el resto de la linea se ignora
//BEGIN<espacio>nombremenu 
//END  <comentario opcional>
//texto<espacio>:<espacio>url
//texto<espacio>><espacio>submenu

$definicion=<<<MENU
BEGIN principal    #menu inicial
Página Principal | $verdocumento
Explorador de archivos | $aplicacion/exploradorarchivos/ver&pagina=login
END principal
#
BEGIN elcentro
Características del Centro  * caracteristicascentro
Cursos y listas * cursosylistas
Profesorado * informacionprofesores
Horarios y Calendarios * informacionhorarioscalendarios
Sistema de Gestión * sistemagestion
END elcentro
#
BEGIN legislacion
Normativa y documentación oficial | $verdocumento/normativadocoficial
Departamentos  * departamentos
END
# este menu se anula porque se incluye en los sliders

BEGIN sistemagestion
Documentación del Sistema de Gestión | $verarchivo/docgestion
END

BEGIN instrucciones
Documentos para el profesorado | $verdocumento/documentosprofesorado
Instrucciones diversas * instruccionesgenerales
Guardias * instruccionesguardias
Aulas(Desdobles, informática..) y Biblioteca * instruccionesaulasybiblioteca
Reprografía * instruccionesreprografia
END
#
#
BEGIN impresosymodelos
Informes sobre alumnado * informesalumnado
Otros informes sobre Alumnado * informesalumnadootros
Modelos * modelos
Permisos profesorado * permisos
Varios * informesvarios
Documento Sugerencias, quejas y reclamaciones | $verarchivo?pagina=calidad&documento=documentosqr
END
#
BEGIN informacion
Permisos retribuidos | $servirarchivo?pagina=cuadernodelprofesor&documento=permisosretribuidos
Planes y criterios * planificacion
Resultados * resultados
Normativa y Doc.Oficial | $verdocumento/normativadocoficial
Direcciones de interés | $servirarchivo?documento=/direccionesinteres/index.htm
END
#
BEGIN caracteristicascentro
Plano del Centro | $servirarchivo/?pagina=cuadernodelprofesor&documento=planodelcentro
Estructura y funcionamiento | $servirarchivo/?pagina=cuadernodelprofesor&documento=/CP04_Estructura%20y%20funcionamiento.doc
Oferta educativa | $servirarchivo/?pagina=cuadernodelprofesor&documento=/CP05_Oferta%20educativa.doc
END
BEGIN informacionhorarioscalendarios
Calendario escolar | $servirarchivo/?pagina=cuadernodelprofesor&documento=calendarioescolar
Horario general del centro |  $servirarchivo/?pagina=jefaturaestudios&documento=horariogeneralcentro
Horario personal del profesorado |  $servirarchivo/?pagina=jefaturaestudios&documento=horariopersonalprofesorado
Calendario-Horario de las evaluaciones |  $servirarchivo/?pagina=cuadernodelprofesor&documento=/CP13_Evaluacion_Calendario.doc
Planificación Trimestral |  $servirarchivo/?pagina=cuadernodelprofesor&documento=/CP18_Planificaci%F3n%20trimestral.doc
Horario de aulas de desdobles | $verdocumento/aulasespeciales
Horario,guía y fondos de biblioteca |$verdocumento/biblioteca
END
BEGIN planificacion
Evaluación, proceso y documentos |$servirarchivo/?pagina=cuadernodelprofesor&documento=evaluacionprocesodocumentos
Plan general de actividades complementarias |$servirarchivo/?pagina=cuadernodelprofesor&documento=planactividadescomplementarias
Plan de evacuación del centro |$servirarchivo/?pagina=cuadernodelprofesor&documento=planevacuacion
Aulas de desdobles por curso y departamento |$servirarchivo/?pagina=jefaturaestudios&documento=desdobleporcursodepartamento
Criterios para interpretar o definir los indicadores de conformidad de los cursos |$servirarchivo/?pagina=calidad&documento=criteriosindicadoresconformidad
END
#
BEGIN informacionprofesores
Profesores de los departamentos didácticos |$servirarchivo/?pagina=cuadernodelprofesor&documento=personaldocente
Relación de tutores y tutoras |$servirarchivo/?pagina=cuadernodelprofesor&documento=relaciontutores
Relación de Profesores por grupo y nivel |$servirarchivo/?pagina=jefaturaestudios&documento=profesoresgruponivel
END
#
BEGIN cursosylistas
Especificaciones de los cursos | $verdocumento/especificacionescursos
Listas de cursos |$verarchivo/grupos
Cálculo de % clases impartidas |$verarchivo/grupos
END
#
BEGIN claustroccpconsejo
Convocatoria y actas del Claustro |$verarchivo/actasclaustro
Convocatoria y actas de la CCP |$verarchivo/actasccp
Convocatoria y actas del Consejo Escolar |$verarchivo/actasconsejo
END
#
BEGIN resultados
Resultados académicos |$verarchivo/resulacademicos
Resultados de encuestas |$verarchivo/resulencuestas
Resultados de procesos |$verarchivo/resulprocesos
END
#
BEGIN instruccionesgenerales
#Instr. para la acogida del personal |$servirarchivo/?pagina=calidad&documento=acogidapersonal
Instr. para la acogida del personal |$servirarchivo/pagina:calidad/documento:acogidapersonal
Instr. y proceso para regular la convivencia |$servirarchivo/?pagina=cuadernodelprofesor&documento=normasconvivencia
Instr. para la utilización de servicios,espacios y materiales comunes |$servirarchivo/?pagina=cuadernodelprofesor&documento=serviciosespacioscomunes
Instr. para la Evaluación. Proceso y documentos |$servirarchivo/?pagina=cuadernodelprofesor&documento=evaluacionprocesodocumentos
Instr. para calibrar el sistema de puntuación del profesorado |$servirarchivo/?pagina=calidad&documento=calibracion
Instr. para organizar actividades complementarias extraescolares |$servirarchivo/?pagina=vicedireccion&documento=criteriosaces
Instr. para la evacuación del centro |$servirarchivo/?pagina=cuadernodelprofesor&documento=planevacuacion
END
#
BEGIN instruccionesguardias
Instr. para el servicio de guardia |$servirarchivo/?pagina=cuadernodelprofesor&documento=instruccionesguardias
Servicio de guardia de recreo |$servirarchivo/?pagina=cuadernodelprofesor&documento=planvigilanciarecreo
Guardia de 1ª y 4ª hora |$servirarchivo/?pagina=jefaturaestudios&documento=guardias1y4hora
Estudio Asistido |$servirarchivo/pagina:cuadernodelprofesor/documento:estudioasistido   
END
#
BEGIN instruccionesaulasybiblioteca
Estudio Asistido |$servirarchivo/?pagina=cuadernodelprofesor&documento=estudioasistido
Aulas de Desdoble |$servirarchivo/?pagina=jefaturaestudios&documento=auladesdoble
Aula de Informática |$servirarchivo/?pagina=jefaturaestudios&documento=aulainformatica
Instr. para el uso de la biblioteca |$servirarchivo/?pagina=biblioteca&documento=normasbiblioteca
END
#
BEGIN instruccionesreprografia
Instr. para el profesorado sobre el servicio de reprografía |$servirarchivo/?pagina=secretaria&documento=instruccionesreprografia
Instr. para la impresión y copia de documentos |$servirarchivo/?pagina=secretaria&documento=instruccionesfotocopiadora
END
#
BEGIN informesalumnado
Informe individual 1ª/2ªEval. |$servirarchivo/?pagina=calidad&documento=informeindividual
Informe individual agrup. específico. |$servirarchivo/?pagina=calidad&documento=informeindividualagrupamiento
Encuesta satisfacciªn del alumnado. |$servirarchivo/?pagina=calidad&documento=encuestasatisfaccionalumnado
Areas/materias no superadas final de cursos |$servirarchivo/?pagina=calidad&documento=areasnosuperadas
Consejo orientador 4º ESO |$servirarchivo/?pagina=calidad&documento=consejoorientador
Actas de evaluación por grupo * actasevaluacion
END
#
BEGIN informesalumnadootros
Atención de las clases profesorado ausente |$servirarchivo/?pagina=cuadernodelprofesor&documento=fichaguardias
Informe individual para el tutor |$servirarchivo/?pagina=varios&documento=informeparaeltutor
Comunicado de falta de disciplina |$servirarchivo/?pagina=cuadernodelprofesor&documento=normasconvivencia
END
#
BEGIN modelos
Seguimiento Program. Didácticas |$servirarchivo/?pagina=calidad&documento=seguimientoprogramaciones
Seguimiento Plan Departamental |$servirarchivo/?pagina=calidad&documento=seguimientoplandepartamental
Examen |$servirarchivo/?pagina=varios&documento=modeloexamen
Acta(reuniones) |$servirarchivo/?pagina=varios&documento=modeloacta
Orden del día(reuniones) |$servirarchivo/?pagina=varios&documento=modeloordendia
Memoria final |$servirarchivo/?pagina=calidad&documento=memoriafinal
END
#
BEGIN permisos
Solicitud |$servirarchivo/?pagina=calidad&documento=solicitudpermiso
Justificación de la ausencia |$servirarchivo/?pagina=calidad&documento=justificacionausencia
Atención de las clases profesorado ausente |$servirarchivo/?pagina=cuadernodelprofesor&documento=fichaguardias
END
#
BEGIN informesvarios
Hoja de pedido (más de 150 euros) |$servirarchivo/?pagina=calidad&documento=pedidomasde150
Plantilla para elaborar el inventario |$servirarchivo/?pagina=/secretaria&documento=/FICHA recogida de DATOS PARA EL INVENTARIO.doc
Solicitud uso de instalaciones |$servirarchivo/?pagina=calidad&documento=solicitudusoinstalaciones
Propuesta de actividades complementarias |$servirarchivo/?pagina=cuadernodelprofesor&documento=/CP14_Extraescolares.doc
Impreso materias selectividad |$servirarchivo/?pagina=jefaturaestudios&documento=/Selectividad.doc
END
#
# *** tercer nivel
BEGIN actasevaluacion
Instrucciones 1 | $verdocumento/aaa
END
MENU;


//explode es mas r�pido que otras funciones con expresiones regulares
//que admiten mas flexibilidad
//solo admite un retorno de carro, no dos
//duda en windows el final de linea es tambien \n

$array_menu=explode("\n",$definicion);

//En lugar de definir una variable global  as�
//$GLOBALS["menu"]=$array_menu;
//se prueba este m�todo

//$configure=& Configure::getInstance();
//$configure->menu=$array_menu;
Configure::write("menu",$array_menu)

?>