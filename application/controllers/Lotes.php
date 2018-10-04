<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Lotes extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Entradas';

        $this->load->model('model_entradas');
        $this->load->model('model_articulos');
        $this->load->model('model_lotes');
        $this->load->model('model_divisiones');
        $this->load->model('model_almacenes');

        $this->load->model('model_proovedores');

        $this->load->library('form_validation');



//        $this->data['lotes'] = $this->model_lotes->getLoteData();

    }

    /*
    * It only redirects to the manage product page
    */
    public function index()
    {
        // echo "PUTO";
        if (!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

//        $this->render_template('lotes/edit', $this->data);
        $this->render_template('lotes/index', $this->data);
    }
    public function edit()
    {
        // echo "PUTO";
        if (!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }


        $this->data['articulos'] = $this->model_articulos->getArticuloData();
        $this->data['almacenes'] = $this->model_almacenes->getAlmacenesData();
        $this->data['entradas'] = $this->model_entradas->getEntradasData();
        $this->data['proovedores'] = $this->model_proovedores->getProovedorData();

        $this->render_template('lotes/edit', $this->data);

    }
    /*
    * It Fetches the products data from the product tabled
    * this function is called from the datatable ajax function
    */

    public function fetchLotesData()
    {
        $result = array('data' => array());

        $data = $this->model_lotes->getLoteData();

        foreach ($data as $key => $value) {

            $store_data = $this->model_almacenes->getAlmacenesData($value['Almacen']);
            $articulo_data = $this->model_articulos->getArticuloData($value['Articulo']);
//            echo $articulo_data['Nombre'];
//            echo $store_data['Nombre'];
            // button
            $buttons = '';

            if (in_array('deleteProduct', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value['ID'] . ',' . $value['Entrada'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
            if (in_array('deleteProduct', $this->permission)) {
                $buttons .= ' <a type="button" class="btn btn-default" href= "edit?lote_serial='. $value['Serial'] .'&lote_id='. $value['ID'] .' "><i class="fa fa-pencil"></i></a>';
            }


//            $img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';

//            $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $qty_status = '';
            if ($value['Stock'] <= 10) {
                $qty_status = '<span class="label label-warning">Low !</span>';
            } else if ($value['Stock'] <= 0) {
                $qty_status = '<span class="label label-danger">Out of stock !</span>';
            }


            $result['rows'][$key] = array(
                'ID'=>$value['ID'],
                'Articulo'=>$articulo_data['Nombre'],
                'Serial'=>$value['Serial'],
                'Entrada'=>$value['Entrada'],
                'Coste'=>$value['Coste'],
                'Precio'=>$value['Precio'],
                'Cantidad'=>$value['Cantidad'],
//                'Unidades'=>$value['Unidades'],
                'Division'=>$value['Division'],
                'Stock'=>$value['Stock'] . ' ' . $qty_status,
                'Descripcion'=>$value['Descripcion'],
                'Almacen'=>$store_data['Nombre'],
//                $availability,
                'Buttons'=>$buttons
            );
        } // /foreach

        echo json_encode($result);
    }

    public function fetchLoteSerial(){

        $result = array();

        $data = $this->model_lotes->getLoteData();

        foreach ($data as $key => $value) {
            $result['rows'][$key] = array('Serial'=>$value['Serial']);

        }

        echo json_encode($result);

    }

    public function fetchLoteSerialByArticulo(){

        $result = array();

        $data = $this->model_lotes->getLoteDataByArticulo($_GET['articulo_id']);

        foreach ($data as $key => $value) {
            $result['rows'][$key] = array('ID'=>$value['ID'],'Serial'=>$value['Serial']);

        }

        echo json_encode($result);

    }

    public function getLoteByName()
    {
        $name = $_GET['serial'];
        //echo $name;
//        $result = array('data' => array());

        $data = $this->model_lotes->getMyLoteByName($name);

        if($data)
            echo json_encode($data);
        else
            echo header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);

//
//        foreach ($data as $key => $value) {
//            $result['data'][$key] = array(
//                $value['ID'],
//                $value['Serial'],
//                $value['Articulo'],
//                $value['Entrada'],
//                $value['Salida'],
//                $value['Descripcion'],
//                $value['Cantidad'],
//                $value['Unidades'],
//                $value['Stock'],
//                $value['Division'],
//                $value['Precio'],
//                $value['Coste'],
//                $value['Almacen'],
//                $value['Vendido'],
//                $value['Movimiento']
//            );
//        } // /foreach



    }

    public function getDivLoteDataById($id)
    {
        if ($id) {
            $data = $this->model_lotes->getDivLoteDataById($id);
            echo json_encode($data);
        }
    }
    public function getDivisionData()
    {

        $result = array('data' => array());
        if (empty($_GET['id']))
            $data = $this->model_divisiones->getDivisionData();
        else
            $data = $this->model_divisiones->getDivisionData($_GET['id']);

        //$data=$result;

        foreach ($data as $key => $value) {

            // button
            //echo $value['Piezas'];
            $buttons = '';
            // button
            if (in_array('updateProduct', $this->permission)) {
                $buttons = '<button type="button" class="btn btn-default" onclick="editFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
            }

            if (in_array('deleteProduct', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

            $qty_status = '';
            if ($value['Piezas'] <= 5) {
                $qty_status = '<span class="label label-warning">Pocas !</span>';
            } else if ($value['Piezas'] <= 0) {
                $qty_status = '<span class="label label-danger">Fuera de Stock !</span>';
            }

            //echo $buttons;
            $result['rows'][$key] = array(
                'ID' => $value['ID'],
                'Piezas' => $value['Piezas'] . ' ' . $qty_status,
                'Piezas_Stock' => $value['Piezas_Stock'] . ' ' . $qty_status,
                'Largo' => $value['Largo'],
                'Alto' => $value['Alto'],
                'Espesor' => $value['Espesor'],
                'Buttons' => $buttons
            );
        } // /foreach11
        echo json_encode($result);
    }

    public function getDivisionDataByLote(){

        $result = array('data' => array());

//        echo $_GET['id'];
        $data = $this->model_divisiones->getDivisionDataByLote($_GET['id']);

        foreach ($data as $key => $value) {

            // button
            //echo $value['Piezas'];
            $buttons = '';
            // button
            if (in_array('updateProduct', $this->permission)) {
                $buttons = '<button type="button" class="btn btn-default" onclick="editFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
            }

            if (in_array('deleteProduct', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

            $qty_status = '';
            if ($value['Piezas'] <= 5) {
                $qty_status = '<span class="label label-warning">Pocas !</span>';
            } else if ($value['Piezas'] <= 0) {
                $qty_status = '<span class="label label-danger">Fuera de Stock !</span>';
            }

            //echo $buttons;
            $result['rows'][$key] = array(
                'ID' => $value['ID'],
                'Piezas' => $value['Piezas'] . ' ' . $qty_status,
                'Largo' => $value['Largo'],
                'Alto' => $value['Alto'],
                'Espesor' => $value['Espesor'],
                'Buttons' => $buttons
            );
        } // /foreach11
        echo json_encode($result);

    }


    public function getDivisionDataById($id)
    {
        if ($id) {
            $data = $this->model_divisiones->getDivisionDataById($id);
            echo json_encode($data);
        }
    }

    /************VALIDATORS***************************/
//    public function is0($str){
//        if(intval($str)==0) {
//            $this->form_validation->set_message('is0', 'El campo %s no puede ser 0');
//            return FALSE;
//        }else {
////                echo "SHIT";
//            return TRUE;
//        }
//    }


    public function decimal_numeric($str)
    {
//        echo "AKI";
        if (!is_numeric($str)) //Use your logic to check here
        {
            $this->form_validation->set_message('decimal_numeric', 'El campo %s no se corresponde con el formato');
            return FALSE;
        }
        else
        {
            try{


                $results=explode(".",$str,2);
                //SI es mayor de tres decimales
                if(count($results)==2){
                    //Compruebo si es solo 0
                    if(intval($results[0])==0 && intval($results[1]==0)){

                        $this->form_validation->set_message('decimal_numeric', 'El campo %s no puede ser 0');
                        return FALSE;
                    }
                    if(strlen($results[1])>3) {
                        $this->form_validation->set_message('decimal_numeric', 'El campo %s no puede exceder de 3 decimales');

                        return FALSE;
                    }
                }else if(intval($results[0])==0){
                    $this->form_validation->set_message('decimal_numeric', 'El campo %s no puede ser 0');
                    return FALSE;
                }
                return TRUE;
            }catch (Exception $e){
                return FALSE;
            }
        }
    }

    public function entire_numeric($str)
    {
//        echo "AKI";
        if (!is_numeric($str)) //Use your logic to check here
        {
            $this->form_validation->set_message('entire_numeric', 'El campo %s no se corresponde con el formato');
            return FALSE;
        }
        else {

            $results=explode(".",$str,2);
//            echo "SHIT".$results[0];

            if(count($results)>1){
                $this->form_validation->set_message('entire_numeric', 'El campo %s debe ser un número entero');
                return FALSE;
            }
            if(intval($results[0])==0) {
                $this->form_validation->set_message('entire_numeric', 'El campo %s no puede ser 0');
                return FALSE;
            }else {
//                echo "SHIT";
                return TRUE;
            }

        }

    }



    public function createDivision($Lote)
    {

        //echo "ENTRA";
        if (!in_array('createProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

//        if(!$Lote)
//            $Lote=$_GET[''];
        $this->form_validation->set_rules('create_piezas', 'Piezas', 'trim|required|callback_entire_numeric');
        $this->form_validation->set_rules('create_largo', 'Largo', 'trim|required|callback_decimal_numeric');
        $this->form_validation->set_rules('create_alto', 'Alto/Ancho', 'trim|required|callback_decimal_numeric');
        $this->form_validation->set_rules('create_espesor', 'Espesor', 'trim|required|callback_decimal_numeric');

//        $this->form_validation->set_rules('create_lote', 'Largo', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

//        $this->entire_numeric($this->input->post('create_piezas'));
//        $lote = json_decode($this->getDivLoteDataById($Lote));
//
//        echo $Lote;
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'Piezas' => $this->input->post('create_piezas'),
                'Largo' => $this->input->post('create_largo'),
                'Alto' => $this->input->post('create_alto'),
                'Espesor' => $this->input->post('create_espesor'),
                'Piezas_Stock' => $this->input->post('create_piezas'),
                'Lote'  => $Lote,
            );
//            die();
            $create = $this->model_divisiones->create($data);


            if ($create == true) {
                $response['success'] = true;
                $response['messages'] = 'División creada';

                $response['division'] = $create;

            } else {
                $response['success'] = false;
                $response['messages'] = 'Error!';
            }
        } else {
            $response['success'] = false;
            foreach ($_POST as $key => $value) {
                $response['messages'][$key] = form_error($key);
            }
        }

        echo json_encode($response);
    }

    public function editDivisionDataById($id)
    {
        if (!in_array('updateProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if (!$id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('edit_piezas', 'Piezas', 'trim|required|callback_entire_numeric');
        $this->form_validation->set_rules('edit_largo', 'Largo', 'trim|required|callback_decimal_numeric');
        $this->form_validation->set_rules('edit_alto', 'Alto/Ancho', 'trim|required|callback_decimal_numeric');
        $this->form_validation->set_rules('edit_espesor', 'Espesor', 'trim|required|callback_decimal_numeric');

        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');


        if ($this->form_validation->run() == TRUE) {
            // true case

            $data = array(

                'Piezas' => $this->input->post('edit_piezas'),
                'Largo' => $this->input->post('edit_largo'),
                'Alto' => $this->input->post('edit_alto'),
                'Espesor' => $this->input->post('edit_espesor'),
                'Piezas_Stock' => $this->input->post('edit_piezas'),

            );


            $update = $this->model_divisiones->update($data, $id);
            if ($update == true) {
                $response['success'] = true;
                $response['messages'] = 'Entrada actualizada';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Error al actualizar';
            }
        } else {
            $response['success'] = false;
            foreach ($_POST as $key => $value) {
                $response['messages'][$key] = form_error($key);
            }
        }
        echo json_encode($response);
    }

    public function deleteDivision()
    {
        if (!in_array('deleteProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $div_id = $this->input->post('div_id');

        $response = array();
        if ($div_id) {
            $delete = $this->model_divisiones->remove($div_id);
            if ($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Eliminado correctamente!!";
            } else {
                $response['success'] = false;
                $response['messages'] = "Error al eliminar";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Recargue la página!!";
        }

        echo json_encode($response);
    }
    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
    public function create()
    {
        // echo "PUTA";
        if (!in_array('createProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $Serial=$_GET['serial'];
        $response = array();

        $this->form_validation->set_rules('lote_serial', 'Lote Serial', 'trim|required');
        $this->form_validation->set_rules('articulo', 'Artículo', 'trim|required');
        $this->form_validation->set_rules('entrada', 'Entrada', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required');
        $this->form_validation->set_rules('precio', 'Precio', 'trim|required');
        $this->form_validation->set_rules('unidades', 'Unidades', 'trim|required');
//        $this->form_validation->set_rules('division', 'Division', 'trim|required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required');
        $this->form_validation->set_rules('almacen', 'Almacen', 'trim|required');
        $this->form_validation->set_rules('coste', 'Coste', 'trim|required');
//        $this->form_validation->set_rules('stock', 'Stock', 'trim|required');

        if($this->form_validation->run() == True) {

//            $divisiones = $this->model_divisiones->getDivisionDataByLote($lote_id);
//            echo json_encode($divisiones);
//            $list = array();

//            foreach ($divisiones as $k => $value) {
//                array_push($list, intval($value['ID']));
//            }
//            $lista = array(
//                'id' => $list
//            );

            $data = array(
                'Serial' => $Serial,
                'Articulo' => $this->input->post('articulo'),
                'Entrada' => $this->input->post('entrada'),
                'Coste' => $this->input->post('coste'),
                'Cantidad' => $this->input->post('cantidad'),
                'Unidades' => $this->input->post('unidades'),
                'Stock' => $this->input->post('stock'),
                'Division' => $this->input->post('division'),
                'Descripcion' => $this->input->post('descripcion'),
                'Almacen' => $this->input->post('store')
            );

            $create = $this->model_lotes->create($data);
            if ($create == true) {
                $response['success'] = true;
                $response['messages'] = 'Lote creado';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Error!';
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
    * If the validation is not valid, then it redirects to the edit product page
    * If the validation is successfully then it updates the data into the database
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
    public function update()
    {
        $lote_id=$_GET['lote_id'];

        if (!in_array('updateProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if (!$lote_id) {
            redirect('dashboard', 'refresh');
        }

        $response = array();


//        $this->form_validation->set_rules('lote_serial', 'Lote Serial', 'trim|required');
        $this->form_validation->set_rules('articulo', 'Artículo', 'trim|required');
        $this->form_validation->set_rules('entrada', 'Entrada', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim');
        $this->form_validation->set_rules('precio', 'Precio', 'trim|required');
//        $this->form_validation->set_rules('unidades', 'Unidades', 'trim|required');
//        $this->form_validation->set_rules('division', 'Division', 'trim|required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required');
        $this->form_validation->set_rules('almacen', 'Almacen', 'trim|required');
//        $this->form_validation->set_rules('salida', 'Almacen', 'trim');
        $this->form_validation->set_rules('coste', 'Coste', 'trim|required');
//        $this->form_validation->set_rules('stock', 'Stock', 'trim|required');
        $this->form_validation->set_rules('fecha', 'Fecha', 'trim|required');
        $this->form_validation->set_rules('proovedor', 'Proovedor', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

//        die(var_dump($_POST));
//        foreach ($_POST as $key => $value) {
//            echo "<tr>";
//            echo "<td>";
//            echo $key;
//            echo "</td>";
//            echo "<td>";
//            echo $value;
//            echo "</td>";
//            echo "</tr>";
//        }
//        die();
        if ($this->form_validation->run() == TRUE) {
            // true case
//            echo "ENTRA";
            $entrada_data=array('Fecha'=>$this->input->post('fecha'),'Proovedor' => $this->input->post('proovedor'),'ID'=>$this->input->post('entrada'));

            $this->updateFromLote($entrada_data);


            $divisiones=$this->model_divisiones->getDivisionDataByLote($lote_id);

            $list= array();
            foreach ($divisiones as $k => $value) {
                array_push($list,intval($value['ID']));
            }
            $lista=array(
                'id'=>$list
            );


            $data = array(
//                'Serial' => $this->input->post('lote_serial'),
                'Articulo' => intval($this->input->post('articulo')),
                'Entrada' => intval($this->input->post('entrada')),
                'Coste' => $this->input->post('coste'),
                'Cantidad' => $this->input->post('cantidad'),
                'Precio' => $this->input->post('precio'),
//                'Unidades' => $this->input->post('unidades'),
//                'Stock' => $this->input->post('stock'),
                'Division' => json_encode($lista),
                'Descripcion' => $this->input->post('descripcion'),
                'Almacen' => intval($this->input->post('almacen'))
            );

//            echo json_encode($data);
//            die();

            $update = $this->model_lotes->update($data, $lote_id);
            if ($update == true) {
//                    echo "ENTRA";
                $response['success'] = true;
                $response['messages'] = 'Lote actualizado';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Error al actualizar';
            }

        }else {
            $response['success'] = false;
            foreach ($_POST as $key => $value) {
                $response['messages'][$key] = form_error($key);
            }
        }

        echo json_encode($response);

    }

    public function updateFromEntrada()
    {
        $lote_id=$_GET['lote_id'];

        if (!in_array('updateProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if (!$lote_id) {
            redirect('dashboard', 'refresh');
        }

        $response = array();


        $this->form_validation->set_rules('lote_serial', 'Lote Serial', 'trim|required');
        $this->form_validation->set_rules('articulo', 'Artículo', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim');
        $this->form_validation->set_rules('precio', 'Precio', 'trim|required');
//        $this->form_validation->set_rules('unidades', 'Unidades', 'trim|required');
//        $this->form_validation->set_rules('division', 'Division', 'trim|required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required');
        $this->form_validation->set_rules('almacen', 'Almacen', 'trim|required');
//        $this->form_validation->set_rules('salida', 'Almacen', 'trim');
        $this->form_validation->set_rules('coste', 'Coste', 'trim|required');
//        $this->form_validation->set_rules('stock', 'Stock', 'trim|required');
        $this->form_validation->set_rules('fecha', 'Fecha', 'trim|required');
        $this->form_validation->set_rules('proovedor', 'Proovedor', 'trim|required');
        $this->form_validation->set_rules('pagado', 'Estado', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');



        if ($this->form_validation->run() == TRUE) {
            // true case
//            $entrada_data=array('Fecha'=>$this->input->post('fecha'),'Proovedor' => $this->input->post('proovedor'));
            $entrada_data=array('Proovedor' => $this->input->post('proovedor'),'Pagado'=>$this->input->post('pagado'));

            $create_entrada = $this->model_entradas->create($entrada_data);

            $divisiones=$this->model_divisiones->getDivisionDataByLote($lote_id);

            $list= array();
            foreach ($divisiones as $k => $value) {
                array_push($list,intval($value['ID']));
            }
            $lista=array(
                'id'=>$list
            );


            $data = array(
                'Serial' => $this->input->post('lote_serial'),
                'Articulo' => intval($this->input->post('articulo')),
                'Entrada' => intval($create_entrada),
                'Coste' => $this->input->post('coste'),
                'Cantidad' => $this->input->post('cantidad'),
                'Precio' => $this->input->post('precio'),
//                'Unidades' => $this->input->post('unidades'),
                'Stock' => $this->input->post('cantidad'),
                'Division' => json_encode($lista),
                'Descripcion' => $this->input->post('descripcion'),
                'Almacen' => intval($this->input->post('almacen'))
            );

//            echo json_encode($data);
//            die();

            $update = $this->model_lotes->update($data, $lote_id);
            if ($update == true) {
//                    echo "ENTRA";
                $response['success'] = true;
                $response['messages'] = 'Lote creado';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Error al actualizar';
            }

        }else {
            $response['success'] = false;
            foreach ($_POST as $key => $value) {
                $response['messages'][$key] = form_error($key);
            }
        }

        echo json_encode($response);

    }


    public function updateFromLote($entrada_data)
    {
        if (!in_array('updateProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $response = array();

            // true case
//                echo "ENTRA2";

                $data = array(
                    'Proovedor' => $entrada_data['Proovedor'],
                    'Fecha' => $entrada_data['Fecha'],
                );

                $update = $this->model_entradas->update($data, $entrada_data['ID']);

                if ($update == true) {
//                    echo "ENTRA";
                    $response['success'] = true;
                    $response['messages'] = 'Entrada actualizada';
                } else {
                    $response['success'] = false;
                    $response['messages'] = 'Error al actualizar';
                }
//        echo json_encode($response);
    }
    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
    public function remove()
    {
        if (!in_array('deleteProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $lote_id = $this->input->post('lote_id');
        $entrada_id = $this->input->post('entrada_id');
        $divisiones = $this->model_divisiones->getDivisionDataByLote($lote_id);

        $response = array();

        if ($lote_id) {

            $deleteEntrada = $this->model_entradas->remove($entrada_id);
            $deleteLote = $this->model_lotes->remove($lote_id);

            foreach($divisiones as $key=>$value){
                $delete_array = $this->model_divisiones->remove($value['ID']);
                if($delete_array==false)
                    $response['messages'] .= 'No se pudo eliminar la division con ID:'. $value['ID'];

            }

            if (($deleteEntrada && $deleteLote) == true) {
                $response['success'] = true;
                $response['messages'] = "Eliminado correctamente!!";
            } else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Refresh the page again!!";
        }

        echo json_encode($response);
    }
    public function createSerial()
    {
        if (!in_array('createProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $Serial=$_GET['serial'];
        $response = array();



        $data = array(
            'Serial' => $Serial,
        );

        $create = $this->model_lotes->createSerial($data);
        if($create == true) {
            $response['success'] = true;
            $response['messages'] = 'Lote creado';
            $response['loteID']=$create;
        }
        else {
            $response['success'] = false;
            $response['messages'] = 'Error!';
        }
//        }else {
//            $response['success'] = false;
//            foreach ($_POST as $key => $value) {
//                $response['messages'][$key] = form_error($key);
//            }
//        }

        echo json_encode($response);

    }


    public function removeBySerial()
    {
        if (!in_array('deleteProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $Serial=$_GET['serial'];

        $response = array();
        if ($Serial) {
            $delete = $this->model_lotes->removeBySerial($Serial);
            if ($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Eliminado correctamente!!";
            } else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Refresh the page again!!";
        }

        echo json_encode($response);
    }

    public function removeFromEntrada()
    {
        if (!in_array('deleteProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $id=$_GET['id'];

        $response = array();
        if ($id) {
            $delete = $this->model_lotes->remove($id);
            if ($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Eliminado correctamente!!";
            } else {
                $response['success'] = false;
                $response['messages'] = "Error in the database while removing the product information";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Refresh the page again!!";
        }

        echo json_encode($response);
    }

        ////PRUEBA CON PAGINADO Y FILTRADO
        public function fetchLotesDataFilteringPagination()
        {
            $result = array('data' => array());


            $search_field = $this->input->get('searchField'); // search field name
            $search_strings = $this->input->get('searchString'); // search string
            $page = $this->input->get('page'); //page number
            $limit = $this->input->get('rows'); // number of rows fetch per page
            $sidx = $this->input->get('sidx'); // field name which you want to sort
            $sord = $this->input->get('sord'); // field data which you want to soft
            if(!$sidx) { $sidx = 1; } // if its empty set to 1
            $count = $this->model_lotes->countTotal($search_field, $search_strings);
            $total_pages = 0;
            if($count > 0) { $total_pages = ceil($count/$limit); }
            if($page > $total_pages) { $page = $total_pages; }
            $start = ($limit * $page) - $limit;

            if($this->input->get('_search') && $this->input->get('filters')) {

                $search_strings = json_decode($this->input->get('filters')) ;
            }

            $lotedata=($this->model_lotes->getLoteDataFilterPagination($sidx, $sord, $start, $limit, $search_field, $search_strings));

    //        echo $lotedata;
    //        die();
            foreach ($lotedata as $key => $value) {
                $buttons = '';
    //            echo $x['ID'];
                if (in_array('deleteProduct', $this->permission)) {
                    $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value->ID . ',' . $value->Ent_ID . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
                }
                if (in_array('updateProduct', $this->permission)) {
                    $buttons .= ' <a type="button" class="btn btn-default" href= "edit?lote_serial='. $value->Serial .'&lote_id='. $value->ID .' "><i class="fa fa-pencil"></i></a>';
                }

                $value->Buttons=$buttons;
    //            echo  $value->Buttons;
            }



            $data = array('page'=>$page,
                'total'=>$total_pages,
                'records'=>$count,
                'rows'=>$lotedata,
            );


            echo json_encode($data);
        }


}


