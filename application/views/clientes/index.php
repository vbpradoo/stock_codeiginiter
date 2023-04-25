<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Control
            <small>Clientes</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Principal</a></li>
            <li class="active">Clientes</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12 col-xs-12">

                <div id="messages"></div>

                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php elseif ($this->session->flashdata('error')): ?>
                    <div class="alert alert-error alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <?php if (in_array('createProduct', $user_permission)): ?>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Añadir Cliente
                    </button>
                    <br/> <br/>
                <?php endif; ?>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Control de Clientes</h3>
                    </div>
                    <!-- /.box-header -->
                    <table id="jqGrid" class="box-body"></table>

                    <div id="jqGridPager"></div>
                </div>
                <!-- /.box -->
            </div>
            <!-- col-md-12 -->
        </div>
        <!-- /.row -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php if (in_array('createProduct', $user_permission)): ?>
    <!-- create brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Añadir Cliente</h4>
                </div>

                <?php echo form_open_multipart("clientes/create"); ?>
<!--                <form role="form" action="--><?php //echo base_url('clientes/create') ?><!--" method="POST" id="createForm"-->
<!--                      enctype="multipart/form-data">-->

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="cliente_image">Imagen</label>
                            <div class="kv-avatar">
                                <div class="file-loading">
                                    <input id="cliente_image" name="cliente_image" type="file">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="cliente_nombre">Nombre Cliente</label>
                            <input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre"
                                   placeholder="Introduzca nombre de cliente" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="cliente_empresa">Empresa</label>
                            <input type="text" class="form-control" id="cliente_empresa" name="cliente_empresa"
                                   placeholder="Introduzca nombre de empresa" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="cliente_nif">NIF</label>
                            <input type="text" class="form-control" id="cliente_nif" name="cliente_nif"
                                   placeholder="Introduzca el NIF" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="cliente_telefono">Teléfono</label>
                            <input type="text" class="form-control" id="cliente_telefono"
                                   name="cliente_telefono"
                                   placeholder="Introduzca teléfono" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="cliente_correo">Correo</label>
                            <input type="email" class="form-control" id="cliente_correo" name="cliente_correo"
                                   placeholder="Introduzca correo" autocomplete="off">
                        </div>
<!--                        <div class="form-group">-->
<!--                            <label for="cliente_cantidad">Cantidad</label>-->
<!--                            <input type="text" class="form-control" id="cliente_cantidad"-->
<!--                                   name="cliente_cantidad"-->
<!--                                   placeholder="Introduzca cantidad" autocomplete="off">-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="cliente_gastado">Gastado</label>-->
<!--                            <input type="text" class="form-control" id="cliente_gastado" name="cliente_gastado"-->
<!--                                   placeholder="Introduzca lo que lleva gastado" autocomplete="off">-->
<!--                        </div>-->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>

                <?php echo form_close();?>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php endif; ?>

<?php if (in_array('updateProduct', $user_permission)): ?>
    <!-- edit brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar Cliente</h4>
                </div>

                <?php echo form_open_multipart("clientes/update"); ?>


                    <div class="modal-body">
                        <div id="messages"></div>
                        <div class="form-group">
                            <label>Imagen Actual: </label>
                            <img id="preimage" width="150" height="150" class="img-circle">
                        </div>
                        <div class="form-group">
                            <label for="edit_cliente_image">Imagen</label>
                            <div class="kv-avatar">
                                <div class="file-loading">
                                    <input id="edit_cliente_image" name="edit_cliente_image" type="file">
                                </div>
                            </div>
                            <div class="form-group">
                                <input id="cliente_id" class="form-control" name="cliente_id" type="text" style="visibility: hidden;">
                            </div>
                            <div class="form-group">
                                <label for="edit_cliente_nombre">Nombre Cliente</label>
                                <input type="text" class="form-control" id="edit_cliente_nombre"
                                       name="edit_cliente_nombre"
                                       placeholder="Introduzca nombre de cliente" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="edit_cliente_empresa">Empresa</label>
                                <input type="text" class="form-control" id="edit_cliente_empresa"
                                       name="edit_cliente_empresa"
                                       placeholder="Introduzca nombre de empresa" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="edit_cliente_nif">NIF</label>
                                <input type="text" class="form-control" id="edit_cliente_nif" name="edit_cliente_nif"
                                       placeholder="Introduzca el NIF" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="edit_cliente_telefono">Teléfono</label>
                                <input type="text" class="form-control" id="edit_cliente_telefono"
                                       name="edit_cliente_telefono"
                                       placeholder="Introduzca teléfono" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="edit_cliente_correo">Correo</label>
                                <input type="email" class="form-control" id="edit_cliente_correo"
                                       name="edit_cliente_correo"
                                       placeholder="Introduzca correo" autocomplete="off">
                            </div>
