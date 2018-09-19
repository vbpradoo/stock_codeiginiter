<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Entradas extends Admin_Controller
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
        $this->load->model('model_proovedores');
        $this->load->model('model_almacenes');

//        $this->data['lotes'] = $this->model_lotes->getLoteData();;
        $this->data['proovedor'] = $this->model_proovedores->getProovedorData();
        $this->data['almacenes'] = $this->model_almacenes->getAlmacenesData();
        $this->data['articulos'] = $this->model_articulos->getArticuloData();
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

    public function getEntradasData()
    {
        $result = array('data' => array());

        $data = $this->model_entradas->getEntradasData();

        foreach ($data as $key => $value) {

            // button
            $buttons = '';

            if (in_array('updateStore', $this->permission)) {
                $buttons = '<button type="button" class="btn btn-default" onclick="editFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
            }

            if (in_array('deleteStore', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

            $status = ($value['Pagado'] == 1) ? '<span class="label label-success">Pagado</span>' : '<span class="label label-warning">Sin pagar</span>';

            $result['rows'][$key] = array(
                'ID' => $value['ID'],
                'Proovedor' => $value['Proovedor'],
                'Fecha' => $value['Fecha'],
                'Cantidad' => $value['Cantidad'],
                'Descripcion' => $value['Descripcion'],
                'Pagado' => $status,
                'Buttons' => $buttons
            );
        } // /foreach

        echo json_encode($result);
    }

    public function getEntradasDataById($id)
    {
        if ($id) {
            $data = $this->model_entradas->getEntradasData($id);
            echo json_encode($data);
        }
    }

//
//    public function fetchLotesData()
//    {
//        $result = array('data' => array());
//
//        $data = $this->model_lotes->getLoteData();
//
//        foreach ($data as $key => $value) {
//
//            $store_data = $this->model_alamacenes->getAlmacenesData($value['Almacen']);
//            // button
//            $buttons = '';
//            if (in_array('updateProduct', $this->permission)) {
//                $buttons .= '<a href="' . base_url('entradas/update/' . $value['ID']) . '" class="btn btn-default"><i class="fa fa-pencil"></i></a>';
//            }
//
//            if (in_array('deleteProduct', $this->permission)) {
//                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
//            }
//
//
////            $img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';
//
////            $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
//
//            $qty_status = '';
//            if ($value['Stock'] <= 10) {
//                $qty_status = '<span class="label label-warning">Low !</span>';
//            } else if ($value['Stock'] <= 0) {
//                $qty_status = '<span class="label label-danger">Out of stock !</span>';
//            }
//
//
//            $result['data'][$key] = array(
//                $value['ID'],
//                $value['Serial'],
//                $value['Descripcion'],
//                $value['Stock'] . ' ' . $qty_status,
//                $store_data['Nombre'],
////                $availability,
//                $buttons
//            );
//        } // /foreach
//
//        echo json_encode($result);
//    }

    public function getLoteByName()
    {
        $name = $_GET['serial'];
        //echo $name;
        $result = array('data' => array());

        $data = $this->model_lotes->getMyLoteByName($name);
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

        echo json_encode($data);
    }

//    public function getDivisionData()
//    {
//
//        // echo "ENTRA";
//        $result = array('data' => array());
//
//        $data = $this->model_divisiones->getDivisionData();
//
//        foreach ($data as $key => $value) {
//
//            // button
//            if (in_array('updateProduct', $this->permission)) {
//                $buttons = '<button type="button" class="btn btn-default" onclick="editFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
//            }
//
//            if (in_array('deleteProduct', $this->permission)) {
//                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
//            }
//
//
////            $img = '<img src="'.base_url($value['image']).'" alt="'.$value['name'].'" class="img-circle" width="50" height="50" />';
//
////            $availability = ($value['availability'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';
//
//            $qty_status = '';
//            if ($value['Piezas'] <= 5) {
//                $qty_status = '<span class="label label-warning">Pocas !</span>';
//            } else if ($value['Piezas'] <= 0) {
//                $qty_status = '<span class="label label-danger">Fuera de Stock !</span>';
//            }
//
//
//            $result['data'][$key] = array(
//                'ID'=>$value['ID'],
//                $value['Piezas'] . ' ' . $qty_status,
//                $value['Ancho'],
//                $value['Alto'],
//                $value['Largo'],
//                $buttons
//            );
//        } // /foreach
//
//        echo json_encode($result);
//    }


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
        $response = array();

        $this->form_validation->set_rules('proovedor', 'Proovedor', 'trim|required');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|required');
        $this->form_validation->set_rules('pagado', 'Pagado', 'trim|required');


        if ($this->form_validation->run() == TRUE) {
            // true case
//            $upload_image = $this->upload_image();

            $data = array(
                'Proovedor' => $this->input->post('proovedor'),
                'Cantidad' => $this->input->post('cantidad'),
                'Pagado' => $this->input->post('pagado'),
            );

            $create = $this->model_entradas->create($data);
            if ($create == true) {
                $response['success'] = true;
                $response['messages'] = 'Entrada creada';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Error!';
            }

            echo json_encode($response);

        }
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


        $response = array();

        if ($entrada_id) {

            $this->form_validation->set_rules('edit_proovedor', 'Proovedor', 'trim|required');
            $this->form_validation->set_rules('edit_fecha', 'Fecha', 'trim|required');
            $this->form_validation->set_rules('edit_cantidad', 'Cantidad', 'trim|required');
            $this->form_validation->set_rules('edit_descripcion', 'Descripcion', 'trim|required');
            $this->form_validation->set_rules('edit_active', 'Estado', 'trim|required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

//        echo "HOLA";

            if ($this->form_validation->run() == TRUE) {
                // true case
//                echo "ENTRA2";

                $data = array(
                    'Proovedor' => $this->input->post('edit_proovedor'),
                    'Fecha' => $this->input->post('edit_fecha'),
                    'Cantidad' => $this->input->post('edit_cantidad'),
                    'Pagado' => $this->input->post('edit_active'),
                    'Descripcion' => $this->input->post('edit_descripcion'),
                );


                $update = $this->model_entradas->update($data, $entrada_id);

                if ($update == true) {
//                    echo "ENTRA";
                    $response['success'] = true;
                    $response['messages'] = 'Entrada actualizada';
                } else {
                    $response['success'] = false;
                    $response['messages'] = 'Error al actualizar';
                }
            } else {
//                echo "PASA  ";
                $response['success'] = false;
                foreach ($_POST as $key => $value) {
                    $response['messages'][$key] = form_error($key);
                }
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Recargue la página!!";
        }
        echo json_encode($response);

    }




//    public function update($entrada_id)
//    {
//        if (!in_array('updateProduct', $this->permission)) {
//            redirect('dashboard', 'refresh');
//        }
//
//        if (!$entrada_id) {
//            redirect('dashboard', 'refresh');
//        }
//
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
//
//        if ($this->form_validation->run() == TRUE) {
//            // true case
//
//            $data = array(
//                'Serial' => $this->input->post('lote_serial'),
//                'Articulo' => $this->input->post('articulo'),
//                'Entrada' => $this->input->post('entrada'),
//                'Coste' => $this->input->post('coste'),
//                'Cantidad' => $this->input->post('cantidad'),
//                'Unidades' => $this->input->post('unidades'),
//                'Stock' => $this->input->post('stock'),
//                'Division' => $this->input->post('division'),
//                'Descripcion' => $this->input->post('descripcion'),
//                'Almacen' => $this->input->post('store')
//            );
//
//
////            if($_FILES['product_image']['size'] > 0) {
////                $upload_image = $this->upload_image();
////                $upload_image = array('image' => $upload_image);
////
////                $this->model_products->update($upload_image, $entrada_id);
////            }
//
//            $update = $this->model_entradas->update($data, $entrada_id);
//            if ($update == true) {
//                $this->session->set_flashdata('success', 'Se ha creado correctamente!');
//                redirect('entradas/', 'refresh');
//            } else {
//                $this->session->set_flashdata('errors', 'Ha ocurrido un error!!');
//                redirect('entradas/update', 'refresh');
//            }
//        } else {
//            // attributes
////            $attribute_data = $this->model_attributes->getActiveAttributeData();
////
////            $attributes_final_data = array();
////            foreach ($attribute_data as $k => $v) {
////                $attributes_final_data[$k]['attribute_data'] = $v;
////
////                $value = $this->model_attributes->getAttributeValueData($v['id']);
////
////                $attributes_final_data[$k]['attribute_value'] = $value;
////            }
////
////            // false case
////            $this->data['attributes'] = $attributes_final_data;
////            $this->data['brands'] = $this->model_brands->getActiveBrands();
////            $this->data['category'] = $this->model_category->getActiveCategroy();
////            $this->data['stores'] = $this->model_stores->getActiveStore();
////
////            $product_data = $this->model_products->getProductData($entrada_id);
////            $this->data['product_data'] = $product_data;
////            $this->render_template('products/edit', $this->data);
//        }
//    }

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
                $response['messages'] = "Error al eliminar";
            }
        } else {
            $response['success'] = false;
            $response['messages'] = "Recargue la página!!";
        }

        echo json_encode($response);
    }

}