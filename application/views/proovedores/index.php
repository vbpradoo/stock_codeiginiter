<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Control
            <small>Proveedores</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Principal</a></li>
            <li class="active">Proveedores</li>
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
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Añadir Proovedor
                    </button>
                    <br/> <br/>
                <?php endif; ?>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Control de Proveedores</h3>
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
                    <h4 class="modal-title">Añadir Proovedor</h4>
                </div>

                <form role="form" action="<?php echo base_url('proovedores/create') ?>" method="POST" id="createForm"
                      enctype="multipart/form-data">

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="proovedor_image">Imagen</label>
                            <div class="kv-avatar">
                                <div class="file-loading">
                                    <input id="proovedor_image" name="proovedor_image" type="file">
                                </div>
                            </div>
                            <!--                                <div id="proovedor_image" class="dropzone">-->
                            <!--                                    <div class="dz-message">-->
                            <!--                                        <h3>Arrastre la imagen</h3> ó <strong>clique</strong> para cargar-->
                            <!--                                        <span class="glyphicon glyphicon-upload" style="font-size: 1.5em; position: center"></span>-->
                            <!--                                    </div>-->
                            <!--                                </div>-->
                        </div>
                        <div class="form-group">
                            <label for="proovedor_nombre">Nombre Proveedor</label>
                            <input type="text" class="form-control" id="proovedor_nombre" name="proovedor_nombre"
                                   placeholder="Introduzca nombre de proveedor" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="proovedor_empresa">Empresa</label>
                            <input type="text" class="form-control" id="proovedor_empresa" name="proovedor_empresa"
                                   placeholder="Introduzca nombre de empresa" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="proovedor_nif">NIF</label>
                            <input type="text" class="form-control" id="proovedor_nif" name="proovedor_nif"
                                   placeholder="Introduzca el NIF" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="proovedor_telefono">Teléfono</label>
                            <input type="text" class="form-control" id="proovedor_telefono"
                                   name="proovedor_telefono"
                                   placeholder="Introduzca teléfono" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="proovedor_correo">Correo</label>
                            <input type="text" class="form-control" id="proovedor_correo" name="proovedor_correo"
                                   placeholder="Introduzca correo" autocomplete="off">
                        </div>
<!--                        <div class="form-group">-->
<!--                            <label for="proovedor_cantidad">Cantidad</label>-->
<!--                            <input type="text" class="form-control" id="proovedor_cantidad"-->
<!--                                   name="proovedor_cantidad"-->
<!--                                   placeholder="Introduzca cantidad" autocomplete="off">-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="proovedor_gastado">Gastado</label>-->
<!--                            <input type="text" class="form-control" id="proovedor_gastado" name="proovedor_gastado"-->
<!--                                   placeholder="Introduzca lo que lleva gastado" autocomplete="off">-->
<!--                        </div>-->
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>

                </form>


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
                    <h4 class="modal-title">Editar Proveedor</h4>
                </div>

                <form role="form" action="<?php echo base_url('proovedores/update') ?>" method="post" id="updateForm"
                      enctype="multipart/form-data">

                    <div class="modal-body">
                        <div id="messages"></div>
                        <div class="form-group">
                            <label>Imagen Actual: </label>
                            <img id="preimage" width="150" height="150" class="img-circle">
                        </div>
                        <div class="form-group">
                            <label for="edit_proovedor_image">Imagen</label>
                            <div class="kv-avatar">
                                <div class="file-loading">
                                    <input id="edit_proovedor_image" name="edit_proovedor_image" type="file">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="edit_proovedor_nombre">Nombre Proveedor</label>
                                <input type="text" class="form-control" id="edit_proovedor_nombre"
                                       name="edit_proovedor_nombre"
                                       placeholder="Introduzca nombre de proveedor" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="edit_proovedor_empresa">Empresa</label>
                                <input type="text" class="form-control" id="edit_proovedor_empresa"
                                       name="edit_proovedor_empresa"
                                       placeholder="Introduzca nombre de empresa" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="edit_proovedor_nif">NIF</label>
                                <input type="text" class="form-control" id="edit_proovedor_nif" name="edit_proovedor_nif"
                                       placeholder="Introduzca el NIF" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="edit_proovedor_telefono">Teléfono</label>
                                <input type="text" class="form-control" id="edit_proovedor_telefono"
                                       name="edit_proovedor_telefono"
                                       placeholder="Introduzca teléfono" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="edit_proovedor_correo">Correo</label>
                                <input type="text" class="form-control" id="edit_proovedor_correo"
                                       name="edit_proovedor_correo"
                                       placeholder="Introduzca correo" autocomplete="off">
                            </div>
