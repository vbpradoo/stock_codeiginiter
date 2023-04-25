
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/plugins/jqGrid/css/theme-jqgrid.css') ?>"/>
<script type="text/ecmascript" src="<?php echo base_url('assets/plugins/GuriddoJqGrid/js/i18n/grid.locale-es.js') ?>"></script>
<!-- This is the Javascript file of jqGrid -->
<script type="text/ecmascript" src="<?php echo base_url('assets/plugins/GuriddoJqGrid/src/jquery.jqGrid.js') ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/GuriddoJqGrid/js/jszip.min.js')?>"></script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Control
            <small>Lotes</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard/') ?>""><i class="fa fa-dashboard"></i>Principal</a></li>
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

                <?php if (in_array('createProduct', $user_permission)): ?>
                    <a href="<?php echo base_url('entradas/createEntrada') ?>" class="btn btn-primary">Añadir Lotes</a>
                    <a href="<?php echo base_url('lotes/edit') ?>" class="btn btn-success">Editar Lotes</a>
                    <br/> <br/>
                <?php endif; ?>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Control de Lotes</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="filter_control" class="btn-group box-tools pull-right"
                             style="margin-right: 4em;margin-bottom: 1em;">
                            <button  type="button" data-toggle="modal" data-target="#exportModal" class="btn btn-default btn_fixed btn-warning" style="color: #ffffff;">
                                <!--                            <button  type="button" id="export_button_header" class="btn btn-default btn_fixed btn-warning" style="color: #ffffff;">-->
                                Exportar selección
                            </button>
                            <!--                            <button id="filter_button" type="button" onclick="removeFunc(30,16)" class="btn btn-default btn_fixed">-->
                            <!--                                Borrar-->
                            <!--                            </button>-->
                        </div>
                        <div class="col-md-12">
                            <table id="lotes_jqGrid" class="box-body"></table>
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
                    <h4 class="modal-title">Borrar Lote</h4>
                </div>

                <form role="form" method="post" id="removeForm">
                    <div class="modal-body">
                        <p> ¿Está seguro de querer borrar el lote? </p>
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

