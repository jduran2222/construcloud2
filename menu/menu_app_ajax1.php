<?php
require_once("../include/session.php");
$where_c_coste = " id_c_coste={$_SESSION['id_c_coste']} ";
$id_c_coste = $_SESSION['id_c_coste'];
require_once("../../conexion.php");
require_once("../include/funciones.php");

//$dir_raiz = $_SESSION["dir_raiz"];


    $no_cargado = '<span style=color:red; title=No_Cargado_a_obra> (NC)</span>';
    $fecha = date('Y-m-d');

    $sql = "SELECT ID_PARTE, ID_OBRA, CONCAT(MID(NOMBRE_OBRA,1,20),'...') as NOMBRE_OBRA,Fecha,' ' as a1,NumP,' ' as br,(NumV) AS Num_otros_alb, "
            . "' ' as br7, NumProd, ' ' as br3, fotos,IF(Cargado,'','$no_cargado') as no_cargado "
            . " FROM Partes_ViewC WHERE Fecha='$fecha' AND $where_c_coste ORDER BY NOMBRE_OBRA   ";

    $result = $Conn->query($sql);

    $partes_hoy_html = '<p style="font-size: 60px;width:100%; height:150px;">Partes de hoy:</p>';

    if ($result->num_rows > 0)
    {
        while ($rs = $result->fetch_array(MYSQLI_ASSOC))
        {
            $partes_hoy_html .= "<a class='btn btn-default' style='font-size: 60px;width:62%; height:180px;' href='../personal/parte.php?id_parte={$rs["ID_PARTE"]}' "
                    . " target='_blank' >{$rs["NOMBRE_OBRA"]}<br>"
                    ."<span style='font-size: 40px'>". cc_format($rs["NumP"], 'icon_usuarios')
                    . cc_format($rs["Num_otros_alb"], 'icon_albaranes')
                    . cc_format($rs["fotos"], 'icon_fotos')
                    . cc_format($rs["NumProd"], 'icon_produccion')
                    . "{$rs["no_cargado"]}</span></a>  ";

                    //../proveedores/albaran_anadir.php?id_obra='+id_obra+'&id_proveedor='+id_proveedor+'&fecha='+fecha+'&ref='+ref+'&importe='+importe+'&add_foto='+add_foto
            $partes_hoy_html .= "<a class='btn btn-default' style='font-size: 80px;width:12%; height:180px;' "
                    . " href='../proveedores/albaran_anadir.php?id_obra={$rs["ID_OBRA"]}&fecha=$fecha&add_foto=1' "
                    . " target='_blank' ><span class='glyphicon glyphicon-tags'></span></a>";
            $partes_hoy_html .= "<a class='btn btn-default' style='font-size: 80px;width:12%; height:180px;' "
                    . " href='../documentos/doc_upload_multiple_form.php?tipo_entidad=obra_foto&id_entidad={$rs["ID_OBRA"]}&fecha_doc=$fecha' "
                    . " target='_blank' ><span class='glyphicon glyphicon-camera'></span></a>";
            $partes_hoy_html .= "<a class='btn btn-default' style='font-size: 80px;width:12%; height:180px;' "
                    . " href='../obras/obras_ficha.php?id_obra={$rs["ID_OBRA"]}' "
                    . " target='_blank' ><span class='glyphicon glyphicon-road'></span></a>";
            $partes_hoy_html .= "<br>";
        }
    } else
    {
        $partes_hoy_html .= '<p>no hay Partes</p>';
    }




   $partes_hoy_html .="<br><a target='_blank' class='btn btn-link' style='font-size: 60px;width:100%; height:150px;' "
                   . "  href='../personal/parte_anadir_form_app.php'  ><i class='fas fa-plus-circle'></i> añadir Parte</a>" ;


  echo $partes_hoy_html ;

  ?>