<?php
require_once("../include/session.php");
$where_c_coste=" id_c_coste={$_SESSION['id_c_coste']} " ;   // AND $where_c_coste 

 require_once("../../conexion.php");
 require_once("../include/funciones.php");

//$titulo_pagina="RV " . Dfirst("PRODUCCION","Prod_view", "ID_PRODUCCION={$_GET["id_produccion"]} AND $where_c_coste"  ) ;
?>

<HTML>
<HEAD>
     <title>Gestión OBRAS</title> 
    
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
	
	<link rel='shortcut icon' type='image/x-icon' href='/favicon.ico' />
	
  <!--ANULADO 16JUNIO20<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
   <link rel="stylesheet" href="../css/estilos.css<?php echo (isset($_SESSION["is_desarrollo"]) AND $_SESSION["is_desarrollo"])? "?d=".date("ts") : "" ; ?>" type="text/css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <!--ANULADO 16JUNIO20<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
</HEAD>
<BODY>


<!-- CONEXION CON LA BBDD Y MENUS -->
<?php 

require_once("../../conexion.php"); 
require_once("../menu/topbar.php");
//require_once("../bancos/bancos_menutop_r.php");


//require_once("../include/NumeroALetras.php"); 


?>


<div style="overflow:auto">	   
   
	<!--************ INICIO *************  -->

<div id="main" class="mainc_100" style=" background-color:white">
	
<?php 

// configuracion del modo Calendario TABLA_CALENDAR.PHP
$fecha_cal= isset($_GET["fecha_cal"]) ? $_GET["fecha_cal"] : ( isset($_POST["fecha_cal"]) ? $_POST["fecha_cal"] : date('Y-m-d') )  ;
//$link_calendar_mes="pagos_y_cobros.php?fecha_cal=" ;  // link para avanzar o retroceder meses

//$fecha_db="f_vto" ;   // determinamos el campo DATETIME que se ubicará el Calendario   

//$style_hidden_if_global=$listado_global? " disabled " : ""  ; 



$tipo_subcentro= isset($_GET["tipo_subcentro"]) ?  $_GET["tipo_subcentro"] :  (isset($_POST["tipo_subcentro"]) ?  $_POST["tipo_subcentro"] :  "OG") ;
$Obra    = isset($_GET["Obra"]) ?  $_GET["Obra"] :          (isset($_POST["Obra"]) ?  $_POST["Obra"] :  "") ;
$grupo = isset($_GET["grupo"]) ?  $_GET["grupo"] :    (isset($_POST["grupo"]) ?  $_POST["grupo"] :  "") ;
$cliente  = isset($_GET["cliente"]) ?  $_GET["cliente"] :      (isset($_POST["cliente"]) ?  $_POST["cliente"] :  "") ;
$observaciones=isset($_GET["observaciones"])?$_GET["observaciones"] :  (isset($_POST["observaciones"]) ?  $_POST["observaciones"] :  "") ;

$fecha1   = isset($_GET["fecha1"]) ?  $_GET["fecha1"]     :    (isset($_POST["fecha1"]) ?  $_POST["fecha1"] :  "")  ;
$fecha2   = isset($_GET["fecha2"]) ?  $_GET["fecha2"]     :    (isset($_POST["fecha2"]) ?  $_POST["fecha2"] :  "") ;
$Dia   = isset($_GET["Dia"]) ?  $_GET["Dia"]     :    (isset($_POST["Dia"]) ?  $_POST["Dia"] :  "") ;
$Semana   = isset($_GET["Semana"]) ?  $_GET["Semana"]     :    (isset($_POST["Semana"]) ?  $_POST["Semana"] :  "") ;
$Mes   = isset($_GET["Mes"]) ?  $_GET["Mes"]     :    (isset($_POST["Mes"]) ?  $_POST["Mes"] :  "") ;
$Trimestre   = isset($_GET["Trimestre"]) ?  $_GET["Trimestre"]     :    (isset($_POST["Trimestre"]) ?  $_POST["Trimestre"] :  "") ;
$Anno   = isset($_GET["Anno"]) ?  $_GET["Anno"]     :    (isset($_POST["Anno"]) ?  $_POST["Anno"] :  "") ;

$importe1 = isset($_GET["importe1"]) ?  $_GET["importe1"] :    (isset($_POST["importe1"]) ?  $_POST["importe1"] :  "") ;
$importe2 = isset($_GET["importe2"]) ?  $_GET["importe2"] :    (isset($_POST["importe2"]) ?  $_POST["importe2"] :  "") ;
//  $ingreso1 = isset($_GET["ingreso1"]) ?  $_GET["ingreso1"] :    (isset($_POST["ingreso1"]) ?  $_POST["ingreso1"] :  "") ;
//  $ingreso2 = isset($_GET["ingreso2"]) ?  $_GET["ingreso2"] :    (isset($_POST["ingreso2"]) ?  $_POST["ingreso2"] :  "") ;
//  $remesa   = isset($_GET["remesa"]) ?  $_GET["remesa"]     :    (isset($_POST["remesa"]) ?  $_POST["remesa"] :  "") ;
$activa  = isset($_GET["activa"]) ?  $_GET["activa"]   :    (isset($_POST["activa"]) ?  $_POST["activa"] :  "1") ;      // activa
//  $proveedor= isset($_GET["proveedor"]) ?  $_GET["proveedor"] :  (isset($_POST["proveedor"]) ?  $_POST["proveedor"] :  "") ;
//  $cliente  = isset($_GET["cliente"]) ?  $_GET["cliente"]   :    (isset($_POST["cliente"]) ?  $_POST["cliente"] :  "") ;
//  $NG       = isset($_GET["NG"]) ?  $_GET["NG"]             :    (isset($_POST["NG"]) ?  $_POST["NG"] :  "") ;
$agrupar  = isset($_GET["agrupar"]) ?  $_GET["agrupar"]   :    (isset($_POST["agrupar"]) ?  $_POST["agrupar"] :  "obras");  


// FORMATOS checkboxs
$inicio_form = !isset($_POST["tipo_subcentro"]) ;       // variables que indica que hay que inicializar el form y los check boxs
$fmt_prod_obra = isset($_GET["fmt_prod_obra"]) ? 
                              ( $_GET["fmt_prod_obra"] ? "checked" : "" )
                            : (isset($_POST["fmt_prod_obra"]) ?  "checked" : 
                              ( $inicio_form ? "checked" : ""  )  );                // vaor por defecto 'checked'

$fmt_prod_origen = isset($_GET["fmt_prod_origen"]) ? 
                              ( $_GET["fmt_prod_origen"] ? "checked" : "" )
                            : (isset($_POST["fmt_prod_origen"]) ?  "checked" : 
                              ( $inicio_form ? "" : ""  )  );                // valor por defecto ''

$fmt_gastos_estimados = isset($_GET["fmt_gastos_estimados"]) ? 
                              ( $_GET["fmt_gastos_estimados"] ? "checked" : "" )
                            : (isset($_POST["fmt_gastos_estimados"]) ?  "checked" : "");  
$fmt_plan = isset($_GET["fmt_plan"]) ? 
                              ( $_GET["fmt_plan"] ? "checked" : "" )
                            : (isset($_POST["fmt_plan"]) ?  "checked" : "");  
$fmt_ventas = isset($_GET["fmt_ventas"]) ? 
                              ( $_GET["fmt_ventas"] ? "checked" : "" )
                            : (isset($_POST["fmt_ventas"]) ?  "checked" : "");  
$fmt_facturacion = isset($_GET["fmt_facturacion"]) ? 
                              ( $_GET["fmt_facturacion"] ? "checked" : "" )
                            : (isset($_POST["fmt_facturacion"]) ?  "checked" : "");  

