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
                        <form role="form" method="post" enctype="multipart/form-data" id="initForm">
                            <?php echo validation_errors(); ?>

                            <div class="form-group">
                                <label for="lote_serial">Id Lote</label>
                                <input type="text" class="form-control" id="lote_serial" name="lote_serial"
                                       placeholder="Introduzca Id Lote" autocomplete="off" maxlength="11"/>
                            </div>
                            <!--  Añadimos la referencia al articulo -->
                            <div id="Articulo" class="form-group" style="display: none;">
                                <label for="articulo">Código de Producto</label>
                                <select class="form-control select_group" id="articulo" name="articulo"
                                        style="width: 100% !important;">
                                    <?php foreach ($articulos as $k => $v): ?>
                                        <option id="<?php echo $v['ID'] ?>"
                                                value="<?php echo $v['ID'] ?>"> <?php echo $v['Serial'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div id="Proovedor" class="form-group" style="display: none;">
                                <label for="proovedor">Proveedor</label>
                                <select class="form-control select_group" id="proovedor" name="proovedor"
                                        style="width: 100% !important;">
                                    <?php foreach ($proovedor as $k => $v): ?>
                                        <option id="<?php echo $v['ID'] ?>"
                                                value="<?php echo $v['ID'] ?>"><?php echo $v['Nombre'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div id="Pagado" class="form-group" style="display: none;">
                                <label for="pagado">Estado</label>
                                <select class="form-control select_group" id="pagado" name="pagado">
                                    <option value="0">Sin pagar</option>
                                    <option value="1">Pagado</option>
                                </select>
                            </div>

                            <div id="Fecha" class="form-group" style="display: none;">
                                <label for="fecha">Fecha</label>
                                <input type="text" class="form-control" id="fecha" name="fecha"
                                       placeholder="Introduzca Fecha" autocomplete="off" readonly/>
                            </div>

                            <div id="Division" class="box-body" style="display: none;">
                                <?php if (in_array('createProduct', $user_permission)): ?>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"
                                            type="button">Añadir
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


                            <div class="box-footer" id="Footer" style="display: none;">
                                <button id="Enviar" type="submit" class="btn btn-primary">Guardar entrada</button>
                                <a href="javascript:volverFunc();" class="btn btn-warning">Volver</a>
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

                <form role="form" method="post" id="createForm">

                    <div class="modal-body">
                        <div id="messages"></div>

                        <div class="form-group">
                            <label for="create_piezas">Piezas</label>
                            <input type="text" class="form-control" id="create_piezas" name="create_piezas"
                                   placeholder="Introduzca piezas" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="create_largo">Largo</label>
                            <input type="text" class="form-control" id="create_largo" name="create_largo"
                                   placeholder="Introduzca largo" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="create_alto">Alto</label>
                            <input type="text" class="form-control" id="create_alto" name="create_alto"
                                   placeholder="Introduzca alto" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="create_espesor">Espesor</label>
                            <input type="text" class="form-control" id="create_espesor" name="create_espesor"
                                   placeholder="Introduzca espesor" autocomplete="off">
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

                <form role="form"  method="post" id="updateForm">

                    <div class="modal-body">
                        <div id="messages"></div>

                        <div class="form-group">
                            <label for="edit_piezas">Piezas</label>
                            <input type="text" class="form-control" id="edit_piezas" name="edit_piezas"
                                   placeholder="Introduzca piezas" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="edit_largo">Largo</label>
                            <input type="text" class="form-control" id="edit_largo" name="edit_largo"
                                   placeholder="Introduzca largo" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="edit_alto">Alto/Ancho</label>
                            <input type="text" class="form-control" id="edit_alto" name="edit_alto"
                                   placeholder="Introduzca alto" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="edit_espesor">Espesor</label>
                            <input type="text" class="form-control" id="edit_espesor" name="edit_espesor"
                                   placeholder="Introduzca espesor" autocomplete="off">
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

    var base_url = "<?php echo base_url(); ?>";
    var lote;
    var editor;
    var form = $("#initForm");
    var map = new Map();
    var row_id=0;

    $(document).ready(function () {

        $(".select_group").select2({width: 'resolve'});
        $("#entradasNav").addClass('active');
        $("#createENav").addClass('active');
        $("#descripcion").wysihtml5();

        //I add for display
        document.getElementById("lote_serial").addEventListener('input', function (evt) {
            var serial = document.getElementById('lote_serial').value;

            if (serial.length === 11 && validateSerial(serial)) {
                console.log(base_url + 'lotes/LoteExists');

                //WE PLACE HERE OUR ALGORITHM TO DETECT FORMAT SERIAL

                // serial = 'serial=' + serial;
                $.ajax({
                    url: base_url + "lotes/LoteExists/" + serial
                }).done(function (evt) {
                    //Cargamos la información previa si eciste LOTE
                    $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + "El lote ya existe" +
                        '</div>');

                }).fail(function () {

                    if (confirm("El lote no existe, quiere crear uno nuevo¿?")) {

                        // console.log(response);

                        //Inicailizo el Grid
                        initJqGrid();

                        // lote = response.loteID;

                        viewAll();

                    }
                });
            }
            else if (serial.length === 11) {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + "Formato de lote invalido." +
                    '</div>');

                document.getElementById('lote_serial').value = "";
            }

        });


        // $("#Enviar").on('click', function () {

        $("#initForm").unbind('submit').on('submit', function () {

            // remove the text-danger
            $(".text-danger").remove();

            //First we need to create the Entrada
            var form = $("#initForm");
            var string = form.serialize() + "&division="+JSON.stringify(strMapToObj(map)) ;
            console.log(form.attr("action"));
            form.attr("action", base_url + "lotes/createLote");
            console.log("SIOH");
            console.log(form.serialize());
            console.log(string);

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: string    , // /converting the form data into array and sending it to server
                dataType: 'json',
                success: function (response) {

                    // console.log();
                    // $('#jqGrid').trigger('reloadGrid');

                    if (response.success === true) {
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                            '</div>');

                        $("#messages").append('<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.message_entrada +
                            '</div>');
                        var i=0;
                        response.messages_div.forEach(function(div) {
                            console.log(lote);
                            if(response.success_div[i]) {
                                $("#messages").append('<div class="alert alert-success alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + div +
                                    '</div>');
                            }
                            else{
                                $("#messages").append('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + div +
                                    '</div>');
                            }
                            i++;
                        });


                        // reset the form and our global parameters
                        $("#initForm")[0].reset();
                        $("#initForm .form-group").removeClass('has-error').removeClass('has-success');
                        map = new Map();
                        row_id=0;

                        closeAll();
                        $("#jqGrid").jqGrid("clearGridData");


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
                            $("#messages").append('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.message_entrada +
                                '</div>');
                            var j=0;
                            response.messages_div.forEach(function(div) {
                                console.log(lote);
                                if(response.success_div[j]) {
                                    $("#messages").append('<div class="alert alert-success alert-dismissible" role="alert">' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + div +
                                        '</div>');
                                }
                                else{
                                    $("#messages").append('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + div +
                                        '</div>');
                                }
                                j++;
                            });
                        }
                    }
                }
            });

            return false;
        });


        // $("#articulo").change(function () {
        //     console.log($("#articulo").val());
        //     if ($("#articulo").val() !== "")
        //         $("#Proovedor").show();
        // });
        // document.getElementById("proovedor").addEventListener('select', function (evt) {
        //     if (evt.val() !== "")
        //         $("#Fecha").show();
        // });
        // document.getElementById("fecha").addEventListener('select', function (evt) {
        //     if (evt.val() !== "")
        //         $("#Division").show();
        //     $("#Cantidad").show();
        // });
        // document.getElementById("cantidad").addEventListener('input', function (evt) {
        //     if (evt.val() !== "")
        //         $("#Precio").show()
        // });
        // document.getElementById("precio").addEventListener('input', function (evt) {
        //     $("#Almacen").show()
        // });
        // document.getElementById("almacen").addEventListener('input', function (evt) {
        //     $("#Descripcion").show()
        // });

    });

    // function volverFunc() {
    //     console.log("ENTRAA");
    //     $.ajax({
    //         url: base_url + "lotes/removeFromEntrada?id=" + lote,
    //     }).done(function (evt) {
    //         //Cargamos la información previa si eciste LOTE
    //         console.log("Eliminado lote ID:" + lote);
    //
    //         window.location.href = base_url + "entradas/index";
    //
    //     })
    // }

    function viewAll() {
        $("#Articulo").show(100);
        $("#Proovedor").show(100);
        $("#Pagado").show(100);
        //Load todays date
        moment.locale('es');
        $("#fecha").val(moment().format('DD/MM/YYYY'));
        $("#Fecha").show(100);
        $("#Division").show(200);
        $("#Cantidad").show(200);
        // $("#cantidad").prop("disabled", true);
        $("#Precio").show(300);
        $("#Coste").show(400);
        $("#Almacen").show(500);
        $("#Descripcion").show(500);
        $("#Footer").show(600);
    }

    function closeAll() {
        $("#Articulo").hide(100);
        $("#Proovedor").hide(100);
        $("#Pagado").hide(100);
        $("#Fecha").hide(100);
        $("#Division").hide(200);
        $("#Cantidad").hide(200);
        // $("#cantidad").prop("disabled", true);
        $("#Precio").hide(300);
        $("#Coste").hide(400);
        $("#Almacen").hide(500);
        $("#Descripcion").hide(500);
        $("#Footer").hide(600);
    }

    function initJqGrid(string) {
        var lastsel;
        $("#jqGrid").jqGrid({

            // url: base_url + 'lotes/getDivisionDataByLote' + string,
            datatype: "json",
            styleUI: "Bootstrap",
            colModel: [
                // {
                //     label: 'ID',
                //     name: 'ID',
                //     index: 'ID',
                //     sorttype: 'number',
                //     // width: "1px",
                //     align: 'center'
                //     // formatter: formatTitle
                // },
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
                    label: 'Largo',
                    name: 'Largo',
                    index: 'Largo',
                    // width: "3px",
                    sorttype: 'text',
                    // formatter: 'number',
                    align: 'center'
                }, {
                    label: 'Ancho/Alto',
                    name: 'Alto',
                    index: 'Alto',
                    sorttype: 'text',
                    // width: "3px",
                    align: 'center'
                },
                {
                    label: 'Espesor',
                    name: 'Espesor',
                    index: 'Espesor',
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
                var $grid = $(table), newWidth = $grid.closest(".ui-jqgrid").parent().width() - 50;
                $grid.jqGrid("setGridWidth", newWidth, true);

            });
        }
    }


    // submit the create from
    $("#createForm").unbind('submit').on('submit', function () {
        var form = $(this);
        //We place the action for the add Division Form
        console.log(lote);
        form.attr('action', base_url + 'lotes/checkDivFormatCreate');


        $(".text-danger").remove();
        console.log("ENTRA CREATE");

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(), // /converting the form data into array and sending it to server
            dataType: 'json',
            success: function (response) {

                console.log("SUCCESS EN CREATE");
                if (response.success === true) {
                    $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                        '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                        '</div>');

                    // Añadir Fila
                        var buttons = '<button type="button" class="btn btn-default" onclick="editFunc('+row_id+')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';


                        buttons += ' <button type="button" class="btn btn-default" onclick="removeFunc('+row_id+')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';


                    var data = {
                        'Piezas': parseInt($("#create_piezas").val()),
                        'Largo': parseFloat($("#create_largo").val()),
                        'Alto': parseFloat($("#create_alto").val()),
                        'Espesor': parseFloat($("#create_espesor").val()),
                        'Piezas_Stock': parseFloat($("#create_piezas").val()),
                        'Lote':"",
                        'Buttons': buttons,
                    }

                    $('#jqGrid').jqGrid("addRowData", row_id, data);
                    // hide the modal
                    $("#addModal").modal('hide');

                    delete  data.Buttons;
                    map.set(row_id, data);
                    // console.log(response.division);
                    getCantidad();
                    // reset the form
                    $("#createForm")[0].reset();
                    $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

                    row_id++;


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
                $('#jqGrid').trigger('reloadGrid');


            }
        });
        return false;

    });


    // });

    // edit function
    function editFunc(id) {
        console.log(id);
            var row = $("#jqGrid").jqGrid("getRowData",id);
            console.log(row);
            $("#edit_piezas").val(row.Piezas);
            $("#edit_alto").val(row.Alto);
            $("#edit_largo").val(row.Largo);
            $("#edit_espesor").val(row.Espesor);

            // submit the edit from
            $("#updateForm").unbind('submit').bind('submit', function () {
                var form = $(this);
                form.attr('action', base_url + 'lotes/checkDivFormatEdit');

                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: form.serialize(), // /converting the form data into array and sending it to server
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response);


                        if (response.success === true) {
                            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                '</div>');


                            var data = {
                                'Piezas': parseInt($("#edit_piezas").val()),
                                'Piezas_Stock': parseInt($("#edit_piezas").val()),
                                'Largo': parseFloat($("#edit_largo").val()),
                                'Alto': parseFloat($("#edit_alto").val()),
                                'Espesor': parseFloat($("#edit_espesor").val()),
                                'Lote': "",
                            };

                            //Change row data
                            $('#jqGrid').jqGrid("setRowData", id, data);


                            // hide the modal
                            $("#editModal").modal('hide');

                            console.log("EDIT:  "+id);
                            map.set(id, data);

                            getCantidad();


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
                        $('#jqGrid').trigger('reloadGrid');

                    }
                });

                return false;
            });


    }


    // remove functions
    function removeFunc(id) {

        $("#removeForm").unbind('submit').bind('submit', function () {

            var response = $('#jqGrid').jqGrid("delRowData", id);

            $('#jqGrid').trigger('reloadGrid');

            if (response === true) {
                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + "Eliminado correctamente!!" +
                    '</div>');
                console.log(id);
                map.delete(id);
                getCantidad();
                // hide the modal
                $("#removeModal").modal('hide');

            } else {

                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + "No se pudo eliminar la división !!" +
                    '</div>');
            }

            return false;
        });

    }

    function getCantidad() {
        console.log("ENTRA");
        var alto = 0, largo = 0, piezas = 0, espesor = 0;
        var data_lineal=0, data_area=0, data_vol=0;
        for (const value of map.values()) {

            // alto += value.Alto;
            // largo += value.Largo;
            // piezas += value.Piezas;
            // espesor += value.Espesor;
            data_lineal += value.Piezas * value.Largo;
            data_area += value.Piezas * value.Largo* value.Alto;
            data_vol += value.Piezas * value.Largo * value.Alto * value.Espesor;

        }


        $("#cantidad").val("Lineal T: " + data_lineal + "m" + "\tÁrea T: " + data_area + "m²" + "\tVolumen T: " + data_vol + "m³");

    }

    ///VALIDATE DATA,

    //HANDLE THE GOING BACK
    $(window).on('beforeunload', function () {
        alert("CUIDADO!!!");
    });


    function validateSerial(serial) {

        var pattern = new RegExp('^[0-9]$');
        var pattern_letters = new RegExp('^[A-Z]$');
        var string = serial.split("");
        if (string[0] !== 'L')
            return false;
        else if (!pattern.test(string[1]))
            return false;
        else if (!pattern.test(string[2]))
            return false;
        else if (!pattern_letters.test(string[3]))
            return false;
        else if (!pattern_letters.test(string[4]))
            return false;
        else if (!pattern_letters.test(string[5]))
            return false;
        else if (!pattern.test(string[6]))
            return false;
        else if (!pattern.test(string[7]))
            return false;
        else if (!pattern.test(string[8]))
            return false;
        else if (!pattern.test(string[9]))
            return false;
        else if (!pattern_letters.test(string[10]))
            return false;
        else
            return true;
    }

    function strMapToObj(strMap) {
        let obj = Object.create(null);
        for (let [k,v] of strMap) {
            // We don’t escape the key '__proto__'
            // which can cause problems on older engines
            obj[k] = v;
        }
        return obj;
    }
</script>