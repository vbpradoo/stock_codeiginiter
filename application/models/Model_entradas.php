<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 27/08/2018
 * Time: 16:50
 */

class Model_entradas extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getEntradasData($id = null)
    {
        if($id) {
            $sql = "SELECT * FROM entrada where ID = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM entrada ORDER BY ID DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

//    public function getActiveProductData()
//    {
//        $sql = "SELECT * FROM entradas WHERE availability = ? ORDER BY id DESC";
//        $query = $this->db->query($sql, array(1));
//        return $query->result_array();
//    }

    public function create($data)
    {
        if($data) {
            $insert = $this->db->insert('entrada', $data);
//            return ($insert == true) ? true : false;
            if($insert)
                return $this->db->insert_id();
            else
                return false;
        }
    }

    public function update($data, $id)
    {
        if($data && $id) {
            $this->db->where('ID', $id);
            $update = $this->db->update('entrada', $data);
            return ($update == true) ? true : false;
        }
    }

    public function remove($id)
    {
        if($id) {
            $this->db->where('ID', $id);
            $delete = $this->db->delete('entrada');
            return ($delete == true) ? true : false;
        }
    }

    public function countTotalEntradas()
    {
        $sql = "SELECT * FROM entrada";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getEntradasDataFilterPagination($sidx, $sord, $start, $limit, $search_field, $search_strings)
    {
//        $this->db->select('lote.ID, lote.Serial, lote.Articulo, lote.Entrada, lote.Descripcion, lote.Cantidad, lote.Stock, lote.Precio, lote.Coste, lote.Almacen, lote.Vendido');
        $this->db->select('Entrada.ID, Lote.Serial, Art.Serial as Articulo, Prov.Nombre as Proovedor, Entrada.Fecha,Lote.Cantidad, Art.Descripcion, Lote.Anexo');

        $this->db->from('entrada Entrada');
        $this->db->join('lote Lote','Lote.Entrada = Entrada.ID','left');
        $this->db->join('articulo Art','Art.ID = Lote.Articulo','left');
        $this->db->join('proovedor Prov','Prov.ID = Entrada.Proovedor','left');

        if($sidx == 'ID') { $this->db->order_by('Entrada.ID', $sord); }
        else if($sidx == 'Lote') { $this->db->order_by('Lote.Serial', $sord); }
        else if($sidx == 'Proovedor') { $this->db->order_by('Proovedor', $sord); }
        else if($sidx == 'Articulo') { $this->db->order_by('Articulo.Serial', $sord); }
        else if($sidx == 'Fecha') { $this->db->order_by('Entrada.Fecha', $sord); }
        else if($sidx == 'Cantidad') { $this->db->order_by('Lote.Cantidad', $sord); }
        else if($sidx == 'Descripcion') { $this->db->order_by('Articulo.Descripcion', $sord); }
//        else if($sidx == 'Pagado') { $this->db->order_by('Entrada.Pagado', $sord); }
        else { $this->db->order_by('Entrada.Fecha', 'desc'); }
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
        $this->db->select('Entrada.ID, Lote.Serial, Art.Serial as Articulo, Prov.Nombre as Proovedor, Entrada.Fecha,Lote.Cantidad, Art.Descripcion, Lote.Anexo');

        $this->db->from('entrada Entrada');
        $this->db->join('lote Lote','Lote.Entrada = Entrada.ID','left');
        $this->db->join('articulo Art','Art.ID = Lote.Articulo','left');
        $this->db->join('proovedor Prov','Prov.ID = Entrada.Proovedor','left');



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
                        $this->db->like('Entrada.ID', $value->data);
                    else
                        $this->db->where('Entrada.ID', $value->data);
                    break;
                case 'Serial':
                    if ($value->op == 'cn')
                        $this->db->like('Lote.Serial', $value->data);
                    else
                        $this->db->where('Lote.Serial', $value->data);
                    break;
                case 'Articulo':
                    if ($value->op == 'cn')
                        $this->db->like('Art.Serial', $value->data);
                    else
                        $this->db->where('Art.Serial', $value->data);
                    break;
                case 'Proovedor':
                    if ($value->op == 'cn')
                        $this->db->like('Prov.Nombre', $value->data);
                    else
                        $this->db->where('Prov.Nombre', $value->data);
                    break;
                case 'Fecha':
                    $date = explode("/", $value->data);
                    $date_f = $date[2] . '-' . $date[1] . '-' . $date[0];
                    if ($value->op == 'ge')
                        $this->db->where('Entrada.Fecha >=', $date_f);
                    else if ($value->op == 'le')
                        $this->db->where('Entrada.Fecha <=', $date_f);
                    else
                        $this->db->like('Entrada.Fecha', $date_f);
                    break;
            }

        }
    }

}