//
////debug
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

    ?>    
 
 <!--<a class="btn btn-link noprint" title="va al listado de relaciones valoradas de la Obra" href="../obras/obras_prod.php?id_obra=<?php echo $id_obra;?>" ><span class="glyphicon glyphicon-arrow-left"></span> Volver a Producciones</a>-->    
 <!--<a class="btn btn-link noprint" title="imprimir" href=#  onclick="window.print();"><i class="fas fa-print"></i> Imprimir pantalla</a>-->
 <!--<a class="btn btn-link noprint" title="ver datos generales de la Produccion actual" target='_blank' href="../obras/prod_ficha.php?id_obra=<?php echo $id_obra;?>&id_produccion=<?php echo $id_produccion;?>" ><span class="glyphicon glyphicon-th-list"></span> ficha Produccion</a>-->    
 
<script>

//function formato_prod_obra()
//{ //    $('#fmt_costes').prop('checked',!($('#fmt_costes').prop('checked'))) ;
//    $('#fmt_costes').prop('checked',false) ;
//    $('#fmt_texto_udo').prop('checked',true) ;
//    $('#fmt_med_proyecto').prop('checked',true) ;  
//    $('#fmt_resumen_cap').prop('checked',false) ;  
//    $('#fmt_anadir_med').prop('checked',true) ;  
//    $('#fmt_seleccion').prop('checked',false) ;  
////    $('#btn_agrupar_udos').click() ;  
////   document.getElementbyID("btn_agrupar_udos").click();
////   document.getElementById('agrupar').value = 'udos'; document.getElementById('form1').submit();
//
////    window.print();
//}
//function formato_certif()
//{ //    $('#fmt_costes').prop('checked',!($('#fmt_costes').prop('checked'))) ;
//    $('#fmt_costes').prop('checked',false) ;
//    $('#fmt_texto_udo').prop('checked',true) ;
//    $('#fmt_med_proyecto').prop('checked',false) ;  
//    $('#fmt_resumen_cap').prop('checked',true) ;  
//    $('#fmt_anadir_med').prop('checked',false) ;  
//    $('#fmt_seleccion').prop('checked',false) ;  
//}
//
//function formato_estudio_costes()
//{ //    $('#fmt_costes').prop('checked',!($('#fmt_costes').prop('checked'))) ;
//    $('#fmt_costes').prop('checked',true) ;
//    $('#fmt_texto_udo').prop('checked',true) ;
//    $('#fmt_med_proyecto').prop('checked',true) ;  
//    $('#fmt_resumen_cap').prop('checked',true) ;  
//    $('#fmt_anadir_med').prop('checked',false) ;  
//    $('#fmt_seleccion').prop('checked',false) ;  
//}

</script>    

    <!--<div id="chart_div" style="display:none"></div>-->
<!--    <div id="chart_div" ></div>-->

 
 <h1><span class='noprint'>Gestión OBRAS</span></h1>
 
         <!--ENCABEZADOS PARA IMPRESION-->
 <!--<div class='divHeader'>-->
 <div >
   <h4 class='border'><?php // echo $NOMBRE_COMPLETO;?></h4>
   <h6> <?php // echo $EXPEDIENTE;?></h6>
 </div>  
   <h3><?php // echo $PRODUCCION;?></h3>

   
<!--  <div class='divFooter'>
   <h6 class='border'>Página</h6> 
 </div>  
   -->
    <div class='row noprint' style='border-style: solid ; border-color:grey; margin-bottom: 5px; padding:10px'>
 
   
   <form class='noprint' action="../obras/obras_view.php" method="post" id='form1' name='form1' >
      <INPUT type='hidden' id='fecha_cal' name='fecha_cal' value='<?php echo $fecha_cal;?>'>
       
    <div class='col-lg-6'>
           
<TABLE class="noprint">
<!--    <TR><TD color=red colspan=2 bgcolor=PapayaWhip align=center>
            
        </TD></TR>-->

<TR><TD colspan='2' align="center"><b>OBRAS</b></TD></TR>
    
<TR><TD>Tipo subcentro </TD><TD><INPUT  type="text" id="tipo_subcentro" name="tipo_subcentro" value="<?php echo $tipo_subcentro;?>"><button type="button" onclick="document.getElementById('tipo_subcentro').value='OGAMEX' ; ">*</button></TD></TR>
<TR><TD>Nombre Obra </TD><TD><INPUT  type="text" id="Obra" name="Obra" value="<?php echo $Obra;?>"><button type="button" onclick="document.getElementById('Obra').value='' ; ">*</button></TD></TR>
<TR><TD>Grupo </TD><TD><INPUT   type="text" id="banco" name="grupo" value="<?php echo $grupo;?>"><button type="button" onclick="document.getElementById('grupo').value='' ; ">*</button></TD></TR>
<TR><TD>Cliente  </TD><TD><INPUT   type="text" id="cliente" name="cliente" value="<?php echo $cliente;?>"><button type="button" onclick="document.getElementById('cliente').value='' ; ">*</button></TD></TR>

<?php               
$radio=$activa ;
$chk_todos =  ['','']  ; $chk_on = ['','']  ; $chk_off =  ['','']  ;
if ($radio=="") { $chk_todos = ["active","checked"] ;} elseif ($radio==1) { $chk_on =  ["active","checked"]  ;} elseif ($radio==0)  { $chk_off =  ["active","checked"]  ;}
echo "<TR><TD>Activas</td><td>"
     . "<div class='btn-group btn-group-toggle' data-toggle='buttons'>"
     . "<label class='btn btn-default {$chk_todos[0]}'><input type='radio' id='activa' name='activa' value='' {$chk_todos[1]} />Todas     </label> "
     . "<label class='btn btn-default {$chk_on[0]}'><input type='radio' id='activa1' name='activa' value='1'  {$chk_on[1]} />Activas   </label>"
     . "<label class='btn btn-default {$chk_off[0]}'><input type='radio' id='activa0' name='activa' value='0' {$chk_off[1]}  />No Activas</label>"
     . "</div>"
     . "</TD></TR>" ;
?>              

</TABLE></div><div class='col-lg-6'><TABLE> 

<TR><TD colspan="2" align="center"><b>PERIODO</b></TD></TR>
<TR><TD>Fecha desde </TD><TD><INPUT   type="date" id="fecha1" name="fecha1" value="<?php echo $fecha1;?>"><button type="button" onclick="document.getElementById('fecha1').value='' ; ">*</button></TD></TR>
<TR><TD>Fecha hasta</TD><TD><INPUT   type="date" id="fecha2" name="fecha2" value="<?php echo $fecha2;?>"><button type="button" onclick="document.getElementById('fecha2').value='' ; ">*</button></TD></TR>
<TR><TD>Dia</TD><TD><INPUT   type="text" id="Dia" name="Dia" value="<?php echo $Dia;?>"><button type="button" onclick="document.getElementById('Dia').value='' ; ">*</button></TD></TR>
<TR><TD>Semana</TD><TD><INPUT   type="text" id="Semana" name="Semana" value="<?php echo $Semana;?>"><button type="button" onclick="document.getElementById('Semana').value='' ; ">*</button></TD></TR>
<TR><TD>Mes</TD><TD><INPUT   type="text" id="Mes" name="Mes" value="<?php echo $Mes;?>"><button type="button" onclick="document.getElementById('Mes').value='' ; ">*</button></TD></TR>
<TR><TD>Trimestre</TD><TD><INPUT   type="text" id="Trimestre" name="Trimestre" value="<?php echo $Trimestre;?>"><button type="button" onclick="document.getElementById('Trimestre').value='' ; ">*</button></TD></TR>
<TR><TD>Año</TD><TD><INPUT   type="text" id="Anno" name="Anno" value="<?php echo $Anno;?>"><button type="button" onclick="document.getElementById('Anno').value='' ; ">*</button></TD></TR>





