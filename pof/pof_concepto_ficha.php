<?php
// cambios
require_once("../include/session.php");
$where_c_coste = " id_c_coste={$_SESSION['id_c_coste']} ";
$id_c_coste = $_SESSION['id_c_coste'];

$titulo = 'PoF Concepto';

//INICIO
include_once('../templates/_inc_privado1_header.php');
include_once('../templates/_inc_privado2_navbar.php');

?>

        <!-- Contenido principal 
        <div class="container-fluid bg-light">
            <div class="row">
                <!--****************** ESPACIO LATERAL  *****************
                <div class="col-12 col-md-4 col-lg-3"></div>
                <!--****************** ESPACIO LATERAL  *****************

                <!--****************** BUSQUEDA GLOBAL  *****************
                <!--<div class="col-12 col-md-4 col-lg-9">-->


<?php 


$id=$_GET["id"];
 

?>
	

  <?php              // DATOS   FICHA . PHP
 //echo "<pre>";
// $result=$Conn->query($sql="SELECT *  FROM POF_DETALLE WHERE id=$id AND $where_c_coste");
 $result=$Conn->query($sql="SELECT id,ID_POF,NUMERO,NOMBRE_POF,CONCAT(NUMERO,'-',NOMBRE_POF ) AS NOMBRE_POF_NUM,   CANTIDAD,CONCEPTO,DESCRIPCION,Precio_Cobro,id_udo,NOMBRE_OBRA,ID_OBRA,user,fecha_creacion"
         . "  FROM POF_concepto_View WHERE id=$id  AND $where_c_coste");
 $rs = $result->fetch_array(MYSQLI_ASSOC) ;
 
 $id_pof=$rs["ID_POF"] ;
 
 $id=$rs["id"] ;

$id_obra=$rs["ID_OBRA"] ;
$nombre_obra=$rs["NOMBRE_OBRA"] ;
$id_udo=$rs["id_udo"] ;

 require_once("../obras/obras_menutop_r.php");   // metemos el menu OBRAS despues de declarar la variables $id_obra
 
//  $titulo="Concepto de POF: <b>{$rs["CONCEPTO"]}</b><br>(POF:{$rs["NUMERO"]}-{$rs["NOMBRE_POF"]})" ;
  $titulo="<br> Concepto: <b>{$rs["CONCEPTO"]}</b><br>POF:{$rs["NUMERO"]}-{$rs["NOMBRE_POF"]}" ;
  
//  $links["PROVEEDOR"]=["../proveedores/proveedores_ficha.php?id_proveedor=", "ID_PROVEEDORES"] ;
//  $links["RAZON_SOCIAL"]=["../proveedores/proveedores_ficha.php?id_proveedor=", "ID_PROVEEDORES"] ;
//  

  
//  $selects["ID_PROVEEDORES"]=["ID_PROVEEDORES","PROVEEDOR","Proveedores"] ;   // datos para clave foránea

    $updates=["DESCRIPCION",'CANTIDAD','CONCEPTO','Precio_Cobro','Precio_Compra','id_udo']  ;
    $ocultos=["NUMERO", "NOMBRE_POF"];
    
  
  
  $tabla_update="POF_CONCEPTOS" ;
  $id_update="id" ;
  $id_valor=$id ;
  $delete_boton=1;

  $links["NOMBRE_POF_NUM"] = ["../pof/pof.php?id_pof=", "ID_POF",'abrir Peticion de Oferta' ,'formato_sub'] ;
  $etiquetas["NOMBRE_POF_NUM"]='NOMBRE POF';

  $formats["DESCRIPCION"]="text_edit" ;
  $formats["Ocultar"]="boolean" ;
  $selects["id_udo"]=["ID_UDO","UDO","Udos_View","","../obras/udo_prod.php?id_udo=","id_udo","AND ID_OBRA=$id_obra"] ;   // datos para clave foránea
  $etiquetas["id_udo"]='UDO vinculada';
  $tooltips["id_udo"]="Unidad de Obra (UDO) del Proyecto para la que es necesario este concepto de esta Petición de Oferta (POF {$rs["NOMBRE_POF"]})" ;

  
  ?>
  
                  
                    
  <div style="overflow:visible">	   
  <div id="main" class="mainc"> 
      
  <?PHP require("../include/ficha.php"); ?>
   
      <!--// FIN     **********    FICHA.PHP-->
 </div>
      
      
	<!-- WIDGET DOCUMENTOS  -->
	
<div class="right2">
	
<?php 

$tipo_entidad='pof_concepto' ;
$id_entidad=$id;
$id_subdir=$id_pof ;
$size='100px' ;
require("../menu/LRU_registro.php"); require("../include/widget_documentos.php");  

 ?>
	 
