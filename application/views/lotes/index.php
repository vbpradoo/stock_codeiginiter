

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Control
            <small>Lotes</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Principal</a></li>
            <li class="active">Lotes</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12 col-xs-12">

                <div id="messages"></div>

                <?php if($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php elseif($this->session->flashdata('error')): ?>
                    <div class="alert alert-error alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <?php if(in_array('createProduct', $user_permission)): ?>
                    <a href="<?php echo base_url('entradas/createEntrada') ?>" class="btn btn-primary">Añadir Lotes</a>
                    <a href="<?php echo base_url('lotes/edit') ?>" class="btn btn-success">Editar Lotes</a>
                    <br /> <br />
                <?php endif; ?>

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Control de Lotes</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div id="filter_control" class="btn-group box-tools pull-right" style="margin-right: 4em;margin-bottom: 1em;">
                            <button id="filter_button" type="button" class="btn btn-default btn_fixed">
                                Filtrado
                            </button>
<!--                            <button id="filter_button" type="button" onclick="removeFunc(30,16)" class="btn btn-default btn_fixed">-->
<!--                                Borrar-->
<!--                            </button>-->
                        </div>
                        <div class="col-md-12">
                            <table id="jqGrid" class="box-body"></table>
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

<?php if(in_array('deleteProduct', $user_permission)): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Borrar Lote</h4>
                </div>

                <form role="form"  method="post" id="removeForm">
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



<script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
    var filter_click = false;

    $(document).ready(function() {


        $("#lotesNav").addClass('active');
        $("#indexLNav").addClass('active');

        document.getElementById("filter_button").addEventListener("click", function () {

            if (filter_click === true) {
                filter_click = false;
                $("#filter_button").removeClass("btn-warning");
                $("#filter_button").addClass("btn-default");
                // $("#libGrid").jsGrid("option", "filtering", false);
                $(".ui-search-toolbar").css("visibility","visible");

                console.log("TRUE");
            }
            else if (filter_click === false) {
                filter_click = true;
                $("#filter_button").removeClass("btn-default");
                $("#filter_button").addClass("btn-warning");
                // $("#libGrid").jsGrid("option", "filtering", true);
                $(".ui-search-toolbar").css(" visibility" ,"hidden");

            }

            $('#jqGrid').trigger('reloadGrid');
        });

        $("#jqGrid").jqGrid({

            url: base_url + "lotes/fetchLotesDataFilteringPagination",
            datatype: "json",
            search:true,
            styleUI: "Bootstrap",
            // columns:[{cellClass: 'ui-grid-cell-contents-auto'}],
            colModel: [
                {
                    label: 'ID',
                    name: 'ID',
                    index: 'ID',
                    sorttype: 'number',
                    // width: "5px",
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn","eq"] // eq = equal to
                    }
                },
                {
                    label: 'Serial',
                    name: 'Serial',
                    index: 'Serial',
                    sorttype: 'text',
                    // width: "10px",
                    search: true,
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["ge","le","eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                    }
                    // formatter: formatLink
                },
                {
                    label: 'Artículo',
                    name: 'Articulo',
                    index: 'Articulo',
                    // width: "10px",
                    sorttype: 'text',
                    // formatter: 'number',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn","eq"] // eq = equal to
                    }
                }, {
                    label: 'Entrada',
                    name: 'Entrada',
                    index: 'Entrada',
                    // width: "10px",
                    sorttype: 'text',
                    align: 'center',
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
                                language:'es',
                            });
                        },
                        // show search options
                        sopt: ["ge","le","eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                    }
                }, {
                    label: 'Descripción',
                    name: 'Descripcion',
                    index: 'Descripcion',
                    // width: "10px",
                    sorttype: 'text',
                    // formatter: 'number',
                    align: 'center'
                }, {
                    label: 'Cantidad',
                    name: 'Cantidad',
                    index: 'Cantidad',
                    // width: "10px",
                    sorttype: 'text',
                    // formatter: 'number',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["ge","le","eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
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
                    // width: "10px",
                    sorttype: 'text',
                    // formatter: 'number',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["ge","le","eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                    }
                },
                {
                    label: 'Precio',
                    name: 'Precio',
                    index: 'Precio',
                    // width: "10px",
                    sorttype: 'text',
                    // formatter: 'number',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["ge","le","eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                    }
                },
                {
                    label: 'Coste',
                    name: 'Coste',
                    index: 'Coste',
                    // width: "10px",
                    sorttype: 'text',
                    // formatter: 'number',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["ge","le","eq"] // ge = greater or equal to, le = less or equal to, eq = equal to
                    }
                },
                {
                    label: 'Almacen',
                    name: 'Almacen',
                    index: 'Almacen',
                    // width: "10px",
                    sorttype: 'text',
                    // formatter: 'number',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn","eq"] // eq = equal to
                    }
                },
                {
                    label: 'Vendido',
                    name: 'Vendido',
                    index: 'Vendido',
                    // width: "10px",
                    sorttype: 'text',
                    // formatter: 'number',
                    align: 'center',
                    stype: "select",
                    // searchoptions value - name values pairs for the dropdown - they will appear as options
                    searchoptions: { value: ":[All];1:Vendido;0:Por Vender"}
                },
                {
                    label: 'Division',
                    name: 'Division',
                    index: 'Division',
                    hidden: true,
                    // width: "10px",
                    sorttype: 'text',
                    // formatter: 'number',
                    align: 'center'
                },
                {
                    label: 'Estado',
                    name: 'Pagado',
                    index: 'Pagado',
                    // width: "10px",
                    align: 'center',
                    stype: "select",
                    // searchoptions value - name values pairs for the dropdown - they will appear as options
                    searchoptions: { value: ":[All];1:Pagado;0:Por Pagar"}
                }, {
                    label: 'Control',
                    name: 'Buttons',
                    search: false,
                    index: 'Control',
                    // width: "10px",
                    align: 'center'
                }
            ],

            viewrecords: true, // show the current page, data rang and total records on the toolbar
            width: "auto",
            height: "auto",
            rowNum: 10,
            rowList : [10, 20, 50, 100],
            autowidth: true,
            pager: "#jqGridPager",
            caption: "Lotes",
            subGrid: true,
            subGridOptions: { "plusicon" : "fa fa-plus",
                "minusicon" :"fa fa-minus",
                "openicon" : "fa fa-angle-double-right",
                "reloadOnExpand" : false,
                "selectOnExpand" : true ,
            },

            subGridRowExpanded: function(subgrid_id, row_id) {
                // we pass two parameters
                // subgrid_id is a id of the div tag created within a table
                // the row_id is the id of the row
                // If we want to pass additional parameters to the url we can use
                // the method getRowData(row_id) - which returns associative array in type name-value
                // here we can easy construct the following

                var string = "?";
                var obj = JSON.parse($("#jqGrid").getRowData(row_id)['Division']);
                console.log(obj);
                for (var i = 0; i < obj.id.length; i++) {
                    if (i === obj.id.length - 1)
                        string += "id[]=" + obj.id[i];
                    else
                        string += "id[]=" + obj.id[i] + "&";
                }
                console.log($("#jqGrid").getRowData(row_id));
                var subgrid_table_id = subgrid_id+"_t";

                $("#"+subgrid_id).html("<table id='"+subgrid_table_id+"' class='scroll'></table><div id='jqGridPager' class='scroll'></div>");

                $("#" + subgrid_table_id).jqGrid({
                    // url: base_url+"lotes/getDivisionData"+string,
                    url: base_url+"lotes/getDivisionData"+string,
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
                            label: 'Espesor',
                            name: 'Espesor',
                            index: 'Espesor',
                            sorttype: 'text',
                            // width: "3px",
                            align: 'center'
                        }
                    ],
                    height: '100%',
                    // rowNum: 20,
                    sortname: 'num',
                    sortorder: "asc"
                });
            },
            loadComplete: function () {


                // $(".sgcollapsed").width($("#jqGrid_subgrid").width());
                // $(".sgcollapsed").css("display","inline-block");
                $(".fa-angle-double-right").css("margin-left","1.2em") ;

            },

        });

        $("#jqGrid").jqGrid('filterToolbar', {stringResult: true, searchOnEnter: true,
            defaultSearch: 'cn', ignoreCase: true,searchOperators: true });
        // $(".ui-search-toolbar").css("display","none");



        // $("#jqGrid").bind("jqGridAfterLoadComplete", function () {
        //     var $this = $(this), iCol, iRow, rows, row, cm, colWidth,
        //         $cells = $this.find(">tbody>tr>td"),
        //         $colHeaders = $(this.grid.hDiv).find(">.ui-jqgrid-hbox>.ui-jqgrid-htable>thead>.ui-jqgrid-labels>.ui-th-column>div"),
        //         colModel = $this.jqGrid("getGridParam", "colModel"),
        //         n = $.isArray(colModel) ? colModel.length : 0,
        //         idColHeadPrexif = "jqgh_" + this.id + "_";
        //
        //     $cells.wrapInner("<span class='mywrapping'></span>");
        //     $colHeaders.wrapInner("<span class='mywrapping'></span>");
        //
        //     for (iCol = 0; iCol < n; iCol++) {
        //         cm = colModel[iCol];
        //         colWidth = $("#" + idColHeadPrexif + $.jgrid.jqID(cm.name) + ">.mywrapping").outerWidth() + 25; // 25px for sorting icons
        //         for (iRow = 0, rows = this.rows; iRow < rows.length; iRow++) {
        //             row = rows[iRow];
        //             if ($(row).hasClass("jqgrow")) {
        //                 colWidth = Math.max(colWidth, $(row.cells[iCol]).find(".mywrapping").outerWidth());
        //             }
        //         }
        //         $this.jqGrid("setColWidth", iCol, colWidth);
        //     }
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

                // $("#jqGrid_subgrid").width($(".sgcollapsed").width()+9);

            });
        }


    });



    // $("#jqGrid").bind("jqGridAfterLoadComplete", function () {
        //     var $this = $(this), iCol, iRow, rows, row, cm, colWidth,
        //         $cells = $this.find(">tbody>tr>td"),
        //         $colHeaders = $(this.grid.hDiv).find(">.ui-jqgrid-hbox>.ui-jqgrid-htable>thead>.ui-jqgrid-labels>.ui-th-column>div"),
        //         colModel = $this.jqGrid("getGridParam", "colModel"),
        //         n = $.isArray(colModel) ? colModel.length : 0,
        //         idColHeadPrexif = "jqgh_" + this.id + "_";
        //
        //     $cells.wrapInner("<span class='mywrapping'></span>");
        //     $colHeaders.wrapInner("<span class='mywrapping'></span>");
        //
        //     for (iCol = 0; iCol < n; iCol++) {
        //         cm = colModel[iCol];
        //         colWidth = $("#" + idColHeadPrexif + $.jgrid.jqID(cm.name) + ">.mywrapping").outerWidth() + 25; // 25px for sorting icons
        //         for (iRow = 0, rows = this.rows; iRow < rows.length; iRow++) {
        //             row = rows[iRow];
        //             if ($(row).hasClass("jqgrow")) {
        //                 colWidth = Math.max(colWidth, $(row.cells[iCol]).find(".mywrapping").outerWidth());
        //             }
        //         }
        //         $this.jqGrid("setColWidth", iCol, colWidth);
        //     }
        // });


    // remove functions
    function removeFunc(id,entradas)
    {
        if(id) {
            // console.log(id,entradas);

            $("#removeForm").on('submit', function() {

                var form = $(this);
                form .attr("action",base_url+"lotes/remove");
                // remove the text-danger
                $(".text-danger").remove();

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: { lote_id: id, entrada_id: entradas},
                    dataType: 'json',
                    success:function(response) {

                        $("#jqGrid").trigger('reloadGrid');

                        if(response.success === true) {
                            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                                '</div>');

                            // hide the modal
                            $("#removeModal").modal('hide');

                        } else {

                            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                                '</div>');
                        }
                    }
                });

                return false;
            });
        }
    }


</script>
