<?php 
require_once("../include/session.php"); 
$where_c_coste=" id_c_coste={$_SESSION['id_c_coste']} " ;

 //echo "El filtro es:{$_GET["filtro"]}"; 

$id_obra=$_GET["id_obra"]  ;
$solo_udo_vacias= isset($_GET["solo_udo_vacias"]) ? $_GET["solo_udo_vacias"] : '' ;


require_once("../../conexion.php");
require_once("../include/funciones.php");
 

//if ($id_obra=Dfirst("ID_OBRA", 'OBRAS', "ID_OBRA=$id_obra AND $where_c_coste"))    
if ($rs=Drow( 'OBRAS', "ID_OBRA=$id_obra AND $where_c_coste"))    
{
    
//   $id_prod_estudio_costes = Dfirst("id_prod_estudio_costes", "OBRAS", "ID_OBRA=$id_obra AND $where_c_coste  ")  ;
   $id_obra = $rs["ID_OBRA"] ; // confirmacion de SEGURIDAD
   $id_prod_estudio_costes = $rs["id_prod_estudio_costes"] ;
   $id_subobra_auto = $rs["id_subobra_auto"] ;
  
   $sql= "DELETE FROM `PRODUCCIONES_DETALLE`  WHERE ID_PRODUCCION='$id_prod_estudio_costes' "  ;     // vaciamos la id_produccion_estudio_coste solamente, las otras RV , por seguridad, deben de hacerlo manualmente    
   $Conn->query($sql) ;
  
//   $solo_udo_vacias_where= $solo_udo_vacias ? " AND MED_PROYECTO=0 " : ""  ;   
   
   if($solo_udo_vacias)
   {    
       $sql= "DELETE FROM `Udos`  WHERE ID_OBRA=$id_obra  AND MED_PROYECTO=0 "  ;     // ejecuto DELETE
       $Conn->query($sql) ;

       $sql= "DELETE FROM `Capitulos`  WHERE ID_OBRA=$id_obra AND (ID_CAPITULO NOT IN (SELECT DISTINCT ID_CAPITULO FROM Udos WHERE ID_OBRA=$id_obra )) "  ;     // ejecuto DELETE
       logs( "SQL CAPITULOS:" . $sql ) ;
       logs( "SQL CAPITULOS:" . $Conn->query($sql) ) ;

       $sql= "DELETE FROM `SubObras`  WHERE ID_OBRA=$id_obra AND ID_SUBOBRA<>'$id_subobra_auto' AND ID_SUBOBRA NOT IN (SELECT DISTINCT  ID_SUBOBRA FROM Udos WHERE ID_OBRA=$id_obra)"  ;     // ejecuto DELETE
       $Conn->query($sql) ;

    }else
    {
        
       $sql= "DELETE FROM `Udos`  WHERE ID_OBRA=$id_obra "  ;     // ejecuto DELETE
       if (!($Conn->query($sql)))   // si hay errores vamos a borrar una a una las UDOS 
       {
           $array_udos= DArray("ID_UDO", "Udos", "ID_OBRA='$id_obra'" ) ;
           foreach ($array_udos as $id_udo) {
                      $sql= "DELETE FROM `Udos`  WHERE ID_UDO='$id_udo[0]'"  ;     // ejecuto DELETE
                      $Conn->query($sql) ;
           }

       }    

       $sql= "DELETE FROM `Capitulos`  WHERE ID_OBRA=$id_obra "  ;     // ejecuto DELETE
      if (!($Conn->query($sql)))   // si hay errores vamos a borrar una a una las UDOS 
       {
           $array_capitulos= DArray("id_capitulo", "Capitulos", "ID_OBRA='$id_obra'" ) ;
           foreach ($array_capitulos as $id_capitulo) {
                      $sql= "DELETE FROM `Capitulos`  WHERE ID_CAPITULO='$id_capitulo[0]'"  ;     // ejecuto DELETE
                      $Conn->query($sql) ;
           }

       }    

       $sql= "DELETE FROM `SubObras`  WHERE ID_OBRA=$id_obra AND ID_SUBOBRA<>'$id_subobra_auto' "  ;     // ejecuto DELETE
      if (!($Conn->query($sql)))   // si hay errores vamos a borrar una a una las UDOS 
       {
           $array_subobra= DArray("ID_SUBOBRA", "SubObras", "ID_OBRA='$id_obra'   AND ID_SUBOBRA<>'$id_subobra_auto' " ) ;
           foreach ($array_subobra as $id_subobra) {
                      $sql= "DELETE FROM `SubObras`  WHERE ID_SUBOBRA='$id_subobra[0]'"  ;     // ejecuto DELETE
                      $Conn->query($sql) ;
           }

       }    
    }
}
else
{
    echo cc_page_error( 'ERROR: Obra no encontrada al tratar de borrar PROYECTO') ;
}   
//echo "<script languaje='javascript' type='text/javascript'>window.close();</script>"; 


?>