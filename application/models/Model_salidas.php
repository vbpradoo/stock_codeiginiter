<?php

class Model_salidas extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /* get the orders data */
    public function getSalidasData($id = null)
    {
        if($id) {
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


        $data = array(
            'Bill_no' => $bill_no,
            'Cliente' => $this->input->post('cliente_nombre'),
//            'Fecha' => strtotime(date('d-m-Y h:i:s a')),
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
                // Llamamos a la fución de chekeo de vendido
                array_push($sal_info['checkSold'], $this->checkSold($this->input->post('lote')[$y], $sal_id));

            }
        }
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

//    public function countOrderItem($order_id)
//    {
//        if($order_id) {
//            $sql = "SELECT * FROM orders_item WHERE order_id = ?";
//            $query = $this->db->query($sql, array($order_id));
//            return $query->num_rows();
//        }
//    }

    public function update($id)
    {
        if($id) {
            $user_id = $this->session->userdata('id');
            // fetch the order data

            $data = array(
                'customer_name' => $this->input->post('customer_name'),
                'customer_address' => $this->input->post('customer_address'),
                'customer_phone' => $this->input->post('customer_phone'),
                'gross_amount' => $this->input->post('gross_amount_value'),
                'service_charge_rate' => $this->input->post('service_charge_rate'),
                'service_charge' => ($this->input->post('service_charge_value') > 0) ? $this->input->post('service_charge_value'):0,
                'vat_charge_rate' => $this->input->post('vat_charge_rate'),
                'vat_charge' => ($this->input->post('vat_charge_value') > 0) ? $this->input->post('vat_charge_value') : 0,
                'net_amount' => $this->input->post('net_amount_value'),
                'discount' => $this->input->post('discount'),
                'paid_status' => $this->input->post('paid_status'),
                'user_id' => $user_id
            );

            $this->db->where('id', $id);
            $update = $this->db->update('orders', $data);

            // now the order item
            // first we will replace the product qty to original and subtract the qty again
            $this->load->model('model_products');
            $get_order_item = $this->getOrdersItemData($id);
            foreach ($get_order_item as $k => $v) {
                $product_id = $v['product_id'];
                $qty = $v['qty'];
                // get the product
                $product_data = $this->model_products->getProductData($product_id);
                $update_qty = $qty + $product_data['qty'];
                $update_product_data = array('qty' => $update_qty);

                // update the product qty
                $this->model_products->update($update_product_data, $product_id);
            }

            // now remove the order item data
            $this->db->where('order_id', $id);
            $this->db->delete('orders_item');

            // now decrease the product qty
            $count_product = count($this->input->post('product'));
            for($x = 0; $x < $count_product; $x++) {
                $items = array(
                    'order_id' => $id,
                    'product_id' => $this->input->post('product')[$x],
                    'qty' => $this->input->post('qty')[$x],
                    'rate' => $this->input->post('rate_value')[$x],
                    'amount' => $this->input->post('amount_value')[$x],
                );
                $this->db->insert('orders_item', $items);

                // now decrease the stock from the product
                $product_data = $this->model_products->getProductData($this->input->post('product')[$x]);
                $qty = (int) $product_data['qty'] - (int) $this->input->post('qty')[$x];

                $update_product = array('qty' => $qty);
                $this->model_products->update($update_product, $this->input->post('product')[$x]);
            }

            return true;
        }
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
            $id=(array) json_decode($lote['Salida']);
//            echo gettype($id);

            if($id==false || $id==null) {
                $id['id'] =array();
                array_push($id['id'],$sal_id);
            }else{
                array_push($id['id'],$sal_id);
            }
//            echo "ES".json_encode($id);
//            die();
            $update_vendido = array('Vendido'=>$vendido,'Salida'=>json_encode($id));
            $update=$this->model_lotes->update($update_vendido, $lote_id);

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

    public function getSalidasDataFilterPagination($sidx, $sord, $start, $limit, $search_field, $search_string)
    {
//        $this->db->select('lote.ID, lote.Serial, lote.Articulo, lote.Entrada, lote.Descripcion, lote.Cantidad, lote.Stock, lote.Precio, lote.Coste, lote.Almacen, lote.Vendido');
        $this->db->select('Salida.ID,Salida.Bill_no, cli.Nombre as Cliente, Salida.Fecha as Fecha, Salida.Descripcion, Salida.Cantidad_Total');

        $this->db->from('salida Salida');
        $this->db->join('cliente cli','cli.ID = Salida.Cliente','left');

        if($sidx == 'ID') { $this->db->order_by('Salida.ID', $sord); }
        else if($sidx == 'Bill_no') { $this->db->order_by('Salida.Bill_no', $sord); }
        else if($sidx == 'Cliente') { $this->db->order_by('cli.Nombre', $sord); }
        else if($sidx == 'Fecha') { $this->db->order_by('Fecha', $sord); }
        else if($sidx == 'Descripcion') { $this->db->order_by('Salida.Descripcion', $sord); }
        else if($sidx == 'Cantidad_Total') { $this->db->order_by('Salida.Cantidad_Total', $sord); }
        else { $this->db->order_by('Salida.ID', $sord); }
//        if($search_field == 'ID') { $this->db->like('Articulo.ID', $search_string); }
//        if($search_field == 'Nombre') { $this->db->like('Articulo.Nombre', $search_string); }

        $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result=$query->result();

        return $result;
    }

    public function countTotal($search_field, $search_string)
    {
        $this->db->select('Salida.ID,Salida.Bill_no, cli.Nombre as Cliente, Salida.Fecha as Fecha, Salida.Descripcion, Salida.Cantidad_Total');

        $this->db->from('salida Salida');
        $this->db->join('cliente cli','cli.ID = Salida.Cliente','left');
//
//        if($search_field == 'ID') { $this->db->like('Articulo.ID', $search_string); }
//        if($search_field == 'Nombre') { $this->db->like('Articulo.Nombre', $search_string); }

        $query = $this->db->get();
        return count($query->result());
    }

}