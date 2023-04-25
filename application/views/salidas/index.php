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

                <?php if (in_array('createOrder', $user_permission)): ?>
                    <a href="<?php echo base_url('salidas/createSalida') ?>" class="btn btn-primary">Añadir Salida</a>
                    <br/> <br/>
                <?php endif; ?>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Control de Salidas</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-12">
                            <table id="salidas_jqGrid" class="box-body"></table>
                            <div id="jqGridPager"></div>
                        </div>
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

<?php if (in_array('deleteProduct', $user_permission)): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Borrar Salida</h4>
                </div>

                <form role="form" method="post" id="removeForm">
                    <div class="modal-body">
                        <p> ¿Está seguro de querer borrar la salida? </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Borrar</button>
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
                    <h4 class="modal-title">Editar Entrada</h4>
                </div>
                <form role="form" method="post" action="<?php echo base_url('salidas/update') ?>" id="updateForm">
                    <div class="modal-body">
                        <div id="messages"></div>

                        <div class="form-group">
                            <label for="edit_fecha">Fecha</label>
                            <input type="text" class="form-control" id="edit_fecha" name="edit_fecha"
                                   placeholder="Introduzca fecha" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="edit_alb_id">Nº Albarán :</label>
                            <input class="form-control " id="edit_alb_id" name="edit_alb_id" placeholder="Introduzca Albarán ID" autocomplete="off">
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



