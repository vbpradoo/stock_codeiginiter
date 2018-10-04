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
            Editar
            <small>Lote</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Principal</a></li>
            <li class="active">Lotes</li>
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
                        <h3 class="box-title">Editar Lote</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <button class="btn btn-primary" data-toggle="modal" id="xSerial"
                                type="button">Buscar por Serial
                        </button>
                        <button class="btn btn-primary" data-toggle="modal" id="xArticulo"
                                type="button">Buscar por Artículo
                        </button>



                        <form id="editLoteForm" role="form" method="post"  enctype="multipart/form-data" >
                            <?php echo validation_errors(); ?>

                            <div class="form-group" id="Serial" style="display: none;">
                                <label for="lote_serial">Id Lote</label>
                                <select type="text" class="form-control lote_serial" id="lote_serial" name="lote_serial" style="margin-top:1%;">
                                    <option></option>
                                </select>
                            </div>

                            <!--  Añadimos la referencia al articulo -->
                            <div id="Articulo" class="form-group" style="display: none;">
                                <label for="articulo">Código de Producto</label>
                                <select class="form-control select_group articulo_serial" id="articulo" name="articulo"
                                        style="width: 100% !important;">
                                    <?php foreach ($articulos as $k => $v): ?>
                                        <option id="<?php echo $v['ID'] ?>"
                                                value="<?php echo $v['ID'] ?>"> <?php echo $v['Nombre'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <!-- Guardo el valor para poder madarlo en el form-->
<!--                            <div id="articulo_value" class="form-group" style="visibility: hidden;"> -->
<!--                            </div> -->


                            <div id="Proovedor" class="form-group" style="display: none;">
                                <label for="proovedor">Proveedor</label>
                                <select class="form-control select_group" id="proovedor" name="proovedor" style="width: 100% !important;">
                                    <?php foreach ($proovedores as $k => $v): ?>
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
                                <a href="<?php echo base_url('lotes/index') ?>" class="btn btn-warning">Volver</a>
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

                <form role="form" action="<?php echo base_url('lotes/createDivision') ?>" method="post" id="createForm">

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
                            <label for="edit_alto">Alto</label>
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
    var path=false;
    var base_url = "<?php echo base_url(); ?>";
    var lote;
    var map =new Map();

    $(document).ready(function () {

        $(".select_group").select2({width: 'resolve'});
        // $("#descripcion").wysihtml5();
        //Checkout if this have been call from index
        var url = new URL(window.location.href);
        var index_serial = url.searchParams.get("lote_serial");
        var index_id = url.searchParams.get("lote_id");

        if(index_serial !== "" && index_serial !== null) {
            console.log(index_serial);
            $("#Serial").show(100);
            $("#xSerial").hide(100);
            $("#xArticulo").hide(100);
            // console.log(results);
            var results= [];
            results.push(
                {
                    "id": index_id,
                    "text": index_serial,
                });
            $('.lote_serial').select2({
                width: '100%',
                placeholder: 'Seleccione Serial',
                data: results,
                allowClear: true,
                containerCssClass: "margin-bottom-1",
            });

            $("#lote_serial").val(index_serial);
            $("#lote_serial").trigger('change.select2');
            // $("#lote_serial").change();

        }


        initJqGrid();
        $("#editLNav").addClass('active');
        $("#lotesNav").addClass('active');

        //I add for display
        $("#lote_serial").unbind().change(function (evt) {

            //WE PLACE HERE OUR ALGORITHM TO DETECT FORMAT SERIAL

            var serial = 'serial=' + $("#lote_serial option:selected").text().trim().toString();
            console.log(serial);
            $.ajax({
                url: base_url + "lotes/getLoteByName",
                data: serial,

            }).then(function (evt) {
                //Cargamos la información previa si eciste LOTE
                console.log(evt);
                lote = JSON.parse(evt);
                var id = "id="+lote.Entrada;

                $.ajax({
                    url: base_url + "entradas/getEntradasDataByIdURL",
                    dataType: 'json',
                    data: id,

                }).done(function(entrada) {

                    console.log("ENTRADA_"+entrada);

                    //Create array query
                    console.log(lote.Division);
                    var obj = JSON.parse(lote.Division);
                    // console.log("EOHH");
                    var string = "?";
                    for (var i = 0; i < obj.id.length; i++) {
                        if (i === obj.id.length - 1)
                            string += "id[]=" + obj.id[i];
                        else
                            string += "id[]=" + obj.id[i] + "&";
                    }

                    // console.log(lote.ID);
                    string = "id=" + lote.ID;
                    //We reset the grid
                    $("#jqGrid").jqGrid("clearGridData");
                    console.log("PROCECESOA"+string);
                    $("#jqGrid").jqGrid().setGridParam({url : "getDivisionDataByLote?"+string}).trigger("reloadGrid");

                    $("#articulo").val(lote.Articulo).change();
                    $("#entrada").val(lote.Entrada);
                    $("#proovedor").val(entrada.Proovedor).change();
                    $("#fecha").val(entrada.Fecha);
                    // console.log("Proovedor:" + $("#proovedor").val() + "\tOri:" + lote.Proovedor);
                    $("#cantidad").val(lote.Cantidad);
                    $("#precio").val(lote.Precio);
                    $("#coste").val(lote.Coste);
                    $("#almacen").val(lote.Almacen).change();
                    $("#descripcion").val(lote.Descripcion);

                    // $("#lote_serial").select2({ disabled : true });

                    $("#Articulo").show(100);
                    $("#Proovedor").show(100);
                    $("#Fecha").show(100);
                    $("#Division").show(200);
                    $("#Cantidad").show(200);
                    $("#Precio").show(300);
                    $("#Coste").show(400);
                    $("#Almacen").show(500);
                    $("#Descripcion").show(500);
                    $("#Footer").show(600);
                    // $("#descripcion").val(lote.Descripcion);
                });

            }).fail(function () {

                alert("Error al extraer los datos de lote");
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">' +
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + "Error al acceder a la información de lote" +
                    '</div>');

            });


        });


        // $("#Enviar").on('click', function () {
        $("#editLoteForm").unbind('submit').on('submit', function() {
            var form = $("#editLoteForm");
            // remove the text-danger
            $(".text-danger").remove();

            var lote_id="lote_id="+lote.ID;

            form.attr("action",base_url+'lotes/update?'+lote_id);
            console.log(form.attr("action"));
            // console.log(form.serialize());
            $("#lote_serial").select2({ disabled : false });
            var data = form.serialize()+"&entrada="+lote.Entrada;
            if(path)
             data += "&articulo="+$("#articulo").prop("value");
            console.log(data);
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: data,
                dataType: 'json',
                success: function (response) {

                    console.log();
                    $('#jqGrid').trigger('reloadGrid');

                    if (response.success === true) {
                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                            '</div>');

                        // reset the form
                        $("#editLoteForm")[0].reset();
                        $("#editLoteForm .form-group").removeClass('has-error').removeClass('has-success');

                        $("#Serial").hide(100);
                        $("#Articulo").hide(100);
                        $("#Proovedor").hide(100);
                        $("#Fecha").hide(100);
                        $("#Division").hide(200);
                        $("#Cantidad").hide(200);
                        $("#Precio").hide(300);
                        $("#Coste").hide(400);
                        $("#Almacen").hide(500);
                        $("#Descripcion").hide(500);
                        $("#descripcion").remove();
                        $("#Footer").hide(600);
                        $("#xSerial").show(600);
                        $("#xArticulo").show(600);
                        $("#lote_serial").select2({ disabled : false });
                        $("#articulo").select2({ disabled : false });

                        // location.reload();

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


        $("#xSerial").unbind().click(function(){
            path=false;
            $("#Serial").show(100);
            $("#xSerial").hide(100);
            $("#xArticulo").hide(100);

            $.ajax({
                url: base_url+"lotes/fetchLoteSerial",
                type: 'GET',
                contentType: 'application/json; charset=utf-8'
            }).then(function (response) {

                // Conversion to Select2 data format
                var results = [];
                response = JSON.parse(response).rows;
                $.each(response, function (i, element) {
                    // console.log(element.Serial);
                    // console.log(i);
                    results.push(
                        {
                            "id": i,
                            "text": element.Serial
                        }
                    )
                });
                // console.log(results);
                $('.lote_serial').select2({
                    width: '100%',
                    placeholder: 'Seleccione Serial',
                    data: results,
                    allowClear: true,
                    containerCssClass: "margin-bottom-1",
                });
            });

        });

        $("#xArticulo").unbind().click(function(){
            path=true;
            $("#Articulo").show(100);
            $("#xSerial").hide(100);
            $("#xArticulo").hide(100);
            $.ajax({
                url: base_url+"articulos/fetchArticuloNombre",
                type: 'GET',
                contentType: 'application/json; charset=utf-8'
            }).then(function (response) {

                response = JSON.parse(response).rows;
                // Conversion to Select2 data format
                var results = [];
                $.each(response, function (i, element) {
                    // console.log(element);
                    results.push(
                        {
                            "id": element.ID,
                            "text": element.Nombre
                        }
                    )
                });


                $('.articulo_serial').select2({
                    width: '100%',
                    placeholder: 'Seleccione Artículo',
                    data: results,
                    allowClear: true,

                    containerCssClass: "margin-bottom-1",
                });
                // allSelect2Fields.push($('.spacecraft-select-ajax'))

                //Mostraos el selector de serial una vez escogido el producto
                $("#Articulo").unbind().change(function () {

                    // $("#articulo_value").val($("#articulo").val());
                    $("#articulo").select2({ disabled : true });
                    // $("#articulo").prop(value);

                    // console.log("DENTRO ");
                    document.getElementById("Articulo").appendChild(document.getElementById("Serial"));
                    $("#Serial").show(100);
                    var articulo= "articulo_id="+$("#Articulo option:selected").val();
                    // console.log(articulo);

                    $.ajax({
                        url: base_url + "lotes/fetchLoteSerialByArticulo",
                        type: 'GET',
                        data: articulo,
                        contentType:'application/json; charset=utf-8'
                    }).done(function (response) {

                        // $(".lote_serial").select2("destroy");

                        // $(".lote_serial").empty();
                        // $("#lote_serial").addClass(".lote_serial");
                        // console.log("CAMBIA");
                        // Conversion to Select2 data format
                        var results = [];
                        response = JSON.parse(response).rows;
                        $.each(response, function (i, element) {
                            // console.log(element.Serial);
                            // console.log(i);
                            results.push(
                                {
                                    "id": i,
                                    "text": element.Serial
                                }
                            )
                        });

                        $('.lote_serial').select2({
                            width: '100%',
                            placeholder: 'Seleccione Serial',
                            data: results,
                            allowClear: true,
                            containerCssClass: "margin-bottom-1",
                        });
                    });
                });


            });

        });
    });

    // function changeJqGrid(string){
    //     //We reset the grid
    //     $("#jqGrid").jqGrid("clearGridData");
    //     console.log("PROCECESOA");
    //     $("#jqGrid").jqGrid().setGridParam({url : "getDivisionDataByLote?"+string}).trigger("reloadGrid");
    //
    // }

    function initJqGrid() {
        var lastsel;
        // console.log("initJqGrid             "+ string);
        // $("#jqGrid").trigger("reloadGrid");

        $("#jqGrid").jqGrid({

            datatype: "json",
            loadonce: false,
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
                    label: 'Alto/Ancho',
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

            onSelectRow: function (id) {
                if (id && id !== lastsel) {
                    console.log(id);
                    // $('#jqGrid').jqGrid('restoreRow', lastsel);
                    $('#jqGrid').jqGrid('editRow', id, true);
                    lastsel = id;
                }
            },

            loadComplete: function(response){

                /*********FUNCION PARA OBTENER LA CANTIDAD**************/
                response.rows.forEach(function(data) {
                    console.log(data);
                    var datos={'Piezas':parseInt(data.Piezas),'Largo':parseFloat(data.Largo),'Alto': parseFloat(data.Alto),'Espesor':parseFloat(data.Espesor)};
                    map.set(parseInt(data.ID),datos);

                });
                getCantidad();
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
        form.attr('action', base_url + 'lotes/createDivision/' + lote.ID);
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
                    map.set(response.division,data);
                    // console.log(response.division);
                    // getCantidad();
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
                            console.log(response)

                            $('#jqGrid').trigger('reloadGrid');

                            if (response.success === true) {
                                $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.messages +
                                    '</div>');

                                // hide the modal
                                $("#editModal").modal('hide');

                                // var data ={'Piezas':parseInt($("#edit_piezas").val()),'Largo':parseFloat($("#edit_largo").val()),'Alto': parseFloat($("#edit_alto").val()),'Espesor':parseFloat($("input[name=edit_espesor]").val())};
                                // map.set(id,data);
                                //
                                // getCantidad();
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
                form.attr("action",base_url+"lotes/deleteDivision")
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


    //HANDLE THE GOING BACK
    $(window).on('beforeunload', function() {
        alert("CUIDADO!!!");
    });



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

</script>