<!--                            <div class="form-group">-->
<!--                                <label for="edit_cliente_cantidad">Cantidad</label>-->
<!--                                <input type="text" class="form-control" id="edit_cliente_cantidad"-->
<!--                                       name="edit_cliente_cantidad"-->
<!--                                       placeholder="Introduzca cantidad" autocomplete="off">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="edit_cliente_gastado">Gastado</label>-->
<!--                                <input type="text" class="form-control" id="edit_cliente_gastado"-->
<!--                                       name="edit_cliente_gastado"-->
<!--                                       placeholder="Introduzca lo que lleva gastado" autocomplete="off">-->
<!--                            </div>-->

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </div>
                <?php echo form_close();?>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php endif; ?>


<?php if (in_array('deleteProduct', $user_permission)): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Eliminar cliente</h4>
                </div>

                <?php echo form_open_multipart("clientes/remove"); ?>
                    <div class="modal-body">
                        <p>Está seguro de que desea eliminar este cliente?</p>
                    </div>
                <div class="form-group">
                    <input id="cliente_id_remove" class="form-control" name="cliente_id_remove" type="text" style="visibility: hidden;">
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                <?php echo form_close();?>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php endif; ?>


<script type="text/javascript">

    var base_url = "<?php echo base_url(); ?>";

    $(document).ready(function () {

        $("#clienteNav").addClass('active');


        $("#jqGrid").jqGrid({

            url: base_url + "clientes/fetchClientesDataFilteringPagination",
            datatype: "json",
            styleUI: "Bootstrap",
            colModel: [
                {
                    label: 'ID',
                    name: 'ID',
                    index: 'ID',
                    sorttype: 'number',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                }, {
                    name: 'image',
                    label: 'Imagen',
                    align: 'center',
                    search: false,
                    sortable: false,
                },
                {
                    label: 'Nombre',
                    name: 'Nombre',
                    index: 'Nombre',
                    sorttype: 'text',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                }, {
                    label: 'Correo',
                    name: 'Correo',
                    index: 'Correo',
                    sorttype: 'text',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                }, {
                    label: 'Teléfono',
                    name: 'Telefono',
                    index: 'Telefono',
                    sorttype: 'text',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                }, {
                    label: 'Empresa',
                    name: 'Empresa',
                    index: 'Empresa',
                    sorttype: 'text',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                },
                    // }, {
                //     label: 'Cantidad',
                //     name: 'Cantidad',
                //     index: 'Cantidad',
                //     // width: "3px",
                //     sorttype: 'text',
                //     align: 'center'
                // }, {
                //     label: 'Gastado',
                //     name: 'Gastado',
                //     index: 'Gastado',
                //     // width: "3px",
                //     sorttype: 'text',
                //     align: 'center'
                // }, {
                {
                    label: 'NIF',
                    name: 'NIF',
                    index: 'NIF',
                    // width: "3px",
                    sorttype: 'text',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                },
                {  label: 'Control',
                    name: 'Buttons',
                    index: 'Control',
                    // width: "3px",
                    align: 'center',
                    search: false,
                    sortable: false,
                }
            ],

            viewrecords: true, // show the current page, data rang and total records on the toolbar
            width: "auto",
            height: "auto",
            rowNum: 10,
            rowList : [10, 20, 50, 100],
            autowidth: true,
            pager: "#jqGridPager",
            caption: "Clientes",

            loadComplete: function () {
                // var objRows = $("#jqGrid tr").splice(1);
                // var objHeader = $("tr[class=ui-jqgrid-labels]");
                // var objFirstRowHeader = $(objHeader[1]).children("th");
                //
                // for (i = 0; i < objRows.length; i++) {
                //     var objFirstRowColumns = $(objRows[i]).children("td");
                //
                //     for (i = 0; i < objFirstRowColumns.length; i++) {
                //         $(objFirstRowColumns[i]).css("width", $(objFirstRowHeader[i]).width());
                //     }
                // }
            },
        });

        ChangejQGridDesign("#jqGrid", "#jqGridPager");

        $("#jqGrid").jqGrid('filterToolbar', {
            stringResult: true, searchOnEnter: true,
            defaultSearch: 'cn', ignoreCase: true, searchOperators: true
        });

        function ChangejQGridDesign(table, pager) {
            jQuery(table).jqGrid('navGrid', pager, {
                edit: false, add: false, del: false,
                search: true,
                searchicon: 'ace-icon fa fa-search orange',
                refresh: true,
                refreshicon: 'ace-icon fa fa-refresh green',
                view: true,
                viewicon: 'ace-icon fa fa-search-plus grey'
            });
            //navButtons

            // jQuery(table).jqGrid('inlineNav', pager,
            //     {  //navbar options
            //         edit: true,
            //         editicon: 'ace-icon fa fa-pencil blue',
            //         add: true,
            //         addicon: 'ace-icon fa fa-plus-circle purple',
            //         del: true,
            //         delicon: 'ace-icon fa fa-trash-o red'
            //     });

            //replace icons with FontAwesome icons like above
            //updatePagerIcons
            var replacement =
                {
                    'ui-icon-seek-first': 'ace-icon fa fa-angle-double-left bigger-140',
                    'ui-icon-seek-prev': 'ace-icon fa fa-angle-left bigger-140',
                    'ui-icon-seek-next': 'ace-icon fa fa-angle-right bigger-140',
                    'ui-icon-seek-end': 'ace-icon fa fa-angle-double-right bigger-140'
                };
            $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .ui-icon').each(function () {
                var icon = $(this);
                var $class = $.trim(icon.attr('class').replace('ui-icon', ''));

                if ($class in replacement) icon.attr('class', 'ui-icon ' + replacement[$class]);
            });

            // enableTooltips
            $('.navtable .ui-pg-button').tooltip({container: 'body'});
            $(table).find('.ui-pg-div').tooltip({container: 'body'});

            var $grid = $(table),
                newWidth = $grid.closest(".ui-jqgrid").parent().width() - 50;
            $grid.jqGrid("setGridWidth", newWidth, true);

            $(window).on("resize", function () {
                var $grid = $(table),
                    newWidth = $grid.closest(".ui-jqgrid").parent().width() - 50;
                $grid.jqGrid("setGridWidth", newWidth, true);

                var objRows = $("#jqGrid tr").splice(1);
                var objHeader = $("tr[class=ui-jqgrid-labels]");
                var objFirstRowHeader = $(objHeader[1]).children("th");

                for (i = 0; i < objRows.length; i++) {
                    var objFirstRowColumns = $(objRows[i]).children("td");

                    for (i = 0; i < objFirstRowColumns.length; i++) {
                        $(objFirstRowColumns[i]).css("width", $(objFirstRowHeader[i]).width());
                    }
                }
            });
        }


        $("#cliente_image").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            browseLabel: '',
            removeLabel: '',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',
            // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
            // layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
            layoutTemplates: {main2: '{preview} {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
        });

        $("#edit_cliente_image").fileinput({
            overwriteInitial: true,
            maxFileSize: 1500,
            showClose: false,
            showCaption: false,
            browseLabel: '',
            removeLabel: '',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',
            // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
            // layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
            layoutTemplates: {main2: '{preview} {remove} {browse}'},
            allowedFileExtensions: ["jpg", "png", "gif","jpeg"]
        });


    });

    // edit function
    function editFunc(id) {
        $.ajax({
            url: 'getClienteDataById/' + id,
            type: 'post',
            dataType: 'json',
            success: function (response) {

                // console.log(response);
                // $("#edit_proovedor_").val(response.);
                $("#preimage").attr("src", base_url + "/" + response.image);
                $("#edit_cliente_nombre").val(response.Nombre);
                $("#cliente_id").val(id);
                $("#edit_cliente_empresa").val(response.Empresa);
                $("#edit_cliente_nif").val(response.NIF);
                $("#edit_cliente_telefono").val(response.Telefono);
                $("#edit_cliente_correo").val(response.Correo);
                $("#edit_cliente_cantidad").val(response.Cantidad);
                $("#edit_cliente_gastado").val(response.Gastado);
            }
        });
    }

    // remove functions
    function removeFunc(id) {
        if (id) {
            $("#cliente_id_remove").val(id);
        }
    }


</script>
