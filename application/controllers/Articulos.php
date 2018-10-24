<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 30/08/2018
 * Time: 22:49
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Articulos extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'Articulos';

        $this->load->model('model_articulos');
        $this->load->model('model_familia');

    }

    /*
    * It only redirects to the manage product page and
    */
    public function index()
    {
        if(!in_array('viewBrand', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

//        $result = $this->model_articulos->getArticuloData();

//        $this->data['results'] = $result;
        $this->data['familia'] = $this->model_familia->getFamiliaData();

        $this->render_template('articulos/index', $this->data);
    }

    public function getArticulosData()
    {
        $result = array('data' => array());

        $data = $this->model_articulos->getArticuloData();
        $famdata = $this->model_familia->getFamiliaData();

        foreach ($data as $key => $value) {

            // button
            $buttons = '';

            if(in_array('viewBrand', $this->permission)) {
                $buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value['ID'].')" data-toggle="modal" data-target="#editArticuloModal"><i class="fa fa-pencil"></i></button>';
            }

            if(in_array('deleteBrand', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc('.$value['ID'].')" data-toggle="modal" data-target="#removeArticuloModal"><i class="fa fa-trash"></i></button>';
            }

            $status = ($value['Activo'] == 1) ? '<span class="label label-success">Activo</span>' : '<span class="label label-warning">Inactivo</span>';

            $nombreFamilia='';

            foreach($famdata as $famkey => $famvalue){
                if($famvalue['ID']==$value['Familia'])
                    $nombreFamilia = $famvalue['Nombre'];
            }

            $result['rows'][$key] = array(
                'ID'=>$value['ID'],
                'Serial'=>$value['Serial'],
                'Nombre'=>$value['Nombre'],
                'Descripcion'=>$value['Descripcion'],
                'Familia'=>$value['Familia'],
                'FamName'=>$nombreFamilia,
                'Activo'=>$status,
                'Buttons'=>$buttons

            );
        } // /foreach

        echo json_encode($result);
    }



    /*
    * It checks if it gets the brand id and retreives
    * the brand information from the brand model and
    * returns the data into json format.
    * This function is invoked from the view page.
    */
    public function getArticuloDataById($id)
    {
        if($id) {
            $data = $this->model_articulos->getArticuloData($id);
            echo json_encode($data);
        }

        return false;
    }

    public function fetchArticuloSerial(){

        $result = array();

        $data = $this->model_articulos->getArticuloData();

        foreach ($data as $key => $value) {
            $result['rows'][$key] = array('Serial'=>$value['Serial'], 'ID'=>$value['ID']);

        }

        echo json_encode($result);

    }

    /*
    * Its checks the brand form validation
    * and if the validation is successfully then it inserts the data into the database
    * and returns the json format operation messages
    */
    public function create()
    {

        if(!in_array('createBrand', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $response = array();

        $this->form_validation->set_rules('articulo_nombre', 'Nombre artículo', 'trim|required');
        $this->form_validation->set_rules('articulo_serial', 'Código artículo', 'trim|required');
        $this->form_validation->set_rules('articulo_descripcion', 'Descripción', 'trim');
        $this->form_validation->set_rules('articulo_familia', 'Familia', 'trim|required');
        $this->form_validation->set_rules('articulo_active', 'Activo', 'trim|required');

        $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'Nombre' => $this->input->post('articulo_nombre'),
                'Serial' => $this->input->post('articulo_serial'),
                'Descripcion' => $this->input->post('articulo_descripcion'),
                'Familia' => $this->input->post('articulo_familia'),
                'Activo' => $this->input->post('articulo_active'),
            );

            $create = $this->model_articulos->create($data);
            if($create == true) {
                $response['success'] = true;
                $response['messages'] = 'Artículo creado';
            }
            else {
                $response['success'] = false;
                $response['messages'] = 'Error!';
            }
        }
        else {
            $response['success'] = false;
            foreach ($_POST as $key => $value) {
                $response['messages'][$key] = form_error($key);
            }
        }

        echo json_encode($response);
    }

    /*
    * Its checks the brand form validation
    * and if the validation is successfully then it updates the data into the database
    * and returns the json format operation messages
    */
    public function update($id)
    {
        if(!in_array('updateBrand', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $response = array();

        if($id) {
            $this->form_validation->set_rules('edit_articulo_nombre', 'Nombre artículo', 'trim|required');
            $this->form_validation->set_rules('edit_articulo_serial', 'Código artículo', 'trim|required');
            $this->form_validation->set_rules('edit_articulo_descripcion', 'Descripción', 'trim');
            $this->form_validation->set_rules('edit_articulo_familia', 'Familia', 'trim|required');
            $this->form_validation->set_rules('edit_articulo_active', 'Activo', 'trim|required');

            $this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'Nombre' => $this->input->post('edit_articulo_nombre'),
                    'Serial' => $this->input->post('edit_articulo_serial'),
                    'Descripcion' => $this->input->post('edit_articulo_descripcion'),
                    'Familia' => $this->input->post('edit_articulo_familia'),
                    'Activo' => $this->input->post('edit_articulo_active'),
                );

                $update = $this->model_articulos->update($data, $id);
                if($update == true) {
                    $response['success'] = true;
                    $response['messages'] = 'Artículo actualizado';
                }
                else {
                    $response['success'] = false;
                    $response['messages'] = 'Error al actualizar';
                }
            }
            else {
                $response['success'] = false;
                foreach ($_POST as $key => $value) {
                    $response['messages'][$key] = form_error($key);
                }
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Recargue la página!!";
        }

        echo json_encode($response);
    }

    /*
    * It removes the brand information from the database
    * and returns the json format operation messages
    */
    public function remove()
    {
        if(!in_array('deleteBrand', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $articulo_id = $this->input->post('articulo_id');
        $response = array();
        if($articulo_id) {
            $delete = $this->model_articulos->remove($articulo_id);

            if($delete == true) {
                $response['success'] = true;
                $response['messages'] = "Artículo eliminado";
            }
            else {
                $response['success'] = false;
                $response['messages'] = "Error al eliminar";
            }
        }
        else {
            $response['success'] = false;
            $response['messages'] = "Recargue la página!!";
        }

        echo json_encode($response);
    }

    /*FAMILIA*/
    public function getFamiliaData()
    {
        echo json_encode($this->model_familia->getFamiliaData());
    }

    /*************ARTICULOS CON PAGINADO Y FILTRADO******************/
    ////PRUEBA CON PAGINADO Y FILTRADO
    public function fetchArticulosDataFilteringPagination()
    {
        $result = array('data' => array());


        $search_field = $this->input->get('searchField'); // search field name
        $search_string = $this->input->get('searchString'); // search string
        $page = $this->input->get('page'); //page number
        $limit = $this->input->get('rows'); // number of rows fetch per page
        $sidx = $this->input->get('sidx'); // field name which you want to sort
        $sord = $this->input->get('sord'); // field data which you want to soft
        if(!$sidx) { $sidx = 1; } // if its empty set to 1
        $count = $this->model_articulos->countTotal($search_field, $search_string);
        $total_pages = 0;
        if($count > 0) { $total_pages = ceil($count/$limit); }
        if($page > $total_pages) { $page = $total_pages; }
        $start = ($limit * $page) - $limit;

        $articulodata=($this->model_articulos->getArticuloDataFilterPagination($sidx, $sord, $start, $limit, $search_field, $search_string));
//        $famdata = $this->model_familia->getFamiliaData();


        foreach ($articulodata as $key => $value) {
            $buttons = '';
            $nombreFamilia='';
//            echo $x['ID'];
            if (in_array('deleteProduct', $this->permission)) {
                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value->ID . ')" data-toggle="modal" data-target="#removeArticuloModal"><i class="fa fa-trash"></i></button>';
            }
            if (in_array('updateProduct', $this->permission)) {
                $buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value->ID.')" data-toggle="modal" data-target="#editArticuloModal"><i class="fa fa-pencil"></i></button>';
            }
            $value->Buttons=$buttons;

            $status = ($value->Activo == 1) ? '<span class="label label-success" >Activo</span>' : '<span class="label label-warning" >Inactivo</span>';
            $value -> Activo =$status;

//                foreach($famdata as $famkey => $famvalue){
//                    if($famvalue['ID']==$value->Familia)
//                        $nombreFamilia = $famvalue['Nombre'];
//                }

//            $value->Familia = $nombreFamilia;
        }

        $data = array('page'=>$page,
            'total'=>$total_pages,
            'records'=>$count,
            'rows'=>$articulodata,
        );

        echo json_encode($data);
    }


}