<!--                            <div class="form-group">-->
<!--                                <label for="edit_proovedor_cantidad">Cantidad</label>-->
<!--                                <input type="text" class="form-control" id="edit_proovedor_cantidad"-->
<!--                                       name="edit_proovedor_cantidad"-->
<!--                                       placeholder="Introduzca cantidad" autocomplete="off">-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="edit_proovedor_gastado">Gastado</label>-->
<!--                                <input type="text" class="form-control" id="edit_proovedor_gastado"-->
<!--                                       name="edit_proovedor_gastado"-->
<!--                                       placeholder="Introduzca lo que lleva gastado" autocomplete="off">-->
<!--                            </div>-->

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </div>
                    </div>
                </form>

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
                    <h4 class="modal-title">Eliminar proveedor</h4>
                </div>

                <form role="form" action="<?php echo base_url('proovedores/remove') ?>" method="post" id="removeForm">
                    <div class="modal-body">
                        <p>Está seguro de que desea eliminar este proveedor?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php endif; ?>


<script type="text/javascript">

    var base_url = "<?php echo base_url(); ?>";

    $(document).ready(function () {

        $("#proovedorNav").addClass('active');


        $("#jqGrid").jqGrid({

            url: base_url + "proovedores/fetchProovedoresDataFilteringPagination",
            datatype: "json",
            styleUI: "Bootstrap",
            colModel: [
                {
                    label: 'ID',
                    name: 'ID',
                    index: 'ID',
                    sorttype: 'number',
                    // width: "1px",
                    align: 'center'
                    // formatter: formatTitle
                }, {
                    name: 'image',
                    label: 'Imagen',
                    // width: 150,
                    align: 'center',
                    // formatter: formatImage
                },
                {
                    label: 'Nombre',
                    name: 'Nombre',
                    index: 'Nombre',
                    sorttype: 'text',
                    // width: "2px",
                    align: 'center'
                    // formatter: formatLink
                }, {
                    label: 'Correo',
                    name: 'Correo',
                    index: 'Correo',
                    // width: "3px",
                    sorttype: 'text',
                    align: 'center'
                }, {
                    label: 'Teléfono',
                    name: 'Telefono',
                    index: 'Telefono',
                    // width: "3px",
                    sorttype: 'text',
                    align: 'center'
                }, {
                    label: 'Empresa',
                    name: 'Empresa',
                    index: 'Empresa',
                    // width: "3px",
                    sorttype: 'text',
                    align: 'center'
                },
                {
                    label: 'NIF',
                    name: 'NIF',
                    index: 'NIF',
                    // width: "3px",
                    sorttype: 'text',
                    align: 'center'
                },
                // {
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
                // },
                {
                    label: 'Control',
                    name: 'Buttons',
                    index: 'Control',
                    // width: "3px",
                    align: 'center'
                }
            ],

            viewrecords: true, // show the current page, data rang and total records on the toolbar
            width: "auto",
            height: "auto",
            rowNum: 10,
            rowList : [10, 20, 50, 100],
            autowidth: true,
            pager: "#jqGridPager",
            caption: "Provedores",

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

        // var width = ($(".box").width());
        // $("#jqGrid").setGridWidth(width);
        ChangejQGridDesign("#jqGrid", "#jqGridPager");


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


        // submit the create from
        $("#createForm").unbind('submit').on('submit', function () {
            var form = $(this);
            // remove the text-danger
            $(".text-danger").remove();
            console.log("ENTRA");


            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(), // /converting the form data into array and sending it to server
                dataType: 'json',
                success: function (response) {

                    $('#jqGrid').trigger('reloadGrid');

                    if (response.success === true) {
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                            '</div>');


                        // hide the modal
                        $("#addModal").modal('hide');

                        // reset the form
                        // $("#createForm")[0].reset();
                        // $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

                    } else {

                        if (response.messages instanceof Object) {
                            $.each(response.messages, function (index, value) {
                                var id = $("#" + index);

                                id.closest('.form-group')
                                    .removeClass('has-error')
                                    .removeClass('has-success')
                                    .addClass(value.length > 0 ? 'has-error' : 'has-success');

                                id.after(value);

                            });
                        } else {
                            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                                '</div>');
                        }
                    }
                }
            });

            return false;
        });


        //IMAGE
        var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' +
            'onclick="alert(\'Call your custom code here.\')">' +
            '<i class="glyphicon glyphicon-tag"></i>' +
            '</button>';
        $("#proovedor_image").fileinput({
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
            allowedFileExtensions: ["jpg", "png", "gif"]
        });

        //IMAGE
        var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' +
            'onclick="alert(\'Call your custom code here.\')">' +
            '<i class="glyphicon glyphicon-tag"></i>' +
            '</button>';
        $("#edit_proovedor_image").fileinput({
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
            allowedFileExtensions: ["jpg", "png", "gif"]
        });


    });

    // edit function
    function editFunc(id) {
        $.ajax({
            url: 'getProovedoresDataById/' + id,
            type: 'post',
            dataType: 'json',
            success: function (response) {

                console.log(response);
                // $("#edit_proovedor_").val(response.);
                $("#preimage").attr("src", base_url + "/" + response.image);
                $("#edit_proovedor_nombre").val(response.Nombre);
                $("#edit_proovedor_empresa").val(response.Empresa);
                $("#edit_proovedor_telefono").val(response.Telefono);
                $("#edit_proovedor_correo").val(response.Correo);
                // $("#edit_proovedor_cantidad").val(response.Cantidad);
                // $("#edit_proovedor_gastado").val(response.Gastado);

                // submit the edit from
                $("#updateForm").unbind('submit').bind('submit', function () {
                    var form = $(this);

                    // remove the text-danger
                    $(".text-danger").remove();

                    $.ajax({
                        url: form.attr('action') + '/' + id,
                        type: form.attr('method'),
                        data: form.serialize(), // /converting the form data into array and sending it to server
                        dataType: 'json',
                        success: function (response) {

                            $('#jqGrid').trigger('reloadGrid');

                            if (response.success === true) {
                                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                    '</div>');


                                // hide the modal
                                $("#editModal").modal('hide');
                                // reset the form
                                $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

                            } else {

                                if (response.messages instanceof Object) {
                                    $.each(response.messages, function (index, value) {
                                        var id = $("#" + index);

                                        id.closest('.form-group')
                                            .removeClass('has-error')
                                            .removeClass('has-success')
                                            .addClass(value.length > 0 ? 'has-error' : 'has-success');

                                        id.after(value);

                                    });
                                } else {
                                    $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                                        '</div>');
                                }
                            }
                        }
                    });

                    return false;
                });

            }
        });
    }

    // remove functions
    function removeFunc(id) {
        if (id) {

            $("#removeForm").on('submit', function () {

                var form = $(this);
                // console.log("SHIT");
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: {proovedor_id: id},
                    dataType: 'json',
                    success: function (response) {

                        $('#jqGrid').trigger('reloadGrid');

                        if (response.success === true) {
                            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                '</div>');

                            // hide the modal
                            $("#removeModal").modal('hide');

                        } else {

                            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.messages +
                                '</div>');
                        }
                    }
                });

                return false;
            });
        }
    }


</script>