<TR><TD></TD><TD><INPUT type="submit" class='btn btn-success btn-xl' style='width: 15vw;'  value="actualizar consulta" id="submit" name="submit"></TD></TR>

<input type="hidden"  id="agrupar"  name="agrupar" value="<?php echo $agrupar;?>"> 

</TABLE></div></div>


<div class='noprint'>
Formato:&nbsp; 
        <label><INPUT type="checkbox" id="fmt_prod_obra" name="fmt_prod_obra" <?php echo $fmt_prod_obra;?>  >&nbsp;Producción periodo&nbsp;&nbsp;</label>
        <label><INPUT type="checkbox" id="fmt_gastos_estimados" name="fmt_gastos_estimados" <?php echo $fmt_gastos_estimados;?>  >&nbsp;Gastos Estimados&nbsp;&nbsp;</label>
        <label><INPUT type="checkbox" id="fmt_prod_origen" name="fmt_prod_origen" <?php echo $fmt_prod_origen;?>  >&nbsp;Producción a origen&nbsp;&nbsp;</label>
        <label><INPUT type="checkbox" id="fmt_plan" name="fmt_plan" <?php echo $fmt_plan;?>  >&nbsp;Plan mes&nbsp;&nbsp;</label>
        <label><INPUT type="checkbox" id="fmt_ventas" name="fmt_ventas" <?php echo $fmt_ventas;?>  >&nbsp;Ventas&nbsp;&nbsp;</label>
        <label><INPUT type="checkbox" id="fmt_facturacion" name="fmt_facturacion" <?php echo $fmt_facturacion;?>  >&nbsp;Facturacion a origen&nbsp;&nbsp;</label>
<!--         <a class="btn btn-link btn-xs noprint" title="formato para realizar un Estudio de costes de un Proyecto o Liciación" href=#  onclick="formato_estudio_costes();"><i class="fas fa-euro-sign"></i> modo Estudio de Costes</a>
         <a class="btn btn-link btn-xs noprint" title="formato de formulario para registrar Producciones de Obra" href=#  onclick="formato_prod_obra();"><i class="fas fa-hard-hat"></i> modo Producción Obra</a>
         <a class="btn btn-link btn-xs noprint" title="imprimir la producción con formato de Certificación sin costes, con texto_udo y con resumen" href=#  onclick="formato_certif();"><i class="fas fa-print"></i> modo Certificacion</a>-->

       
</div>         
   
<?php  

//$style_hidden_if_global=$listado_global? " disabled " : ""  ;

echo "<div id='myDIV' class='noprint' style='margin-top: 25px; padding:10px'>" ; 


$btnt['obras']=['Datos generales','', ''] ;
$btnt['vacio']=['','',''] ;
$btnt['situacion']=['Estado actual','', ''] ;
$btnt['vacio3']=['','',''] ;
$btnt['prod_gasto_obras']=['PRODUCCION-Obras','Produccion de Obra - Gastos',''] ;
$btnt['prod_gasto_dias']=['dias','',''] ;
$btnt['prod_gasto_semanas']=['semanas','',''] ;
$btnt['prod_gasto_meses']=['meses','',''] ;
$btnt['prod_gasto_annos']=['años','',''] ;
$btnt['prod_gasto_tipo']=['tipo','',''] ;
$btnt['vacio2']=['','',''] ;

//$btnt['calendar']=['calendario','',''] ;
//$btnt['comparadas']=['comparadas','',''] ;
//$btnt['EDICION']=['MODO EDICION','' ,$style_hidden_if_global ] ;

foreach ( $btnt as $clave => $valor)
{
  $disabled= isset($valor[2]) ? $valor[2] : ""  ;
//  echo "<button $disabled id='btn_agrupar_$clave' class='cc_btnt$active' title='{$valor[1]}' onclick=\"getElementById('agrupar').value = '$clave'; document.getElementById('form1').submit(); \">{$valor[0]}</button>" ;  
  $active= ($clave==$agrupar) ? "cc_active" : "" ;  
  echo (substr($clave,0,5)=='vacio') ? "   " : "<button $disabled id='btn_agrupar_$clave' class='cc_btnt $active' title='{$valor[1]}' "
                    . " onclick=\"getElementById('agrupar').value = '$clave'; document.getElementById('form1').submit(); \">{$valor[0]}</button>" ;  
}           
  
echo '</div>' ;
//echo '</form>' ;

//echo "<button  class='btn btn-warning' title='copia el resultado de la consulta a una produccion nueva' onclick=\"getElementById('crea_produccion').value = '1'; document.getElementById('form1').submit(); \">Consulta a prod. nueva</button>" ;  

   // Iniciamos variables para tabla.php  background-color:#B4045


$where=" $where_c_coste " ;
$where_fecha=" 1=1 " ;

//$where=$tipo_subcentro==""? $where : $where . " AND LOCATE(tipo_subcentro,'$tipo_subcentro')>0 " ;

$where .= $tipo_subcentro=="" ? "" : " AND '$tipo_subcentro' LIKE CONCAT('%',tipo_subcentro,'%') " ;
$where .= $Obra == ""? "" :  " AND  NOMBRE_OBRA  LIKE '%$Obra%'" ;
$where .= $grupo=="" ? "" :  " AND  GRUPOS  LIKE '%$grupo%' " ;
$where .= $activa =="" ? "" :  " AND  activa=$activa " ;                   
$where .= $cliente =="" ? "" :  " AND  CLIENTE LIKE '%$cliente%' " ;                   


//$where = $ref_doc =="" ? $where : $where . " AND   ref_doc  LIKE '%$ref_doc%' " ;
//$where=$observaciones==""? $where : $where . " AND observaciones LIKE '%$observaciones%'" ;

$select_semana="DATE_FORMAT(fecha, '%Y semana %u')"  ;
$select_trimestre="CONCAT(YEAR(fecha), '-', QUARTER(fecha),'T')"  ;


$where_fecha = $fecha1 ==""? $where_fecha : $where_fecha . " AND fecha >= '$fecha1' " ;
$where_fecha = $fecha2 ==""? $where_fecha : $where_fecha . " AND fecha <= '$fecha2' " ;
$where_fecha = $Semana==""? $where_fecha : $where_fecha . " AND $select_semana = '$Semana' " ;
$where_fecha = $Mes==""? $where_fecha : $where_fecha . " AND DATE_FORMAT(fecha, '%Y-%m') = '$Mes' " ;
$where_fecha = $Trimestre==""? $where_fecha : $where_fecha . " AND $select_trimestre = '$Trimestre' " ;
$where_fecha = $Anno==""? $where_fecha : $where_fecha . " AND YEAR(fecha) = '$Anno' " ;

// CADENA_URL PARA LINK DEL PERIODO
$cadena_link_periodo="v=1" ;
$cadena_link_periodo .= ($tipo_subcentro == "") ? "" :  "&tipo_subcentro=$tipo_subcentro " ;
$cadena_link_periodo .= ($fecha1 == "") ? "" :  "&fecha1=$fecha1 " ;
$cadena_link_periodo .= ($fecha2 == "") ? "" :  "&fecha2=$fecha2 " ;
$cadena_link_periodo .= ($Semana == "") ? "" :  "&Semana=$Semana " ;
$cadena_link_periodo .= ($Mes == "") ? "" :  "&Mes=$Mes " ;
$cadena_link_periodo .= ($Trimestre == "") ? "" :  "&Trimestre=$Trimestre " ;
$cadena_link_periodo .= ($Anno == "") ? "" :  "&Anno=$Anno " ;

