<?php 

if(!$modal_ajax)
{        
//incluimos códigos y datos de cálculo y consultas para el menú superior
include_once('../templates/_inc_privado2_1_topbar.php');
include_once('../include/funciones_js.php');
?>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light navbar-fixed-top text-sm noprint">
    <!-- Left navbar links -->
    <input id="auxiliar" type="hidden">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"  onclick="cargar_ajax('auxiliar','../menu/menu_lateral_collapse_ajax.php');">
          <i class="fas fa-bars"></i>
        </a>
      </li>
    </ul>


    <ul class="navbar-nav ml-auto">

<!--       <li class="nav-item d-inline-block p-1 border-left">
        <a href="#" class="p-1 px-1 px-sm-2 btn btn-success btn-xs" title="Refrescar" onclick='javascript:window.location.reload();'>
          <i class="fas fa-redo"></i>
          <span class="d-none d-sm-inline">Refrescar</span>
        </a>
      </li>
      <li class="nav-item d-inline-block p-1">
        <a href="#" class="p-1 px-1 px-sm-2 btn btn-warning btn-xs" title="Cerrar" onclick="javascript:window.close();">
          <i class="far fa-window-close"></i>
          <span class="d-none d-sm-inline">Cerrar</span>
        </a>
      </li> -->

      <!-- Grupo 1 -->

      <li class="nav-item d-inline-block border-left">
        <a id="btn_empresa" href="../agenda/portafirmas.php" class="px-1 px-sm-2 btn btn-link" title="Realizar firma" target='_blank'>
          <i class="fas fa-pen-nib"></i>
          <span class="d-none d-sm-inline">PortaFirmas</span> 
          <?php 
            echo "<sup class='small px-0 px-sm-1'>".badge($portafirmas,'danger')."</sup>";
          ?> 
        </a>
      </li>

      <li class="nav-item d-inline-block">
        <a id="btn_empresa" href="../agenda/tareas.php" target="_blank" class="px-1 px-sm-2 btn btn-link" title="Tareas">
          <i class="fa fa-server"></i>
          <span class="d-none d-sm-inline">Tareas</span> 
          <?php 
            echo "<sup class='small px-0 px-sm-1'>". badge($tareas,'info') . badge($tareas_new,'danger') ."</sup>"  ;
          ?> 
        </a>
      </li>

      <li class="nav-item d-inline-block">
        <a id="btn_empresa" href="../agenda/eventos.php" class="px-1 px-sm-2 btn btn-link" title="Registro de Actividad de la empresa">
          <i class='fas fa-chart-line'></i>
          <span class="d-none d-sm-inline">Actividad</span> 
        </a>
      </li>

      <!-- Grupo 2 -->

      <li class="nav-item d-inline-block border-left">
        <a href="#" class="px-1 px-sm-2 btn btn-link" title="Imprimir" onclick="window.print();">
          <i class="fas fa-print"></i>
          <span class="d-none d-sm-inline">Imprimir</span> 
        </a>
      </li>

      <li class="nav-item d-sm-inline-block">
        <a href="#" class="px-1 px-sm-2 btn btn-link" title="Busqueda global" onclick="busqueda_global();">
          <i class="fas fa-search"></i>
          <span class="d-none d-sm-inline">Buscar</span>
        </a>
      </li>

      <li class="nav-item d-inline-block">
        <a id="btn_empresa" href="../chat/chat_index.php" class="px-1 px-sm-2 btn btn-link" title="Abrir Chat" target='_blank'>
          <i class="fa fa-comments"></i>
          <span class="d-none d-sm-inline">Soporte | Ayuda</span> 
          <?php 
            echo "<sup class='small px-0 px-sm-1'>".$badge_txt."</sup>";
          ?> 
        </a>
      </li>

      <!-- Grupo 3 -->
      <?php 
      //Para revisar elementos en caso de ser administrador:
        $htmlAdmin = '';
        $admin=1;
      if ($admin) {
        $htmlAdmin .= '
      <li class="nav-item d-inline-block border-left">
        <a href="../debug/debug_logs.php" class="px-1 px-sm-2 btn btn-link" target="_blank" title="Abrir debugger">
            <i class="fab fa-dyalog"></i>
            <span class="d-none d-sm-inline">Debugger</span> 
        </a>
      </li>
      <li class="nav-item d-inline-block">
        <a href="../debug/debug_reset.php" target="_blank" title="Realizar reset" class="px-1 px-sm-2 btn btn-link ">
            <i class="fas fa-registered"></i>
            <span class="d-none d-sm-inline">Reset</span> 
        </a>
      </li>';
      }
      if ($admin OR $_SESSION["admin_debug"]) {
         $htmlAdmin .= '
      <li class="nav-item d-inline-block"  style="border:none;color:silver; margin-top:6px;" >
        <span class="d-none d-sm-inline">
        Tiempo: 
        </span>
        <input style="border:none;color:silver"  type="text" id="tiempo_total" size="3">
      </li>
        ';
        echo $htmlAdmin;
      }
      ?>
      <!-- Grupo 4 -->


      <li class="nav-item d-inline-block border-left" style='overflow: hide;'>
        <!-- button with a dropdown -->
        <div class="btn-group">
          <button type="button" class="nav-item d-inline-block btn btn-link  dropdown-toggle" data-toggle="dropdown" data-offset="-52">
            <i class="fas fa-building"></i>
          <span class="d-none d-sm-inline"> <?php echo (ucwords($_SESSION["empresa"])); ?> </span>/
          <i class="far fa-user"></i>
          <span class="d-none d-sm-inline"><?php echo (ucwords($_SESSION["user"])); ?>
          <?php 
          if ($admin) {echo  "<sup class='bg-info small px-0 px-sm-1'>". (   isset($_SESSION['android']) ?  (  ( !empty($_SESSION['android'])) ? 'admin-android' :'admin-pc') :'admin-pc'  )."</sup>"; }
          ?>
          </span></button>
          <div class="dropdown-menu" role="menu">
             
            <a href="../configuracion/empresa_ficha.php"  class="dropdown-item" title='Ficha de la empresa'><i class="fas fa-building"></i> Mi empresa</a>
            <a href="<?php echo "../include/ficha_general.php?url_enc=".encrypt2("tabla=Licencias&id_update=id_licencia&no_update=1&id_valor=".$_SESSION["id_licencia"]); ?>"  title='Licencia activa'  class="dropdown-item"><i class='fas fa-key'></i> Licencia</a>
            <a href="../menu/pagina_empresas.php"  title='Cambia a otras empresas a las que el usuario pertenece' target='_blank' class="dropdown-item"><i class='fas fa-exchange-alt'></i> Cambiar empresa</a>
           <div class="dropdown-divider"></div>
            <a href="../configuracion/usuario_ficha.php"  class="dropdown-item" title='Ficha del Usuario'><i class="far fa-user"></i> Mi usuario</a>
            <a href="../registro/cerrar_sesion.php"  title='Cierra la sesión actual' class="dropdown-item"><i class='fas fa-power-off'></i> Cerrar sesión</a>
          </div>
        </div>
      </li>
    </ul>



  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 noprint">
    <!-- Brand Logo -->
    <a href="//construcloud.es" class="brand-link" target="_blank">
      <img src="../img/construcloud64.svg" alt="ConstruCloud Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><strong>Constru</strong>Cloud 2.0</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo ($path_logo_empresa); ?>_medium.jpg" class="elevation-2" alt="logo empresa usuario">
        </div>
        <div class="info">
          <a href="../menu/pagina_inicio.php" class="d-block"><?php echo ($_SESSION["empresa"] .' | '. $_SESSION["user"]); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul id="left-navbar" class="nav nav-pills nav-sidebar flex-column nav-flat nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="../menu/pagina_inicio.php" class="nav-link">
                <i class="nav-icon fa fa-home"></i>
                <p>
                  Inicio
                </p>
              </a>
            </li>

            <?php 
            $htmlMenuPermisoLicitacion = '';
            if($_SESSION["permiso_licitacion"]) {
                
                $htmlMenuPermisoLicitacion .= '<li class="nav-item has-treeview">';
                $htmlMenuPermisoLicitacion .= '  <a href="#" class="nav-link">';
                $htmlMenuPermisoLicitacion .= '    <i class="fas fa-copy nav-icon"></i>';
                $htmlMenuPermisoLicitacion .= '    <p>';
                $htmlMenuPermisoLicitacion .= '      Licitaciones';
                $htmlMenuPermisoLicitacion .= '      <i class="fas fa-angle-left right"></i>';
                $htmlMenuPermisoLicitacion .= '      <span class="badge badge-info right">'.$num_estudios.'</span>';
                $htmlMenuPermisoLicitacion .= '    </p>';
                $htmlMenuPermisoLicitacion .= '  </a>';
                $htmlMenuPermisoLicitacion .= '  <ul class="nav nav-treeview small">';
                $htmlMenuPermisoLicitacion .= '    <li class="nav-item">';
                $htmlMenuPermisoLicitacion .= '      <a href="../estudios/estudios_calendar.php?_m='.$_m.'&fecha='.date("Y-m-d").'" class="nav-link">';
                $htmlMenuPermisoLicitacion .= '        <i class="far fa-calendar-alt nav-icon"></i>';
                $htmlMenuPermisoLicitacion .= '        <p>Calendario Licit.</p>';
                $htmlMenuPermisoLicitacion .= '      </a>';
                $htmlMenuPermisoLicitacion .= '    </li>';
               if (isset($_SESSION["admin_debug"]) AND $_SESSION["admin_debug"]){ 
                $htmlMenuPermisoLicitacion .= '    <li class="nav-item">';
                $htmlMenuPermisoLicitacion .= '      <a href="#" onClick="modal_ajax_cargar(\'../estudios/estudios_calendar.php?_m='.$_m.'&fecha='.date("Y-m-d").'\');" class="nav-link">';
                $htmlMenuPermisoLicitacion .= '        <i class="far fa-calendar-alt nav-icon"></i>';
                $htmlMenuPermisoLicitacion .= '        <p>Calendario Licit2.</p>';
                $htmlMenuPermisoLicitacion .= '      </a>';
                $htmlMenuPermisoLicitacion .= '    </li>';
               $htmlMenuPermisoLicitacion .= '    <li class="nav-item">';
                $htmlMenuPermisoLicitacion .= '      <a href="#" onClick="cargar_ajax( \'div_main\',    \'../estudios/estudios_calendar.php?_m='.$_m.'&fecha='.date("Y-m-d").'\');" class="nav-link">';
                $htmlMenuPermisoLicitacion .= '        <i class="far fa-calendar-alt nav-icon"></i>';
                $htmlMenuPermisoLicitacion .= '        <p>Calendario Licit3.</p>';
                $htmlMenuPermisoLicitacion .= '      </a>';
                $htmlMenuPermisoLicitacion .= '    </li>';
               }
                $htmlMenuPermisoLicitacion .= '    <li class="nav-item">';
                $htmlMenuPermisoLicitacion .= '      <a href="../estudios/estudios_buscar.php" class="nav-link">';
                $htmlMenuPermisoLicitacion .= '        <i class="fas fa-list nav-icon"></i>';
                $htmlMenuPermisoLicitacion .= '        <p>Listado Licit.</p>';
                $htmlMenuPermisoLicitacion .= '      </a>';
                $htmlMenuPermisoLicitacion .= '    </li>';
                $htmlMenuPermisoLicitacion .= '    <li class="nav-item">';
                $htmlMenuPermisoLicitacion .= '      <a href="../estudios/ofertas_clientes.php" class="nav-link">';
                $htmlMenuPermisoLicitacion .= '        <i class="fa fa-file-invoice-dollar nav-icon"></i>';
                $htmlMenuPermisoLicitacion .= '        <p>Presupuestos</p>';
                $htmlMenuPermisoLicitacion .= '      </a>';
                $htmlMenuPermisoLicitacion .= '    </li>';
                $htmlMenuPermisoLicitacion .= '  </ul>';
                $htmlMenuPermisoLicitacion .= '</li>';
            }
            echo $htmlMenuPermisoLicitacion;
            ?>
            <?php 
            $htmlMenuPermisoObras = '';
            if($_SESSION["permiso_obras"]) {

                $htmlMenuPermisoObras .= '<li class="nav-item has-treeview">';
                $htmlMenuPermisoObras .= '  <a href="#" class="nav-link">';
                $htmlMenuPermisoObras .= '    <i class="fa fa-hard-hat nav-icon"></i>';
                $htmlMenuPermisoObras .= '    <p title="Obras, proyectos y servicios">';
                $htmlMenuPermisoObras .= '      Obras';
                $htmlMenuPermisoObras .= '      <i class="fas fa-angle-left right"></i>';
                $htmlMenuPermisoObras .= '      <span class="badge badge-info right">'.$num_obras.'</span>';
                $htmlMenuPermisoObras .= '    </p>';
                $htmlMenuPermisoObras .= '  </a>';
                $htmlMenuPermisoObras .= '  <ul class="nav nav-treeview small">';
                $htmlMenuPermisoObras .= '    <li class="nav-item">';
                $htmlMenuPermisoObras .= '      <a href="../obras/obras_buscar.php?_m='.$_m.'&tipo_subcentro=OEGA" class="nav-link">';
                $htmlMenuPermisoObras .= '        <i class="fas fa-hard-hat nav-icon"></i>';
                $htmlMenuPermisoObras .= '        <p>Obras o Proyectos</p>';
                $htmlMenuPermisoObras .= '      </a>';
                $htmlMenuPermisoObras .= '    </li>';
                $htmlMenuPermisoObras .= '    <li class="nav-item">';
                $htmlMenuPermisoObras .= '      <a href="../personal/partes.php" class="nav-link">';
                $htmlMenuPermisoObras .= '        <i class="far fa-calendar-alt nav-icon"></i>';
                $htmlMenuPermisoObras .= '        <p>Partes Diarios</p>';
                $htmlMenuPermisoObras .= '      </a>';
                $htmlMenuPermisoObras .= '    </li>';
                $htmlMenuPermisoObras .= '    <li class="nav-item">';
                $htmlMenuPermisoObras .= '      <a href="../personal/registros_view.php" class="nav-link">';
                $htmlMenuPermisoObras .= '        <i class="fas fa-signature nav-icon"></i>';
                $htmlMenuPermisoObras .= '        <p>Registro Jornada</p>';
                $htmlMenuPermisoObras .= '      </a>';
                $htmlMenuPermisoObras .= '    </li>';
                $htmlMenuPermisoObras .= '    <li class="nav-item">';
                $htmlMenuPermisoObras .= '      <a href="../obras/gastos.php?_m='.$_m.'&fecha1='.$fecha_inicio.'" class="nav-link">';
                $htmlMenuPermisoObras .= '        <i class="fas fa-shopping-cart nav-icon"></i>';
                $htmlMenuPermisoObras .= '        <p>Gastos</p>';
                $htmlMenuPermisoObras .= '      </a>';
                $htmlMenuPermisoObras .= '    </li>';
                $htmlMenuPermisoObras .= '    <li class="nav-item">';
                $htmlMenuPermisoObras .= '      <a href="../maquinaria/maquinaria_buscar.php?_m='.$_m.'&tipo_subcentro=M" class="nav-link">';
                $htmlMenuPermisoObras .= '        <i class="fas fa-truck-pickup nav-icon"></i>';
                $htmlMenuPermisoObras .= '        <p>Maquinaria</p>';
                $htmlMenuPermisoObras .= '        <span class="badge badge-info right">'.$num_maquinaria.'</span>';
                $htmlMenuPermisoObras .= '      </a>';
                $htmlMenuPermisoObras .= '    </li>';
                $htmlMenuPermisoObras .= '    <li class="nav-item">';
                $htmlMenuPermisoObras .= '      <a href="../obras/obras_view.php?_m='.$_m.'&tipo_subcentro=O&fecha1='.$fecha_inicio.'" class="nav-link">';
                $htmlMenuPermisoObras .= '        <i class="fas fa-list nav-icon"></i>';
                $htmlMenuPermisoObras .= '        <p>Gestión Obras</p>';
                $htmlMenuPermisoObras .= '      </a>';
                $htmlMenuPermisoObras .= '    </li>';
                $htmlMenuPermisoObras .= '  </ul>';
                $htmlMenuPermisoObras .= '</li>';
            }
            echo $htmlMenuPermisoObras;
            ?>
            <?php 
            $htmlMenuPermisoAdministracion = '';
            if($_SESSION["permiso_administracion"]) {

                $htmlMenuPermisoAdministracion .= '<li class="nav-item has-treeview">';
                $htmlMenuPermisoAdministracion .= '  <a href="#" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '    <i class="fa fa-coins nav-icon"></i>';
                $htmlMenuPermisoAdministracion .= '    <p>';
                $htmlMenuPermisoAdministracion .= '      Administración';
                $htmlMenuPermisoAdministracion .= '      <i class="right fas fa-angle-left"></i>';
                $htmlMenuPermisoAdministracion .= '    </p>';
                $htmlMenuPermisoAdministracion .= '  </a>';
                $htmlMenuPermisoAdministracion .= '  <ul class="nav nav-treeview small">';
                $htmlMenuPermisoAdministracion .= '    <li class="nav-item has-treeview">';
                $htmlMenuPermisoAdministracion .= '      <a href="#" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '        <i class="fa fa-cubes nav-icon"></i>';
                $htmlMenuPermisoAdministracion .= '        <p>';
                $htmlMenuPermisoAdministracion .= '          Proveedores';
                $htmlMenuPermisoAdministracion .= '          <i class="right fas fa-angle-left"></i>';
                $htmlMenuPermisoAdministracion .= '        </p>';
                $htmlMenuPermisoAdministracion .= '      </a>';
                $htmlMenuPermisoAdministracion .= '      <ul class="nav nav-treeview small">';
                $htmlMenuPermisoAdministracion .= '        <li class="nav-item">';
                $htmlMenuPermisoAdministracion .= '          <a href="../proveedores/proveedores_buscar.php" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '            <i class="fa fa-box nav-icon"></i>';
                $htmlMenuPermisoAdministracion .= '            <p>Proveedores</p>';
                $htmlMenuPermisoAdministracion .= '          </a>';
                $htmlMenuPermisoAdministracion .= '        </li>';
                $htmlMenuPermisoAdministracion .= '        <li class="nav-item">';
                $htmlMenuPermisoAdministracion .= '          <a href="../documentos/doc_upload_multiple_form.php?_m='.$_m.'&tipo_entidad=fra_prov" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '            <i class="fa fa-file-upload nav-icon"></i>';
                $htmlMenuPermisoAdministracion .= '            <p>Subir fras. proveedores</p>';
                $htmlMenuPermisoAdministracion .= '          </a>';
                $htmlMenuPermisoAdministracion .= '        </li>';
                $htmlMenuPermisoAdministracion .= '        <li class="nav-item">';
                $htmlMenuPermisoAdministracion .= '          <a href="../proveedores/facturas_proveedores.php?fecha1='.$fecha_inicio.'" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '            <i class="fa fa-file-invoice-dollar nav-icon"></i>';
                $htmlMenuPermisoAdministracion .= '            <p>Facturas Proveedores <span class="badge badge-info right">'.$num_fras_prov.'</span></p>';
                $htmlMenuPermisoAdministracion .= '          </a>';
                $htmlMenuPermisoAdministracion .= '        </li>';
                $htmlMenuPermisoAdministracion .= '        <li class="nav-item">';
                $htmlMenuPermisoAdministracion .= '          <a href="../proveedores/facturas_proveedores.php?_m='.$_m.'&id_proveedor='.$id_proveedor_auto.'" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '            <i class="fa fa-file-invoice-dollar nav-icon"></i>';
                $htmlMenuPermisoAdministracion .= '            <p>Fras prov. no registradas<span class="num_fras_prov_NC badge badge-danger right">'.$num_fras_prov_NR.'</span></p>';
                $htmlMenuPermisoAdministracion .= '          </a>';
                $htmlMenuPermisoAdministracion .= '        </li>';
                $htmlMenuPermisoAdministracion .= '        <li class="nav-item">';
                $htmlMenuPermisoAdministracion .= '          <a href="../proveedores/facturas_proveedores.php?_m='.$_m.'&conciliada=0&fecha1='.$fecha_inicio.'" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '            <i class="fa fa-file-invoice-dollar nav-icon"></i>';
                                                           $script_NC="<script>dfirst_ajax222('fra_NC' , '$sql_num_fra_prov_NC')</script> " ;
                $htmlMenuPermisoAdministracion .= "            <p>Fras prov. no cargadas<span class='num_fras_prov_NC badge badge-danger right' id='fra_NC' >$script_NC</span></p>";
                $htmlMenuPermisoAdministracion .= '          </a>';
                $htmlMenuPermisoAdministracion .= '        </li>';
                $htmlMenuPermisoAdministracion .= '        <li class="nav-item">';
                $htmlMenuPermisoAdministracion .= '          <a href="../proveedores/facturas_proveedores.php?_m='.$_m.'&conciliada=1&pagada=0&fecha1='.$fecha_inicio.'" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '            <i class="fa fa-file-invoice-dollar nav-icon"></i>';
                                                           $script_NP="<script>dfirst_ajax222('fra_NP' , '$sql_num_fra_prov_NP')</script> " ;
                $htmlMenuPermisoAdministracion .= "            <p>Fras prov. no pagadas<span class='num_fras_prov_NP badge badge-danger  right' id='fra_NP' >$script_NP</span></p>";
                $htmlMenuPermisoAdministracion .= '          </a>';
                $htmlMenuPermisoAdministracion .= '        </li>';
                $htmlMenuPermisoAdministracion .= '        <li class="nav-item">';
                $htmlMenuPermisoAdministracion .= '          <a href="../bancos/remesas_listado.php?tipo_remesa=tipo_remesa=\'P\'&conc=activa=1" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '            <i class="fas fa-euro-sign nav-icon"></i>';
                $htmlMenuPermisoAdministracion .= '            <p>Remesa de Pagos <span class="badge badge-info right">'.$num_remesa_pagos.'</span></p>';
                $htmlMenuPermisoAdministracion .= '          </a>';
                $htmlMenuPermisoAdministracion .= '        </li>';
                $htmlMenuPermisoAdministracion .= '      </ul>';
                $htmlMenuPermisoAdministracion .= '    </li>';
                $htmlMenuPermisoAdministracion .= '  </ul>';
                $htmlMenuPermisoAdministracion .= '  <ul class="nav nav-treeview small">';
                $htmlMenuPermisoAdministracion .= '    <li class="nav-item has-treeview">';
                $htmlMenuPermisoAdministracion .= '      <a href="#" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '        <i class="fas fa-users nav-icon"></i>';
                $htmlMenuPermisoAdministracion .= '        <p>';
                $htmlMenuPermisoAdministracion .= '          Clientes';
                $htmlMenuPermisoAdministracion .= '          <i class="fas fa-angle-left right"></i>';
                $htmlMenuPermisoAdministracion .= '        </p>';
                $htmlMenuPermisoAdministracion .= '      </a>';
                $htmlMenuPermisoAdministracion .= '      <ul class="nav nav-treeview small">';
                $htmlMenuPermisoAdministracion .= '        <li class="nav-item">';
                $htmlMenuPermisoAdministracion .= '          <a href="../clientes/clientes_buscar.php" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '            <i class="fa fa-portrait nav-icon"></i>';
                $htmlMenuPermisoAdministracion .= '            <p>Clientes</p>';
                $htmlMenuPermisoAdministracion .= '          </a>';
                $htmlMenuPermisoAdministracion .= '        </li>';
                $htmlMenuPermisoAdministracion .= '        <li class="nav-item">';
                $htmlMenuPermisoAdministracion .= '          <a href="../clientes/facturas_clientes.php?fecha1='.$fecha_inicio.'" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '            <i class="fa fa-file-invoice-dollar nav-icon"></i>';
                $htmlMenuPermisoAdministracion .= '            <p>Facturas Clientes <span class="badge badge-info right">'.$num_fras_cli.'</span></p>';
                $htmlMenuPermisoAdministracion .= '          </a>';
                $htmlMenuPermisoAdministracion .= '        </li>';
                $htmlMenuPermisoAdministracion .= '        <li class="nav-item">';
                $htmlMenuPermisoAdministracion .= '          <a href="../clientes/facturas_clientes.php?cobrada=0" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '            <i class="fa fa-file-invoice-dollar nav-icon"></i>';
                $htmlMenuPermisoAdministracion .= '            <p>Fras. Clientes pdte cobro </p>';
                $htmlMenuPermisoAdministracion .= '          </a>';
                $htmlMenuPermisoAdministracion .= '        </li>';
                $htmlMenuPermisoAdministracion .= '        <li class="nav-item">';
                $htmlMenuPermisoAdministracion .= '          <a href="../bancos/remesas_listado.php?tipo_remesa=tipo_remesa=\'C\'&conc=activa=1" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '            <i class="fas fa-euro-sign nav-icon"></i>';
                $htmlMenuPermisoAdministracion .= '            <p>Remesa de Cobros <span class="badge badge-info  right">'.$num_remesa_cobros.'</span></p>';
                $htmlMenuPermisoAdministracion .= '          </a>';
                $htmlMenuPermisoAdministracion .= '        </li>';
                $htmlMenuPermisoAdministracion .= '      </ul>';
                $htmlMenuPermisoAdministracion .= '    </li>';
                $htmlMenuPermisoAdministracion .= '    <li class="nav-item">';
                $htmlMenuPermisoAdministracion .= '      <a href="../personal/personal_listado.php?baja=BAJA=0" class="nav-link">';
                $htmlMenuPermisoAdministracion .= '        <i class="fa fa-person-booth nav-icon"></i>';
                $htmlMenuPermisoAdministracion .= '        <p>Personal<span class="badge badge-info right">'.$num_empleados.'</span></p>';
                $htmlMenuPermisoAdministracion .= '      </a>';
                $htmlMenuPermisoAdministracion .= '    </li>';

                if($_SESSION["permiso_bancos"]) {
                    $htmlMenuPermisoBancos = '';

                    $htmlMenuPermisoBancos .= '<li class="nav-item">';
                    $htmlMenuPermisoBancos .= '  <a href="../bancos/bancos_ctas_bancos.php?_m='.$_m.'&activo=on" class="nav-link">';
                    $htmlMenuPermisoBancos .= '    <i class="fas fa-university nav-icon"></i>';
                    $htmlMenuPermisoBancos .= '    <p>Bancos<span class="badge badge-info right">'.$num_ctas_bancos.'</span></p>';
                    $htmlMenuPermisoBancos .= '  </a>';
                    $htmlMenuPermisoBancos .= '</li>';
                    $htmlMenuPermisoAdministracion .= $htmlMenuPermisoBancos;
                }

                $htmlMenuPermisoAdministracion .='    <li class="nav-item">';
                $htmlMenuPermisoAdministracion .='      <a href="../bancos/pagos_y_cobros.php" class="nav-link">';
                $htmlMenuPermisoAdministracion .='        <i class="fa fa-hand-holding-usd nav-icon" ></i>';
                $htmlMenuPermisoAdministracion .='        <p>Pagos y Cobros</p>';
                $htmlMenuPermisoAdministracion .='      </a>';
                $htmlMenuPermisoAdministracion .='    </li>';
                $htmlMenuPermisoAdministracion .='    <li class="nav-item">';
                $htmlMenuPermisoAdministracion .='      <a href="../bancos/bancos_lineas_avales.php" class="nav-link">';
                $htmlMenuPermisoAdministracion .='        <i class="fas fa-stamp nav-icon"></i>';
                $htmlMenuPermisoAdministracion .='        <p>Avales<span class="badge badge-danger right" >'.$num_avales_pdtes.'</span></p>';
                $htmlMenuPermisoAdministracion .='      </a>';
                $htmlMenuPermisoAdministracion .='    </li>';
                $htmlMenuPermisoAdministracion .='  </ul>';
                $htmlMenuPermisoAdministracion .='</li>';
            }
            echo $htmlMenuPermisoAdministracion;
            ?>

            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fa fa-cogs nav-icon"></i>
                <p>
                  Herramientas
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>

              <ul class="nav nav-treeview small">
                <!-- DOCUMENTOS -->
                <li class="nav-item"> 
                  <a href="../documentos/documentos.php" class="nav-link">
                    <i class="far fa-file-alt nav-icon"></i> 
                    <p>Documentos</p>
                    <span class="badge badge-info right"><?php echo $num_documentos; ?></span>                    
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../documentos/documentos.php?_m=<?php echo $_m; ?>&clasificar=1" title='Documentación que se ha subido a la plataforma y aún no ha sido tramitada o archivada en su lugar. P. ej. la foto de albarán enviado opr movil desde la propia obra. '>
                    <i class="far fa-file-alt nav-icon"></i>
                    <p>Docs. pdtes. Clasificar
                    <span class='num_fras_prov_NC badge badge-danger right'><?php echo $num_documentos_pdte_clasif; ?></span>
                    </p>
                   </a>
                </li>

                <!-- USUARIOS -->
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="far fa-user nav-icon"></i>
                    <p>
                      Usuarios
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview small">
                    <li class="nav-item">
                      <a class="nav-link" href="../configuracion/usuario_ficha.php" >
                        <i class="fa fa-user-cog nav-icon"></i> 
                        <p>Mi Usuario <?php echo " ({$_SESSION["user"]})"; ?></p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="../configuracion/usuario_anadir.php" class="nav-link">
                        <i class="fa fa-user-plus nav-icon"></i>
                        <p>Añadir usuario</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="../include/tabla_general.php?url_enc=<?php echo encrypt2("select=id_usuario,usuario,email,online,activo,autorizado,permiso_licitacion,permiso_obras,permiso_administracion,permiso_bancos,user,fecha_creacion&tabla=Usuarios_View&where=activo AND id_c_coste=$id_c_coste&link=../configuracion/usuario_ficha.php?id_usuario=&campo=usuario&campo_id=id_usuario") ; ?>" class="nav-link">
                        <i class="fa fa-house-user nav-icon"></i>
                        <p>Usuarios empresa <span class="badge badge-info right"><?php echo $num_usuarios; ?></span></p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="../proveedores/facturas_proveedores.php?_m=<?php echo $_m; ?>&id_proveedor=<?php echo $id_proveedor_auto; ?>" class="nav-link">
                        <i class="fa fa-user-lock nav-icon"></i>
                        <p>Accesos<span class='num_fras_prov_NC badge badge-danger  right' ><?php echo $num_fras_prov_NR; ?></span></p>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="../configuracion/empresa_ficha.php">
                    <i class="fas fa-building nav-icon"></i>
                    <p>Mi Empresa <?php echo " ({$_SESSION["empresa"]})"; ?></p>
                   </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="../menu/menu_app.php">
                    <i class="fa fa-list nav-icon"></i>
                    <p>MENU APP</p>
                   </a>
                </li>
              </ul>
            </li>

            <?php if ($_SESSION["admin"]) { ?>


            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="fa fa-user-secret nav-icon"></i>
                <p>
                  Solo ADMIN
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>

              <ul class="nav nav-treeview small">
                <li class="nav-item"> 
                  <a href="../adminlte/" class="nav-link" target="_blank">
                    <i class="fa fa-code nav-icon"></i> 
                    <p>Admin LTE</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../include/tabla_general.php?_m=<?php echo $_m; ?>&url_enc=<?php echo encrypt2("tabla=w_Accesos&where=id_c_coste='$id_c_coste'&order_by=fecha_creacion DESC LIMIT 500") ?>"> 
                    <i class="fa fa-code nav-icon"></i> 
                    <p>Accesos empresa</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../include/tabla_general.php?_m=<?php echo $_m; ?>&url_enc=<?php echo encrypt2("tabla=w_Accesos&where=id_c_coste='$id_c_coste' AND resultado LIKE '%Error%'&order_by=fecha_creacion DESC LIMIT 500") ?>" >
                    <i class="fa fa-code nav-icon"></i> 
                    <p>Accesos empresa con Error</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../include/tabla_general.php?_m=<?php echo $_m; ?>&tabla=w_Accesos&where=1&order_by=fecha_creacion DESC LIMIT 500" >
                    <i class="fa fa-code nav-icon"></i> 
                    <p>Accesos Global</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../include/tabla_general.php?_m=<?php echo $_m; ?>&tabla=<?php echo encrypt2('w_Accesos'); ?>&where= resultado LIKE '%Erro%'&order_by=fecha_creacion DESC LIMIT 500" >
                    <i class="fa fa-code nav-icon"></i> 
                    <p>Accesos Global con Error</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../include/tabla_debug.php" >
                    <i class="fa fa-code nav-icon"></i>   
                    <p>Tabla DEBUG</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../configuracion/debug_ppal.php" >
                    <i class="fa fa-code nav-icon"></i> 
                    <p>Debug_ppal</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../debug/debug_vars.php" >
                    <i class="fa fa-code nav-icon"></i> 
                    <p>Debug_vars</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../debug/debug.php" >
                    <i class="fa fa-code nav-icon"></i> 
                    <p>Debug</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../pruebas/phpinfo.php" >
                    <i class="fa fa-code nav-icon"></i> 
                    <p>Php_info()</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../include/tabla_debug.php?url_enc=<?php echo encrypt2("sql=SELECT * FROM Usuarios WHERE 1=1 ORDER BY id_usuario&link=../configuracion/usuario_ficha.php?id_usuario=&link_campo=usuario&link_campo_id=id_usuario") ?>" >
                    <i class="fas fa-globe-europe nav-icon"></i> 
                    <p>Usuarios Global</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../include/tabla_debug.php?url_enc=<?php echo encrypt2("sql=SELECT * FROM Empresas_View_ext ORDER BY ultimo_acceso DESC LIMIT 50&link=../configuracion/empresa_ficha.php?id_empresa=&link_campo=C_Coste_Texto&link_campo_id=id_c_coste") ?>" >
                    <i class="fas fa-globe-europe nav-icon"></i> 
                    <p>Empresas Global</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../include/tabla_debug.php?url_enc=<?php echo encrypt2("sql=SELECT * FROM tipos_licencia &tabla_update=tipos_licencia&id_update=id") ?>" >
                    <i class="fa fa-code nav-icon"></i> 
                    <p>Tipos de licencias</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../configuracion/config_variables.php" >
                    <i class="fa fa-code nav-icon"></i> 
                    <p>Configuración Variables</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../include/tabla_debug.php?url_enc=<?php echo encrypt2("sql=SELECT * FROM logs_db ORDER BY id DESC LIMIT 200") ?>" >
                    <i class="fa fa-code nav-icon"></i> 
                    <p>Logs_db</p>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a target="_blank" class="nav-link" href="../include/sign_src/my_sign.php" >
                    <i class="fa fa-code nav-icon"></i> 
                    <p>Signature Pad</p>
                  </a>
                </li>

              </ul>
            </li>

            <?php } ?>


            <!-- <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  Charts
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview small">
                <li class="nav-item">
                  <a href="pages/charts/chartjs.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>ChartJS</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/charts/flot.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Flot</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="pages/charts/inline.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inline</p>
                  </a>
                </li>
              </ul>
            </li> -->


            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">             
                <i class="fa fa-question nav-icon"></i>
                <p>
                  Ayuda
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview small">
                <li class="nav-item">
                  <a href="../img/diagrama_construwin.jpg" class="nav-link">
                    <i class="fa fa-sitemap nav-icon"></i>
                    Diagrama
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../agenda/procedimientos.php" class="nav-link">
                    <i class="fas fa-book nav-icon"></i>
                    <p>Procedimientos</p>
                    <span class="badge badge-info right"><?php echo $num_procedimientos; ?></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="https://www.youtube.com/channel/UCHnW4ZAPAYxWQ6rRzUmS_tw" target="_blank" class="nav-link">
                    <i class="fab fa-youtube nav-icon"></i>
                    Video-tutoriales
                  </a>
                </li>
                <li class="nav-item">
                  <a href="https://foro.construcloud.es" target="_blank" class="nav-link" title="Foro donde consultar dudas con los administradores y otros usuarios, informar de errores, sugerencias..."> 
                    <i class="fas fa-users nav-icon"></i>
                    <p>ConstruCloud Forum</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="https://wiki.construcloud.es" target="_blank" class="nav-link" title="Wikipedia de ConstruCloud.es donde consultar definiciones, procedimientos, de todas las entidades...">
                    <i class="fab fa-wikipedia-w nav-icon"></i>
                    ConstruWIKI
                  </a>
                </li>
<!--                <li class="nav-item">
                  <a href="../include/tabla_general.php?url_enc=<?php echo encrypt2("tabla=historial&where=Tipo_cambio LIKE '%PHP%' &campo=titulo&campo_id=id&link=../include/ficha_general.php?tabla=historial__AND__id_update=id__AND__id_valor=") ?>" class="nav-link">
                    <i class="fa fa-list nav-icon"></i>
                    Versiones
                  </a>
                </li>              -->
              </ul>
              <br>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  
  <div id="div_main"   class="content-wrapper">
      
 <?php
}
?>
