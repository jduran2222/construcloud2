<?php 
require_once("../include/session.php"); 
$where_c_coste=" id_c_coste={$_SESSION['id_c_coste']} " ;

 //echo "El filtro es:{$_GET["filtro"]}";

 require_once("../../conexion.php");
 require_once("../include/funciones.php");

// logs("Ejecutamos sql.php")	;
 
$code=isset($_GET["code"])? $_GET["code"] : 0   ;

if (is_encrypt2($_GET["sql"]))       
{ 
    // está encriptada, la desencriptamos
   $sql= decrypt2($_GET["sql"])  ;
   logs("sql.php line 18: $sql")	;
//   echo $sql;
   
}elseif ($code)
{
  // no está encriptada, pero tiene el antiguo sistema de código  
  $sql=base64_decode($_GET["sql"])  ;  
 
}
else
{   // no tiene ningún sistema de código, la mantenemos por COMPATIBILIDAD , pero hay que terminar eliminándola
//    $sql=$_GET["sql"]  ;
     logs( "SQL.PHP . ERROR SENTENCIA SQL SIN ENCRIPTAR:<BR> $sql" ) ;
     logs_db( "SQL.PHP . ERROR SENTENCIA SQL SIN ENCRIPTAR:<BR> $sql" , "cc_error") ;
     cc_die( "ERROR SENTENCIA SQL SIN ENCRIPTAR AVISAR A ADMINISTRADOR:<BR> $sql" ) ;
//     echo ( "ERROR SENTENCIA SQL SIN ENCRIPTAR AVISAR A ADMINISTRADOR:<BR> $sql" ) ;
     
    
}    
 
// vemos si hay variable1
$var_sql1= isset($_GET["variable1"]) ? $_GET["variable1"] : (isset($_GET["var_sql1"]) ? $_GET["var_sql1"] : '' ) ;
$var_sql2= isset($_GET["variable2"]) ? $_GET["variable2"] : (isset($_GET["var_sql2"]) ? $_GET["var_sql2"] : '' ) ;
$var_sql3= isset($_GET["variable3"]) ? $_GET["variable3"] : (isset($_GET["var_sql3"]) ? $_GET["var_sql3"] : '' ) ;

if ($var_sql1)
{
    $sql= str_replace('_VARIABLE1_', $var_sql1, $sql)  ;
    $sql= str_replace('_VAR_SQL1_', $var_sql1, $sql)  ;
 } 
// probamos si hay una segunda variable
if ($var_sql2)
{
    $sql= str_replace('_VARIABLE2_', $var_sql2, $sql)  ;
    $sql= str_replace('_VAR_SQL2_', $var_sql2, $sql)  ;
}    
if ($var_sql3)
{
    $sql= str_replace('_VARIABLE3_', $var_sql3, $sql)  ;
    $sql= str_replace('_VAR_SQL3_', $var_sql3, $sql)  ;
}    
     



 
 //$result = $Conn->query($sql);
 logs("Ejecutamos: $sql")	;
  
$error_txt=""; 
$array_sql=  explode("_CC_NEW_SQL_", $sql);       // cambiamos el caracter ; punto y coma por esta cadena _CC_NEW_SQL_ para separar varias consultas SQL
foreach ($array_sql as $sql_item) {
  // ejecutamos las sentencias SQL $sql_item
  if (trim($sql_item)!='') {$error_txt.= !($Conn->query($sql_item)) ? "ERROR : $sql_item  \n" : ""  ;}
}

 
 
// if ($Conn->multi_query($sql)) 
 if (!$error_txt) 
  { 
     // todo OK
    // echo "OK" ;
 echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";

  }  
   else
   { 
       //echo "___ERROR___" ;                           // mando mensaje de error
//       echo "ERROR : $sql" ;
      $id_log_db= logs_db( "ERROR en SQL.PHP: $error_txt" , 'cc_error');
       echo $_SESSION["admin"] ? "ERROR en SQL.PHP: id_log_db: $id_log_db, SQL: $error_txt" : "ERROR en SQL.PHP avise administrador. LOG_DB $id_log_db" ;

//       echo $error_txt ;
   }	  
 $Conn->close();



?>