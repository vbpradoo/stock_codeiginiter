<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">

            <li id="dashboardMainMenu">
                <a href="<?php echo base_url('dashboard') ?>">
                    <i class="fa fa-dashboard"></i> <span>Principal</span>
                </a>
            </li>

            <?php if($user_permission): ?>
                <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                    <li class="treeview" id="mainUserNav">
                        <a href="#">
                            <i class="fa fa-users"></i>
                            <span>Usuarios</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php if(in_array('createUser', $user_permission)): ?>
                                <li id="createUserNav"><a href="<?php echo base_url('users/create') ?>"><i class="fa fa-circle-o"></i> Añadir Usuario</a></li>
                            <?php endif; ?>

                            <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                                <li id="manageUserNav"><a href="<?php echo base_url('users') ?>"><i class="fa fa-circle-o"></i> Control de Usuarios</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                    <li class="treeview" id="mainGroupNav">
                        <a href="#">
                            <i class="fa fa-object-group"></i>
                            <span>Grupos</span>
                            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php if(in_array('createGroup', $user_permission)): ?>
                                <li id="addGroupNav"><a href="<?php echo base_url('groups/create') ?>"><i class="fa fa-circle-o"></i> Añadir Grupo</a></li>
                            <?php endif; ?>
                            <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                                <li id="manageGroupNav"><a href="<?php echo base_url('groups') ?>"><i class="fa fa-circle-o"></i> Control de Grupos</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>


                <?php if(in_array('createBrand', $user_permission) || in_array('updateBrand', $user_permission) || in_array('viewBrand', $user_permission) || in_array('deleteBrand', $user_permission)): ?>
                    <li id="articuloNav">
                        <a href="<?php echo base_url('articulos/') ?>">
                            <i class="glyphicon glyphicon-tags"></i> <span>Artículos</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
                    <li id="proovedorNav">
                        <a href="<?php echo base_url('proovedores/') ?>">
                            <i class="fa fa-address-book"></i> <span>Proveedores</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
                    <li id="clienteNav">
                        <a href="<?php echo base_url('clientes/') ?>">
                            <i class="fa fa-briefcase"></i> <span>Clientes</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if(in_array('createStore', $user_permission) || in_array('updateStore', $user_permission) || in_array('viewStore', $user_permission) || in_array('deleteStore', $user_permission)): ?>
                    <li id="almacenNav">
                        <a href="<?php echo base_url('almacenes/') ?>">
                            <i class="fa fa-location-arrow"></i> <span>Almacenes</span>
                        </a>
                    </li>
                <?php endif; ?>

                <!--          --><?php //if(in_array('createAttribute', $user_permission) || in_array('updateAttribute', $user_permission) || in_array('viewAttribute', $user_permission) || in_array('deleteAttribute', $user_permission)): ?>
                <!--          <li id="attributeNav">-->
                <!--            <a href="--><?php //echo base_url('attributes/') ?><!--">-->
                <!--              <i class="fa fa-files-o"></i> <span>Atributos</span>-->
                <!--            </a>-->
                <!--          </li>-->
                <!--          --><?php //endif; ?>
                <li class="treeview" id="lotesNav">
                    <a href="#">
                        <i class="fa fa-archive"></i>
                        <span>Lotes</span>
                        <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="editLNav"><a href="<?php echo base_url('lotes/edit') ?>"><i class="fa fa-circle-o"></i> Modificar Lote</a></li>
                        <li id="indexLNav"><a href="<?php echo base_url('lotes/index') ?>"><i class="fa fa-circle-o"></i>Control de Lotes</a></li>
                    </ul>
                </li>

                <li class="treeview" id="entradasNav">
                    <a href="#">
                        <i class="fa fa-plus-circle"></i>
                        <span>Entradas</span>
                        <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>
                    <ul class="treeview-menu">
                        <li id="createENav"><a href="<?php echo base_url('entradas/createEntrada') ?>"><i class="fa fa-circle-o"></i> Añadir Entrada</a></li>
                        <li id="indexENav"><a href="<?php echo base_url('entradas/index') ?>"><i class="fa fa-circle-o"></i>Historial de Entradas</a></li>
                    </ul>
                </li>


                <?php if(in_array('createOrder', $user_permission) || in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                    <li class="treeview" id="mainSalidasNav">
                        <a href="#">
                            <i class="fa fa-dollar"></i>
                            <span>Salidas</span>
                            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php if(in_array('createOrder', $user_permission)): ?>
                                <li id="addSalidaNav"><a href="<?php echo base_url('salidas/createSalida') ?>"><i class="fa fa-circle-o"></i> Añadir Salida</a></li>
                            <?php endif; ?>
                            <?php if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                                <li id="manageSalidaNav"><a href="<?php echo base_url('salidas/index') ?>"><i class="fa fa-circle-o"></i> Control de Salidas</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if(in_array('viewReports', $user_permission)): ?>
<!--                    <li id="reportNav">-->
    <!--                        <a href="--><?php //echo base_url('reports/') ?><!--">-->
<!--                            <i class="glyphicon glyphicon-stats"></i> <span>Estadísticas</span>-->
<!--                        </a>-->
<!--                    </li>-->
                <?php endif; ?>


                <?php if(in_array('updateCompany', $user_permission)): ?>
                    <li id="companyNav"><a href="<?php echo base_url('company/') ?>"><i class="fa fa-building"></i> <span>Empresa</span></a></li>
                <?php endif; ?>



                <!-- <li class="header">Settings</li> -->

                <?php if(in_array('viewProfile', $user_permission)): ?>
                    <li><a href="<?php echo base_url('users/profile/') ?>"><i class="fa fa-user-o"></i> <span>Perfil</span></a></li>
                <?php endif; ?>
                <?php if(in_array('updateSetting', $user_permission)): ?>
                    <li><a href="<?php echo base_url('users/setting/') ?>"><i class="fa fa-wrench"></i> <span>Ajustes</span></a></li>
                <?php endif; ?>

            <?php endif; ?>
            <!-- user permission info -->
            <li><a href="<?php echo base_url('auth/logout') ?>"><i class="glyphicon glyphicon-log-out"></i> <span>Salir</span></a></li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>