<!-- export brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="exportModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Exportar tabla</h4>
            </div>
            <form class="form-inline">
                <div class="modal-body">
                    <p> ¿Con qué nombre desea exportar? </p>
                    <div class="form-group">
                        <input id="exportName" class="form-control" align="left" name="exportName" type="text" >.xlsx
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="button" id="export_button" class="btn btn-primary">Exportar</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";

    $(document).ready(function () {


        $("#lotesNav").addClass('active');
        $("#indexLNav").addClass('active');

        $("#export_button").unbind("click").click(function () {
            // function exportExcel(filename){
            //     var filename = "lotes_registro";
            var filename = $("#exportName").val();
            if(filename === "")
                filename="lotes_registro";

            var options = {
                includeLabels: true,
                includeGroupHeader: true,
                includeFooter: true,
                fileName: filename+".xlsx",
                mimetype: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
                maxlength: 40,
                onBeforeExport: null,
                replaceStr: null
            };

            $("#lotes_jqGrid").jqGrid('exportToExcel', options);
            $("#exportModal").modal('hide');
            $("#exportName").val("");
        });

        $("#lotes_jqGrid").jqGrid({

            url:base_url + "lotes/fetchLotesDataFilteringPagination",
            datatype: "json",
            search: true,
            styleUI: "Bootstrap",
            responsive: true,
            // columns: [{cellClass: 'ui-grid-cell-contents-auto'}],
            colModel: [
                {
                    label: 'ID',
                    name: 'ID',
                    index: 'ID',
                    sorttype: 'number',
                    hidden: true,
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                },
                {
                    label: 'Serial',
                    name: 'Serial',
                    index: 'Serial',
                    sorttype: 'text',
                    search: true,
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                    }
                    // formatter: formatLink
                },
                {
                    label: 'Artículo',
                    name: 'Articulo',
                    index: 'Articulo',
                    sorttype: 'text',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                },{
                    label: 'Familia',
                    name: 'Familia',
                    index: 'Familia',
                    sorttype: 'text',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                },
                {
                    label: 'Entrada',
                    name: 'Entrada',
                    index: 'Entrada',
                    // width: "100%",
                    sorttype: 'text',
                    align: 'center',
                    formatter: formatFecha,
                    searchoptions: {
                        // dataInit is the client-side event that fires upon initializing the toolbar search field for a column
                        // use it to place a third party control to customize the toolbar
                        dataInit: function (element) {
                            $(element).datepicker({
                                id: 'Entrada_datePicker',
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
                    sorttype: 'text',
                    align: 'center'
                }, {
                    label: 'Cantidad',
                    name: 'Cantidad',
                    index: 'Cantidad',
                    search: false,
                    sortable: false,
                    sorttype: 'text',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["ge", "le", "eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                    }
                },
                // {
                //     label: 'Unidades',
                //     name: 'Unidades',
                //     index: 'Unidades',
                //     // width: "3px",
                //     sorttype: 'text',
                //     // formatter: 'number',
                //     align: 'center'
                // },
                {
                    label: 'Stock',
                    name: 'Stock',
                    index: 'Stock',
                    // width: "100%",
                    sorttype: 'text',
                    search: false,
                    sortable: false,
                    // formatter: 'number',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["ge", "le", "eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                    }
                },
                // {
                //     label: 'Precio',
                //     name: 'Precio',
                //     index: 'Precio',
                //     // width: "100%",
                //     sorttype: 'text',
                //     // formatter: 'number',
                //     align: 'center',
                //     searchoptions: {
                //         // show search options
                //         sopt: ["ge","le","eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                //     }
                // },
                // {
                //     label: 'Coste',
                //     name: 'Coste',
                //     index: 'Coste',
                //     // width: "100%",
                //     sorttype: 'text',
                //     // formatter: 'number',
                //     align: 'center',
                //     searchoptions: {
                //         // show search options
                //         sopt: ["ge","le","eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                //     }
                // },
                {
                    label: 'Almacen',
                    name: 'Almacen',
                    index: 'Almacen',
                    sorttype: 'text',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                },
                {
                    label: 'Vendido',
                    name: 'Vendido',
                    index: 'Vendido',
                    sorttype: 'text',
                    align: 'center',
                    stype: "select",
                    // searchoptions value - name values pairs for the dropdown - they will appear as options
                    searchoptions: {value: ":[All];1:Vendido;0:Por Vender"}
                },
                {
                    label: 'Division',
                    name: 'Division',
                    index: 'Division',
                    hidden: true,
                    sorttype: 'text',
                    align: 'center'
                },
                // {
                //     label: 'Estado',
                //     name: 'Pagado',
                //     index: 'Pagado',
                //     // width: "100%",
                //     align: 'center',
                //     stype: "select",
                //     // searchoptions value - name values pairs for the dropdown - they will appear as options
                //     searchoptions: { value: ":[All];1:Pagado;0:Por Pagar"}
                // },
                {
                    label: 'Control',
                    name: 'Buttons',
                    search: false,
                    index: 'Control',
                    align: 'center',
                    sortable:false,
                }
            ],

            viewrecords: true, // show the current page, data rang and total records on the toolbar
            width: "auto",
            height: "auto",
            rowNum: 10,
            rowList: [10, 20, 50, 100, 1000],
            autowidth: true,
            pager: "#jqGridPager",
            caption: "Lotes",
            subGrid: true,
            subGridWidth: "45%",
            subGridOptions: {
                "plusicon": "fa fa-plus",
                "minusicon": "fa fa-minus",
                "openicon": "fa fa-angle-double-right",
                "reloadOnExpand": false,
                "selectOnExpand": true,
            },

            subGridRowExpanded: function (subgrid_id, row_id) {
                // we pass two parameters
                // subgrid_id is a id of the div tag created within a table
                // the row_id is the id of the row
                // If we want to pass additional parameters to the url we can use
                // the method getRowData(row_id) - which returns associative array in type name-value
                // here we can easy construct the following
                // console.log(subgrid_id);
                var string = "?";
                var obj = JSON.parse($("#lotes_jqGrid").getRowData(row_id)['Division']);
                console.log(obj);
                for (var i = 0; i < obj.id.length; i++) {
                    if (i === obj.id.length - 1)
                        string += "id[]=" + obj.id[i];
                    else
                        string += "id[]=" + obj.id[i] + "&";
                }
                // console.log($("#lotes_jqGrid").getRowData(row_id));
                var subgrid_table_id = subgrid_id + "_t";

                $("#" + subgrid_id).html("<table id='" + subgrid_table_id + "' class='scroll'></table><div id='jqGridPager' class='scroll'></div>");

                $("#" + subgrid_table_id).jqGrid({
                    // url: base_url+"lotes/getDivisionData"+string,
                    url: base_url + "lotes/getDivisionData" + string,
                    datatype: "json",
                    styleUI: "Bootstrap",
                    responsive: true,
                    colModel: [
                        {
                            label: 'ID',
                            name: ' ID',
                            index: 'ID',
                            hidden: true,
                            sorttype: 'number',
                            align: 'center',
                            sortable:false,

                        },
                        {
                            label: 'Cantidad',
                            name: 'Piezas',
                            index: 'Piezas',
                            sorttype: 'text',
                            width: "100%",
                            align: 'center',
                            sortable:false,
                        },
                        {
                            label: 'Stock',
                            name: 'Piezas_Stock',
                            index: 'Piezas_Stock',
                            sorttype: 'text',
                            width: "100%",
                            align: 'center',
                            sortable:false,
                        },
                        {
                            label: 'Largo',
                            name: 'Largo',
                            index: 'Largo',
                            width: "100%",
                            sorttype: 'text',
                            align: 'center',
                            sortable:false,
                        }, {
                            label: 'Alto/Ancho',
                            name: 'Alto',
                            index: 'Alto',
                            sorttype: 'text',
                            width: "100%",
                            align: 'center',
                            sortable:false,
                        },
                        {
                            label: 'Espesor',
                            name: 'Espesor',
                            index: 'Espesor',
                            sorttype: 'text',
                            width: "100%",
                            align: 'center',
                            sortable:false,
                        },
                        {
                            label: 'Metros Lineales',
                            name: 'Metros Lineales',
                            index: 'Metros Lineales',
                            sorttype: 'text',
                            width: "100%",
                            align: 'center',
                            sortable:false,
                        },
                        {
                            label: 'Metros Cuadrados',
                            name: 'Metros Cuadrados',
                            index: 'Metros Cuadrados',
                            sorttype: 'text',
                            width: "150%",
                            align: 'center',
                            sortable:false,
                        },
                        {
                            label: 'Metros Cúbicos',
                            name: 'Metros Cubicos',
                            index: 'Metros Cubicos',
                            sorttype: 'text',
                            width: "150%",
                            align: 'center',
                            sortable:false,

                        }
                    ],
                    height: '100%',
                    sortname: 'num',
                    sortorder: "asc",
                    gridComplete:function() {
                        var subgrid = $("#" + subgrid_table_id);
                        for (var j = 1; j <= obj.id.length; j++) {
                            var piezas = parseFloat(subgrid.jqGrid('getCell', j, 'Piezas_Stock'));
                            var ml = parseFloat(subgrid.jqGrid('getCell', j, 'Largo')) * piezas;
                            var m2 = parseFloat(subgrid.jqGrid('getCell', j, 'Largo')) * parseFloat(subgrid.jqGrid('getCell', j, 'Alto')) * piezas;
                            var m3 = parseFloat(subgrid.jqGrid('getCell', j, 'Largo')) * parseFloat(subgrid.jqGrid('getCell', j, 'Alto')) * parseFloat(subgrid.jqGrid('getCell', j, 'Espesor')) * piezas;
                            // console.log("ENTRA:"+subgrid.jqGrid('getCell',1,'Piezas_Stock'));
                            subgrid.jqGrid('setCell', j, 'Metros Lineales', round(ml) + "   ml");
                            subgrid.jqGrid('setCell', j, 'Metros Cuadrados', round(m2) + "   m²");
                            subgrid.jqGrid('setCell', j, 'Metros Cubicos', round(m3) + "   m³   ");
                        }

                        //ADJUST CONTENT
                        adjustGrid("#" + subgrid_table_id,true)
                    },
                });
            }
            // ,beforeRequest: function(data, status, xhr){
            //     console.log("ENTRA")
            //     $('#jqGrid').jqGrid('clearGridData');
            // }
            , loadComplete: function (data) {
                var grid = $('#lotes_jqGrid')[0];
                var datos = data.rows;
                datos.forEach(function (campo) {
                    delete campo.Buttons;
                    delete campo.Vendido;
                    delete campo.Division;
                    delete campo.Unidades;
                    // delete campo.Descripcion;
                    delete campo.Ent_ID;
                });
                grid.p.data = datos;
                // adjustGrid("#lotes_jqGrid")

            },
            onPaging: function (pgButton) {
                // $('#jqGrid').jqGrid('clearGridData');
            },
            loadError : function(xhr,st,err) {
                // alert("Type: "+st+"; Response: "+ xhr.status + " "+xhr.statusText);
                alert("La búsqueda que desea realizar no encuentra nada. Cambie los campos de búsqueda.");
                $("#lotes_jqGrid").jqGrid("clearGridData", true);

            },gridComplete: function(){
                // adjustGrid("#lotes_jqGrid")
                // console.log("ACABA");
            },

        });

        function formatFecha (cellvalue, options, rowObject)
        {
            // do something here
            console.log(cellvalue);
            cellvalue = moment(cellvalue).format('DD-MM-YYYY');
            return cellvalue;
        }

        $("#lotes_jqGrid").jqGrid('filterToolbar', {
            stringResult: true, searchOnEnter: true,
            defaultSearch: 'cn', ignoreCase: true, searchOperators: true
        });

        $("#lotes_jqGrid").jqGrid()[0].p.subGridWidth = $("#jqGrid_ID").width();


        ChangejQGridDesign("#lotes_jqGrid", "#jqGridPager");
        $(".ui-jqgrid-hdiv ").css("overflow","hidden");

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
                    'glyphicon-step-backward': 'ace-icon fa fa-angle-double-left bigger-140',
                    'glyphicon-backward': 'ace-icon fa fa-angle-left bigger-140',
                    'glyphicon-forward': 'ace-icon fa fa-angle-right bigger-140',
                    'glyphicon-step-forward': 'ace-icon fa fa-angle-double-right bigger-140'
                };
            $('.ui-pg-table:not(.navtable) > tbody > tr > .ui-pg-button > .glyphicon').each(function () {
                var icon = $(this);
                var $class = $.trim(icon.attr('class').replace('glyphicon', ''));
                if ($class in replacement)
                    icon.attr('class', 'ui-icon ' + replacement[$class]);
            });

            // enableTooltips
            $('.navtable .ui-pg-button').tooltip({container: 'body'});
            $(table).find('.ui-pg-div').tooltip({container: 'body'});

            var $grid = $(table),
                newWidth = $grid.closest(".ui-jqgrid").parent().width() - 50;
            $grid.jqGrid("setGridWidth", newWidth, true);


            $(window).on("resize", function () {
                // reSizeGrid();
                // $("#jqGrid_subgrid").width($(".sgcollapsed").width());

                // $("#jqGrid_subgrid").width($(".sgcollapsed").width()+9);

            });
        }

    });

    function reSizeGrid() {
        //OVERFLOW Y HIDDEN
        $(".ui-jqgrid-hdiv ").css("overflow","hidden");
        var $grid = $("#lotes_jqGrid"),
            newWidth = $grid.closest(".ui-jqgrid").parent().width() - 50;
        $grid.jqGrid("setGridWidth", newWidth, true);
        // console.log(newWidth);
        var objRows = $("#lotes_jqGrid tr").splice(1);
        var objHeader = $("tr[class=ui-jqgrid-labels]");
        var objFirstRowHeader = $(objHeader[1]).children("th");

        for (i = 0; i < objRows.length; i++) {
            var objFirstRowColumns = $(objRows[i]).children("td");

            for (i = 0; i < objFirstRowColumns.length; i++) {
                $(objFirstRowColumns[i]).css("width", $(objFirstRowHeader[i]).width());
            }
        }
    }

    function adjustGrid(grid, subgrid = false){
        var $grid = $(grid),
            newWidth = $grid.closest(".ui-jqgrid").parent().width() - 50;
        $grid.jqGrid("setGridWidth", newWidth, true);
        // console.log(grid);
        var objRows = $(grid+" tr").splice(1);
        if(!subgrid) {
            var objHeader = $("tr[class=ui-jqgrid-labels]");
            var objFirstRowHeader = $(objHeader[0]).children("th");
        }else{
            var objHeader = $("tr[class=ui-jqgrid-labels]");
            console.log(objHeader);
            var objFirstRowHeader = $(objHeader[1]).children("th");
        }
        for (var i = 0; i < objRows.length; i++) {
            var objFirstRowColumns = $(objRows[i]).children("td");

            for (var j = 0; j < objFirstRowColumns.length; j++) {
                var paddT = $(objFirstRowHeader[j]).innerWidth() - $(objFirstRowHeader[j]).width();
                $(objFirstRowColumns[j]).css("width", $(objFirstRowHeader[j]).innerWidth()+1);
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
                form.attr("action", base_url + "lotes/remove");
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: {lote_id: id, entrada_id: entradas},
                    dataType: 'json',
                    success: function (response) {

                        $("#lotes_jqGrid").trigger('reloadGrid');

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

    function round(num, decimales = 3) {
        var signo = (num >= 0 ? 1 : -1);
        num = num * signo;
        if (decimales === 0) //con 0 decimales
            return signo * Math.round(num);
        // round(x * 10 ^ decimales)
        num = num.toString().split('e');
        num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
        // x * 10 ^ (-decimales)
        num = num.toString().split('e');
        return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
    }


</script>