// prueba de usar gastos global y prod. sem. global
$cadena_link_periodo .= ($Obra == "") ? "" :  "&Obra=$Obra " ;





//// SELECT A INCLUIR EN LOS SQL SEGUN EL FORMATO ///////////////////////////////////////////

// SI ES formato Costes $fmt_costes añadimos las columnas gastos_est y beneficio

if (!$fmt_prod_obra )   { $ocultos[]="importe_prod" ;$ocultos[]="gasto_real" ;$ocultos[]="benef_real"  ;$ocultos[]="margen_real"  ; }
if (!$fmt_gastos_estimados )   { $ocultos[]="gasto_est" ;$ocultos[]="benef_est" ;$ocultos[]="margen_est"  ; }
if (!$fmt_plan )   { $ocultos[]="PLAN" ;}
if (!$fmt_ventas )   { $ocultos[]="VENTAS" ;$ocultos[]="GASTOS_EX" ;$ocultos[]="Beneficio"  ;$ocultos[]="Margen"  ; }
if (!$fmt_facturacion )   { $ocultos[]="Facturado" ;$ocultos[]="Facturado_iva" ;$ocultos[]="Pdte_Cobro"  ; }



//$select_COSTE_EST = $fmt_costes ? ", COSTE_EST,Estudio_coste " : ""  ;               
//$select_COSTE_EST_T = $fmt_costes ? ", '' as COSTE_EST, '' as acc " : ""  ;               


$tipo_tabla='' ;       // indica si usamos tabla.php o tabla_group.php o tabla_pdf.php
//$tabla_pdf=0 ;             // usaremos TABLA_GROUP.PHP 


// BOTONES A MOSTRAR SEGUN EL FORMATO, SELECCIÓN, ANADIR_MED...

$content_sel="" ;         // inicializamos el contenido del <div> SELECTION
$content_anadir_med="" ;

   
//// contenedor selection por defecto
//     $content_sel.="<div class='border noprint' >" ;
//     $content_sel.="<big>Seleccionados:</big> <a class='btn btn-danger btn-xs noprint btn_topbar' href='#' onclick='borrar_mediciones_udo($id_produccion)' title='Vacía las mediciones de las Udo seleccionadas' ><i class='far fa-trash-alt'></i> Borrar mediciones Udos seleccionadas</a>" ;
//     $content_sel.="<a class='btn btn-warning btn-xs noprint btn_topbar' href='#' onclick='prod_completa_udo($id_produccion)' title='Completa hasta Medicion de Proyecto (MED_PROYECTO) las Udos seleccionadas' >MED_PROYECTO a Udos seleccionadas</a>" ;
//     $content_sel.="</div>" ; 
//     
//    if ($fmt_anadir_med) $content_anadir_med="  <a class='btn btn-warning btn-xs noprint btn_topbar' href='#' onclick='prod_anade_med_udo($id_produccion)' title='Añade a cada unidad de obra la medición de la columna 'Añadir Med' >añade columna de mediciones </a>" ;
//
////    $sql="SELECT  ID_OBRA,ID_CAPITULO, CAPITULO AS ID_SUBTOTAL_CAPITULO,ID_UDO,ID_UDO AS _ID_UDO,ud $select_UDO $select_MED_PROYECTO,SUM(MEDICION) as MEDICION"
////           . " $select_anadir_med , PRECIO, SUM(IMPORTE) as importe $select_COSTE_EST $select_costes  FROM ConsultaProd WHERE $where  GROUP BY ID_UDO ORDER BY CAPITULO,ID_UDO " ;
//
////    $where_urlencode=rawurlencode($where) ;
//    $where_urlencode=base64_encode($where) ;
////    $where_urlencode=$where ;
//    echo " <a class='btn btn-warning btn-xs noprint btn_topbar' href='#' onclick=\"copy_prod_consulta($id_obra,$id_produccion,'$where_urlencode','$PRODUCCION')\" title='Crea una Relación Valorada nueva con la consulta actual' >crea Rel.Valorada nueva</a>" ;
  
// FIN BOTONES A MOSTRAR

