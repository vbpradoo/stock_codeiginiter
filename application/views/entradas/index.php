<script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.3.1/viewer.min.js"></script>


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
                    <?php  foreach($this->session->flashdata('success') as $k =>$v): ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <?php echo $v; ?>
                    </div>
                    <?php endforeach ?>
                <?php endif; ?>
                <?php if($this->session->flashdata('error')): ?>
                <?php  foreach($this->session->flashdata('error') as $k =>$v): ?>
                <div class="alert alert-error alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                    <?php echo $v; ?>
                    </div>
                    <?php endforeach ?>
                <?php endif; ?>

                <?php if (in_array('createProduct', $user_permission)): ?>
                    <a class="btn btn-primary" href="<?php echo base_url('entradas/createEntrada') ?>">Añadir
                        Entrada</a>
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
<!--                <form role="form" method="post"   action="--><?php //echo base_url('entradas/update') ?><!--" id="updateForm">-->
                <?php echo form_open_multipart("lotes/updateEntrada"); ?>
                    <div class="modal-body">
                        <div id="messages"></div>

                        <div class="form-group">
                            <label for="edit_fecha">Fecha</label>
                            <input type="text" class="form-control" id="edit_fecha" name="edit_fecha"
                                   placeholder="Introduzca fecha" autocomplete="off">
                        </div>
<!--                        <div class="form-group">-->
<!--                            <label for="edit_active">Estado</label>-->
<!--                            <select class="form-control select_group" id="edit_active" name="edit_active">-->
<!--                                <option value="1">Pagado</option>-->
<!--                                <option value="2">Sin pagar</option>-->
<!--                            </select>-->
<!--                        </div>-->
                    </div>

                    <div class="form-group" style="margin-left: 2%;">
                        <label for="lote_anexo">Anexo: </label>
                        <div class="kv-avatar" style="margin-left: 2%;">
                            <div class="file-loading">
                                <input id="lote_anexo" name="lote_anexo" type="file">
                            </div>
                        </div>

                    </div>
                    <div class ="form-group">
                        <!--                                <label for="lote_anexo">Anexo: </label>-->
                        <input id="entrada_id" class="form-control" name="entrada_id" type="text" style="visibility: hidden;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>

                    <?php echo form_close();?>


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
                    <h4 class="modal-title">Eliminar Entrada</h4>
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

<?php if (in_array('viewProduct ', $user_permission)): ?>
    <!-- remove brand modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="anexoModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Anexo:</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php endif; ?>

