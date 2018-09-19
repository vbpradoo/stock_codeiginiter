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

        $this->data['lotes'] = $this->model_lotes->getLoteData();;

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

        $this->render_template('entradas/create', $this->data);
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
            // button
            $buttons = '';
            if (in_array('updateProduct', $this->permission)) {
                $buttons .= '<a href="' . base_url('entradas/update/' . $value['ID']) . '" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
            }

            if (in_array('deleteProduct', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }


//            $img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';

//            $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

            $qty_status = '';
            if ($value['Stock'] <= 10) {
                $qty_status = '<span class="label label-warning">Low !</span>';
            } else if ($value['Stock'] <= 0) {
                $qty_status = '<span class="label label-danger">Out of stock !</span>';
            }


            $result['data'][$key] = array(
                $value['ID'],
                $value['Serial'],
                $value['Descripcion'],
                $value['Stock'] . ' ' . $qty_status,
                $store_data['Nombre'],
//                $availability,
                $buttons
            );
        } // /foreach

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
                'Ancho' => $value['Ancho'],
                'Alto' => $value['Alto'],
                'Largo' => $value['Largo'],
                'Buttons' => $buttons
            );
        } // /foreach11
        echo json_encode($result);
    }

    public function getDivisionDataByLote(){

        $result = array('data' => array());

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
                'Ancho' => $value['Ancho'],
                'Alto' => $value['Alto'],
                'Largo' => $value['Largo'],
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

    public function createDivision($Lote)
    {

        //echo "ENTRA";
        if (!in_array('createProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('create_piezas', 'Piezas', 'trim|required');
        $this->form_validation->set_rules('create_ancho', 'Ancho', 'trim|required');
        $this->form_validation->set_rules('create_alto', 'Alto', 'trim|required');
        $this->form_validation->set_rules('create_largo', 'Largo', 'trim|required');
//        $this->form_validation->set_rules('create_lote', 'Largo', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

//        $lote = json_decode($this->getDivLoteDataById($Lote));
//
//        echo $Lote;
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'Piezas' => $this->input->post('create_piezas'),
                'Ancho' => $this->input->post('create_ancho'),
                'Alto' => $this->input->post('create_alto'),
                'Largo' => $this->input->post('create_largo'),
                'Lote'  => $Lote,
            );

            $create = $this->model_divisiones->create($data);


            if ($create == true) {
                $response['success'] = true;
                $response['messages'] = 'Entrada creada';

//                $response['division'] = $result;

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

        $this->form_validation->set_rules('edit_piezas', 'Piezas', 'trim|required');
        $this->form_validation->set_rules('edit_alto', 'Alto', 'trim|required');
        $this->form_validation->set_rules('edit_ancho', 'Ancho', 'trim|required');
        $this->form_validation->set_rules('edit_largo', 'Largo', 'trim|required');


        if ($this->form_validation->run() == TRUE) {
            // true case

            $data = array(

                'Piezas' => $this->input->post('edit_piezas'),
                'Ancho' => $this->input->post('edit_ancho'),
                'Alto' => $this->input->post('edit_alto'),
                'Largo' => $this->input->post('edit_largo'),

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

//        $this->form_validation->set_rules('lote_serial', 'Lote Serial', 'trim|required');
//        $this->form_validation->set_rules('articulo', 'Artículo', 'trim|required');
//        $this->form_validation->set_rules('entrada', 'Entrada', 'trim|required');
//        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required');
//        $this->form_validation->set_rules('precio', 'Precio', 'trim|required');
//        $this->form_validation->set_rules('unidades', 'Unidades', 'trim|required');
//        $this->form_validation->set_rules('division', 'Division', 'trim|required');
//        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required');
//        $this->form_validation->set_rules('almacen', 'Almacen', 'trim|required');
//        $this->form_validation->set_rules('coste', 'Coste', 'trim|required');
//        $this->form_validation->set_rules('stock', 'Stock', 'trim|required');




            $data = array(
                'Serial' => $Serial,
//                'Articulo' => $this->input->post('articulo'),
//                'Entrada' => $this->input->post('entrada'),
//                'Coste' => $this->input->post('coste'),
//                'Cantidad' => $this->input->post('cantidad'),
//                'Unidades' => $this->input->post('unidades'),
//                'Stock' => $this->input->post('stock'),
//                'Division' => $this->input->post('division'),
//                'Descripcion' => $this->input->post('descripcion'),
//                'Almacen' => $this->input->post('store')
            );

            $create = $this->model_lotes->create($data);
            if($create == true) {
                $response['success'] = true;
                $response['messages'] = 'Lote creado';
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

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
//    public function upload_image()
//    {
//        // assets/images/product_image
//        $config['upload_path'] = 'assets/images/product_image';
//        $config['file_name'] =  uniqid();
//        $config['allowed_types'] = 'gif|jpg|png';
//        $config['max_size'] = '1000';
//
//        // $config['max_width']  = '1024';s
//        // $config['max_height']  = '768';
//
//        $this->load->library('upload', $config);
//        if ( ! $this->upload->do_upload('product_image'))
//        {
//            $error = $this->upload->display_errors();
//            return $error;
//        }
//        else
//        {
//            $data = array('upload_data' => $this->upload->data());
//            $type = explode('.', $_FILES['product_image']['name']);
//            $type = $type[count($type) - 1];
//
//            $path = $config['upload_path'].'/'.$config['file_name'].'.'.$type;
//            return ($data == true) ? $path : false;
//        }
//    }

    /*
    * If the validation is not valid, then it redirects to the edit product page
    * If the validation is successfully then it updates the data into the database
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
    public function update($entrada_id)
    {
        if (!in_array('updateProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        if (!$entrada_id) {
            redirect('dashboard', 'refresh');
        }

        $this->form_validation->set_rules('lote_serial', 'Lote Serial', 'trim|required');
        $this->form_validation->set_rules('articulo', 'Artículo', 'trim|required');
        $this->form_validation->set_rules('entrada', 'Entrada', 'trim|required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'trim|required');
        $this->form_validation->set_rules('precio', 'Precio', 'trim|required');
        $this->form_validation->set_rules('unidades', 'Unidades', 'trim|required');
        $this->form_validation->set_rules('division', 'Division', 'trim|required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required');
        $this->form_validation->set_rules('almacen', 'Almacen', 'trim|required');
        $this->form_validation->set_rules('coste', 'Coste', 'trim|required');
        $this->form_validation->set_rules('stock', 'Stock', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case

            $data = array(
                'Serial' => $this->input->post('lote_serial'),
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


//            if($_FILES['product_image']['size'] > 0) {
//                $upload_image = $this->upload_image();
//                $upload_image = array('image' => $upload_image);
//
//                $this->model_products->update($upload_image, $entrada_id);
//            }

            $update = $this->model_entradas->update($data, $entrada_id);
            if ($update == true) {
                $this->session->set_flashdata('success', 'Se ha creado correctamente!');
                redirect('entradas/', 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Ha ocurrido un error!!');
                redirect('entradas/update', 'refresh');
            }
        } else {
            // attributes
//            $attribute_data = $this->model_attributes->getActiveAttributeData();
//
//            $attributes_final_data = array();
//            foreach ($attribute_data as $k => $v) {
//                $attributes_final_data[$k]['attribute_data'] = $v;
//
//                $value = $this->model_attributes->getAttributeValueData($v['id']);
//
//                $attributes_final_data[$k]['attribute_value'] = $value;
//            }
//
//            // false case
//            $this->data['attributes'] = $attributes_final_data;
//            $this->data['brands'] = $this->model_brands->getActiveBrands();
//            $this->data['category'] = $this->model_category->getActiveCategroy();
//            $this->data['stores'] = $this->model_stores->getActiveStore();
//
//            $product_data = $this->model_products->getProductData($entrada_id);
//            $this->data['product_data'] = $product_data;
//            $this->render_template('products/edit', $this->data);
        }
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

        $entrada_id = $this->input->post('entrada_id');

        $response = array();
        if ($entrada_id) {
            $delete = $this->model_entradas->remove($entrada_id);
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

}