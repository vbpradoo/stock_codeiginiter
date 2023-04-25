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

        $this->render_template('entradas/index', $this->data);
    }

    public function createEntrada()
    {
        // echo "PUTO";
        if (!in_array('viewProduct', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $this->render_template('entradas/create_new', $this->data);
    }

//    public function anexoLote()
//    {
//        // echo "PUTO";
//        if (!in_array('updateProduct', $this->permission)) {
//            redirect('dashboard', 'refresh');
//        }
////        $id =  ;
////        echo $this->uri->segment(4);
////        $this->data['lote_id'] = $this->model_lotes->getMyLoteByName($this->uri->segment(4));
//        $this->data['lote_id'] = $_GET['id'];
//        $this->render_template('entradas/anexo_lote', $this->data);
//
////        die();
////        $this->render_template('entradas/anexo_lote', $this->data);
////        $this->render_template('entradas/anexo_lote', $this->data);
//
//    }

    /*
    * It Fetches the products data from the product tabled
    * this function is called from the datatable ajax function
    */

    public function getEntradasData(){

        $result = array('data' => array());

        $data = $this->model_entradas->getEntradasData();
        $proodata = $this->model_proovedores->getProovedorData();
        $lotedata = $this->model_lotes->getLoteData();

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

            foreach($proodata as $proo => $proovalue){
                if($proovalue['ID']==$value['Proovedor'])
                    $proovedor = $proovalue['Nombre'];
            }

            foreach($lotedata as $lotee => $lotevalue){
                if($lotevalue['Entrada']==$value['ID']) {
                    $lote = $lotevalue['Serial'];
                    $cantidad = $lotevalue['Cantidad'];
                }
            }

            $result['rows'][$key] = array(
                'ID' => $value['ID'],
                'Lote' => $lote,
                'Proovedor' => $proovedor,
                'Fecha' => $value['Fecha'],
                'Cantidad' => $cantidad,
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

    public function getEntradasDataByIdURL()
    {

        $data = $this->model_entradas->getEntradasData($_GET['id']);
        echo json_encode($data);

    }

    public function getLoteByName()
    {
        $name = $_GET['serial'];
        //echo $name;
        $result = array('data' => array());

        $data = $this->model_lotes->getMyLoteByName($name);

        echo json_encode($data);
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
        $response = array();

        $this->form_validation->set_rules('Proovedor', 'Proovedor', 'trim|required');
        $this->form_validation->set_rules('Cantidad', 'Cantidad', 'trim|required');
//        $this->form_validation->set_rules('Pagado', 'Pagado', 'trim');

        if ($this->form_validation->run() == TRUE) {


            $data = array(
                'Proovedor' => $this->input->post('Proovedor'),
                'Cantidad' => $this->input->post('Cantidad'),
//                'Pagado' => $this->input->post('pagado'),
            );

            $create = $this->model_entradas->create($data);

            if ($create) {
//                echo $create;
                $response['success'] = $create;
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
//        echo json_encode($_POST);
//        $entrada_id = $_GET['id'];
//        $edit_fecha = $_GET['edit_fecha'];
        $response = array();
//        echo $edit_fecha;

        if ($entrada_id) {

//            $this->form_validation->set_rules('edit_proovedor', 'Proovedor', 'trim|required');
            $this->form_validation->set_rules('edit_fecha', 'Fecha', 'trim|required');
//            $this->form_validation->set_rules('edit_cantidad', 'Cantidad', 'trim|required');
//            $this->form_validation->set_rules('edit_descripcion', 'Descripcion', 'trim');
//            $this->form_validation->set_rules('edit_active', 'Estado', 'trim|required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');


            if ($this->form_validation->run() == TRUE) {
                // true case
//                echo "ENTRA2";

                $data = array(
//                    'Proovedor' => $this->input->post('edit_proovedor'),
                    'Fecha' => $this->input->post('edit_fecha'),
//                    'Cantidad' => $this->input->post('edit_cantidad'),
                   // 'Pagado' => $this->input->post('edit_active'),
//                    'Descripcion' => $this->input->post('edit_descripcion'),
                );
//                echo json_encode($data);

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

//        echo "EOHHHH".$entrada_id;
//        die();
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

    /*************ENTRADAS CON PAGINADO Y FILTRADO******************/
    ////PRUEBA CON PAGINADO Y FILTRADO
    public function fetchEntradasDataFilteringPagination()
    {
        $result = array('data' => array());


        $search_field = $this->input->get('searchField'); // search field name
        $search_strings = $this->input->get('searchString'); // search string
        $page = $this->input->get('page'); //page number
        $limit = $this->input->get('rows'); // number of rows fetch per page
        $sidx = $this->input->get('sidx'); // field name which you want to sort
        $sord = $this->input->get('sord'); // field data which you want to soft
        if(!$sidx) { $sidx = 1; } // if its empty set to 1
        if ($this->input->get('_search') && $this->input->get('filters')) {

            $search_strings = json_decode($this->input->get('filters'));
        }
        $count = $this->model_entradas->countTotal($search_field, $search_strings);
        $total_pages = 0;
        if($count > 0) { $total_pages = ceil($count/$limit); }
        if($page > $total_pages) { $page = $total_pages; }
        $start = ($limit * $page) - $limit;

        $entradasdata=($this->model_entradas->getEntradasDataFilterPagination($sidx, $sord, $start, $limit, $search_field, $search_strings));
//        $famdata = $this->model_familia->getFamiliaData();


        foreach ($entradasdata as $key => $value) {
            $buttons = '';

//            if (in_array('deleteProduct', $this->permission)) {
//                $buttons .= ' <button type="button" class="btn btn-default" onclick="removeFunc(' . $value->ID . ')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
//            }
            if (in_array('updateProduct', $this->permission)) {
                $buttons .= '<button type="button" class="btn btn-default" onclick="editFunc('.$value->ID.')" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil"></i></button>';
            }
            if (in_array('viewProduct', $this->permission) && isset($value->Anexo) && $value->Anexo != '') {
                $path = array();
                $path['absolute']=substr($value->Anexo,2);
                $path['relative'] = explode("/",$path['absolute'])[3];
                $buttons .= '<a type="button" id="'.$path['absolute'].'" class="btn btn-default" onclick="viewAnexo(this)" data-toggle="modal" data-target="#anexoModal" ><i class="fa fa-eye"></i></a>';
            }
//            var_dump($value->Anexo);
//            die();
            $value->Buttons=$buttons;

//            $status = ($value->Pagado == 1) ? '<span class="label label-success" >Pagado</span>' : '<span class="label label-warning" >Sin pagar</span>';
//            $value -> Pagado =$status;

//                foreach($famdata as $famkey => $famvalue){
//                    if($famvalue['ID']==$value->Familia)
//                        $nombreFamilia = $famvalue['Nombre'];
//                }

//            $value->Familia = $nombreFamilia;
        }

        $data = array('page'=>$page,
            'total'=>$total_pages,
            'records'=>$count,
            'rows'=>$entradasdata,
        );

        echo json_encode($data);
    }


}