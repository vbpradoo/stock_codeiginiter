<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Proovedores';

        $this->load->model('model_clientes');

    }

    /*
    * It only redirects to the manage product page
    */
    public function index()
    {
        if (!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->render_template('clientes/index', $this->data);
    }

    /*
    * It Fetches the products data from the product table
    * this function is called from the datatable ajax function
    */
    public function getClienteData()
    {
//        echo "MAN";
        $result = array('data' => array());

        $data = $this->model_clientes->getClienteData();

        foreach ($data as $key => $value) {

            // button
            $buttons = '';
            if (in_array('updateProduct', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default fa fa-pencil" onclick="editFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#editModal"></button>';

            }

            if (in_array('deleteProduct', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default fa fa-trash " onclick="removeFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#removeModal"></button>';
            }


            $img = '<img src="' . base_url($value['image']) . '" alt="' . $value['Nombre'] . '" class="img-circle" width="50" height="50" />';


            $result['rows'][$key] = array(
                'ID' => $value['ID'],
                'image' => $img,
                'Nombre' => $value['Nombre'],
                'Correo' => $value['Correo'],
                'Telefono' => $value['Telefono'],
                'Empresa' => $value['Empresa'],
                'Cantidad' => $value['Cantidad'],
                'Gastado' => $value['Gastado'],
                'Buttons' => $buttons
            );
        } // /foreach

        echo json_encode($result);
    }

    public function getClienteDataById($id)
    {
        if ($id) {
            $data = $this->model_clientes->getClienteData($id);
            echo json_encode($data);
        }
    }

    /*
    * If the validation is not valid, then it redirects to the create page.
    * If the validation for each input field is valid then it inserts the data into the database
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
    public function create()
    {
        if (!in_array('createProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $response = array();

        $this->form_validation->set_rules('cliente_nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('cliente_empresa', 'Empresa', 'trim|required');
        $this->form_validation->set_rules('cliente_telefono', 'Telefono', 'trim|required');
        $this->form_validation->set_rules('cliente_correo', 'Correo', 'trim|required');
        $this->form_validation->set_rules('cliente_cantidad', 'Cantidad', 'trim|required');
        $this->form_validation->set_rules('cliente_gastado', 'Gastado', 'trim|required');


        if ($this->form_validation->run() == TRUE) {
            // true case
//            echo "AKI";

            $upload_image = $this->upload_image();
            if($upload_image == false || $upload_image=='<p>You did not select a file to upload.</p>') {
                $upload_image = 'assets/images/user.png';   //DEFAULT PIC
            }
//            echo $upload_image;
            $data = array(
                'Nombre' => $this->input->post('cliente_nombre'),
                'Empresa' => $this->input->post('cliente_empresa'),
                'Telefono' => $this->input->post('cliente_telefono'),
                'Correo' => $this->input->post('cliente_correo'),
                'image' => $upload_image,
                'Cantidad' => $this->input->post('cliente_cantidad'),
                'Gastado' => $this->input->post('cliente_gastado')

            );

            $create = $this->model_clientes->create($data);

            if ($create == true) {
                $response['success'] = true;
                $response['messages'] = 'Cliente creado';
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

    /*
    * This function is invoked from another function to upload the image into the assets folder
    * and returns the image path
    */
    public function upload_image()
    {
        // assets/images/product_image
        $config['upload_path'] = 'assets/images/cliente_image';
        $config['file_name'] = uniqid();
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';

        // $config['max_width']  = '1024';s
        // $config['max_height']  = '768';

        $this->load->library('upload', $config);
//        echo(json_encode(! $this->upload->do_upload('proovedor_image')));
//        die();


        if (! $this->upload->do_upload('cliente_image')) {
            $error = $this->upload->display_errors();
            return $error;
        } else {
            $data = array('upload_data' => $this->upload->data());
            $type = explode('.', $_FILES['cliente_image']['name']);
            $type = $type[count($type) - 1];

            $path = $config['upload_path'] . '/' . $config['file_name'] . '.' . $type;
            return ($data == true) ? $path : false;
        }

    }

    /*
    * If the validation is not valid, then it redirects to the edit product page
    * If the validation is successfully then it updates the data into the database
    * and it stores the operation message into the session flashdata and display on the manage product page
    */
    public function update($id)
    {
        if (!in_array('updateProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $response = array();

        if ($id) {


            $this->form_validation->set_rules('edit_cliente_nombre', 'Nombre Proovedor', 'trim|required');
            $this->form_validation->set_rules('edit_cliente_empresa', 'Empresa', 'trim|required');
            $this->form_validation->set_rules('edit_cliente_telefono', 'Telefono', 'trim|required');
            $this->form_validation->set_rules('edit_cliente_correo', 'Correo', 'trim|required');
            $this->form_validation->set_rules('edit_cliente_cantidad', 'Cantidad', 'trim|required');
            $this->form_validation->set_rules('edit_cliente_gastado', 'Gastado', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                // true case

                $data = array(
                    'Nombre' => $this->input->post('edit_cliente_nombre'),
                    'Empresa' => $this->input->post('edit_cliente_empresa'),
                    'Telefono' => $this->input->post('edit_cliente_telefono'),
                    'Correo' => $this->input->post('edit_cliente_correo'),
                    'Cantidad' => $this->input->post('edit_cliente_cantidad'),
                    'Gastado' => $this->input->post('edit_cliente_gastado'),
                );


//                if ($_FILES['cliente_image']['size'] > 0) {
//                    $upload_image = $this->upload_image();
//                    $upload_image = array('image' => $upload_image);
//
//                    $this->model_clientes->update($upload_image, $id);
//                    echo "IN";
//                }

                $update = $this->model_clientes->update($data, $id);

                if ($update == true) {
                    $response['success'] = true;
                    $response['messages'] = 'Se ha actualizado correctamente!';
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
        } else {
            $response['success'] = false;
            $response['messages'] = "Recargue la página!!";
        }

        echo json_encode($response);

    }

    /*
    * It removes the data from the database
    * and it returns the response into the json format
    */
    public
    function remove()
    {
        if (!in_array('deleteProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $id = $this->input->post('cliente_id');

        $response = array();
        if ($id) {
            $delete = $this->model_clientes->remove($id);
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