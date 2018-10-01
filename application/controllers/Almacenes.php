<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 30/08/2018
 * Time: 19:45
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Almacenes extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Almacenes';

        $this->load->model('model_almacenes');
    }

    /*
    * It only redirects to the manage stores page
    */
    public function index()
    {
        if (!in_array('viewStore', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->render_template('almacenes/index', $this->data);
    }

    /*
    * It retrieve the specific store information via a store id
    * and returns the data in json format.
    */
    public function getAlmacenesDataById($id)
    {
        if ($id) {
            $data = $this->model_almacenes->getAlmacenesData($id);
            echo json_encode($data);
        }
    }

    /*
    * It retrieves all the store data from the database
    * This function is called from the datatable ajax function
    * The data is return based on the json format.
    */
    public function getAlmacenesData()
    {
        $result = array('data' => array());

        $data = $this->model_almacenes->getAlmacenesData();

        foreach ($data as $key => $value) {

            // button
            $buttons = '';

            if (in_array('updateStore', $this->permission)) {
                $buttons = '<button type="button" class="btn btn-default" onclick="editFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
            }

            if (in_array('deleteStore', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value['ID'] . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }

            $status = ($value['Activo'] == 1) ? '<span class="label label-success">Activo</span>' : '<span class="label label-warning">Inactivo</span>';

            $result['rows'][$key] = array(
                'ID'=>$value['ID'],
                'Nombre'=>$value['Nombre'],
                'Localizacion'=>$value['Localizacion'],
                'Activo'=>$status,
                'Buttons'=>$buttons
            );
        } // /foreach

        echo json_encode($result);
    }

    /*
    * If the validation is not valid, then it provides the validation error on the json format
    * If the validation for each input is valid then it inserts the data into the database and
    returns the appropriate message in the json format.
    */
    public function create()
    {
        if (!in_array('createStore', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $response = array();

        $this->form_validation->set_rules('store_name', 'Store name', 'trim|required');
        $this->form_validation->set_rules('store_location', 'Store location', 'trim|required');
        $this->form_validation->set_rules('active', 'Active', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'Nombre' => $this->input->post('store_name'),
                'Localizacion' => $this->input->post('store_location'),
                'Activo' => $this->input->post('active'),
            );

            $create = $this->model_almacenes->create($data);
            if ($create == true) {
                $response['success'] = true;
                $response['messages'] = 'Almacén creado';
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
    * If the validation is not valid, then it provides the validation error on the json format
    * If the validation for each input is valid then it updates the data into the database and
    returns a n appropriate message in the json format.
    */
    public function update($id)
    {
        if (!in_array('updateStore', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $response = array();

        if ($id) {
            $this->form_validation->set_rules('edit_store_name', 'Store name', 'trim|required');
            $this->form_validation->set_rules('edit_store_location', 'Store location', 'trim|required');
            $this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'Nombre' => $this->input->post('edit_store_name'),
                    'Localizacion' => $this->input->post('edit_store_location'),
                    'Activo' => $this->input->post('edit_active'),
                );

                $update = $this->model_almacenes->update($data, $id);
                if ($update == true) {
                    $response['success'] = true;
                    $response['messages'] = 'Almacén actualizado';
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
    * If checks if the store id is provided on the function, if not then an appropriate message
    is return on the json format
    * If the validation is valid then it removes the data into the database and returns an appropriate
    message in the json format.
    */
    public function remove()
    {
        if (!in_array('deleteStore', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $store_id = $this->input->post('store_id');

        $response = array();
        if ($store_id) {
            $delete = $this->model_almacenes->remove($store_id);
            if ($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Almacén eliminado";
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