$union_sql4=0 ;  // decidirá si añadir UNION sql4 con prod origen y facturación a origen
$select_prod_origen="" ;
$select_prod_origen_sql4="" ;
$select_prod_origen_Union="" ;
$select_prod_origen_Union_T="" ;


 switch ($agrupar) {
   case "obras":
//     $sql="SELECT ID_OBRA,activa,tipo_subcentro AS T,NOMBRE_OBRA,importe_sin_iva,Cartera_pdte "
//         . "Cartera_pdte,Porcentaje_Plazo , Valoracion/importe_sin_iva as Porcentaje_ejecutado, Valoracion/importe_sin_iva-Porcentaje_Plazo as Porcentaje_DESFASE"
//           . ",' ' as ID_TH_COLOR, Valoracion as Importe_Ejecutado ,Gastos as Gasto_real, "
//           . "Valoracion-Gastos as Beneficio_real,(Valoracion-Gastos)/Valoracion as Margen_real,(Valoracion-Gasto_est)/Valoracion as Margen_estimado "
//         . ",' ' as ID_TH_COLOR2, VENTAS,GASTOS_EX, VENTAS-GASTOS_EX AS Beneficios"
//            . " FROM Obras_View WHERE $where  ORDER BY NOMBRE_OBRA " ;

      $sql="SELECT ID_OBRA,activa,tipo_subcentro AS T,NOMBRE_OBRA,IMPORTE AS importe_iva_inc  "
         . ",Plazo,F_Fin_Plazo,id_produccion_obra, 'ver Prod_Obra' as PRODUCCION_OBRA "
            . " FROM Obras_View WHERE $where  ORDER BY NOMBRE_OBRA " ;


//     $sql_T="SELECT  '' as ID_OBRA,'' as aa,COUNT(ID_OBRA) as num_pagos, 'Suma2' ,   SUM(IMPORTE) as IMPORTE , SUM(importe_sin_iva) as importe_sin_iva , "
//             . " SUM(VENTAS) as VENTAS , SUM(Cartera_pdte) as Cartera_pdte   FROM Obras_View WHERE $where    " ;
   break;
   case "situacion":
//     $sql="SELECT ID_OBRA,activa,tipo_subcentro AS T,NOMBRE_OBRA,importe_sin_iva,Cartera_pdte "
//         . "Cartera_pdte,Porcentaje_Plazo , Valoracion/importe_sin_iva as Porcentaje_ejecutado, Valoracion/importe_sin_iva-Porcentaje_Plazo as Porcentaje_DESFASE"
//           . ",' ' as ID_TH_COLOR, Valoracion as Importe_Ejecutado ,Gastos as Gasto_real, "
//           . "Valoracion-Gastos as Beneficio_real,(Valoracion-Gastos)/Valoracion as Margen_real,(Valoracion-Gasto_est)/Valoracion as Margen_estimado "
//         . ",' ' as ID_TH_COLOR2, VENTAS,GASTOS_EX, VENTAS-GASTOS_EX AS Beneficios"
//            . " FROM Obras_View WHERE $where  ORDER BY NOMBRE_OBRA " ;

      $sql="SELECT ID_OBRA,activa,tipo_subcentro AS T,NOMBRE_OBRA,IMPORTE AS importe_iva_inc , importe_sin_iva "
         . ", VENTAS , Cartera_pdte, VENTAS/importe_sin_iva as Porcentaje_ejecutado,F_Fin_Plazo,Porcentaje_Plazo ,  VENTAS/importe_sin_iva-Porcentaje_Plazo as Porcentaje_DESFASE"
           . ",' ' as ID_TH_COLOR,  "
           . "Facturado_iva , Facturado_iva/IMPORTE AS Porcentaje_Facturado , Pdte_Cobro , ' ' as ID_TH_COLOR2  "
            . " FROM Obras_View WHERE $where  ORDER BY NOMBRE_OBRA " ;

     $sql_T="SELECT  '' as ID_OBRA,'' as aa,COUNT(ID_OBRA) as num_pagos, 'Suma2' ,   SUM(IMPORTE) as IMPORTE , SUM(importe_sin_iva) as importe_sin_iva , "
             . " SUM(VENTAS) as VENTAS , SUM(Cartera_pdte) as Cartera_pdte   FROM Obras_View WHERE $where    " ;
   break;
   case "obras2":
     $sql="SELECT ID_OBRA,activa,tipo_subcentro AS T,NOMBRE_OBRA,importe_sin_iva,Cartera_pdte,  Beneficio_pdte,Margen_estimado  "
           . "  , Plazo,F_Acta_Rep,Porcentaje_Plazo,F_Fin_Plazo,importe_POF, VENTAS,Facturado_iva,Pdte_Cobro ,GRUPOS"
            . " FROM Obras_View WHERE $where  ORDER BY NOMBRE_OBRA " ;

     $sql_T="SELECT '' as aa,COUNT(ID_OBRA) as num_pagos, 'Suma' ,  SUM(IMPORTE) as Importe_contrato_iva ,  SUM(importe_sin_iva) as importe_sin_iva , "
             . " SUM(Cartera_pdte) as Cartera_pdte , SUM(Beneficio_pdte) as Beneficio_pdte  FROM Obras_View WHERE $where    " ;
   break;
   case "prod_gasto_obras":
       
       $select_PPAL=" ID_OBRA ,id_produccion_obra, NOMBRE_OBRA , " ;
       $select_PPAL_Union=" ID_OBRA ,id_produccion_obra, NOMBRE_OBRA , " ;
       
       // produccion a origen
       $select_prod_origen = $fmt_prod_origen ? " 0 as prod_origen, 0 as gastos_origen," : "" ;
       $select_prod_origen_sql4 = $fmt_prod_origen ? " Valoracion as prod_origen, Gastos as gastos_origen," : "" ;
       $select_prod_origen_Union = $fmt_prod_origen ?  " SUM(prod_origen) as prod_origen , SUM(gastos_origen) as gastos_origen "
                              . " , SUM(prod_origen) - SUM(gastos_origen) as benef_origen , (SUM(prod_origen) - SUM(gastos_origen))/SUM(prod_origen) as margen_origen ," : "" ;
       $select_prod_origen_Union_T = $fmt_prod_origen ? " '' as prod_origen , '' as gastos_origen ,'' as benef_origen , '' as margen_origen , " : "" ;
       $union_sql4 = ($fmt_prod_origen OR $fmt_facturacion) ;

       
       
       $group_order="GROUP BY ID_OBRA ORDER BY NOMBRE_OBRA";
       

       $links["importe_prod"] = ["../obras/obras_prod_detalle.php?$cadena_link_periodo&agrupar=udos&id_produccion=", "id_produccion_obra", "Abrir la PRODUCCION OBRA "] ;
       $links["gasto_real"] = ["../obras/gastos.php?$cadena_link_periodo&id_obra=", "ID_OBRA", "Abrir los Gastos "] ;
       $links["benef_real"] = ["../obras/obras_prod_detalle.php?$cadena_link_periodo&agrupar=balance&id_produccion=", "id_produccion_obra", "Abrir la Balance "] ;
       $links["VENTAS"] = ["../obras/obras_ventas.php?id_obra=", "ID_OBRA","abrir Ventas y Facturación de obra"] ;
       $links["GASTOS_EX"] = ["../obras/obras_ventas.php?id_obra=", "ID_OBRA","abrir Ventas y Facturación de obra"] ;
       $links["Facturado_iva"] = ["../obras/obras_ventas.php?id_obra=", "ID_OBRA","abrir Ventas y Facturación de obra"] ;
       
//       $group_order="GROUP BY Mes ORDER BY Mes";
       // sql produccion
//        echo $sql ;

        // si filtramos por Mes mostramos el boton de CERRAR Mes
       if ($Mes) // PROVISIONAL
//       if ($Mes AND 0)
       {
            $fecha_ventas=$Mes."-01" ;
            $onclick1_VARIABLE1_="ID_OBRA" ;           // paso de variables para dar instrucciones al boton 'add' para añadir un detalle a la udo
            $onclick1_VARIABLE2_="importe_prod" ;     // idem
            $onclick1_VARIABLE3_="gasto_real" ;     // idem

            $sql_insert="DELETE FROM VENTAS WHERE ID_OBRA='_VARIABLE1_' AND FECHA='$fecha_ventas' ;"  ;
//            $sql_insert="UPDATE VENTAS SET PLAN=999999 WHERE ID_OBRA='_VARIABLE1_' AND FECHA='$fecha_ventas' ;"  ;
            $sql_insert.="INSERT INTO VENTAS ( ID_OBRA,FECHA,IMPORTE,GASTOS_EX ) " . 
                      " VALUES ( '_VARIABLE1_', '$fecha_ventas','_VARIABLE2_','_VARIABLE3_'  );"  ;

            $sql_insert=encrypt2($sql_insert) ;

//            $actions_row["onclick1_link"]="<a class='btn btn-warning btn-xs' target='_blank' title='Cierra el Mes y registra el Importe producido como Venta y los gastos reales como Gastos de Explotación' "
//                    . " href=\"../include/sql.php?code=1&sql=$sql_insert&variable1=_VARIABLE1_&variable2=_VARIABLE2_&variable3=_VARIABLE3_ \"  "
//                    . "onclick='location.reload();' >cerrar mes</a> ";
            $actions_row["onclick1_link"]="<a class='btn btn-warning btn-xs'  title='Cierra el Mes y registra el Importe producido como Venta y los gastos reales como Gastos de Explotación' "
                    . " href=# onclick='js_href(\"../include/sql.php?code=1&sql=$sql_insert&variable1=_VARIABLE1_&variable2=_VARIABLE2_&variable3=_VARIABLE3_ \")'  "
                    . " >cerrar mes</a> ";
            $actions_row["id"]="ID_OBRA";
       }   
     
     
   break;
   case "prod_gasto_dias":
       
       $select_PPAL=" Fecha , " ;
       $select_PPAL_Union=" Fecha , " ;
       $group_order="GROUP BY Fecha ORDER BY Fecha";

    break;
   case "prod_gasto_semanas":
       
       $select_PPAL=" $select_semana as Semana , " ;
       $select_PPAL_Union=" Semana , " ;
       $group_order="GROUP BY Semana ORDER BY Semana";
       
       $links["gasto_real"] = ["../obras/gastos.php?$cadena_link_periodo&Semana=", "Semana", "Abrir los Gastos "] ;


    break;
   case "prod_gasto_meses":
       
       $select_PPAL=" DATE_FORMAT(fecha, '%Y-%m') as Mes , " ;
       $select_PPAL_Union=" Mes , " ;
       $group_order="GROUP BY Mes ORDER BY Mes";
       
        // si filtramos por OBRA y ese filtro Obra es una única obra mostramos el boton de CERRAR Mes
       if ($Obra AND (Dfirst("COUNT(ID_OBRA)","OBRAS"," NOMBRE_OBRA='$Obra' AND $where_c_coste ")==1)) // PROVISIONAL
//       if ($Mes AND 0)
       {
//            $fecha_ventas=$Mes."-01" ;
            $id_obra_cierre_mes=Dfirst("ID_OBRA","OBRAS"," NOMBRE_OBRA='$Obra' AND $where_c_coste ");
            $onclick1_VARIABLE1_="Mes" ;           // paso de variables para dar instrucciones al boton 'add' para añadir un detalle a la udo
            $onclick1_VARIABLE2_="importe_prod" ;     // idem
            $onclick1_VARIABLE3_="gasto_real" ;     // idem

            $sql_insert="DELETE FROM VENTAS WHERE ID_OBRA=$id_obra_cierre_mes AND FECHA='_VARIABLE1_-01' ;"  ;
//            $sql_insert="UPDATE VENTAS SET PLAN=999999 WHERE ID_OBRA='_VARIABLE1_' AND FECHA='$fecha_ventas' ;"  ;
            $sql_insert.="INSERT INTO VENTAS ( ID_OBRA,FECHA,IMPORTE,GASTOS_EX ) " . 
                      " VALUES ( '$id_obra_cierre_mes', '_VARIABLE1_-01','_VARIABLE2_','_VARIABLE3_'  );"  ;

            $sql_insert=encrypt2($sql_insert) ;

//            $actions_row["onclick1_link"]="<a class='btn btn-warning btn-xs' target='_blank' title='Cierra el Mes y registra el Importe producido como Venta y los gastos reales como Gastos de Explotación' "
//                    . " href=\"../include/sql.php?code=1&sql=$sql_insert&variable1=_VARIABLE1_&variable2=_VARIABLE2_&variable3=_VARIABLE3_ \"  "
//                    . "onclick='location.reload();' >cerrar mes</a> ";
            $actions_row["onclick1_link"]="<a class='btn btn-warning btn-xs'  title='Cierra el Mes y registra el Importe producido como Venta y los gastos reales como Gastos de Explotación' "
                    . " href=# onclick='js_href(\"../include/sql.php?code=1&sql=$sql_insert&variable1=_VARIABLE1_&variable2=_VARIABLE2_&variable3=_VARIABLE3_ \")'  "
                    . " >cerrar mes</a> ";
            $actions_row["id"]="Mes";
       }   
     
       

    break;
   case "prod_gasto_annos":
       
       $select_PPAL=" YEAR(fecha) as Anno , " ;
       $select_PPAL_Union=" Anno , " ;
       $group_order="GROUP BY Anno ORDER BY Anno";

    break;
   case "prod_gasto_tipo":
       
       $select_PPAL=" tipo_subcentro , " ;
       $select_PPAL_Union=" tipo_subcentro , " ;
       
//       $select_prod_origen=" 0 as prod_origen, 0 as gastos_origen," ;
//       $select_prod_origen_Union=" SUM(prod_origen) as prod_origen2 , SUM(gastos_origen) as gastos_origen , 'juan' as boon2 , " ;
       
       $group_order="GROUP BY tipo_subcentro ORDER BY tipo_subcentro ";
//       $union_sql4=1;

    break;


   }
  
 // componemos los SQL para las prod_gasto*  
