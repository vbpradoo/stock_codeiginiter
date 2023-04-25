<?php

class Model_salidas extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /* get the orders data */
    public function getSalidasData($id = null,$edit=null)
    {
        if($id) {
            if($edit)
                $sql = "SELECT ID,AlbaranID,Fecha FROM salida WHERE ID = ?";
            else
                $sql = "SELECT * FROM salida WHERE ID = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM salida ORDER BY ID DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // get the orders item data
//    public function getOrdersItemData($order_id = null)
//    {
//        if(!$order_id) {
//            return false;
//        }
//
//        $sql = "SELECT * FROM orders_item WHERE order_id = ?";
//        $query = $this->db->query($sql, array($order_id));
//        return $query->result_array();
//    }

    public function create()
    {

        $sal_info=array('checkSold'=>array());
        $sal_id=0;
        $user_id = $this->session->userdata('id');
        $bill_no = 'ALB-'.strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));

        $count_lotes = count($this->input->post('lote'));
        $ventas = array();
        for($x = 0; $x < $count_lotes; $x++) {
            $venta = array(
                'Lote_ID' => $this->input->post('lote')[$x],
                'Articulo_ID' => $this->input->post('articulo_hidden')[$x],
                'Division_ID' => $this->input->post('division')[$x],
                'Cantidad' => $this->input->post('cantidad')[$x],
                'Stock' => $this->input->post('stock_hidden')[$x],
            );
            array_push($ventas,$venta);
        }

        $date = explode(" ",  $this->input->post('fecha_alb'));
        $date_a = explode("/",  $date[0]);
        $date = $date_a[2].'-'.$date_a[1].'-'.$date_a[0].' '.$date[1];
        $data = array(
            'Bill_no' => $bill_no,
            'AlbaranID' => $this->input->post('num_albaran'),
            'Cliente' => $this->input->post('cliente_nombre'),
            'Fecha' => $date,
            'Venta' => json_encode($ventas),
            'Cantidad_Total' => $this->input->post('cantidad_total_hidden'),
            'User_id' => $user_id
        );

//        echo json_encode($data);

        $insert = $this->db->insert('salida', $data);


        $this->load->model('model_divisiones');

        if($insert) {
            $sal_id = $this->db->insert_id();
            for ($y = 0; $y < count($ventas); $y++) {
                $division = $this->model_divisiones->getDivisionDataById($this->input->post('division')[$y]);

//          echo $division['Piezas_Stock'].":\t".($division['Piezas_Stock']-($this->input->post('cantidad')[$y]))."\n";
                $update_division = array('Piezas_Stock' => ($division['Piezas_Stock'] - ($this->input->post('cantidad')[$y])));
                $this->model_divisiones->update($update_division, $this->input->post('division')[$y]);
                // Llamamos a la función de chekeo de vendido
                array_push($sal_info['checkSold'], $this->checkSold($this->input->post('lote')[$y], $sal_id));

            }
        }
//        die();

        if($insert){
            $sal_info['success']=true;
            $sal_info['message']="Salida creada con exito!";
            $sal_info['sal_id']=$sal_id;
        }
        else{
            $sal_info['success']=false;
            $sal_info['message']="Error al crear!";
        }


        return $sal_info;
    }

    public function remove($id)
    {
        if($id) {
            $this->db->where('ID', $id);
            $delete = $this->db->delete('salida');

//            $this->db->where('order_id', $id);
//            $delete_item = $this->db->delete('orders_item');
            return ($delete == true ) ? true : false;
        }
    }

    public function update($data, $id)
    {
        if($data && $id) {
            $this->db->where('ID', $id);
            $update = $this->db->update('salida', $data);
            return ($update == true) ? true : false;
        }
    }

    public function countTotalSalidas()
    {
        $sql = "SELECT * FROM salida";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function checkSold($lote_id,$sal_id){

        $response = array();

        if($lote_id) {
            $this->load->model('model_lotes');
            $this->load->model('model_divisiones');
            $lote = $this->model_lotes->getLoteData($lote_id);

            //CHECKEO VENDIDO OPOR VENDER//
            $divisiones=$this->model_divisiones->getDivisionDataByLote($lote_id);
            $porvender=0;
            foreach ($divisiones as $k => $value) {
                $porvender+=$value['Piezas_Stock'];
            }
            if($porvender!==0)
                $vendido=0;
            else
                $vendido=1;
            //AÑADO DALIDA ID A LA LISTA DE SALIDAS DE LOTE//{"id":[2,3,4]}
            $id['id'] =array();
            $id['id']=(array) json_decode($lote['Salida']);
//            echo gettype($id);

            if($id==false || $id==null) {
                $id['id'] =array();
                array_push($id['id'],$sal_id);
            }else{
                array_push($id['id'],$sal_id);
            }
//            echo "ES".json_encode($id);
//            die();
            $stock = $this->countStock($lote_id);
            $update_vendido = array('Vendido'=>$vendido,'Salida'=>json_encode($id),'Stock'=>$stock);
            $update = $this->model_lotes->update($update_vendido, $lote_id);

            if($update){
                $response['success_lote']=$update;
                $response['messages']="Lote ".$lote['Serial']." Info Actualizada";
            }else{
                $response['success_lote']=false;
                $response['messages']="Error actualizando lote " . $lote_id;
            }
        }else {
            $response['success_lote']=false;
            $response['messages']="Error cargando lote " . $lote_id;
        }
        return $response;
    }

    public function getSalidasDataFilterPagination($sidx, $sord, $start, $limit, $search_field, $search_strings)
    {
//        $this->db->select('lote.ID, lote.Serial, lote.Articulo, lote.Entrada, lote.Descripcion, lote.Cantidad, lote.Stock, lote.Precio, lote.Coste, lote.Almacen, lote.Vendido');
        $this->db->select('Salida.ID,Salida.Bill_no,Salida.AlbaranID, cli.Nombre as Cliente, Salida.Fecha as Fecha, Salida.Descripcion, Salida.Cantidad_Total');

        $this->db->from('salida Salida');
        $this->db->join('cliente cli','cli.ID = Salida.Cliente','left');

        if($sidx == 'ID') { $this->db->order_by('Salida.ID', $sord); }
        else if($sidx == 'Bill_no') { $this->db->order_by('Salida.Bill_no', $sord); }
        else if($sidx == 'AlbaranID') { $this->db->order_by('Salida.AlbaranID', $sord); }
        else if($sidx == 'Cliente') { $this->db->order_by('cli.Nombre', $sord); }
        else if($sidx == 'Fecha') { $this->db->order_by('Fecha', $sord); }
        else if($sidx == 'Descripcion') { $this->db->order_by('Salida.Descripcion', $sord); }
        else if($sidx == 'Cantidad_Total') { $this->db->order_by('Salida.Cantidad_Total', $sord); }
        else { $this->db->order_by('Salida.Fecha', 'desc');}
//        if($search_field == 'ID') { $this->db->like('Articulo.ID', $search_string); }
//        if($search_field == 'Nombre') { $this->db->like('Articulo.Nombre', $search_string); }
        if ($search_strings) {
//            echo "ENTRA";
            $this->getSearch($search_strings);

        }
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result=$query->result();

        return $result;
    }

    public function countTotal($search_field, $search_strings)
    {
        $this->db->select('Salida.ID,Salida.Bill_no,Salida.AlbaranID, cli.Nombre as Cliente, Salida.Fecha as Fecha, Salida.Descripcion, Salida.Cantidad_Total');

        $this->db->from('salida Salida');
        $this->db->join('cliente cli','cli.ID = Salida.Cliente','left');
//
//        if($search_field == 'ID') { $this->db->like('Articulo.ID', $search_string); }
//        if($search_field == 'Nombre') { $this->db->like('Articulo.Nombre', $search_string); }
        if ($search_strings) {
//            echo "ENTRA";
            $this->getSearch($search_strings);
        }

        $query = $this->db->get();
        return count($query->result());
    }

    public function getSearch($search_strings)
    {
        foreach ($search_strings->rules as $key => $value) {

//                echo $value->field;
            switch ($value->field) {
                case 'ID':
                    if ($value->op == 'cn')
                        $this->db->like('Salida.ID', $value->data);
                    else
                        $this->db->where('Salida.ID', $value->data);
                    break;
                case 'Bill_no':
                    if ($value->op == 'cn')
                        $this->db->like('Salida.Bill_no', $value->data);
                    else
                        $this->db->where('Salida.Bill_no', $value->data);
                    break;
                case 'AlbaranID':
                    if ($value->op == 'cn')
                        $this->db->like('Salida.AlbaranID', $value->data);
                    else
                        $this->db->where('Salida.AlbaranID', $value->data);
                    break;
                case 'Cliente':
                    if ($value->op == 'cn')
                        $this->db->like('cli.Nombre', $value->data);
                    else
                        $this->db->where('cli.Nombre', $value->data);
                    break;
                case 'Fecha':
                    $date = explode("/", $value->data);
                    $date_f = $date[2].'-'.$date[1].'-'.$date[0];
                    if ($value->op == 'ge')
                        $this->db->where('Salida.Fecha >=', $date_f);
                    else if ($value->op == 'le')
                        $this->db->where('Salida.Fecha <=', $date_f);
                    else
                        $this->db->like('Salida.Fecha', $date_f);
                    break;
                case 'Descripcion':
                    $this->db->like('Salida.Descripcion', $value->data);
                    break;
//                case 'Cantidad Total':
//                    if ($value->op == 'ge')
//                        $this->db->where('Lote.Cantidad >=', $value->data);
//                    else if ($value->op == 'le')
//                        $this->db->where('Lote.Cantidad <=', $value->data);
//                    else
//                        $this->db->where('Lote.Cantidad', $value->data);
//                    break;
                case 'Cantidad Total':
                    if ($value->op == 'cn')
                        $this->db->like('Salida.Cantidad_Total', $value->data);
                    else
                        $this->db->where('Salida.Cantidad_Total', $value->data);
                    break;
            }


        }
    }


    public function countStock($id){
        $divisiones =  $this->model_divisiones->getDivisionDataByLote($id);
        $data_lineal=0;
        $data_area=0;
        $data_vol = 0;
        foreach ($divisiones as $k => $v) {
            $stock = floatval($v['Piezas_Stock']);
            $alto = floatval($v['Alto']);
            $largo = floatval($v['Largo']);
            $espesor = floatval($v['Espesor']);

            $data_lineal += ($stock * $largo);
            $data_area += $stock * $largo * $alto;
            $data_vol += $stock * $largo * $alto * $espesor;
        }

        return "Lineal T: ".round($data_lineal,3)."m" ."\tÁrea T: ".round($data_area,3 )."m²"."\tVolumen T: ". round($data_vol,3) ."m³";
    }
}