<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    var filter_click = false;

    $(document).ready(function () {


        $("#mainSalidasNav").addClass('active');
        $("#manageSalidaNav").addClass('active');

        // document.getElementById("filter_button").addEventListener("click", function () {
        //
        //     if (filter_click === true) {
        //         filter_click = false;
        //         $("#filter_button").removeClass("btn-warning");
        //         $("#filter_button").addClass("btn-default");
        //         // $("#libGrid").jsGrid("option", "filtering", false);
        //         $(".ui-search-toolbar").css("visibility","visible");
        //
        //         console.log("TRUE");
        //     }
        //     else if (filter_click === false) {
        //         filter_click = true;
        //         $("#filter_button").removeClass("btn-default");
        //         $("#filter_button").addClass("btn-warning");
        //         // $("#libGrid").jsGrid("option", "filtering", true);
        //         $(".ui-search-toolbar").css(" visibility" ,"hidden");
        //
        //     }
        //
        //     $('#jqGrid').trigger('reloadGrid');
        // });

        $("#salidas_jqGrid").jqGrid({

            url: base_url + "salidas/fetchSalidasDataFilteringPagination",
            datatype: "json",
            search: true,
            styleUI: "Bootstrap",
            // columns:[{cellClass: 'ui-grid-cell-contents-auto'}],
            colModel: [
                {
                    label: 'ID',
                    name: 'ID',
                    index: 'ID',
                    sorttype: 'number',
                    width: "100%",
                    hidden: true,
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                },
                {
                    label: 'Bill_no',
                    name: 'Bill_no',
                    index: 'Bill_no',
                    sorttype: 'text',
                    width: "100%",
                    search: true,
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                    }

                },
                {
                    label: 'Albarán ID',
                    name: 'AlbaranID',
                    index: 'AlbaranID',
                    sorttype: 'text',
                    width: "100%",
                    search: true,
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                    }
                },
                // formatter: formatLink
                {
                    label: 'Cliente',
                    name: 'Cliente',
                    index: 'Cliente',
                    width: "100%",
                    sorttype: 'text',
                    // formatter: 'number',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                }, {
                    label: 'Fecha',
                    name: 'Fecha',
                    index: 'Fecha',
                    width: "100%",
                    sorttype: 'text',
                    formatter: formatFecha,
                    align: 'center',
                    searchoptions: {
                        // dataInit is the client-side event that fires upon initializing the toolbar search field for a column
                        // use it to place a third party control to customize the toolbar
                        dataInit: function (element) {
                            $(element).datepicker({
                                id: 'Salida_datePicker',
                                dateFormat: 'dd-mm-yy',
                                //minDate: new Date(2010, 0, 1),
                                maxDate: new Date(2030, 0, 1),
                                showOn: 'focus',
                                language: 'es',
                            });
                        },
                        // show search options
                        sopt: ["ge", "le", "eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                    }
                }, {
                    label: 'Descripción',
                    name: 'Descripcion',
                    index: 'Descripcion',
                    width: "100%",
                    sorttype: 'text',
                    align: 'center'
                }, {
                    label: 'Cantidad Total',
                    name: 'Cantidad_Total',
                    index: 'Cantidad_Total',
                    width: "100%",
                    sorttype: 'text',
                    align: 'center',
                    search: false,
                    // searchoptions: {
                    //     // show search options
                    //     sopt: ["cn","eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                    // }
                },
                {
                    label: 'Control',
                    name: 'Buttons',
                    search: false,
                    index: 'Control',
                    width: "100%",
                    align: 'center',
                    sortable: false,
                },
                {
                    label: 'Venta',
                    name: 'Venta',
                    index: 'Venta',
                    width: "100%",
                    hidden: true,
                    sorttype: 'text',
                    align: 'center',
                    // searchoptions: {
                    //     // show search options
                    //     sopt: ["ge","le","eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                    // }
                },
            ],

            viewrecords: true, // show the current page, data rang and total records on the toolbar
            width:
                "auto",
            height:
                "auto",
            rowNum:
                10,
            rowList:
                [10, 20, 50, 100],
            // autowidth: true,
            shrinkToFit:
                false,
            cmTemplate:
                {
                    autoResizable: true
                }
            ,
            autoResizing: {
                compact: true, maxColWidth:
                    "20%"
            }
            ,
            autoresizeOnLoad: true,
            pager:
                "#jqGridPager",
            caption:
                "Salidas",
            subGrid:
                true,
            subGridOptions:
                {
                    "plusicon":
                        "fa fa-plus",
                    "minusicon":
                        "fa fa-minus",
                    "openicon":
                        "fa fa-angle-double-right",
                    "reloadOnExpand":
                        false,
                    "selectOnExpand":
                        true,
                }
            ,

            subGridRowExpanded: function (subgrid_id, row_id) {
                // we pass two parameters
                // subgrid_id is a id of the div tag created within a table
                // the row_id is the id of the row
                // If we want to pass additional parameters to the url we can use
                // the method getRowData(row_id) - which returns associative array in type name-value
                // here we can easy construct the following
                // console.log(subgrid_id);
                var string = "?";
                var sal_id = JSON.parse($("#salidas_jqGrid").getRowData(row_id)['ID']);

                var subgrid_table_id = subgrid_id + "_t";

                $("#" + subgrid_id).html("<table id='" + subgrid_table_id + "' class='scroll'></table><div id='jqGridPager' class='scroll'></div>");

                $("#" + subgrid_table_id).jqGrid({
                    // url: base_url+"lotes/getDivisionData"+string,
                    url: base_url + "salidas/getVentasData/" + sal_id,
                    datatype: "json",
                    styleUI: "Bootstrap",
                    colModel: [
                        {
                            label: 'Lote',
                            name: 'Lote',
                            index: 'Lote',
                            sorttype: 'text',
                            width: "100%",
                            align: 'center',
                            sortable: false,
                        },
                        {
                            label: 'Articulo',
                            name: 'Articulo',
                            index: 'Articulo',
                            sorttype: 'text',
                            width: "100%",
                            align: 'center',
                            sortable: false,
                        },
                        {
                            label: 'Division',
                            name: 'Elemento',
                            index: 'Elemento',
                            sorttype: 'text',
                            width: "100%",
                            align: 'center',
                            sortable: false,
                        },
                        {
                            label: 'Cantidad',
                            name: 'Cantidad',
                            index: 'Cantidad',
                            width: "100%",
                            sorttype: 'text',
                            align: 'center',
                            sortable: false,
                        },
                        {
                            label: 'Metros Lineales',
                            name: 'Metros_lineales',
                            index: 'Metros_lineales',
                            sorttype: 'text',
                            width: "100%",
                            align: 'center',
                            sortable: false,
                        },
                        {
                            label: 'Metros Cuadrados',
                            name: 'Metros_cuadrados',
                            index: 'Metros_cuadrados',
                            sorttype: 'text',
                            width: "150%",
                            align: 'center',
                            sortable: false,
                        },
                        {
                            label: 'Metros Cúbicos',
                            name: 'Metros_cubicos',
                            index: 'Metros_cubicos',
                            sorttype: 'text',
                            width: "150%",
                            align: 'center',
                            sortable: false,
                        }
                    ],
                    height: '100%',
                    rowNum: 50,
                    sortname: 'num',
                    sortorder: "asc",
                    gridComplete: function () {
                        adjustGrid("#" + subgrid_table_id, true);
                    }

                });

            }
            ,
            subGridRowColapsed: function (subgrid_id, row_id) {
                // this function is called before removing the data
                // var subgrid_table_id;
                // subgrid_table_id = subgrid_id+"_t";
                // $("#"+subgrid_table_id).remove();
            }
            ,

            loadComplete: function (data) {

                // reSizeGrid();

            }
            ,
            gridComplete: function () {
                adjustGrid("#salidas_jqGrid");
            }
            ,
            resizeStop: function () {

            }
            ,


        })
        ;

        $("#salidas_jqGrid").jqGrid('filterToolbar', {
            stringResult: true, searchOnEnter: true,
            defaultSearch: 'cn', ignoreCase: true, searchOperators: true
        });

        // $(".ui-search-toolbar").css("display","none");


        function formatFecha(cellvalue, options, rowObject) {
            // do something here
            console.log(cellvalue);
            cellvalue = moment(cellvalue).format('DD-MM-YYYY');
            return cellvalue;
        }

        ChangejQGridDesign("#salidas_jqGrid", "#jqGridPager");

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
                reSizeGrid();
                $("#jqGrid_subgrid").width($(".sgcollapsed").width());


            });
        }


    })
    ;

    function reSizeGrid() {
        var $grid = $("#salidas_jqGrid"),
            newWidth = $grid.closest(".ui-jqgrid").parent().width() - 50;
        $grid.jqGrid("setGridWidth", newWidth, true);
        // console.log(newWidth);
        var objRows = $("#salidas_jqGrid tr").splice(1);
        var objHeader = $("tr[class=ui-jqgrid-labels]");
        var objFirstRowHeader = $(objHeader[1]).children("th");

        for (i = 0; i < objRows.length; i++) {
            var objFirstRowColumns = $(objRows[i]).children("td");

            for (i = 0; i < objFirstRowColumns.length; i++) {
                $(objFirstRowColumns[i]).css("width", $(objFirstRowHeader[i]).width());
            }
        }
    }

    function adjustGrid(grid, subgrid = false) {
        var $grid = $(grid),
            newWidth = $grid.closest(".ui-jqgrid").parent().width() - 50;
        $grid.jqGrid("setGridWidth", newWidth, true);
        console.log(grid);
        var objRows = $(grid + " tr").splice(1);
        if (!subgrid) {
            var objHeader = $("tr[class=ui-jqgrid-labels]");
            var objFirstRowHeader = $(objHeader[0]).children("th");
        } else {
            var objHeader = $("tr[class=ui-jqgrid-labels]");
            console.log(objHeader);
            var objFirstRowHeader = $(objHeader[1]).children("th");
        }
        for (var i = 0; i < objRows.length; i++) {
            var objFirstRowColumns = $(objRows[i]).children("td");
            for (var j = 0; j < objFirstRowColumns.length; j++) {
                var paddT = $(objFirstRowHeader[j]).innerWidth() - $(objFirstRowHeader[j]).width();
                $(objFirstRowColumns[j]).css("width", $(objFirstRowHeader[j]).innerWidth() + 1);
                $(objFirstRowColumns[j]).css("margin-right", "1");
            }
        }
    }

    // remove functions
    function removeFunc(id, entradas) {
        if (id) {
            // console.log(id,entradas);

            $("#removeForm").on('submit', function () {

                var form = $(this);
                form.attr("action", base_url + "salidas/remove");
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: {salida_id: id},
                    dataType: 'json',
                    success: function (response) {

                        $("#salidas_jqGrid").trigger('reloadGrid');

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
                        var i = 0;
                        var j = 0;
                        response.messages_div.forEach(function (div) {
                            console.log(div);
                            if (response.success_div[i]) {
                                $("#messages").append('<div class="alert alert-success alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + div +
                                    '</div>');
                            }
                            else {
                                $("#messages").append('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + div +
                                    '</div>');
                            }
                            i++;
                        });
                        response.messages_lote.forEach(function (lote) {
                            console.log(lote);
                            if (response.success_lote[j]) {
                                $("#messages").append('<div class="alert alert-success alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>' + lote +
                                    '</div>');
                            }
                            else {
                                $("#messages").append('<div class="alert alert-warning alert-dismissible" role="alert">' +
                                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
                                    '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>' + lote +
                                    '</div>');
                            }
                            j++;
                        });
                    }
                });

                return false;
            });
        }
    }

    function editFunc(id) {

        if (id) {
            $("#edit_fecha").datetimepicker({
                date: moment(),
                minDate: new Date(2018, 1, 1),
                // maxDate: new Date(2030, 0, 1),
                // showOn: 'focus',
                locale: 'es',
            });

            $.ajax({
                url: 'getSalidasDataById/' + id,
                type: 'get',
                dataType: 'json',
                success: function (response) {
                    // console.log(response);
                    // $("#edit_proovedor").val(response.Proovedor);
                    // $("#edit_fecha").val(response.Fecha);
                    $('#edit_fecha').data("DateTimePicker").date(moment(response.Fecha));
                    $('#edit_alb_id').val(response.AlbaranID);

                    $("#updateForm").unbind('submit').bind('submit', function () {
                        var form = $(this);
                        $(".text-danger").remove();
                        if($("#edit_fecha").val().includes('/'))
                            convertTime($("#edit_fecha"));

                        var url = form.attr('action')+'/'+id;

                        $.ajax({
                            url: url,
                            type: form.attr('method'),
                            data: form.serialize(), // /converting the form data into array and sending it to server
                            dataType: 'json',
                            success: function (response) {

                                $('#salidas_jqGrid').trigger('reloadGrid');
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
    }

    function convertTime($) {
        var date = $.val();
        date = date.split('/');
        var anho = date[2].split(' ')[0];
        var time = date[2].split(' ')[1];
        // console.log(anho+"-"+date[1]+"-"+date[0] +" "+ time);
        var converted=anho+"-"+date[1]+"-"+date[0] +" "+ time;
        $.val(converted);

    }

</script>