</div>	
	
<?php            //  div `POF  tabla.php

if ($id_udo)
{    
$sql="SELECT id,ID_POF,CONCAT(NUMERO,'-',NOMBRE_POF) AS NOMBRE_POF,CANTIDAD,CONCEPTO,Precio_Cobro "
        . " FROM  POF_concepto_View WHERE id<>$id  AND id_udo=$id_udo  AND $where_c_coste ORDER BY NUMERO   ";
//echo $sql;
$result=$Conn->query($sql );

//$sql="SELECT '','','', SUM(importe) FROM Fras_Prov_Pagos_View  WHERE ID_FRA_PROV=$id_fra_prov  AND $where_c_coste ";
////echo $sql;
//$result_T=$Conn->query($sql );

//$formats["f_vto"]='fecha';
$links["CONCEPTO"] = ["../pof/pof_concepto_ficha.php?id=", "id", "ver POF CONCEPTO",'formato_sub'] ;
$links["NOMBRE_POF"] = ["../pof/pof.php?id_pof=", "ID_POF",'abrir Peticion de Oferta' ,'formato_sub'] ;

//$aligns["importe"] = "right" ;
//$aligns["abonado"] = "center" ;
//$aligns["P_multiple"] = "center" ;
//$aligns["Importe_ejecutado"] = "right" ;

//$tooltips["abonado"] = "Pago abonado. Clickar para ver el movimiento bancario" ;
//$tooltips["P_multiple"] = "Pago múltiple. Pago para varias facturas" ;

//$titulo="<a href=\"proveedores_documentos.php?id_proveedor=$id_proveedor\">Documentos (ver todos...)</a> " ;
$titulo="Conceptos POF vinculados a la misma UDO" ;
$msg_tabla_vacia="No hay";


 echo "<div class='right2'>";
	
require("../include/tabla.php");
echo $TABLE ; 
	
echo '</div>'  ;

}

////////// fin pof relacionadas  
//
//
          // ----- div VALES  tabla.php   -----


//
////$sql="SELECT ,,,, FROM POF_CONCEPTOS  WHERE ID_POF=$id_pof  AND $where_c_coste ";
//$sql="SELECT id,CANTIDAD,CONCEPTO,DESCRIPCION,P{$id_num_prov} ,P{$id_num_prov}*CANTIDAD AS Importe FROM POF_CONCEPTOS  WHERE ID_POF=$id_pof  ";
////echo $sql;
//$result=$Conn->query($sql );
//
//$sql="SELECT '' as a,'Total' as b,'' as c,'' as c1,SUM(P{$id_num_prov}*CANTIDAD) as Importe FROM POF_CONCEPTOS  WHERE ID_POF=$id_pof  ";
////$sql="SELECT '' as a,'' as b,'' as c, SUM(importe) as importe FROM Vales_view  WHERE ID_FRA_PROV=$id_fra_prov  AND $where_c_coste ";
////echo $sql;
//$result_T=$Conn->query($sql );
//
//
// $updates=["P{$id_num_prov}" , '*']  ;
//  
//  $tabla_update="POF_CONCEPTOS" ;
//  $id_update="id" ;
//  $id_clave="id" ;
//  
//$formats["FECHA"]='fecha';
//$formats["Importe"]='moneda';
//$formats["DESCRIPCION"]='textarea';
//
//$links["CONCEPTO"] = ["../pof/pof_concepto_ficha.php?id=", "id", 'ver ficha','ppal'] ;
////$links["NOMBRE_OBRA"]=["../obras/obras_ficha.php?id_obra=", "ID_OBRA"] ;
//
////$aligns["importe"] = "right" ;
////$aligns["Pdte_conciliar"] = "right" ;
////$aligns["Importe_ejecutado"] = "right" ;
//
////$tooltips["conc"] = "Factura conciliada. Los Vales (albaranes de proveedor) suman el importe de la factura" ;
//
////$titulo="<a href=\"proveedores_documentos.php?id_proveedor=$id_proveedor\">Documentos (ver todos...)</a> " ;
//$titulo="Conceptos presupuestados" ;
//$msg_tabla_vacia="No hay conceptos";
//
//?>
	
<!--  <div class="right2"> -->
<!-- <div class="right2">
	
<?php // require("../include/tabla.php"); echo $TABLE ; ?>
	 
</div>
	-->

<?php  

$Conn->close();

?>
	 

</div>

                </div>
                <!--****************** BUSQUEDA GLOBAL  *****************
            </div>
        </div>
        <!-- FIN Contenido principal -->
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php 

//FIN
include_once('../templates/_inc_privado3_footer.php');