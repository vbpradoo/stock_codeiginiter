<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Historial
            <small>Entradas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Principal</a></li>
            <li class="active">Entradas</li>
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
                    <a class="btn btn-primary" href="<?php echo base_url('entradas/createEntrada') ?>">Añadir Entrada</a>
                    <br/> <br/>
                <?php endif; ?>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Historial de Entradas</h3>
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

<?php //if (in_array('createStore', $user_permission)): ?>
<!--    <!-- create brand modal -->-->
<!--    <div class="modal fade" tabindex="-1" role="dialog" id="addModal">-->
<!--        <div class="modal-dialog" role="document">-->
<!--            <div class="modal-content">-->
<!--                <div class="modal-header">-->
<!--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span-->
<!--                                aria-hidden="true">&times;</span></button>-->
<!--                    <h4 class="modal-title">Añadir Almacén</h4>-->
<!--                </div>-->
<!---->
<!--                <form role="form" action="--><?php //echo base_url('almacenes/create') ?><!--" method="post" id="createForm">-->
<!---->
<!--                    <div class="modal-body">-->
<!---->
<!--                        <div class="form-group">-->
<!--                            <label for="brand_name">Nombre Almacén</label>-->
<!--                            <input type="text" class="form-control" id="store_name" name="store_name"-->
<!--                                   placeholder="Introduzca nombre de almacén" autocomplete="off">-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="brand_name">Localización</label>-->
<!--                            <input type="text" class="form-control" id="store_location" name="store_location"-->
<!--                                   placeholder="Introduzca locallización de almacén" autocomplete="off">-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="active">Estado</label>-->
<!--                            <select class="form-control" id="active" name="active">-->
<!--                                <option value="1">Activo</option>-->
<!--                                <option value="2">Inactivo</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="modal-footer">-->
<!--                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>-->
<!--                        <button type="submit" class="btn btn-primary">Guardar cambios</button>-->
<!--                    </div>-->
<!---->
<!--                </form>-->
<!---->
<!---->
<!--            </div><!-- /.modal-content -->-->
<!--        </div><!-- /.modal-dialog -->-->
<!--    </div><!-- /.modal -->-->
<?php //endif; ?>

<?php if (in_array('updateProduct', $user_permission)): ?>
    <!-- edit brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="editModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar Entrada</h4>
                </div>

                <form role="form" action="<?php echo base_url('entradas/update') ?>" method="post" id="updateForm">

                    <div class="modal-body">
                        <div id="messages"></div>

<!--                        <div class="form-group">-->
<!--                            <label for="edit_proovedor">Proovedor</label>-->
<!--                            <input type="text" class="form-control" id="edit_proovedor" name="edit_proovedor"-->
<!--                                   placeholder="" autocomplete="off">-->
<!--                        </div>-->
                        <div class="form-group">
                            <label for="edit_fecha">Fecha</label>
                            <input type="text" class="form-control" id="edit_fecha" name="edit_fecha"
                                   placeholder="Introduzca fecha" autocomplete="off">
                        </div>
<!--                        <div class="form-group">-->
<!--                            <label for="edit_cantidad">Cantidad</label>-->
<!--                            <input type="text" class="form-control" id="edit_cantidad" name="edit_cantidad"-->
<!--                                   placeholder="Introduzca cantidad" autocomplete="off">-->
<!--                        </div>-->
<!--                        <div class="form-group">-->
<!--                            <label for="edit_descripcion">Descripción</label>-->
<!--                            <input type="text" class="form-control" id="edit_descripcion" name="edit_descripcion"-->
<!--                                   placeholder="Introduzca descripción" autocomplete="off">-->
<!--                        </div>-->
                        <div class="form-group">
                            <label for="edit_active">Estado</label>
                            <select class="form-control select_group" id="edit_active" name="edit_active">
                                <option value="1">Pagado</option>
                                <option value="2">Sin pagar</option>
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

