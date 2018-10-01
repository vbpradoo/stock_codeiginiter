<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Control
            <small>Artículos</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Principal</a></li>
            <li class="active">Artículos</li>
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

                <?php if (in_array('createBrand', $user_permission)): ?>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addArticuloModal">Añadir
                        Articulo
                    </button>
                    <button class="btn btn-info" id="verFamiliaModal">Mostrar familias
                    </button>
                    <button class="btn btn-default btn-circle btn-xl fa fa-plus " id="addFamiliaButton"
                            alt="Añadir familia" style="display: none;         width: 2.5em;
                            height: 2.5em;
                            padding: 10px 16px;
                            border-radius: 20em;
                            font-size: 2em;
                            text-align: center;
                            line-height: 1.33;
                            position: fixed;
                            z-index: 10;
                            top: 6.3em;
                            right: 0px;
                            background: rgb(60, 141, 188);
                            color: rgb(243, 156, 18);">
                        <!--                        glyphicon glyphicon-plus-->
                    </button>
                    <br/> <br/>
                <?php endif; ?>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Control de Artículos</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div id="famGrid" style="display:none">
                            <table id="familiaGrid"></table>
                            <div id="familiyPager"></div>
                        </div>

                        <table id="jqGrid" class="box-body"></table>
                        <div id="jqGridPager"></div>
                    </div>
                    <!-- /.box-body -->
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

<?php if (in_array('createBrand', $user_permission)): ?>
    <!-- create brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addArticuloModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Añadir Artículo</h4>
                </div>

                <form role="form" action="<?php echo base_url('articulos/create') ?>" method="post"
                      id="createArticuloForm">

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="articulo_nombre">Nombre de artículo</label>
                            <input type="text" class="form-control" id="articulo_nombre" name="articulo_nombre"
                                   placeholder="Introduzca nombre de artículo" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="articulo_descripcion">Descripción</label>
                            <input type="text" class="form-control" id="articulo_descripcion"
                                   name="articulo_descripcion" placeholder="Introduzca descripción de artículo"
                                   autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="articulo_familia">Familia</label>
                            <select class="form-control articulo_familia" id="articulo_familia" name="articulo_familia"
                                    style="width: 100% !important;">
                                <option></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="articulo_active">Estado</label>
                            <select class="form-control" id="articulo_active" name="articulo_active">
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>

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

<?php if (in_array('updateBrand', $user_permission)): ?>
    <!-- edit brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editArticuloModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar Artículo</h4>
                </div>

                <form role="form" action="<?php echo base_url('articulos/update') ?>" method="post"
                      id="updateArticuloForm">

                    <div class="modal-body">

                        <div id="messages"></div>

                        <div class="form-group">
                            <label for="edit_articulo_nombre">Nombre de artículo</label>
                            <input type="text" class="form-control" id="edit_articulo_nombre"
                                   name="edit_articulo_nombre"
                                   placeholder="Introduzca nombre de artículo" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="edit_articulo_descripcion">Descripción</label>
                            <input type="text" class="form-control" id="edit_articulo_descripcion"
                                   name="edit_articulo_descripcion" placeholder="Introduzca descripción de artículo"
                                   autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="edit_articulo_familia">Familia</label>
                            <select class="form-control edit_articulo_familia" id="edit_articulo_familia" name="edit_articulo_familia"
                                    style="width: 100% !important;">
                                <option></option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_articulo_active">Estado</label>
                            <select class="form-control" id="edit_articulo_active" name="edit_articulo_active">
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>

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

<?php if (in_array('deleteBrand', $user_permission)): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeArticuloModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Eliminar artículo</h4>
                </div>

                <form role="form" action="<?php echo base_url('articulos/remove') ?>" method="post"
                      id="removeArticuloForm">
                    <div class="modal-body">
                        <p>Está seguro de que desea eliminar este artículo?</p>
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



<?php if (in_array('createBrand', $user_permission)): ?>
    <!-- create brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addFamiliaModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Añadir Familia</h4>
                </div>
                <form role="form" action="<?php echo base_url('familia/create') ?>" method="post"
                      id="createFamiliaForm">

                    <div class="modal-body">

                        <div class="form-group">
                            <label for="familia_nombre">Nombre de familia</label>
                            <input type="text" class="form-control" id="familia_nombre" name="familia_nombre"
                                   placeholder="Introduzca nombre de familia" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="familia_descripcion">Descripción</label>
                            <input type="text" class="form-control" id="familia_descripcion"
                                   name="familia_descripcion" placeholder="Introduzca descripción de familia"
                                   autocomplete="off">
                        </div>

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
<?php if (in_array('updateBrand', $user_permission)): ?>
    <!-- edit brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editFamiliaModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar familia</h4>
                </div>

                <form role="form" action="<?php echo base_url('familia/update') ?>" method="post"
                      id="updateFamiliaForm">

                    <div class="modal-body">

                        <div id="messages"></div>
                        <div class="form-group">
                            <label for="edit_familia_nombre">Nombre de familia</label>
                            <input type="text" class="form-control" id="edit_familia_nombre" name="edit_familia_nombre"
                                   placeholder="Introduzca nombre de familia" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="edit_familia_descripcion">Descripción</label>
                            <input type="text" class="form-control" id="edit_familia_descripcion"
                                   name="edit_familia_descripcion" placeholder="Introduzca descripción de familia"
                                   autocomplete="off">
                        </div>
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