if (like($agrupar,'prod_gasto%'))
{
     // sql produccion
     $sql1=" (SELECT $select_PPAL SUM(importe)*COEF_BAJA*(1+GG_BI) as importe_prod,SUM(gasto_est) as gasto_est, $select_prod_origen "
           . " SUM(importe)*COEF_BAJA*(1+GG_BI)-SUM(gasto_est) as benef_est , 1-SUM(gasto_est)/(SUM(importe)*COEF_BAJA*(1+GG_BI)) as margen_est, 0 AS gasto_real,"
           . " 0 AS PLAN, 0 AS VENTAS, 0 AS GASTOS_EX ,0 as Facturado, 0 as Facturado_iva, 0 as Pdte_Cobro "
            . " FROM ConsultaProd WHERE $where AND $where_fecha AND ID_PRODUCCION=id_produccion_obra $group_order ) " ;

       //sql gasto
     $sql2=" (SELECT $select_PPAL  0 as importe_prod,0 as gasto_est, $select_prod_origen "
           . " 0 as benef_est , 0 as margen_est, SUM(IMPORTE) AS gasto_real, "
             . " 0 AS PLAN, 0 AS VENTAS, 0 AS GASTOS_EX ,0 as Facturado, 0 as Facturado_iva, 0 as Pdte_Cobro   "
            . " FROM ConsultaGastos_View WHERE $where AND $where_fecha $group_order ) " ;
       
       //sql VENTAS
     $sql3=" (SELECT $select_PPAL  0 as importe_prod,0 as gasto_est, $select_prod_origen "
           . " 0 as benef_est , 0 as margen_est, 0 AS gasto_real, "
             . " SUM(PLAN) AS PLAN, SUM(IMPORTE) AS VENTAS, SUM(GASTOS_EX) AS GASTOS_EX ,0 as Facturado, 0 as Facturado_iva, 0 as Pdte_Cobro " 
            . " FROM Ventas_View WHERE $where AND $where_fecha $group_order ) " ;
       
       //sql PROD-GASTO ORIGEN
     $sql4=" (SELECT $select_PPAL  0 as importe_prod,0 as gasto_est, $select_prod_origen_sql4   "
           . " 0 as benef_est , 0 as margen_est, 0 AS gasto_real, "
             . " 0 AS PLAN,0 AS VENTAS, 0 AS GASTOS_EX ,Facturado,Facturado_iva,Pdte_Cobro " 
            . " FROM Obras_View WHERE $where $group_order ) " ;
     
     $union_all_sql4 =  $union_sql4 ?  " UNION ALL ". $sql4 : "" ;
    
     $sql= "SELECT $select_PPAL_Union ' ' as ID_TH_COLOR, SUM(importe_prod) as importe_prod "
             . " , SUM(gasto_real) AS gasto_real,SUM(importe_prod)- SUM(gasto_real) AS benef_real , 1-SUM(gasto_real)/SUM(importe_prod) as margen_real "
             . " ,' ' as ID_TH_COLOR1, $select_prod_origen_Union "
             . "  ' ' as ID_TH_COLOR2,SUM( gasto_est) AS gasto_est ,SUM(benef_est) AS benef_est ,  1-SUM(gasto_est)/SUM(importe_prod) as margen_est , "
             . " ' ' as ID_TH_COLOR3, SUM(PLAN) AS PLAN, SUM(VENTAS) AS VENTAS, SUM(GASTOS_EX) AS GASTOS_EX ,  SUM(VENTAS)-SUM(GASTOS_EX) AS Beneficio, "
             . " (SUM(VENTAS)-SUM(GASTOS_EX))/SUM(VENTAS) as Margen"
             . "  ,SUM(Facturado) as Facturado, SUM(Facturado_iva) as Facturado_iva, SUM(Pdte_Cobro) as Pdte_Cobro  "
             . " FROM (" . $sql1 ." UNION ALL ". $sql2 ." UNION ALL ". $sql3 . $union_all_sql4 ."  ) X $group_order" ; 
     
//        echo $sql ;
     $sql_T= "SELECT '' as ID_OBRA, 'Suma...' , SUM(importe_prod) as importe_prod "
             . ", SUM(gasto_real) AS gasto_real,SUM(importe_prod)- SUM(gasto_real) AS benef_real , 1-SUM(gasto_real)/SUM(importe_prod) as margen_real "
             . ",$select_prod_origen_Union_T SUM( gasto_est) AS gasto_est ,SUM(benef_est) AS benef_est ,  1- SUM(gasto_est)/SUM(importe_prod) as margen_est ,"
             . "  SUM(PLAN) AS PLAN, SUM(VENTAS) AS VENTAS, SUM(GASTOS_EX) AS GASTOS_EX,  SUM(VENTAS)-SUM(GASTOS_EX) AS Beneficio, (SUM(VENTAS)-SUM(GASTOS_EX))/SUM(VENTAS) as Margen   "
             . " FROM (" . $sql1 ." UNION ALL ". $sql2 ." UNION ALL ". $sql3 . $union_all_sql4 .") X " ; 

   
}       
   
 
/// pruebas
//$links["importe_prod"] = ["../obras/obras_prod_detalle.php?$cadena_link_periodo&agrupar=udos&id_produccion=", "id_produccion_obra", "Abrir la PRODUCCION OBRA "] ;
//$links["gasto_real"] = ["../obras/gastos.php?$cadena_link_periodo", "", "Abrir los Gastos "] ;
//$links["benef_real"] = ["../obras/obras_prod_detalle.php?$cadena_link_periodo&agrupar=balance&id_produccion=", "id_produccion_obra", "Abrir la Balance "] ;


   
$updates=['activa']  ;
$tabla_update="Obras_View" ;
$id_update="ID_OBRA" ;
$id_clave="ID_OBRA" ;


