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
                                                value="<?php echo $v['ID'] ?>"> <?php echo $v['Nombre'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div id="Proovedor" class="form-group" style="display: none;">
                                <label for="proovedor">Proveedor</label>
                                <select class="form-control select_group" id="proovedor" name="proovedor" style="width: 100% !important;">
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
                            <input type="text" class="form-control"  id="create_espesor" name="create_espesor" placeholder="Introduzca espesor" autocomplete="off">
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

                <form role="form" action="<?php echo base_url('lotes/deleteDivision') ?>" method="post" id="removeForm">
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
    var map =new Map();

    $(document).ready(function () {

        $(".select_group").select2({width: 'resolve'});
        $("#entradasNav").addClass('active');
        $("#createENav").addClass('active');
        $("#descripcion").wysihtml5();

        //I add for display
        document.getElementById("lote_serial").addEventListener('input', function (evt) {
            var serial = document.getElementById('lote_serial').value;

            if (serial.length === 11 && validateSerial(serial)) {
                console.log(base_url + 'lotes/getLoteByName');

                //WE PLACE HERE OUR ALGORITHM TO DETECT FORMAT SERIAL

                serial = 'serial=' + serial;
                $.ajax({
                    url: base_url + "lotes/getLoteByName",
                    data: serial,

                }).done(function (evt) {
                    //Cargamos la información previa si eciste LOTE
                    $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                        '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + "El lote ya existe" +
                        '</div>');
                }).fail(function () {

                    if (confirm("El lote no existe, quiere crear uno nuevo¿?")) {
                        // $("#lote_serial").prop('disabled', true);
                        form.attr("action", base_url + 'lotes/create');
                        //Crear lote nuevo.
                        console.log(serial);
                        $.ajax({
                            url: base_url + 'lotes/createSerial/?' + serial,
                            type: 'post',
                            // data: serial,
                            dataType: 'json'
                        }).done(function (response) {

                            console.log(response);

                            //Inicailizo el Grid
                            initJqGrid("?id="+response.loteID);

                            lote = response.loteID;

                            viewAll();

                        });
                    }


                });
            }

            else if(serial.length === 11){
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + "Formato de lote invalido." +
                    '</div>');

                document.getElementById('lote_serial').value="";
            }

        });


        // $("#Enviar").on('click', function () {

        $("#initForm").unbind('submit').on('submit', function () {

            // remove the text-danger
            $(".text-danger").remove();

            //First we need to create the Entrada

            var form = $("#initForm");
            console.log(form.attr("action"));
            console.log(form.attr("action",base_url+"lotes/updateFromEntrada?lote_id="+lote));
            console.log("SIOH");
            console.log(form.serialize());

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(), // /converting the form data into array and sending it to server
                dataType: 'json',
                success: function (response) {

                    console.log();
                    // $('#jqGrid').trigger('reloadGrid');

                    if (response.success === true) {
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                            '</div>');


                        // reset the form
                        $("#initForm")[0].reset();
                        $("#initForm .form-group").removeClass('has-error').removeClass('has-success');
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

    function volverFunc() {
        console.log("ENTRAA");
        $.ajax({
            url: base_url + "lotes/removeFromEntrada?id=" + lote,
        }).done(function (evt) {
            //Cargamos la información previa si eciste LOTE
            console.log("Eliminado lote ID:" + lote);

            window.location.href=base_url+"entradas/index";

        })
    }
    function viewAll(){
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
    function closeAll(){
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
        form.attr('action', base_url + 'lotes/createDivision/' + lote);
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


                    var data ={'Piezas':parseInt($("#create_piezas").val()),'Largo':parseFloat($("#create_largo").val()),'Alto': parseFloat($("#create_alto").val()),'Espesor':parseFloat($("input[name=create_espesor]").val())};
                    // $("#cantidad").val("Area Total: "+data1 + "m²" +"\tVolumen Total: "+ data2 +"m³");

                    map.set(response.division,data);
                    console.log(response.division);
                    getCantidad();
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
                $("#edit_largo").val(response.Largo);
                $("#edit_espesor").val(response.Espesor);

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
                            console.log(response);

                            $('#jqGrid').trigger('reloadGrid');

                            if (response.success === true) {
                                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                    '</div>');

                                // hide the modal
                                $("#editModal").modal('hide');
                                var data ={'Piezas':parseInt($("#edit_piezas").val()),'Largo':parseFloat($("#edit_largo").val()),'Alto': parseFloat($("#edit_alto").val()),'Espesor':parseFloat($("input[name=edit_espesor]").val())};
                                map.set(id,data);

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

                            map.delete(id);
                            getCantidad(id);
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

    function getCantidad(){
        console.log("ENTRA");
        var alto=0,largo=0,piezas=0,espesor=0;
        for (const value of map.values()) {

            alto += value.Alto;
            largo += value.Largo;
            piezas += value.Piezas;
            espesor += value.Espesor;
        }
        // console.log();
        var data_lineal = piezas*largo;
        var data_area = piezas*(largo*alto);
        var data_vol = piezas*(largo*alto*espesor);

        $("#cantidad").val("Lineal T: "+data_lineal + "m" +"\tÁrea T: "+data_area + "m²" +"\tVolumen T: "+ data_vol +"m³");

    }
    ///VALIDATE DATA,

    //HANDLE THE GOING BACK
    $(window).on('beforeunload', function() {
        alert("CUIDADO!!!");
    });

    // var unloadEvent = function (e) {
    //     var confirmationMessage = "Warning: Leaving this page will result in any unsaved data being lost. Are you sure you wish to continue?";
    //     console.log("ENTRA AKI");
    //     (e || window.event).returnValue = confirmationMessage; //Gecko + IE
    //     return confirmationMessage; //Webkit, Safari, Chrome etc.
    // };
    // window.addEventListener("beforeunload", unloadEvent);
    function validateSerial(serial){

        var pattern=new RegExp('^[0-9]$');
        var pattern_letters=new RegExp('^[A-Z]$');
        var string = serial.split("");
        if(string[0]!=='L')
            return false;
        else if(!pattern.test(string[1]))
            return false;
        else if(!pattern.test(string[2]))
            return false;
        else if(!pattern_letters.test(string[3]))
            return false;
        else if(!pattern_letters.test(string[4]))
            return false;
        else if(!pattern_letters.test(string[5]))
            return false;
        else if(!pattern.test(string[6]))
            return false;
        else if(!pattern.test(string[7]))
            return false;
        else if(!pattern.test(string[8]))
            return false;
        else if(!pattern.test(string[9]))
            return false;
        else if(!pattern_letters.test(string[10]))
            return false;
        else
            return true;
    }

</script>