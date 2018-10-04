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
                        <h3 class="box-title">Añador Salida</h3>
                    </div>
                    <!-- /.box-header -->
                    <form role="form" action="<?php base_url('orders/create') ?>" method="post" class="form-horizontal">
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
                                        <select class="form-control select_cliente" id="cliente_nombre" name="cliente_nombre"
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
                                    <label for="gross_amount" class="col-sm-5 control-label" style="text-align:left;" >Empresa</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="cliente_empresa"
                                               name="cliente_empresa" placeholder="Introduzca empresa"
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
                                                <option value="<?php echo $v['ID'] ?>"> <?php echo $v['Nombre'] ?> </option>
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
                                               onkeyup="getTotal(1)" disabled required>
                                    </td>
                                    <td>
                                        <input type="text" name="stock[]" id="stock_1" class="form-control" disabled
                                               autocomplete="off">
<!--                                        <input type="hidden" name="stock_value[]" id="stock_value" class="form-control"-->
<!--                                               autocomplete="off">-->
                                    </td>
                                    <!--                        <td>-->
                                    <!--                          <input type="text" name="amount[]" id="amount_1" class="form-control" disabled autocomplete="off">-->
                                    <!--                          <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">-->
                                    <!--                        </td>-->
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
                                        <!--                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" autocomplete="off">-->
                                    </div>
                                </div>
                                <!--                  --><?php //if($is_service_enabled == true): ?>
                                <!--                  <div class="form-group">-->
                                <!--                    <label for="service_charge" class="col-sm-5 control-label">S-Charge -->
                                <?php //echo $company_data['service_charge_value'] ?><!-- %</label>-->
                                <!--                    <div class="col-sm-7">-->
                                <!--                      <input type="text" class="form-control" id="service_charge" name="service_charge" disabled autocomplete="off">-->
                                <!--                      <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" autocomplete="off">-->
                                <!--                    </div>-->
                                <!--                  </div>-->
                                <!--                  --><?php //endif; ?>
                                <!--                  --><?php //if($is_vat_enabled == true): ?>
                                <!--                  <div class="form-group">-->
                                <!--                    <label for="vat_charge" class="col-sm-5 control-label">Vat -->
                                <?php //echo $company_data['vat_charge_value'] ?><!-- %</label>-->
                                <!--                    <div class="col-sm-7">-->
                                <!--                      <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled autocomplete="off">-->
                                <!--                      <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" autocomplete="off">-->
                                <!--                    </div>-->
                                <!--                  </div>-->
                                <!--                  --><?php //endif; ?>
                                <!--                  <div class="form-group">-->
                                <!--                    <label for="discount" class="col-sm-5 control-label">Discount</label>-->
                                <!--                    <div class="col-sm-7">-->
                                <!--                      <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" autocomplete="off">-->
                                <!--                    </div>-->
                                <!--                  </div>-->
                                <!--                  <div class="form-group">-->
                                <!--                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>-->
                                <!--                    <div class="col-sm-7">-->
                                <!--                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">-->
                                <!--                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off">-->
                                <!--                    </div>-->
                                <!--                  </div>-->

                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <!--                <input type="hidden" name="service_charge_rate" value="-->
                            <?php //echo $company_data['service_charge_value'] ?><!--" autocomplete="off">-->
                            <!--                <input type="hidden" name="vat_charge_rate" value="-->
                            <?php //echo $company_data['vat_charge_value'] ?><!--" autocomplete="off">-->
                            <button type="submit" class="btn btn-primary">Efectuar Salida</button>
                            <a href="<?php echo base_url('orders/') ?>" class="btn btn-warning">Volver</a>
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
    $(document).ready(function () {
        $(".select_lote").select2();
        // $(".select_cliente").select2();
        $(".select_articulo").select2();
        $(".select_division").select2();
        // $("#description").wysihtml5();

        $("#mainOrdersNav").addClass('active');
        $("#addOrderNav").addClass('active');

        var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' +
            'onclick="alert(\'Call your custom code here.\')">' +
            '<i class="glyphicon glyphicon-tag"></i>' +
            '</button>';

        // Add new row in the table
        $("#add_row").unbind('click').bind('click', function () {
            //We initialize the switch
            option=true;
            var table = $("#salida_table");
            var count_table_tbody_tr = $("#salida_table tbody tr").length;
            var row_id = count_table_tbody_tr + 1;

            // $.ajax({
            //     url: base_url + '/salidas/getLoteSalida',
            //     type: 'get',
            //     dataType: 'json',
            //     success: function (response) {

                    // console.log(reponse.x);

                    var html ='<tr id="row_' + row_id + '">' +
                        '<td>' +
                        '<select class="form-control"  data-row-id="' + row_id + '" id="lote_'+ row_id + '" name="lote[]" style="width:100%;" onchange="getLoteData('+row_id+')">'+
                        '<option value=""></option>'+
                        <?php foreach ($lotes as $k => $v): ?>
                        '<option value="<?php echo $v['ID'] ?>"> <?php echo $v['Serial'] ?> </option>'+
                        <?php endforeach ?>
                        '</select>'+
                        '</td>';
                    html += '<td>'+
                        '<select class="form-control select_articulo" data-row-id="row_'+ row_id + '" id="articulo_'+ row_id + '" name="articulo[]" onchange="getLoteFromArticulo('+ row_id + ')" style="width:100%;" required>'+
                        '<option value=""></option>'+
                        <?php foreach ($articulos as $k => $v): ?>
                        '<option value="<?php echo $v['ID'] ?>"> <?php echo $v['Nombre'] ?> </option>'+
                        <?php endforeach ?>
                        '</select>'+
                        '</td>'+
                        '<td>'+
                        '<select class="form-control select_division" data-row-id="row_'+row_id+'" id="division_'+row_id+'" name="division[]" style="width:100%;" onchange="enCantidadStock('+row_id+')"required>'+
                        '<option value=""></option>'+
                        '</select>'+
                        '</td>'+
                        '<td>'+
                        '<input type="number" name="cantidad[]" id="cantidad_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')" disabled required>'+
                        '</td>'+
                        '<td>'+
                        '<input type="text" name="stock[]" id="stock_'+row_id+'" class="form-control" disabled autocomplete="off">'+
                        '</td>'+
                        '<td><button type="button" class="btn btn-default" onclick="removeRow(' + row_id + ')"><i class="fa fa-close"></i></button></td>' +
                        '</tr>';

                    if (count_table_tbody_tr >= 1) {
                        $("#salida_table tbody tr:last").after(html);
                    }
                    else {
                        $("#salida_table tbody").html(html);
                    }
                    $("#lote_"+row_id).select2();
                    $("#articulo_"+row_id).select2();
                    $("#division_"+row_id).select2();

                    // $(".product").select2();

                // }
            // });

            return false;
        });


        $("#cliente_nombre").unbind().change(function () {
            if ($("#cliente_nombre").val() === "") {
                $("#cliente_empresa").val("");
                $("#cliente_telefono").val("");
            } else {
                <?php foreach ($clientes as $k => $v):
                    ?>
                if ($("#cliente_nombre").val() === "<?php echo $v['ID'] ?>") {
                    $("#cliente_empresa").val("<?php echo($v['Empresa'])?>");
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
        if (row) {
            var total = Number($("#stock_value" + row).val()) * Number($("#cantidad_" + row).val());
            total = total.toFixed(2);
            //
            // $("#amount_" + row).val(total);
            // $("#amount_value_" + row).val(total);

            // subAmount();

        } else {
            alert('no row !! please refresh the page');
        }
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

        $('#cantidad_' + row_id).prop('disabled', false);
        $('#cantidad_' + row_id).empty();
        var division_id = $("#division_" + row_id).val();
        $.ajax({
            url: base_url + "lotes/getDivisionDataById/" + division_id,
            type: 'GET',
            contentType: 'application/json; charset=utf-8'
        }).done(function (response) {
            console.log(JSON.parse(response));
            var stock = JSON.parse(response).Piezas_Stock;

            $("#cantidad_" + row_id).attr({
                "max": stock,        // substitute your own
                "min": 0          // values (or variables) here
            });

            $('#stock_' + row_id).prop('value', stock);

        });
    }

    // calculate the total amount of the order
    //function subAmount() {
    //  var service_charge = <?php //echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>//;
    //  var vat_charge = <?php //echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value']:0; ?>//;
    //
    //  var tableProductLength = $("#salida_table tbody tr").length;
    //  var totalSubAmount = 0;
    //  for(x = 0; x < tableProductLength; x++) {
    //    var tr = $("#salida_table tbody tr")[x];
    //    var count = $(tr).attr('id');
    //    count = count.substring(4);
    //
    //    totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    //  } // /for
    //
    //  totalSubAmount = totalSubAmount.toFixed(2);
    //
    //  // sub total
    //  $("#gross_amount").val(totalSubAmount);
    //  $("#gross_amount_value").val(totalSubAmount);
    //
    //  // vat
    //  var vat = (Number($("#gross_amount").val())/100) * vat_charge;
    //  vat = vat.toFixed(2);
    //  $("#vat_charge").val(vat);
    //  $("#vat_charge_value").val(vat);
    //
    //  // service
    //  var service = (Number($("#gross_amount").val())/100) * service_charge;
    //  service = service.toFixed(2);
    //  $("#service_charge").val(service);
    //  $("#service_charge_value").val(service);
    //
    //  // total amount
    //  var totalAmount = (Number(totalSubAmount) + Number(vat) + Number(service));
    //  totalAmount = totalAmount.toFixed(2);
    //  // $("#net_amount").val(totalAmount);
    //  // $("#totalAmountValue").val(totalAmount);
    //
    //  var discount = $("#discount").val();
    //  if(discount) {
    //    var grandTotal = Number(totalAmount) - Number(discount);
    //    grandTotal = grandTotal.toFixed(2);
    //    $("#net_amount").val(grandTotal);
    //    $("#net_amount_value").val(grandTotal);
    //  } else {
    //    $("#net_amount").val(totalAmount);
    //    $("#net_amount_value").val(totalAmount);
    //
    //  } // /else discount
    //
    //} // /sub total amount

    function removeRow(tr_id) {
        $("#salida_table tbody tr#row_" + tr_id).remove();
        // subAmount();
    }


</script>