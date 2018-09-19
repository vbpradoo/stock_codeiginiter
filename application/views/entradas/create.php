<script src="https://cdn.datatables.net/1.10.17/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.17/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.6/js/dataTables.select.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/locale/es.js"></script>

<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Control
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


                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Añadir Entrada</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="form-group">
                            <label for="lote_serial">Id Lote</label>
                            <input type="text" class="form-control" id="lote_serial" name="lote_serial"
                                   placeholder="Introduzca Id Lote" autocomplete="off"/>
                        </div>

                        <form role="form"  method="post" enctype="multipart/form-data" id="initForm">
                            <?php echo validation_errors(); ?>


                            <!--  Añadimos la referencia al articulo -->
                            <div id="Articulo" class="form-group" style="display: none;">
                                <label for="articulo">Código de Producto</label>
                                <select class="form-control select_group" id="articulo" name="articulo"
                                        style="width: 100% !important;">
                                    <?php foreach ($articulos as $k => $v): ?>
                                        <option id="<?php echo $v['ID'] ?>"
                                                value="<?php echo $v['ID'] ?>"> <?php echo $v['Nombre'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div id="Proovedor" class="form-group" style="display: none;">
                                <label for="proovedor">Proveedor</label>
                                <select class="form-control select_group" id="proovedor" name="proovedor[]">
                                    <?php foreach ($proovedor as $k => $v): ?>
                                        <option id="<?php echo $v['ID'] ?>"
                                                value="<?php echo $v['ID'] ?>"><?php echo $v['Nombre'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div id="Fecha" class="form-group" style="display: none;">
                                <label for="fecha">Fecha</label>
                                <input type="text" class="form-control" id="fecha" name="fecha"
                                       placeholder="Introduzca Fecha" autocomplete="off" readonly/>
                            </div>

                            <div id="Division" class="box-body" style="display: none;">
                                <?php if (in_array('createProduct', $user_permission)): ?>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal" type="button">Añadir
                                        Elemento
                                    </button>
                                    <br>
                                <?php endif; ?>
                                <table id="jqGrid" class="table table-bordered table-striped"></table>
                                <div id="jqGridPager"></div>
                            </div>

                            <div id="Cantidad" class="form-group" style="display: none;">
                                <label for="cantidad">Cantidad</label>
                                <input type="text" class="form-control" id="cantidad" name="cantidad"
                                       placeholder="Introduzca cantidad" autocomplete="off"/>
                            </div>

                            <div id="Precio" class="form-group" style="display: none;">
                                <label for="precio">Precio</label>
                                <input type="text" class="form-control" id="precio" name="precio"
                                       placeholder="Introduzca precio" autocomplete="off"/>
                            </div>
                            <div id="Coste" class="form-group" style="display: none;">
                                <label for="coste">Coste</label>
                                <input type="text" class="form-control" id="coste" name="coste"
                                       placeholder="Introduzca coste" autocomplete="off"/>
                            </div>
                            <div id="Almacen" class="form-group" style="display: none;">
                                <label for="almacen">Almacén</label>
                                <select class="form-control select_group" id="almacen" name="almacen">
                                    <?php foreach ($almacenes as $k => $v): ?>
                                        <option id="<?php echo $v['ID'] ?>"
                                                value="<?php echo $v['ID'] ?>"><?php echo $v['Nombre'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div id="Descripcion" class="form-group" style="display: none;">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" type="text" class="form-control" name="descripcion"
                                          placeholder="Introduzca descripción" autocomplete="off">
                                </textarea>
                            </div>


                            <!--                            <div class="form-group">-->
                            <!--                                <label for="store">Availability</label>-->
                            <!--                                <select class="form-control" id="availability" name="availability">-->
                            <!--                                    <option value="1">Yes</option>-->
                            <!--                                    <option value="2">No</option>-->
                            <!--                                </select>-->
                            <!--                            </div>-->

                            <!-- /.box-body -->

                            <div class="box-footer" id="Footer" style="display: none;">
                                <button id="Enviar" type="button" class="btn btn-primary">Guardar entrada</button>
                                <a href="<?php echo base_url('entradas/create') ?>" class="btn btn-warning">Volver</a>
                            </div>
                        </form>
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


<?php if (in_array('createProduct', $user_permission)): ?>
    <!-- create brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Añadir Elemento</h4>
                </div>

                <form role="form"  action="<?php echo base_url('lotes/createDivision') ?>" method="post" id="createForm">

                    <div class="modal-body">
                        <div id="messages"></div>

                        <div class="form-group">
                            <label for="create_piezas">Piezas</label>
                            <input type="text" class="form-control" id="create_piezas" name="create_piezas"
                                   placeholder="Introduzca piezas" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="create_ancho">Ancho</label>
                            <input type="text" class="form-control" id="create_ancho" name="create_ancho"
                                   placeholder="Introduzca ancho" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="create_alto">Alto</label>
                            <input type="text" class="form-control" id="create_alto" name="create_alto"
                                   placeholder="Introduzca alto" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="create_largo">Largo</label>
                            <input type="text" class="form-control" id=create_largo" name="create_largo"
                                   placeholder="Introduzca largo" autocomplete="off">
                        </div>
<!--                        <div style="display: none;" class="form-group">-->
<!--                              <label for="create_lote">Largo</label>-->
<!--                            <input type="text" class="form-control" id=create_lote" name="create_lote"-->
<!--                                   placeholder="Introduzca largo" autocomplete="off">-->
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
                    <h4 class="modal-title">Editar Elemento</h4>
                </div>

                <form role="form" action="<?php echo base_url('lotes/editDivisionDataById') ?>" method="post"
                      id="updateForm">

                    <div class="modal-body">
                        <div id="messages"></div>

                        <div class="form-group">
                            <label for="edit_piezas">Piezas</label>
                            <input type="text" class="form-control" id="edit_piezas" name="edit_piezas"
                                   placeholder="Introduzca piezas" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="edit_ancho">Ancho</label>
                            <input type="text" class="form-control" id="edit_ancho" name="edit_ancho"
                                   placeholder="Introduzca ancho" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="edit_alto">Alto</label>
                            <input type="text" class="form-control" id="edit_alto" name="edit_alto"
                                   placeholder="Introduzca alto" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="edit_largo">Largo</label>
                            <input type="text" class="form-control" id="edit_largo" name="edit_largo"
                                   placeholder="Introduzca largo" autocomplete="off">
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

<?php if (in_array('deleteProduct', $user_permission)): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Eliminar Elemento</h4>
                </div>

                <form role="form" method="post" id="removeForm">
                    <div class="modal-body">
                        <p>Está seguro de que desea eliminar el elemento?</p>
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
    var divisionTable;
    var base_url = "<?php echo base_url(); ?>";
    var lote;
    var editor;
    var form=$("#initForm");;

    $(document).ready(function () {

        $(".select_group").select2({width: 'resolve'});



        //Load todays date
        var date = moment.locale('es');
        $("#fecha").val(moment(Date.now()));

        //I add for display
        document.getElementById("lote_serial").addEventListener('input', function (evt) {
            var serial = document.getElementById('lote_serial').value;

            if (serial.length === 6) {
                console.log(base_url + 'lotes/getLoteByName');

                //WE PLACE HERE OUR ALGORITHM TO DETECT FORMAT SERIAL

                serial = 'serial=' + serial;
                $.ajax({
                    url: base_url + "lotes/getLoteByName",
                    data: serial,

                }).done(function (evt) {
                    //Cargamos la información previa si eciste LOTE
                    if (evt !== null) {

                        form.attr("action",base_url+'lotes/updateFromEntrada');
                        console.log(form.attr("action"));

                        console.log(evt);
                        lote = JSON.parse(evt);
                        //Create array query
                        console.log(lote.Division);
                        var obj = JSON.parse(lote.Division);
                        var string = "?";
                        for (var i = 0; i < obj.id.length; i++) {
                            if (i === obj.id.length - 1)
                                string += "id[]=" + obj.id[i];
                            else
                                string += "id[]=" + obj.id[i] + "&";
                        }




                        // initialize the datatable
                        // divisionTable = $('#divisionTable').DataTable({
                        //     'lengthChange': 'false',
                        //     'ajax': base_url + 'lotes/getDivisionData' + string,
                        //     'dataSrc': 'data',
                        //     'order': [],
                        //     "columns": [
                        //         {"width": "20%"},
                        //         {"width": "20%"},
                        //         {"width": "20%"},
                        //         {"width": "20%"},
                        //         {"width": "20%"},
                        //         {"width": "20%"}
                        //     ],
                        //
                        // });
                        //
                        // $('#divisionTable tbody').on('click', function () {
                        //     if ($(this).hasClass('selected')) {
                        //         $(this).removeClass('selected');
                        //     }
                        //     else {
                        //         divisionTable.$('tr.selected').removeClass('selected');
                        //         $(this).addClass('selected');
                        //     }
                        // });
                        console.log(lote.ID);
                        string = "?id="+lote.ID;
                        initJqGrid(string);

                        console.log(lote.Articulo + "\t" + lote.Almacen);

                        $("#articulo").val(lote.Articulo).change();
                        // $("#proovedores").val(lote.Proovedor).change();
                        $("#cantidad").val(lote.Cantidad);
                        $("#precio").val(lote.Precio);
                        $("#coste").val(lote.Coste);
                        $("#almacen").val(lote.Almacen).change();
                        $("#descripcion").val(lote.Descripcion);
                        $("#descripcion").wysihtml5();

//                        console.log(lote.Articulo+"\t"+lote.Almacen);
                        console.log($("#articulo").val() + "\t");
                        console.log($("#almacen").val());

                        $("#Articulo").show(100);
                        $("#Proovedor").show(100);
                        $("#Division").show(200);
                        $("#Cantidad").show(200);
                        $("#Precio").show(300);
                        $("#Coste").show(400);
                        $("#Almacen").show(500);
                        $("#Descripcion").show(500);
                        $("#Footer").show(600);
                        // $("#descripcion").val(lote.Descripcion);

                    }
                }).fail(function (){

                    if(confirm("El lote no existe, quiere crear uno nuevo¿?")) {
                        form.attr("action",base_url+'lotes/create');
                        //Crear lote nuevo.
                        console.log(serial);
                        $.ajax({
                            url: base_url + 'lotes/create/?'+serial,
                            type: 'post',
                            // data: serial,
                            dataType: 'json'
                        }).done( function (response) {


                                $("#Articulo").show(100);
                                $("#Proovedor").show(100);
                                $("#Division").show(200);
                                $("#Cantidad").show(200);
                                $("#Precio").show(300);
                                $("#Coste").show(400);
                                $("#Almacen").show(500);
                                $("#Descripcion").show(500);
                                $("#Footer").show(600);

                        });
                    }



                });
            }

        });


        $("#Enviar").on('click', function () {

            // remove the text-danger
            $(".text-danger").remove();

            console.log(form.attr("action"));

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

        $("#articulo").change(function () {
            console.log($("#articulo").val());
            if ($("#articulo").val() !== "")
                $("#Proovedor").show();
        });
        document.getElementById("proovedor").addEventListener('select', function (evt) {
            if (evt.val() !== "")
                $("#Fecha").show();
        });
        document.getElementById("fecha").addEventListener('select', function (evt) {
            if (evt.val() !== "")
                $("#Division").show();
            $("#Cantidad").show();
        });
        document.getElementById("cantidad").addEventListener('input', function (evt) {
            if (evt.val() !== "")
                $("#Precio").show()
        });
        document.getElementById("precio").addEventListener('input', function (evt) {
            $("#Almacen").show()
        });
        document.getElementById("almacen").addEventListener('input', function (evt) {
            $("#Descripcion").show()
        });

        $("#mainEntryNav").addClass('active');
        $("#addEntry").addClass('active');

        var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' +
            'onclick="alert(\'Call your custom code here.\')">' +
            '<i class="glyphicon glyphicon-tag"></i>' +
            '</button>';


        // $("#product_image").fileinput({
        //     overwriteInitial: true,
        //     maxFileSize: 1500,
        //     showClose: false,
        //     showCaption: false,
        //     browseLabel: '',
        //     removeLabel: '',
        //     browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
        //     removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
        //     removeTitle: 'Cancel or reset changes',
        //     elErrorContainer: '#kv-avatar-errors-1',
        //     msgErrorClass: 'alert alert-block alert-danger',
        //     // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        //     layoutTemplates: {main2: '{preview} ' + btnCust + ' {remove} {browse}'},
        //     allowedFileExtensions: ["jpg", "png", "gif"]
        // });

    });

    function initJqGrid(string) {
        var lastsel;
        $("#jqGrid").jqGrid({

            url: base_url + 'lotes/getDivisionDataByLote' + string,
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
                    label: 'Piezas',
                    name: 'Piezas',
                    index: 'Piezas',
                    sorttype: 'text',
                    // width: "2px",
                    align: 'center'
                    // formatter: formatLink
                },
                {
                    label: 'Ancho',
                    name: 'Ancho',
                    index: 'Ancho',
                    // width: "3px",
                    sorttype: 'text',
                    // formatter: 'number',
                    align: 'center'
                }, {
                    label: 'Alto',
                    name: 'Alto',
                    index: 'Alto',
                    sorttype: 'text',
                    // width: "3px",
                    align: 'center'
                },
                {
                    label: 'Largo',
                    name: 'Largo',
                    index: 'Largo',
                    sorttype: 'text',
                    // width: "3px",
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
            rowNum: 15,
            editing: true,
            autowidth: true,
            pager: "#jqGridPager",
            caption: "Divisiones",

            // gridComplete: function(){
            //     var ids = jQuery("#jqGrid").jqGrid('getDataIDs');
            //     for(var i=0;i < ids.length;i++) {
            //         var cl = ids[i];
            //         be = "<input style='height:22px;width:20px;' type='button' value='E' onclick=\"jQuery('#rowed2').editRow('" + cl + "');\"  />";
            //             // jQuery("#jqGrid").{('setRowData',ids[i],{act:be});
            //     }
            // },

            onSelectRow: function (id) {
                if (id && id !== lastsel) {
                    console.log(id);
                    // $('#jqGrid').jqGrid('restoreRow', lastsel);
                    $('#jqGrid').jqGrid('editRow', id, true);
                    lastsel = id;
                }
            }

        });


        // document.getElementById("lote_serial").addEventListener('input', function (evt) {
        //
        // });

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
                var $grid = $(table), newWidth = $grid.closest(".ui-jqgrid").parent().width() - 50;
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
            });
        }
    }


    // submit the create from
    $("#createForm").unbind('submit').on('submit', function () {
        var form = $(this);
        //We place the action for the add Division Form
        console.log(lote);
        form.attr('action',base_url+'lotes/createDivision/'+lote.ID);
        // $("#create_lote").val(lote.ID);
        // remove the text-danger
        $(".text-danger").remove();
        console.log("ENTRA CREATE");

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(), // /converting the form data into array and sending it to server
            dataType: 'json',
            success: function (response) {

                console.log("SUCCESS");
                $('#jqGrid').trigger('reloadGrid');

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

    // });

    // edit function
    function editFunc(id) {
        $.ajax({
            url: base_url + 'lotes/getDivisionDataById/' + id,
            type: 'post',
            dataType: 'json',
            success: function (response) {
                console.log(response.Piezas);
                $("#edit_piezas").val(response.Piezas);
                $("#edit_alto").val(response.Alto);
                $("#edit_ancho").val(response.Ancho);
                $("#edit_largo").val(response.Largo);

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
                            console.log(response)

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

                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: {div_id: id},
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