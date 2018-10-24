<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/select_bootstrap_resp.css') ?>">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Control
            <small>Salidas</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Principal</a></li>
            <li class="active">Salidas</li>
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
                        <h3 class="box-title">Añadir Salida</h3>
                    </div>
                    <!-- /.box-header -->
                    <form role="form" method="post" class="form-horizontal" id="createForm">
                        <div class="box-body">

                            <?php echo validation_errors(); ?>

                            <div class="form-group">
                                <label for="gross_amount"
                                       class="col-sm-12 control-label">Fecha: <?php echo date('d-m-Y') ?></label>
                            </div>
                            <div class="form-group">
                                <label for="gross_amount"
                                       class="col-sm-12 control-label">Hora: <?php echo date('h:i a') ?></label>
                            </div>

                            <div class="col-md-4 col-xs-12 pull pull-left">

                                <div class="form-group">
                                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Cliente</label>
                                    <div class="col-sm-7">
                                        <select class="form-control select_cliente" id="cliente_nombre"
                                                name="cliente_nombre"
                                                style="width:100%;" required>
                                            <option value="">Seleccione nombre de cliente</option>
                                            <?php foreach ($clientes as $k => $v): ?>
                                                <option value="<?php echo $v['ID'] ?>"> <?php echo $v['Nombre'] ?> </option>
                                            <?php endforeach ?>
                                        </select>
                                        <!--                      <input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre" placeholder="Introduzca nombre de cliente" autocomplete="off" />-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Empresa</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="cliente_empresa"
                                               name="cliente_empresa" placeholder="Introduzca empresa"
                                               autocomplete="off" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">NIF</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="cliente_nif"
                                               name="cliente_nif" placeholder="Introduzca NIF"
                                               autocomplete="off" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;">Teléfono</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="cliente_telefono"
                                               name="cliente_telefono" placeholder="Introduzca teléfono"
                                               autocomplete="off" disabled>
                                    </div>
                                </div>
                            </div>


                            <br/> <br/>
                            <table class="table table-bordered" id="salida_table">
                                <thead>
                                <tr>
                                    <th style="width:20%">Lote</th>
                                    <th style="width:20%">Artículo</th>
                                    <th style="width:25%">División</th>
                                    <!--                      <th style="width:10%">Qty</th>-->
                                    <th style="width:15%">Cantidad</th>
                                    <th style="width:10%%">Stock</th>
                                    <th style="width:10%">
                                        <button type="button" id="add_row" class="btn btn-default"><i
                                                    class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr id="row_1">
                                    <td>
                                        <select class="form-control select_lote" data-row-id="row_1" id="lote_1"
                                                name="lote[]" style="width:100%;" onchange="getLoteData(1)" required>
                                            <option value=""></option>
                                            <?php foreach ($lotes as $k => $v): ?>
                                                <option value="<?php echo $v['ID'] ?>"> <?php echo $v['Serial'] ?> </option>
                                            <?php endforeach ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control select_articulo" data-row-id="row_1" id="articulo_1"
                                                name="articulo[]" onchange="getLoteFromArticulo(1)" style="width:100%;"
                                                required>
                                            <option value=""></option>
                                            <?php foreach ($articulos as $k => $v): ?>
                                                <option value="<?php echo $v['ID'] ?>"> <?php echo $v['Serial'] ?> </option>
                                            <?php endforeach ?>
                                        </select>
                                        <select class="form-control" data-row-id="row_1" id="articulo_hidden_1"
                                                name="articulo_hidden[]" style="width:100%; visibility: hidden;">
                                            <option value=""></option>
                                            <?php foreach ($articulos as $k => $v): ?>
                                                <option value="<?php echo $v['ID'] ?>"> <?php echo $v['Serial'] ?> </option>
                                            <?php endforeach ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control select_division" data-row-id="row_1" id="division_1"
                                                name="division[]" style="width:100%;" onchange="enCantidadStock(1)"
                                                required>
                                            <option value=""></option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="cantidad[]" id="cantidad_1" class="form-control"
                                               onchange="getTotal(1)" disabled required>
                                    </td>
                                    <td>
                                        <input type="text" name="stock[]" id="stock_1" class="form-control" disabled
                                               autocomplete="off">
                                        <input type="hidden" name="stock_hidden[]" id="stock_hidden_1"
                                               class="form-control"
                                               autocomplete="off">
                                        <input type="hidden" name="division_largo[]" id="division_largo_1"
                                               class="form-control"
                                               autocomplete="off">
                                        <input type="hidden" name="division_alto[]" id="division_alto_1"
                                               class="form-control"
                                               autocomplete="off">
                                        <input type="hidden" name="division_espesor[]" id="division_espesor_1"
                                               class="form-control"
                                               autocomplete="off">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-default" onclick="removeRow('1')"><i
                                                    class="fa fa-close"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <br/> <br/>

                            <div class="col-md-6 col-xs-12 pull pull-right">

                                <div class="form-group">
                                    <label for="gross_amount" class="col-sm-5 control-label">Cantidad Total</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="cantidad_total"
                                               name="cantidad_total" disabled autocomplete="off">
                                        <input type="hidden" name="cantidad_total_hidden" id="cantidad_total_hidden"
                                               class="form-control"
                                               autocomplete="off">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <a target="__blank" type="button" id="imp_presupuesto" class="btn btn-success" style="display: none;">Imprimir Presupuesto</a>
                            <button type="submit" id="env_salida" class="btn btn-primary">Efectuar Salida</button>
                            <a href="<?php echo base_url('salidas/index') ?>" class="btn btn-warning">Volver</a>
                        </div>
                    </form>
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

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    var option = true;
    var cantidad_total = new Map();
    var divisiones_selected = new Map();
    var table_index = 1;

    $(document).ready(function () {
        $(".select_lote").select2();
        // $(".select_cliente").select2();
        $(".select_articulo").select2();
        $(".select_division").select2();
        // $("#description").wysihtml5();

        $("#mainSalidasNav").addClass('active');
        $("#addSalidaNav").addClass('active');

        var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' +
            'onclick="alert(\'Call your custom code here.\')">' +
            '<i class="glyphicon glyphicon-tag"></i>' +
            '</button>';

        // Add new row in the table
        $("#add_row").unbind('click').bind('click', function () {
            //We initialize the switch
            option = true;
            var table = $("#salida_table");
            // var count_table_tbody_tr = $("#salida_table tbody tr").length;
            var count_table_tbody_tr = table_index;
            table_index++;
            var row_id = count_table_tbody_tr + 1;

            // $.ajax({
            //     url: base_url + '/salidas/getLoteSalida',
            //     type: 'get',
            //     dataType: 'json',
            //     success: function (response) {

            // console.log(reponse.x);

            var html = '<tr id="row_' + row_id + '">' +
                '<td>' +
                '<select class="form-control"  data-row-id="' + row_id + '" id="lote_' + row_id + '" name="lote[]" style="width:100%;" onchange="getLoteData(' + row_id + ')">' +
                '<option value=""></option>' +
                <?php foreach ($lotes as $k => $v): ?>
                '<option value="<?php echo $v['ID'] ?>"> <?php echo $v['Serial'] ?> </option>' +
                <?php endforeach ?>
                '</select>' +
                '</td>';
            html += '<td>' +
                '<select class="form-control select_articulo" data-row-id="row_' + row_id + '" id="articulo_' + row_id + '" name="articulo[]" onchange="getLoteFromArticulo(' + row_id + ')" style="width:100%;" required>' +
                '<option value=""></option>' +
                <?php foreach ($articulos as $k => $v): ?>
                '<option value="<?php echo $v['ID'] ?>"> <?php echo $v['Serial'] ?> </option>' +
                <?php endforeach ?>
                '</select>' +
                '<select type="hidden" class="form-control" data-row-id="row_' + row_id + '" id="articulo_hidden_' + row_id + '" name="articulo_hidden[]"  style="width:100%; visibility: hidden;">' +
                '<option value=""></option>' +
                <?php foreach ($articulos as $k => $v): ?>
                '<option value="<?php echo $v['ID'] ?>"> <?php echo $v['Serial'] ?> </option>' +
                <?php endforeach ?>
                '</select>' +
                '</td>' +
                '<td>' +
                '<select class="form-control select_division" data-row-id="row_' + row_id + '" id="division_' + row_id + '" name="division[]" style="width:100%;" onchange="enCantidadStock(' + row_id + ')"required>' +
                '<option value=""></option>' +
                '</select>' +
                '</td>' +
                '<td>' +
                '<input type="number" name="cantidad[]" id="cantidad_' + row_id + '" class="form-control" onchange="getTotal(' + row_id + ')" disabled required>' +
                '</td>' +
                '<td>' +
                '<input type="text" name="stock[]" id="stock_' + row_id + '" class="form-control" disabled autocomplete="off">' +
                '<input type="hidden" name="stock_hidden[]" id="stock_hidden_' + row_id + '" class="form-control"  autocomplete="off">' +
                '<input type="hidden" name="division_largo[]" id="division_largo_' + row_id + '" class="form-control" autocomplete="off">' +
                '<input type="hidden" name="division_alto[]" id="division_alto_' + row_id + '" class="form-control" autocomplete="off">' +
                '<input type="hidden" name="division_espesor[]" id="division_espesor_' + row_id + '" class="form-control" autocomplete="off">' +
                '</td>' +
                '<td><button type="button" class="btn btn-default" onclick="removeRow(' + row_id + ')"><i class="fa fa-close"></i></button></td>' +
                '</tr>';

            if (count_table_tbody_tr >= 1) {
                $("#salida_table tbody tr:last").after(html);
            }
            else {
                $("#salida_table tbody").html(html);
            }
            $("#lote_" + row_id).select2();
            $("#articulo_" + row_id).select2();
            $("#division_" + row_id).select2();

            // $(".product").select2();

            // }
            // });

            return false;
        });


        $("#cliente_nombre").unbind().change(function () {
            if ($("#cliente_nombre").val() === "") {
                $("#cliente_empresa").val("");
                $("#cliente_nif").val("");
                $("#cliente_telefono").val("");
            } else {
                <?php foreach ($clientes as $k => $v):
                ?>
                if ($("#cliente_nombre").val() === "<?php echo $v['ID'] ?>") {
                    $("#cliente_empresa").val("<?php echo($v['Empresa'])?>");
                    $("#cliente_nif").val("<?php echo($v['NIF'])?>");
                    $("#cliente_telefono").val("<?php echo($v['Telefono'])?>");
                }
                <?php endforeach ?>
            }
            // $("#cliente_nombre option:selected").trigger('change.select2');
        });

        // $("#cliente_nombre").val($(".select_cliente").val()).trigger('change.select2');

        $("#cliente_nombre").select2();
    }); // /document

    function getTotal(row = null) {
        // console.log("ENTRA 1");

        if (row) {
            console.log("ENTRA TOTAL");
            var piezas = $("#cantidad_" + row).val();
            var espesor = $("#division_espesor_" + row).val();
            var largo = $("#division_largo_" + row).val();
            var alto = $("#division_alto_" + row).val();

            var data_lineal = piezas * largo;
            var data_area = piezas * (largo * alto);
            var data_vol = piezas * (largo * alto * espesor);

            var total = {"Lineal": data_lineal, "Area": data_area, "Volumen": data_vol};
            cantidad_total.set(row, total);
            refreshTotal();
        } else {
            alert('No hay fila !! Por favor, recargue la página!');
        }
    }

    function refreshTotal() {
        var lineal = 0, area = 0, volumen = 0;
        for (const cantidad of cantidad_total.values()) {
            lineal += cantidad.Lineal;
            area += cantidad.Area;
            volumen += cantidad.Volumen;
        }

        $("#cantidad_total").prop('value', "Lineal T: " + lineal + "m" + "\tÁrea T: " + area + "m²" + "\tVolumen T: " + volumen + "m³");
        $("#cantidad_total_hidden").prop('value', "Lineal T: " + lineal + "m" + "\tÁrea T: " + area + "m²" + "\tVolumen T: " + volumen + "m³");
    }

    // get the product information from the server
    function getLoteData(row_id) {
        console.log("ENTRA POR LOTE");
        option = false;
        var lote_id = $("#lote_" + row_id).val();
        console.log(lote_id)
        if (lote_id === "") {
            $("#articulo_" + row_id).val("");
            $("#division_" + row_id).val("");

            $("#cantidad_" + row_id).val("");

            // $("#amount_"+row_id).val("");
            // $("#amount_value_"+row_id).val("");

        } else {
            console.log(lote_id);
            $.ajax({
                url: base_url + 'salidas/getLoteDataById',
                type: 'get',
                data: {lote_id: lote_id},
                dataType: 'json',
                success: function (response) {
                    // setting the rate value into the rate input field

                    $("#articulo_" + row_id).val(response.Articulo).trigger('change.select2');
                    $("#articulo_hidden_" + row_id).val(response.Articulo).trigger('change.select2');
                    $("#articulo_" + row_id).select2({disabled: true});

                    $("#division_" + row_id).empty();

                    //We get the Divisiones form the Lote.Serial
                    $.ajax({
                        url: base_url + "lotes/getDivisionDataByLote",
                        type: 'GET',
                        data: {id: lote_id},
                        contentType: 'application/json; charset=utf-8'
                    }).done(function (response) {

                        var results = [{"id": "", "text": ""}];
                        response = JSON.parse(response).rows;
                        console.log(response);

                        $.each(response, function (i, element) {
                            console.log(element);
                            // console.log(i);
                            results.push(
                                {
                                    "id": parseInt(element.ID),
                                    "text": "Largo:" + element.Largo + "m ,Alto/Ancho:" + element.Alto + "m ,Espesor:" + element.Espesor + "m"
                                }
                            )
                            for (const division of divisiones_selected.values()) {
                                if (parseInt(element.ID) === division) {

                                }
                            }
                            console.log(results[i])
                        });

                        $("#division_" + row_id).select2({
                            width: '100%',
                            placeholder: 'Seleccione elemento',
                            data: results,
                            allowClear: true,
                            containerCssClass: "margin-bottom-1",
                        });


                    });
                    // $("#division_"+row_id).val(response.Division);

                    // $("#cantidad"+row_id).val(1);

                    // $("#qty_value_"+row_id).val(1);

                    // var total = Number(response.price) * 1;
                    // total = total.toFixed(2);
                    // $("#amount_"+row_id).val(total);
                    // $("#amount_value_"+row_id).val(total);

                    // subAmount();
                } // /success
            }); // /ajax function to fetch the product data
        }
    }

    function getLoteFromArticulo(row_id) {
        console.log(option)
        if (option) {
            console.log("ENTRA POR ARTICULO");

            var articulo_id = $("#articulo_" + row_id).val();
            $("#articulo_hidden_" + row_id).val($("#articulo_" + row_id).val());

            if (articulo_id === "") {

                // $("#lote_" + row_id).val("");
                $("#division_" + row_id).val("");
                $("#cantidad_" + row_id).val("");
            } else {

                $("#lote_" + row_id).empty();
                $.ajax({
                    url: base_url + "lotes/fetchLoteSerialByArticulo",
                    type: 'GET',
                    data: {articulo_id: articulo_id},
                    contentType: 'application/json; charset=utf-8'
                }).done(function (response) {

                    var results = [{"id": "", "text": ""}];
                    response = JSON.parse(response).rows;
                    $.each(response, function (i, element) {
                        // console.log(response);
                        // console.log(i);
                        results.push(
                            {
                                "id": parseInt(element.ID),
                                "text": element.Serial
                            }
                        )
                    });

                    $("#lote_" + row_id).select2({
                        width: '100%',
                        placeholder: 'Seleccione Serial',
                        data: results,
                        allowClear: true,
                        containerCssClass: "margin-bottom-1",
                    });

                });
            }
            option = true;
        }
    }

    function enCantidadStock(row_id) {

        var division_id = $("#division_" + row_id).val();

        for (const division of divisiones_selected.values()) {
            if (division_id === division) {
                alert("Ya tiene selecionado este elemento en otra fila!!");
                $('#cantidad_' + row_id).prop('disabled', true);
                $('#stock_' + row_id).prop('value', "");
                $('#stock_hidden' + row_id).prop('value', "");
                return;
            }
        }
        //We add the division to a map in order to not repeat item
        divisiones_selected.set(row_id, division_id);

        //Significa que ha cambiado de div
        if (cantidad_total.has(row_id)) {
            cantidad_total.delete(row_id);
            refreshTotal();
        }
        $('#cantidad_' + row_id).prop('disabled', false);
        $('#cantidad_' + row_id).empty();
        $('#cantidad_' + row_id).val("");

        $.ajax({
            url: base_url + "lotes/getDivisionDataById/" + division_id,
            type: 'GET',
            contentType: 'application/json; charset=utf-8'
        }).done(function (response) {
            console.log(JSON.parse(response));
            var stock = JSON.parse(response).Piezas_Stock;
            var division = JSON.parse(response);

            $("#cantidad_" + row_id).attr({
                "max": stock,        // substitute your own
                "min": 0          // values (or variables) here
            });

            $('#stock_' + row_id).prop('value', stock);
            $('#stock_hidden_' + row_id).prop('value', stock);
            $('#division_largo_' + row_id).prop('value', division.Largo);
            $('#division_alto_' + row_id).prop('value', division.Alto);
            $('#division_espesor_' + row_id).prop('value', division.Espesor);

        });
    }


    function removeRow(tr_id) {
        $("#salida_table tbody tr#row_" + tr_id).remove();
        cantidad_total.delete(parseInt(tr_id));
        divisiones_selected.delete(parseInt(tr_id));
        refreshTotal();
        // subAmount();
    }

    // submit the create from
    $("#createForm").unbind('submit').on('submit', function () {
        var form = $(this);
        //We place the action for the add Division Form
        form.attr('action', base_url + 'salidas/create');

        $(".text-danger").remove();

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(), // /converting the form data into array and sending it to server
            dataType: 'json',
        }).done(function (response) {

                console.log(response);
                // response = JSON.parse(response);
                // console.log(response)
                // $.each(response, function () {

                    if (response.success === true) {

                        $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">' +
                            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + response.message +
                            '</div>');

                        // console.log(response.checkSold);

                        response.checkSold.forEach(function(lote) {
                            console.log(lote);
                            if(lote.success_lote) {
                                $("#messages").append('<div class="alert alert-success alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + lote.messages +
                                    '</div>');
                            }
                            else{
                                $("#messages").append('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + lote.messages +
                                    '</div>');
                            }
                        });
                        // Mostramos el boton de imprimir//
                        if(response.hasOwnProperty("sal_id")) {
                            $("#imp_presupuesto").show(100);
                            $("#imp_presupuesto").attr("href", base_url + "salidas/printDiv/" +response.sal_id);
                            $("#env_salida").hide(100);
                        }
                       //$("#createForm")[0].reset();
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
                                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + response.message +
                                '</div>');
                        }
                    }
                // });
            });

        return false;
    });

</script>