$formats["activa"] = 'boolean' ;
$formats["PLAN"] = 'moneda' ;
$formats["prod_origen"] = 'moneda' ;
$formats["gastos_origen"] = 'moneda' ;
$formats["Facturado"] = 'moneda' ;
$formats["Facturado_iva"] = 'moneda' ;
$formats["Pdte_Cobro"] = 'moneda' ;
$formats["VENTAS"] = 'moneda' ; 

$aligns["Plazo"] = 'center' ;
$aligns["PRODUCCION_OBRA"] = 'center' ;

$links["NOMBRE_OBRA"] = ["../obras/obras_ficha.php?id_obra=", "ID_OBRA","abrir ficha de obra", "formato_sub"] ;
//$links["VENTAS"] = ["../obras/obras_ventas.php?id_obra=", "ID_OBRA","abrir Ventas y Facturación de obra", "formato_sub"] ;
//$links["facturado_iva"] = ["../obras/obras_ventas.php?id_obra=", "ID_OBRA","abrir Ventas y Facturación de obra", "formato_sub"] ;

$links["PRODUCCION_OBRA"] = ["../obras/obras_prod_detalle.php?id_produccion=", "id_produccion_obra", "Abrir la Produccion en el periodo seleccionado de esta Obra", "formato_sub"] ;

$links["observaciones"] = ["../bancos/pago_ficha.php?id_pago=", "id_pago", "ver pago", "formato_sub"] ;
$links["f_vto"] = ["../bancos/pago_ficha.php?id_pago=", "id_pago", "ver pago", "formato_sub"] ;
// $links["PROVEEDOR"]=["../proveedores/proveedores_ficha.php?id_proveedor=", "id_proveedor"] ;
$links["fecha_banco"]=["../bancos/pago_ficha.php?id_mov_banco=", "id_mov_banco","ver el mov. bancario del cobro", "formato_sub"] ;
$links["concepto_banco"]=["../bancos/pago_ficha.php?id_mov_banco=", "id_mov_banco","ver el mov. bancario del cobro", "formato_sub"] ;



$dblclicks=[] ;  
$dblclicks["NOMBRE_OBRA"]="Obra" ;
$dblclicks["CAPITULO"]="CAPITULO" ;
$dblclicks["UDO"]="UDO" ;
$dblclicks["Fecha"]="FECHA1" ;
$dblclicks["SUBOBRA"]="SUBOBRA" ;
$dblclicks["Semana"]="Semana" ;
$dblclicks["Mes"]="Mes" ;
$dblclicks["Anno"]="Anno" ;

//$formats["Estudio_coste"] = "text_edit" ;
//$formats["COSTE_EST"] = "text_moneda" ;
$tooltips["importe_prod"] = "Importe producido en la Obra en el periodo seleccionado" ;
//$formats["margen"] = "porcentaje" ;
//$formats["P_ejec"] = "porcentaje" ;
$formats["Pdte_Cobro"] = "moneda" ;
$formats["Facturado_iva"] = "moneda" ;
$formats["Estudio_Costes_inicial"] = "moneda" ;
$etiquetas["Porcentaje_Plazo"] = "% plazo" ;
$etiquetas["Porcentaje_ejecutado"] = "% ejecutado" ;
//$formats["COSTE"] = "moneda" ;
////$formats["COSTE_EST"] = "text_edit" ;
//$formats["MED_PROYECTO"] = "fijo" ;
//$formats["MEDICION"] = "fijo" ;
////$formats["fecha"] = "dbfecha" ;
////$formats["conc"] = "boolean" ;
//$formats["PRECIO"] = "moneda" ;
//$formats["exceso"] = "semaforo_OK" ;
////$formats["ingresos"] = "moneda" ;
//$aligns["leyenda_beneficio"] = "right" ;
////$aligns["Neg"] = "center" ;
//$aligns["Pagada"] = "center" ;
//$tooltips["conc"] = "Indica si el pago está conciliado" ;
//$tooltips["Banco_Neg"] = "Indica el banco o línea de descuento donde está negociada" ;

//$cols_string=["NOMBRE_OBRA"] ;
$chart_ocultos=["T"] ;

 //$links["CAPITULO"] = ["../obras/obras_ficha.php?id_obra=", "ID_OBRA"] ;
//echo $sql ;
//echo $sql_T ;
//echo $sql ;
//echo $sql ;

$result=$Conn->query($sql) ;

echo "<div class='noprint'>Filas: {$result->num_rows} <br></div>" ;
//echo $sql ;

if (isset($sql_T)) {$result_T=$Conn->query($sql_T) ; }    // consulta para los TOTALES
if (isset($sql_T2)) {$result_T2=$Conn->query($sql_T2) ; }    // consulta para los TOTALES
if (isset($sql_T3)) {$result_T3=$Conn->query($sql_T3) ; }    // consulta para los TOTALES
if (isset($sql_S)) {$result_S=$Conn->query($sql_S) ; }     // consulta para los SUBGRUPOS , agrupación de filas (Ej. CLIENTES o CAPITULOS en listado de udos)

//$links["NOMBRE_OBRA"] = ["../obras/obras_ficha.php?id_obra=", "ID_OBRA"] ;
//
//if (!$listado_global)
//{
////$links["UDO"] = ["../obras/udo_prod.php?id_produccion=$id_produccion&id_udo=", "ID_UDO","ver detalles de medición de la Unidad de Obra" ,"formato_sub"] ;    
//$links["UDO"] = ["../obras/udo_prod.php?id_produccion=$id_produccion&id_udo=", "ID_UDO" ,"ver detalles de medición de la Unidad de Obra", 'formato_sub'] ;    
//}    
//else
//{
//$links["UDO"] = ["../obras/udo_prod.php?id_udo=", "ID_UDO", "ver ficha de la unidad de obra", "formato_sub"] ;  
//$links["PRODUCCION"]=["../obras/obras_prod_detalle.php?id_produccion=", "ID_PRODUCCION"] ;
//
//}    
//    
//$links["NOMBRE_OBRA"]=["../obras/obras_ficha.php?id_obra=", "ID_OBRA"] ;
//
//


//$titulo="<small>Produccion por $agrupar</small>";

$tabla_expandible=0;
$msg_tabla_vacia="No hay.";
$titulo="";

if (isset($col_sel))  echo $content_sel ;           // si hay columna de SELECTION pinto el div con los botones acciones de selection
if (isset($fmt_anadir_med))  echo $content_anadir_med ;           // si hay columna de SELECTION pinto el div con los botones acciones de selection