<?php if (in_array('deleteBrand', $user_permission)): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeFamiliaModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Eliminar familia</h4>
                </div>

                <form role="form" action="<?php echo base_url('familia/remove') ?>" method="post"
                      id="removeFamiliaForm">
                    <div class="modal-body">
                        <p>Está seguro de que desea eliminar esta familia?</p>
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

        $("#articuloNav").addClass('active');
        // $(".edit_articulo_familia").select2();
        //init select
        initselect();

        $("#verFamiliaModal").click(function () {
            if ($(this).hasClass("btn-info")) {
                $("#famGrid").show(100);
                $("#addFamiliaButton").show(100);
                $(this).removeClass("btn-info").addClass("btn-warning");
                $(this).html("Ocultar familias");
            } else {
                $("#famGrid").hide(100);
                $("#addFamiliaButton").hide(100);
                $(this).removeClass("btn-warning").addClass("btn-info");
                $(this).html("Mostrar familias");
            }
        });

        $("#addFamiliaButton").click(function () {
            $("#addFamiliaModal").modal('show');
        });


        $("#jqGrid").jqGrid({

            url: base_url + "articulos/fetchArticulosDataFilteringPagination",
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
                },
                {
                    label: 'Nombre',
                    name: 'Nombre',
                    index: 'Nombre',
                    sorttype: 'text',
                    // width: "2px",
                    align: 'center'
                    // formatter: formatLink
                },
                {
                    label: 'Descripción',
                    name: 'Descripcion',
                    index: 'Descripción',
                    // width: "3px",
                    sorttype: 'text',
                    align: 'center'
                }, {
                    label: 'Familia',
                    name: 'Familia',
                    index: 'Familia',
                    // width: "3px",
                    sorttype: 'text',
                    align: 'center'
                }, {
                    label: 'Estado',
                    name: 'Activo',
                    index: 'Activo',
                    // width: "3px",
                    align: 'center'
                }, {
                    label: 'Control',
                    name: 'Buttons',
                    index: 'Control',
                    // width: "3px",
                    align: 'center',
                    sortable:false,
                }
            ],

            viewrecords: true, // show the current page, data rang and total records on the toolbar
            width: "auto",
            height: "auto",
            rowNum: 10,
            rowList : [10, 20, 50, 100],
            autowidth: true,
            pager: "#jqGridPager",
            caption: "Artículos",

            loadComplete: function () {

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


            $("#familiaGrid").jqGrid({

                url: base_url + "familia/fetchFamiliaDataFilteringPagination",
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
                    },
                    {
                        label: 'Nombre',
                        name: 'Nombre',
                        index: 'Nombre',
                        sorttype: 'text',
                        // width: "2px",
                        align: 'center'
                        // formatter: formatLink
                    },
                    {
                        label: 'Descripción',
                        name: 'Descripcion',
                        index: 'Descripción',
                        // width: "3px",
                        sorttype: 'text',
                        align: 'center'
                    }, {
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
                pager: "#familiyPager",
                caption: "Familias",

                loadComplete: function () {

                },
            });


            Change2jQGridDesign("#familiaGrid", "#familiyPager");

            function Change2jQGridDesign(table, pager) {
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

                    var objRows = $("#familiaGrid tr").splice(1);
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

        }


        // submit the create from
        $("#createArticuloForm").unbind('submit').on('submit', function () {
            var form = $(this);

            // remove the text-danger
            $(".text-danger").remove();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(), // /converting the form data into array and sending it to server
                dataType: 'json',
                success: function (response) {

                    console.log();
                    $('#jqGrid').trigger('reloadGrid');

                    if (response.success === true) {
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                            '</div>');


                        // hide the modal
                        $("#addArticuloModal").modal('hide');

                        // reset the form
                        $("#createArticuloForm")[0].reset();
                        $("#createArticuloForm .form-group").removeClass('has-error').removeClass('has-success');

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

    });

    // edit function
    function editFunc(id) {
        // console.log(base_url+'getArticuloDataById/' + id,);
        $.ajax({
            url: base_url + 'articulos/getArticuloDataById/' + id,
            type: 'post',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $("#edit_articulo_nombre").val(response.Nombre);
                $("#edit_articulo_descripcion").val(response.Descripcion);
                // $("#edit_articulo_familia> [value=" + response.Familia + "]").attr("selected", "true");
                $(".edit_articulo_familia").val(response.Familia);
                $(".edit_articulo_familia").trigger('change.select2');
                $("#edit_articulo_active> [value=" + response.Activo + "]").attr("selected", "true");
                $("#edit_articulo_active").change();

                // submit the edit from
                $("#updateArticuloForm").unbind('submit').bind('submit', function () {
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
                                $("#editArticuloModal").modal('hide');
                                // reset the form
                                $("#updateArticuloForm .form-group").removeClass('has-error').removeClass('has-success');

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
            $("#removeArticuloForm").on('submit', function () {

                var form = $(this);

                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: {articulo_id: id},
                    dataType: 'json',
                    success: function (response) {

                        $('#jqGrid').trigger('reloadGrid');

                        if (response.success === true) {
                            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                '</div>');

                            // hide the modal
                            $("#removeArticuloModal").modal('hide');

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


    //FOR FAMILIA
    // submit the create from
    $("#createFamiliaForm").unbind('submit').on('submit', function () {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(), // /converting the form data into array and sending it to server
            dataType: 'json',
            success: function (response) {

                // console.log("ENTRA");
                $('#familiaGrid').trigger('reloadGrid');

                if (response.success === true) {
                    $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                        '</div>');


                    //reload the select
                    initselect();


                    // hide the modal
                    $("#addFamiliaModal").modal('hide');

                    // reset the form
                    $("#createFamiliaForm")[0].reset();
                    $("#createFamiliaForm .form-group").removeClass('has-error').removeClass('has-success');

                    // if(confirm("Necesita recargar la página para operar con las nuevsa entradas. Si no desea seguir introduciendo más familias, pulse OK!!"))
                    //     location.reload();

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


    // edit function
    function editFamilia(id) {
        // console.log(base_url+'getArticuloDataById/' + id,);
        $.ajax({
            url: base_url + 'familia/getFamiliaDataById/' + id,
            type: 'post',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $("#edit_familia_nombre").val(response.Nombre);
                $("#edit_familia_descripcion").val(response.Descripcion);

                // submit the edit from
                $("#updateFamiliaForm").unbind('submit').bind('submit', function () {
                    var form = $(this);

                    // remove the text-danger
                    $(".text-danger").remove();

                    $.ajax({
                        url: form.attr('action') + '/' + id,
                        type: form.attr('method'),
                        data: form.serialize(), // /converting the form data into array and sending it to server
                        dataType: 'json',
                        success: function (response) {

                            $('#familiaGrid').trigger('reloadGrid');
                            //reload the select
                            initselect();
                            if (response.success === true) {
                                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                    '</div>');


                                // hide the modal
                                $("#editFamiliaModal").modal('hide');
                                // reset the form
                                $("#updateFamiliaForm .form-group").removeClass('has-error').removeClass('has-success');

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
    function removeFamilia(id) {
        if (id) {
            $("#removeFamiliaForm").on('submit', function () {

                var form = $(this);

                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: {familia_id: id},
                    dataType: 'json',
                    success: function (response) {

                        $('#familiaGrid').trigger('reloadGrid');
                        //reload the select
                        initselect();
                        if (response.success === true) {
                            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                '</div>');

                            // hide the modal
                            $("#removeFamiliaModal").modal('hide');

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

    function initselect(){

        console.log("START");

        $('.articulo_familia').empty();
        $('.edit_articulo_familia').empty();

        $.ajax({
            url: base_url+"articulos/getFamiliaData",
            type: 'GET',
            contentType: 'application/json; charset=utf-8'
        }).then(function (response) {

            // Conversion to Select2 data format
            var results = [];
            response = JSON.parse(response) ;
            console.log(response);

            $.each(response, function (i, element) {
                // console.log(element);
                // console.log(i);
                results.push(
                    {
                        "id": element.ID,
                        "text": element.Nombre
                    }
                )
            });
            console.log(results);
            $('.articulo_familia').select2({
                width: '100%',
                placeholder: 'Seleccione famiilia',
                data: results,
                // multiple: false,
                // maximumSelectionLength: 1,
                allowClear: true,
                containerCssClass: "margin-bottom-1",
            });

            console.log("ENTRA");
            $('.edit_articulo_familia').select2({
                width: '100%',
                placeholder: 'Seleccione famiilia',
                data: results,
                // multiple: false,
                // maximumSelectionLength: 1,
                allowClear: true,
                containerCssClass: "margin-bottom-1",
            });
        });
    }

</script>