<script type="text/javascript">

    var base_url = "<?php echo base_url(); ?>";

    $(document).ready(function () {

        $("#storeNav").addClass('active');
        $(".select_group").select2({width: 'resolve'});
        $("#edit_fecha").datetimepicker({
            date: moment(),
            minDate: new Date(2018, 1, 1),
            // maxDate: new Date(2030, 0, 1),
            // showOn: 'focus',
            locale: 'es',
        });



        $("#jqGrid").jqGrid({

            url: base_url + "entradas/fetchEntradasDataFilteringPagination",
            datatype: "json",
            styleUI: "Bootstrap",
            colModel: [
                {
                    label: 'ID',
                    name: 'ID',
                    index: 'ID',
                    sorttype: 'number',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                }, {
                    label: 'Lote',
                    name: 'Serial',
                    index: 'Serial',
                    sorttype: 'text',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                },
                {
                    label: 'Código',
                    name: 'Articulo',
                    index: 'Articulo',
                    sorttype: 'text',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                },{
                    label: 'Descripción',
                    name: 'Descripcion',
                    index: 'Descripcion',
                    sorttype: 'text',
                    align: 'center',
                    search:false,
                    sortable: false,
                    // searchoptions: {
                    //     // show search options
                    //     sopt: ["cn", "eq"] // eq = equal to
                    // }
                },
                {
                    label: 'Proovedor',
                    name: 'Proovedor',
                    index: 'Proovedor',
                    sorttype: 'text',
                    align: 'center',
                    searchoptions: {
                        // show search options
                        sopt: ["cn", "eq"] // eq = equal to
                    }
                },
                {
                    label: 'Fecha',
                    name: 'Fecha',
                    index: 'Fecha',
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
                    label: 'Cantidad',
                    name: 'Cantidad',
                    index: 'Cantidad',
                    sorttype: 'text',
                    align: 'center',
                    search:false,
                    sortable: false
                },
                // {
                //     label: 'Estado',
                //     name: 'Pagado',
                //     index: 'Pagado',
                //     // width: "3px",
                //     align: 'center'
                // },
                {
                    label: 'Control',
                    name: 'Buttons',
                    index: 'Control',
                    // width: "3px",
                    align: 'center',
                    search:false,
                    sortable: false
                }
            ],

            viewrecords: true, // show the current page, data rang and total records on the toolbar
            width: "auto",
            height: "auto",
            rowNum: 10,
            rowList: [10, 20, 50, 100],
            autowidth: true,
            pager: "#jqGridPager",
            caption: "Entradas",

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


        function formatFecha (cellvalue, options, rowObject)
        {
            // do something here
            console.log(cellvalue);
            // cellvalue = new Date(cellvalue).getDate() +'-' + (parseInt(new Date(cellvalue).getMonth())+1)+'-'+ new Date(cellvalue).getFullYear();

            cellvalue = moment(cellvalue).format('DD-MM-YYYY');
            return cellvalue;
        }
        ChangejQGridDesign("#jqGrid", "#jqGridPager");

        $("#jqGrid").jqGrid('filterToolbar', {
            stringResult: true, searchOnEnter: true,
            defaultSearch: 'cn', ignoreCase: true, searchOperators: true
        });

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
            });
        }

    });

    // edit function
    function editFunc(id) {

        if (id) {
            $.ajax({
                url: 'getEntradasDataById/' + id,
                type: 'get  ',
                dataType: 'json',
                success: function (response) {
                    // console.log(response);
                    console.log(response.Fecha);

                    // $("#edit_proovedor").val(response.Proovedor);
                    // $("#edit_fecha").val(response.Fecha);
                    $('#edit_fecha').data("DateTimePicker").date(moment(response.Fecha));
                    $('#entrada_id').val(id);

                    $("#lote_anexo").fileinput({
                        overwriteInitial: true,
                        maxFileSize: 2500,
                        showClose: false,
                        showCaption: false,
                        browseLabel: '',
                        removeLabel: '',
                        browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
                        removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
                        removeTitle: 'Cancel or reset changes',
                        elErrorContainer: '#kv-avatar-errors-1',
                        msgErrorClass: 'alert alert-block alert-danger',
                        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
                        // layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
                        layoutTemplates: {main2: '{preview} {remove} {browse}'},
                        allowedFileExtensions: ["jpg", "jpeg", "pdf","png"]
                    });
                    // $("#edit_cantidad").val(response.Cantidad);
                    // $("#edit_descripcion").val(response.Descripcion);

                    // $("#edit_active").val(response.Pagado);
                    // $("#edit_active").trigger('change.select2');

                    // submit the edit from
                    $("#updateForm").unbind('submit').bind('submit', function () {
                        var form = $(this);

                        // remove the text-danger + id+'?'+form.serialize()
                        $(".text-danger").remove();
                        // console.log(form.serialize());
                        // console.log(id);
                        // console.log(typeof $("#edit_fecha").val());
                        if($("#edit_fecha").val().includes('/'))
                            convertTime($("#edit_fecha"));

                        var url = form.attr('action')+'/'+id;

                        $.ajax({
                            url: url,
                            type: form.attr('method'),
                            data: form.serialize(), // /converting the form data into array and sending it to server
                            dataType: 'json',
                            success: function (response) {

                                $('#jqGrid').trigger('reloadGrid');
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

    // function addAnexo(id) {
    //
    //     if(id !== undefined){
    //         $('#lote_id').val(id);
    //     }
    // }

    function viewAnexo(elem){
        var filepath = $(elem).attr('id');
        console.log(base_url+filepath);
        window.open(
            base_url+filepath,
            '_blank' // <- This is what makes it open in a new window.
        );
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