echo '</form>' ;

if ($tipo_tabla=='group')
{ require("../include/tabla_group.php"); }
else if ($tipo_tabla=='pdf')
{ require("../include/tabla_pdf.php"); }
else if ($tipo_tabla=='calendar')
{ require("../include/tabla_calendar.php"); }
else 
{ require("../include/tabla.php"); echo $TABLE ; }
    


?>
 <script>

//function prod_anade_med_udo(id_produccion)
//{  // añade la medicion de los INPUT a cada UDO
//
//    //    alert(id_produccion);
////     var nuevo_valor=window.confirm("¿Completar mediciones de UDO hasta MED_PROYETO? ");
////    alert("el nuevo valor es: "+valor) ;
//
//// contruimos el array_str de pares (ID_UDO, MEDICION)
//var array_str="" ;
// $('table input:text').each(
//    function() {
//        
////        array_str+=  $(this).attr('id') + '&' + $(this).val() ;
//        var id=$(this).prop('id') ;
//        
//        if (id.substring(0,4)=='UDO_')
//        {
//            
//          var id_udo=id.substring(4)  ;
////          if (id_udo==72152) $(this).val('123') ;
//          var medicion=$(this).val()  ;
//          if (medicion)
//          {
//              if (!(array_str=="" )) { array_str+= ";" } ;  // inserto el separador de filas
//              array_str+=  id_udo + '&' + medicion ;         // inserto la fila, el par de datos
//          } 
//        }
//    }
//  );
//  
////  array_str+= ")"  ;
//  
////  alert(array_str);  // debug
//  
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//    if (this.readyState == 4 && this.status == 200) {
//        if (this.responseText.substr(0,5)=="ERROR")
//        { alert(this.responseText) ;}                   // mostramos el ERROR
//        else
//        {  //alert(this.responseText) ;     //debug
//           location.reload(true); }  // refresco la pantalla tras edición
//      }
//  };
//  
////  $cadena_link="tabla=$tabla_update&wherecond=$id_update=".$rs["$id_update"] ; 
//
//  xhttp.open("GET", "../obras/prod_add_detalle_ajax.php?id_produccion=" + id_produccion + "&array_str=" + encodeURIComponent(array_str) , true);
//  xhttp.send();   
////    alert(table_selection_IN());
//  
//    
//  return ;  
//        
//}
//     
//function sel_borrar_mediciones_detalle()
// { 
//
//    var nuevo_valor=window.confirm("¿Borrar fila? ");
////    alert("el nuevo valor es: "+valor) ;
//   if (!(nuevo_valor === null) && nuevo_valor)
//   { 
//       
//       var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//    if (this.readyState == 4 && this.status == 200) {
//        if (this.responseText.substr(0,5)=="ERROR")
//        { alert(this.responseText) ;}                   // mostramos el ERROR
//        else
//        {  //alert(this.responseText) ;     //debug
//           location.reload(true); }  // refresco la pantalla tras edición
//      }
//  };
//  
////  $cadena_link="tabla=$tabla_update&wherecond=$id_update=".$rs["$id_update"] ; 
//
//  xhttp.open("GET", "../include/tabla_delete_row_ajax.php?tabla=PRODUCCIONES_DETALLE&wherecond=id IN " + table_selection_IN() , true);
//  xhttp.send();   
//   }
//   else
//   {return;}
// 
//}
//
//function prod_completa_udo(id_produccion)
//{
////    alert(id_produccion);
////     var nuevo_valor=window.confirm("¿Completar mediciones de UDO hasta MED_PROYETO? ");
////    alert("el nuevo valor es: "+valor) ;
//
//  
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//    if (this.readyState == 4 && this.status == 200) {
//        if (this.responseText.substr(0,5)=="ERROR")
//        { alert(this.responseText) ;}                   // mostramos el ERROR
//        else
//        {  //alert(this.responseText) ;     //debug
//           location.reload(true); }  // refresco la pantalla tras edición
//      }
//  };
//  
////  $cadena_link="tabla=$tabla_update&wherecond=$id_update=".$rs["$id_update"] ; 
//
//  xhttp.open("GET", "../obras/prod_completa_udo_prod.php?id_produccion=" + id_produccion + "&table_selection_IN=" + table_selection_IN() , true);
//  xhttp.send();   
////    alert(table_selection_IN());
//  
//    
//  return ;  
//}
//
//function borrar_mediciones_udo(id_produccion)
// { 
//
//    var nuevo_valor=window.confirm("¿Borrar filas? ");
////    alert("el nuevo valor es: "+valor) ;
//   if (!(nuevo_valor === null) && nuevo_valor)
//   { 
//       
//       var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//    if (this.readyState == 4 && this.status == 200) {
//        if (this.responseText.substr(0,5)=="ERROR")
//        { alert(this.responseText) ;}                   // mostramos el ERROR
//        else
//        {  //alert(this.responseText) ;     //debug
//           location.reload(true); }  // refresco la pantalla tras edición
//      }
//  };
//  
////  $cadena_link="tabla=$tabla_update&wherecond=$id_update=".$rs["$id_update"] ; 
//
//  xhttp.open("GET", "../include/tabla_delete_row_ajax.php?tabla=PRODUCCIONES_DETALLE&wherecond=ID_PRODUCCION=" + id_produccion +" AND ID_UDO IN " + table_selection_IN() , true);
//  xhttp.send();   
//   }
//   else
//   {return;}
// 
//}
//     
//     
//     
//     
//function add_detalle( id_produccion, id_udo, med_proyecto ) {
//    var nuevo_valor=window.prompt("Medición", med_proyecto);
////    alert("el nuevo valor es: "+valor) ;
//   if (!(nuevo_valor === null) )
//   { 
//       
//       var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//    if (this.readyState == 4 && this.status == 200) {
//        if (this.responseText.substr(0,5)=="ERROR")
//        { alert(this.responseText) ;}                   // mostramos el ERROR
//        else
//        { //alert(this.responseText) ;       //debug
//          location.reload(true) ; }  // refresco page
//        
//      //document.getElementById("sugerir_obra").innerHTML = this.responseText;
//      }
//  };
//  xhttp.open("GET", "../obras/prod_add_detalle_ajax.php?id_produccion="+id_produccion+"&id_udo="+id_udo+"&medicion="+nuevo_valor, true);
//  xhttp.send();   
//   }
//   else
//   {return;}
//   
//}
//
// function copy_prod_consulta(id_obra,id_produccion,where,produccion0) {
////    var d = new Date();
////    var f=d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate() ;
//     var produccion=window.prompt("Nombre de la nueva producción: ", produccion0  );
//
////    where=encodeURI(where) ;
//    alert(where) ;
//
//    
//   if (produccion)
//   {    
//       var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//    if (this.readyState == 4 && this.status == 200) {
//        if (this.responseText.substr(0,5)=="ERROR")
//        { alert(this.responseText) ;}
//        else
//        {  //alert(this.responseText) ;     //debug
//            location.reload(true); }  // refresco la pantalla tras editar Producción
//      }
//  };
//  xhttp.open("GET", "../obras/prod_copy_ajax.php?id_obra="+id_obra+"&id_produccion="+id_produccion+"&where="+where+"&produccion="+produccion, true);
//  xhttp.send();   
//   }  
//    //alert("el nuevo valor es: "+ fecha) ;
//   
//   return ;
//   
//   
//}

</script>   
   
</div>

<!--************ FIN  *************  -->
	
	

<?php  

$Conn->close();

?>
	 

</div>

<?php require '../include/footer.php'; ?>
</BODY>
</HTML>