<?php if (in_array('deleteStore', $user_permission)): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Eliminar Almacén</h4>
                </div>

                <form role="form" action="<?php echo base_url('entradas/remove') ?>" method="post" id="removeForm">
                    <div class="modal-body">
                        <p>Está seguro de que desea eliminar el lote?</p>
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
    var manageTable;
    var base_url = "<?php echo base_url(); ?>";

    $(document).ready(function () {

        $("#storeNav").addClass('active');
        $(".select_group").select2({width: 'resolve'});

        $("#jqGrid").jqGrid({

            url: base_url + "entradas/fetchEntradasDataFilteringPagination",
            datatype:"json",
            styleUI:"Bootstrap",
            colModel: [
                {
                    label: 'ID',
                    name: 'ID',
                    index:'ID',
                    sorttype: 'number',
                    // width: "1px",
                    align: 'center'
                    // formatter: formatTitle
                },{
                    label: 'Lote',
                    name: 'Serial',
                    index:'Serial',
                    sorttype: 'text',
                    // width: "2px",
                    align: 'center'
                    // formatter: formatLink
                },
                {
                    label: 'Proovedor',
                    name: 'Proovedor',
                    index:'Proovedor',
                    sorttype: 'text',
                    // width: "2px",
                    align: 'center'
                    // formatter: formatLink
                },
                {
                    label: 'Fecha',
                    name: 'Fecha',
                    index:'Fecha',
                    // width: "3px",
                    sorttype: 'text',
                    // formatter: 'number',
                    align: 'center'
                },{
                    label: 'Cantidad',
                    name: 'Cantidad',
                    index:'Cantidad',
                    // width: "3px",
                    sorttype: 'text',
                    align: 'center'
                },{
                    label: 'Descripción',
                    name: 'Descripcion',
                    index:'Descripcion',
                    // width: "3px",
                    sorttype: 'text',
                    // formatter: 'number',
                    align: 'center'
                },{
                    label: 'Estado',
                    name: 'Pagado',
                    index:'Pagado',
                    // width: "3px",
                    align: 'center'
                },{
                    label: 'Control',
                    name: 'Buttons',
                    index:'Control',
                    // width: "3px",
                    align: 'center'
                }
            ],

            viewrecords: true, // show the current page, data rang and total records on the toolbar
            width: "auto",
            height: "auto",
            rowNum: 10,
            rowList : [10, 20, 50, 100],
            autowidth:true,
            pager: "#jqGridPager",
            caption: "Almacenes",

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
            $('.navtable .ui-pg-button').tooltip({ container: 'body' });
            $(table).find('.ui-pg-div').tooltip({ container: 'body' });

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
        // fetchGridData();

        // function fetchGridData() {
        //
        //     var gridArrayData = [];
        //     // show loading message
        //     $("#jqGrid")[0].grid.beginReq();
        //     $.ajax({
        //
        //         type: "GET",
        //         url: base_url + "almacenes/getAlmacenesData",
        //
        //         success: function (result) {
        //             console.log(typeof result);
        //             for (var i = 0; i < result.length; i++) {
        //                 var item = result.items[i];
        //                 gridArrayData.push({
        //                     ID: item.ID,
        //                     Nombre: item.Nombre,
        //                     Localizacion: item.Localizacion,
        //                     Activo: item.Activo,
        //                     // AnswerC: item.answer_count
        //                 });
        //             }
        //             // set the new data
        //             $("#jqGrid").jqGrid('setGridParam', {data: gridArrayData});
        //             // hide the show message
        //             $("#jqGrid")[0].grid.endReq();
        //             // refresh the grid
        //             $("#jqGrid").trigger('reloadGrid');
        //         }
        //     });
        // }

        function formatTitle(cellValue, options, rowObject) {
            return cellValue.substring(0, 50) + "...";
        };

        function formatLink(cellValue, options, rowObject) {
            return "<a href='" + cellValue + "'>" + cellValue.substring(0, 25) + "..." + "</a>";
        };


        // initialize the datatable
        // manageTable = $('#manageTable').DataTable({
        //     'ajax': 'fetchStoresData',
        //     'order': []
        // });

        // $("#jsGrid").jsGrid({
        //     width: "80%",
        //     height: "auto",
        //
        //     inserting: true,
        //     editing: true,
        //     sorting: true,
        //     paging: true,
        //     autoload:true,
        //
        //     deleteConfirm: function(item) {
        //         return "The client \"" + item.Name + "\" will be removed. Are you sure?";
        //     },
        //     rowClick: function(args) {
        //        // showDetailsDialog("Edit", args.item);
        //     },
        //
        //     controller: {
        //         loadData: function() {
        //             var d = $.Deferred();
        //             console.log(base_url);
        //             $.ajax({
        //                 url: base_url+"almacenes/getAlmacenesData",
        //                 dataType: "json"
        //                 // data: filter,
        //
        //             }).done(function(response) {
        //                 var data=[];
        //
        //                 $.each(response,function (i, almacen) {
        //                    console.log(almacen);
        //                     data.push(almacen);
        //                 });
        //                 console.log(data);
        //                 //data=[{"ID":1,"Nombre":"Goulla","Localizacion":"DEsc"}];
        //                 d.resolve(data);
        //             });
        //
        //             return d.promise();
        //         }
        //     },
        //
        //     fields: [
        //         {name: "ID",title:"ID", type: "number", width: "20%"},
        //         {name: "Nombre", title:"Nombre", type: "text", width: "20%", validate: "required"},
        //         {name: "Localizacion",title:"Localización", type: "text", width: "20%"},
        //         {name: "Activo",title:"Activo", type: "number", width: "20%"},
        //         {type: "control"}
        //     ]
        // });


        // submit the create from
        $("#createForm").unbind('submit').on('submit', function () {
            var form = $(this);

            // remove the text-danger
            $(".text-danger").remove();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(), // /converting the form data into array and sending it to server
                dataType: 'json',
                success: function (response) {

                    $('#jqGrid').trigger( 'reloadGrid' );

                    if (response.success === true) {
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                            '</div>');


                        // hide the modal
                        $("#addModal").modal('hide');

                        // reset the form
                        $("#createForm")[0].reset();
                        $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

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
        $.ajax({
            url: 'getEntradasDataById/' + id,
            type: 'post',
            dataType: 'json',
            success: function (response) {
                console.log(response);

                // $("#edit_proovedor").val(response.Proovedor);
                $("#edit_fecha").val(response.Fecha);
                // $("#edit_cantidad").val(response.Cantidad);
                // $("#edit_descripcion").val(response.Descripcion);

                $("#edit_active").val(response.Pagado);
                $("#edit_active").trigger('change.select2');

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

                            $('#jqGrid').trigger( 'reloadGrid');
                            console.log("ENTRA");
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

                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: {entrada_id: id},
                    dataType: 'json',
                    success: function (response) {

                        $('#jqGrid').trigger( 'reloadGrid' );

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
