<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Salidas extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Salidas';

        $this->load->model('model_lotes');
        $this->load->model('model_divisiones');
        $this->load->model('model_articulos');
        $this->load->model('model_salidas');
        $this->load->model('model_clientes');
        $this->load->model('model_company');
    }

    /*
    * It only redirects to the manage order page
    */
    public function index()
    {
        if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->data['page_title'] = 'Control de Salidas';
        $this->render_template('salidas/index', $this->data);
    }

    public function createSalida()
    {
        if(!in_array('createOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->data['page_title'] = 'Añadir Salida';
        $this->data['lotes'] = $this->model_lotes->getLoteData();
        $this->data['articulos'] = $this->model_articulos->getArticuloData();
        $this->data['clientes'] = $this->model_clientes->getClienteData();
        $this->render_template('salidas/create', $this->data);
    }

    /*
    * Fetches the orders data from the orders table
    * this function is called from the datatable ajax function
    */
    public function fetchSalidasData()
    {
        $result = array('data' => array());

        $data = $this->model_salidas->getSalidasData();

        foreach ($data as $key => $value) {

//            $count_total_item = $this->model_orders->countOrderItem($value['id']);
            $cliente = $this->model_clientes->getClienteData($value['Cliente']);


            // button
            $buttons = '';

            if(in_array('viewOrder', $this->permission)) {
                $buttons .= '<a target="__blank" href="'.base_url('salidas/printDiv/'.$value['ID']).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
            }

            if(in_array('updateOrder', $this->permission)) {
//                $buttons .= ' <a href="'.base_url('salidas/update/'.$value['ID']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if(in_array('deleteOrder', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['ID'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

//            if($value['paid_status'] == 1) {
//                $paid_status = '<span class="label label-success">Paid</span>';
//            }
//            else {
//                $paid_status = '<span class="label label-warning">Not Paid</span>';
//            }

            $result['rows'][$key] = array(
                'ID'=>$value['ID'],
                'Bill_no'=>$value['Bill_no'],
                'Cliente'=>$cliente['Nombre'],
                'Fecha'=>$value['Fecha'],
                'Descripcion'=>$value['Descripcion'],
                'Venta'=>$value['Venta'],
                'Cantidad_Total'=>$value['Cantidad_Total'],
                'Buttons'=>$buttons
            );
        } // /foreach

        echo json_encode($result);
    }

    public function getVentasData($id)
    {
        $result = array('data' => array());
        /*Cogemos los datos de venta  e iteramos para extraer toda su info*/

        $data = $this->model_salidas->getSalidasData($id);
//        echo gettype($data['Venta']);
        foreach (json_decode($data['Venta']) as $key => $value) {

            $lote = $this->model_lotes->getLoteData($value->Lote_ID);
            $articulo = $this->model_articulos->getArticuloData($value->Articulo_ID);
            $division = $this->model_divisiones->getDivisionDataById($value->Division_ID);
//                echo json_encode($value);
//                echo json_decode($data['Venta']);
//                echo $articulo;
//                echo $division;
            $cantidad = $value->Cantidad;
            $result['rows'][$key] = array(
                'Lote'=>$lote['Serial'],
                'Articulo'=>$articulo['Serial'],
                'Elemento'=>$division['ID'],
                'Largo'=>$division['Largo'],
                'Alto'=>$division['Alto'],
                'Espesor'=>$division['Espesor'],
                'Cantidad'=>$cantidad,
                'Metros_lineales'=>floatval($cantidad)*floatval($division['Largo']). ' m',
                'Metros_cuadrados'=>floatval($cantidad)*floatval($division['Largo'])*floatval($division['Alto']) .' m²',
                'Metros_cubicos'=>floatval($cantidad)*floatval($division['Largo'])*floatval($division['Alto'])*floatval($division['Espesor']) .' m³',
//                'Cantidad_Total'=>$value['Cantidad_Total'],
//                'Buttons'=>$buttons
            );
        } // /foreach

        echo json_encode($result);
    }

    public function getLoteDataById()
    {
        $id=$_GET['lote_id'];
        if ($id) {
            $data = $this->model_lotes->getLoteData($id);
            echo json_encode($data);
        }
    }

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database
    * and it stores the operation message into the session flashdata and display on the manage group page
    */
    public function create()
    {
        if(!in_array('createOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->data['page_title'] = 'Añadir Salida';
        $response = array();

        $this->form_validation->set_rules('cliente_nombre', 'Nombre Cliente', 'trim|required');
        $this->form_validation->set_rules('lote[]', 'Lote Serial', 'trim|required');
        $this->form_validation->set_rules('articulo_hidden[]', 'Articulo', 'trim|required');
        $this->form_validation->set_rules('division[]', 'Division', 'trim|required');
        $this->form_validation->set_rules('cantidad[]', 'Cantidad', 'trim|required');
        $this->form_validation->set_rules('stock_hidden[]', 'Stock', 'trim|required');
        $this->form_validation->set_rules('cantidad_total_hidden', 'Cantidad Total', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

//        echo $this->input->post('cantidad_total_hidden');
//        echo $this->input->post('stock_hidden[0]');
//        echo $this->input->post('lote[0]');
//        die();

        if ($this->form_validation->run() == TRUE) {

            $salida_id = $this->model_salidas->create();

            if($salida_id) {
                $this->session->set_flashdata('success', 'Salida creada!!');
                $response=$salida_id;
//                redirect('salidas/index', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Ha ocurrido un error!!');
//                redirect('salidas/createSalida', 'refresh');
            }
        }else {
            $response['success'] = false;
            foreach ($_POST as $key => $value) {
                $response['messages'][$key] = form_error($key);
            }
        }
        echo json_encode($response);
    }

    /*
    * It gets the product id passed from the ajax method.
    * It checks retrieves the particular product data from the product id
    * and return the data into the json format.
    */
//    public function getProductValueById()
//    {
//        $product_id = $this->input->post('product_id');
//        if($product_id) {
//            $product_data = $this->model_products->getProductData($product_id);
//            echo json_encode($product_data);
//        }
//    }

    /*
    * It gets the all the active product inforamtion from the product table
    * This function is used in the order page, for the product selection in the table
    * The response is return on the json format.
    */
//    public function getTableProductRow()
//    {
//        $products = $this->model_products->getActiveProductData();
//        echo json_encode($products);
//    }

    /*
    * If the validation is not valid, then it redirects to the edit orders page
    * If the validation is successfully then it updates the data into the database
    * and it stores the operation message into the session flashdata and display on the manage group page
    */
    public function update($id)
    {
        if(!in_array('updateOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if(!$id) {
            redirect('dashboard', 'refresh');
        }

        $this->data['page_title'] = 'Editar Salida';

        $this->form_validation->set_rules('cliente_nombre', 'Nombre Cliente', 'trim|required');
        $this->form_validation->set_rules('lote[]', 'Lote Serial', 'trim|required');
        $this->form_validation->set_rules('articulo[]', 'Articulo', 'trim|required');
        $this->form_validation->set_rules('division[]', 'Division', 'trim|required');
        $this->form_validation->set_rules('cantidad[]', 'Cantidad', 'trim|required');

        if ($this->form_validation->run() == TRUE) {

            $update = $this->model_salidas->update($id);

            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated');
                redirect('salidas/update/'.$id, 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('salidas/update/'.$id, 'refresh');
            }
        }
        else {
            // false case
            $company = $this->model_company->getCompanyData(1);
            $this->data['company_data'] = $company;
            $this->data['is_vat_enabled'] = ($company['vat_charge_value'] > 0) ? true : false;
            $this->data['is_service_enabled'] = ($company['service_charge_value'] > 0) ? true : false;

            $result = array();
            $orders_data = $this->model_orders->getOrdersData($id);

            $result['order'] = $orders_data;
            $orders_item = $this->model_orders->getOrdersItemData($orders_data['id']);

            foreach($orders_item as $k => $v) {
                $result['order_item'][] = $v;
            }

            $this->data['order_data'] = $result;

            $this->data['products'] = $this->model_products->getActiveProductData();

            $this->render_template('orders/edit', $this->data);
        }
    }

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
    public function remove()
    {
        if(!in_array('deleteOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $salida_id = $this->input->post('salida_id');
        $response = array('success_div'=>array(),'messages_div'=>array(),'success_lote'=>array(),'messages_lote'=>array());

        $salidas_data = $this->model_salidas->getSalidasData($salida_id);
//            echo json_encode($salida_id);
        foreach (json_decode($salidas_data['Venta']) as $key => $value) {
            $lote = $this->model_lotes->getLoteData($value->Lote_ID);
            $division = $this->model_divisiones->getDivisionDataById($value->Division_ID);
//            echo json_encode($lote);
//            echo json_encode($division);
            $div_data = array('Piezas_Stock'=>floatval($division['Piezas_Stock'])+floatval($value->Cantidad));
            $update_div = $this->model_divisiones->update($div_data,$division['ID']);
//            $update_div=true;
            if($update_div) {
                array_push($response['success_div'],  true);
                array_push($response['messages_div'],"División :".$division['ID']."  actualizada !!");
            }else{
                array_push($response['success_div'],  false);
                array_push($response['messages_div'],"División :".$division['ID']." no se pudo actualizar !!");
            }


//            echo $lote['Salida'];
            $sal_array =(array) json_decode($lote['Salida'])->id;
            $pos = array_search($salida_id,$sal_array);
            unset($sal_array[$pos]);
            $sal = array('id'=>$sal_array);


            $lote_data = array('Vendido'=>0,'Salida'=>json_encode($sal));
            $update_lote = $this->model_lotes->update($lote_data,$lote['ID']);
//            $update_lote=true;
            if($update_lote) {
                array_push($response['success_lote'],  true);
                array_push($response['messages_lote'],"Lote :".$lote['ID']."  actualizado!!");
            }else{
                array_push($response['success_lote'],  false);
                array_push($response['messages_lote'],"Lote :".$lote['ID']." no se pudo actualizar !!");
            }

        }

            if($salida_id) {
            $delete = $this->model_salidas->remove($salida_id);
//                $delete=true;
            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Salida eliminada !!";
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error de la base de datos al tratar de eliminar.";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Recargue la página!!";
        }

        echo json_encode($response);
    }

    /*
    * It gets the product id and fetch the order data.
    * The order print logic is done here
    */
    public function printDiv($id)
    {
        if(!in_array('viewOrder', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
//        echo $id;
        if($id) {
            $salidas_data = $this->model_salidas->getSalidasData($id);
            $clientes_data = $this->model_clientes->getClienteData($salidas_data['Cliente']);
            $company_info = $this->model_company->getCompanyData(1);

            $venta=json_decode($salidas_data['Venta']);

            $array_articulo=array();
            $array_lotes=array();
//            echo json_encode($venta);

            foreach($venta as $k => $v){
//                $array_articulo[$v->Articulo_ID]=array();
                if(array_key_exists($v->Articulo_ID,$array_articulo)) {
//                    echo gettype($array_articulo[$v->Articulo_ID]);
//                    echo json_encode($array_articulo[$v->Articulo_ID]);
//                    $array_articulo[$v->Articulo_ID] = array_push($array_articulo[$v->Articulo_ID],(array) $v);
//                    $array_articulo[$v->Articulo_ID] += (array) $v;
                    array_push( $array_articulo[$v->Articulo_ID],(array)$v);
                }else {
                    $array_articulo[$v->Articulo_ID] = array();
//                    $array_articulo[$v->Articulo_ID] = $v;
                    array_push($array_articulo[$v->Articulo_ID] , (array) $v);
                }
            }
//            echo "\n";
//            echo json_encode($array_articulo);
            $lotes_data = $this->model_lotes->getLoteData($id);

            $divisiones_data = $this->model_divisiones->getDivisionDataById();

            $articuo_data = $this->model_articulos->getArticuloData();

//            $salida_date = date('d/m/Y', $salidas_data['Fecha']);
            $salida_date = $salidas_data['Fecha'];
//            $paid_status = ($order_data['paid_status'] == 1) ? "Paid" : "Unpaid";

            $html = '<!-- Main content -->
			<!DOCTYPE html>
			<html xmlns="http://www.w3.org/1999/html">
			<head>
              <meta charset="UTF-8">
			 <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge">-->
			  <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
			  <title>Albarán Salida | Ventos de Pedra</title>
			  <!-- Tell the browser to be responsive to screen width -->
			  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
			  <!-- Bootstrap 3.3.7 -->
			  <link rel="stylesheet" href="' .base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css').'">
			  <!-- Font Awesome -->
			  <link rel="stylesheet" href="'.base_url('assets/bower_components/font-awesome/css/font-awesome.min.css').'">
			  <link rel="stylesheet" href="'.base_url('assets/dist/css/AdminLTE.min.css').'">
			  <link rel="stylesheet" href="'.base_url('assets/dist/css/albaran.css').'">
			</head>
			<!--<body onload="window.print();">-->
			<body  onload="window.print();">
			
			<div class="wrapper">
			  <section class="invoice">
			    <!-- title row -->
			    <div class="row">
			      <div class="col-xs-12">
			        <!--<h2 class="page-header">
			          '.$company_info['company_name'].'
			          <small class="pull-right">Fecha: '.$salida_date.'</small>
			        </h2>-->
			       <image id="cabecera" src="'.base_url('assets/images/base.png').'" alt="cabecera ventos"></image>
			      </div>
			      <!-- /.col -->
			    </div>
			    <!-- info row -->
			    <div class="row invoice-info">
			      
			      <br class="col-sm-4 invoice-col">
			        
			        <b style="margin-left: 2%">  Albarán ID:</b> '.$salidas_data['Bill_no'].'<br>
			        <b style="margin-left: 2%">  Cliente:</b> '.$clientes_data['Nombre'].'<br>
			        <b style="margin-left: 2%">  Empresa:</b> '.$clientes_data['Empresa'].' <br />
			        <b style="margin-left: 2%">  NIF:</b> '.$clientes_data['NIF'].' <br />
			        <b style="margin-left: 2%">  Teléfono:</b> '.$clientes_data['Telefono'].'<br>
			        <b style="margin-left: 2%">  Email:</b> '.$clientes_data['Correo'].'</br>
			        
			    </div>
			      <!-- /.col -->
			    ';

            foreach ($array_articulo as $k => $v) {

                $articuo_data = $this->model_articulos->getArticuloData($k);
                $ventas_data = $v;

			    $html.='<!-- Table row -->
			    <div class="row">
			      <div class="col-xs-12 table-responsive">
			        <table class="table table-striped">
			          <thead>
			          <tr>  
			            <th class="articulo">Código</th>
			            <th class="articulo">Producto</th>
			          </tr>
			          </thead>
			          <tbody>
			          <tr>
				            <td>'.$articuo_data['Serial'].'</td>
				            <td>'.$articuo_data['Nombre'].'</td>
			          </tr>
			          </tbody>
			          </table>
			          <table  class="table table-striped">
			          <thead>
			          <tr>  
			            <th class="lote">Lote</th>
			            <th class="cantidad">Cantidad</th>
			            <th class="largo">Largo</th>
			            <th class="alto">Alto/Ancho</th>
			            <th class="espesor">Espesor</th>
			            <th class="subtotal">Subtotal</th>
			          </tr>
			          </thead>
			          <tbody>';
			    foreach ($ventas_data as $c =>$s){

                    $div_data = $this->model_divisiones->getDivisionDataById($s['Division_ID']);
                    $lote_data = $this->model_lotes->getLoteData($s['Lote_ID']);

                    $ml = floatval($s['Cantidad'])*floatval($div_data['Largo']);
			        $m2 = floatval($s['Cantidad'])*floatval($div_data['Largo'])*floatval($div_data['Alto']);
			        $m3 = floatval($s['Cantidad'])*floatval($div_data['Largo'])*floatval($div_data['Alto'])*floatval($div_data['Espesor']);

			        $subtotal = 'M: '.$ml. ', '.'M2: '.$m2. ', '.'M3: '.$m3;
			        $html.= '<tr>
				            <td>'.$lote_data['Serial'].'</td>
				            <td>'.$s['Cantidad'].' u</td>
				            <td>'.$div_data['Largo'].' m</td>
				            <td>'.$div_data['Alto'].' m</td>
				            <td>'.$div_data['Espesor'].' m</td>
				            <td>'.$subtotal.'</td>
			          </tr>';
                     }

            $html .= '</tbody>
			        </table>
			   
                    </div>
                    
			      </div>
			      <!-- /.col -->';
			   }

			    $html.='<!-- /.row -->           
             </div><!-- /.row -->
			 <div class="row">
			      <div class="col-xs-6 pull pull-left">
			      <image id="logo" src="'.base_url('assets/images/logo.png').'" alt="logo ventos"></image>
			      			          <table class="table">
			      <tr>
			      
			              <th style="width:50%">Firmado:</th>
			              <td>'.$clientes_data['Nombre'].'</td>
			              <td>'.$clientes_data['Empresa'].'</td>
			            </tr>
			            </table>    
			      </div>
			      <div class="col-xs-6 pull pull-right">

			        <div class="table-responsive">
			          <table class="table">
			            <tr>
			              <th style="width:50%">Cantidad Total:</th>
			              <td>'.$salidas_data['Cantidad_Total'].'</td>
			            </tr>';


			            
			            $html .=' <tr>
			              <th>Transporte:</th>
			              <td></td>
			            </tr>
			            <tr>
			              <th>Nº de matrícula:</th>
			              <td></td>
			            </tr>
			          
			          </table>
			        </div>
			      </div>
			      <!-- /.col -->
			    </div>
		
			    <!-- /.row -->
			  </section>
			  <!-- /.content -->
			</div>
		</body>
	</html>';

            echo $html;
        }
    }


    /*************SALIDAS CON PAGINADO Y FILTRADO******************/
    ////PRUEBA CON PAGINADO Y FILTRADO
    public function fetchSalidasDataFilteringPagination()
    {
        $result = array('data' => array());


        $search_field = $this->input->get('searchField'); // search field name
        $search_string = $this->input->get('searchString'); // search string
        $page = $this->input->get('page'); //page number
        $limit = $this->input->get('rows'); // number of rows fetch per page
        $sidx = $this->input->get('sidx'); // field name which you want to sort
        $sord = $this->input->get('sord'); // field data which you want to soft
        if(!$sidx) { $sidx = 1; } // if its empty set to 1
        $count = $this->model_salidas->countTotal($search_field, $search_string);
        $total_pages = 0;
        if($count > 0) { $total_pages = ceil($count/$limit); }
        if($page > $total_pages) { $page = $total_pages; }
        $start = ($limit * $page) - $limit;

        $salidasdata=($this->model_salidas->getSalidasDataFilterPagination($sidx, $sord, $start, $limit, $search_field, $search_string));


        foreach ($salidasdata as $key => $value) {
            $buttons = '';

            if(in_array('viewOrder', $this->permission)) {
                $buttons .= '<a target="__blank" href="'.base_url('salidas/printDiv/'.$value->ID).'" class="btn btn-default"><i class="fa fa-print"></i></a>';
            }

//            if(in_array('updateOrder', $this->permission)) {
////                $buttons .= ' <a href="'.base_url('salidas/update/'.$value['ID']).'" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
//            }

            if(in_array('deleteOrder', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value->ID.')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
            $value->Buttons=$buttons;

        }

        $data = array('page'=>$page,
            'total'=>$total_pages,
            'records'=>$count,
            'rows'=>$salidasdata,
        );

        echo json_encode($data);
    }


}