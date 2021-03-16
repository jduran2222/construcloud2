

<?php 


$id_usuario_LRU = isset($id_usuario_LRU) ? $id_usuario_LRU : $_SESSION["id_usuario"] ;
$limite_LRU = isset($limite_LRU) ? $limite_LRU : 30 ;

$sql="SELECT id_entidad, tipo_entidad, entidad, MAX(fecha_creacion) AS fecha, CONCAT('tipo_entidad=',tipo_entidad,'&id_entidad=' "
        . ",id_entidad) as id_entidad_link FROM LRU_entidad WHERE  id_usuario='$id_usuario_LRU' AND $where_c_coste "
                          . " GROUP BY tipo_entidad , id_entidad  ORDER BY   fecha DESC LIMIT $limite_LRU";
//$result=$Conn->query($sql);

$updates=[] ;

//$links["Tarea"] = ["../agenda/tarea_ficha.php?id=", "id",'', 'formato_sub'] ;

$links["entidad"] =["../include/ficha_entidad.php?", "id_entidad_link", "ver entidad  (Obra, Factura, albarán, ...)", 'formato_sub'] ;


//$formats["Terminada"]='boolean' ;
//$formats["Texto"]='text_edit' ;
//$formats["fecha_creacion"]='fecha_friendly' ;
$formats["fecha"]='fecha_friendly' ;
//$formats["no_conforme"]='semaforo_not' ;

//$tabla_update="Tareas" ;
//$id_update="id" ;
//  $id_valor=$id_pago ;
//$actions_row["id"]="id";
//$actions_row["delete_link"]="1";
//$actions_row["delete_confirm"]=1;
        
$titulo="Mis consultas..." ;       
$msg_tabla_vacia="No hay últimas consultas";

$table_button=False;
$chart_button=False;

//$tabla_style=" style='font-size:xx-small;' " ;
$tabla_style=" style='font-size:xx-small;' " ;

require("../include/tabla_ajax.php"); echo $TABLE ;  // LRU
 



 
 ?>


