<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 22/08/2018
 * Time: 19:04
 */

class Model_lotes extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLoteData($id = null)
    {
        if($id) {
            $sql = "SELECT * FROM lote where ID = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM lote ORDER BY ID DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getDivLoteDataById($id = null)
    {
        if($id) {
            $sql = "SELECT division FROM lote where ID = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

    }

    public function getLoteDataByArticulo($id = null)
    {
        if($id) {
            $sql = "SELECT * FROM lote where Articulo = ?";
            $query = $this->db->query($sql, array($id));
            return $query->result_array();
        }

    }



//    public function getActiveProductData()
//    {
//        $sql = "SELECT * FROM entradas WHERE availability = ? ORDER BY id DESC";
//        $query = $this->db->query($sql, array(1));
//        return $query->result_array();
//    }
    public function getMyLoteByName($nombre)
    {
       // if($nombre) {
            $sql = "SELECT * FROM lote where Serial = ?";
            $query = $this->db->query($sql, array($nombre));
            return $query->row_array();
//        }
//
//        $sql = "SELECT * FROM lote where Serial= $nombre ORDER BY ID DESC";
//        $query = $this->db->query($sql);
//        return $query->result_array();
    }
    public function create($data)
    {
        if($data) {
            $insert = $this->db->insert('lote', $data);
            return ($insert == true) ? true : false;
        }
    }

    public function update($data, $id)
    {
        if($data && $id) {
            $this->db->where('ID', $id);
            $update = $this->db->update('lote', $data);
            return ($update == true) ? true : false;
        }
    }

    public function remove($id)
    {
        if($id) {
            $this->db->where('ID', $id);
            $delete = $this->db->delete('lote');
            return ($delete == true) ? true : false;
        }
    }

    public function removeBySerial($serial)
    {
        if($serial) {
            $this->db->where('Serial', $serial);
            $delete = $this->db->delete('lote');
            return ($delete == true) ? true : false;
        }
    }

    public function countTotalLotes()
    {
        $sql = "SELECT * FROM lote";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function createSerial($data)
    {
        if($data) {
            $insert = $this->db->insert('lote', $data);
            if($insert)
                return $this->db->insert_id();
            else
                return false;
        }
    }
    public function getLoteDataFilterPagination($sidx, $sord, $start, $limit, $search_field, $search_strings)
    {
//        $this->db->select('lote.ID, lote.Serial, lote.Articulo, lote.Entrada, lote.Descripcion, lote.Cantidad, lote.Stock, lote.Precio, lote.Coste, lote.Almacen, lote.Vendido');
        $this->db->select('Lote.ID, Lote.Serial, art.Nombre as Articulo, entr.Fecha as Entrada, Lote.Entrada  as Ent_ID, Lote.Descripcion,Lote.Division, Lote.Cantidad, Lote.Stock, Lote.Precio, Lote.Coste, alm.Nombre as Almacen, Lote.Vendido');
        $this->db->from('lote Lote');

        $this->db->join('articulo art','art.ID = Lote.Articulo','left');
        $this->db->join('entrada entr','entr.ID = Lote.Entrada','left');
        $this->db->join('almacen alm','alm.ID = Lote.Almacen','left');

        if($sidx == 'ID') { $this->db->order_by('Lote.ID', $sord); }
        else if($sidx == 'Serial') { $this->db->order_by('Lote.Serial', $sord); }
        else if($sidx == 'Articulo') { $this->db->order_by('Articulo', $sord); }
        else if($sidx == 'Fecha') { $this->db->order_by('Entrada', $sord); }
        else if($sidx == 'Descripcion') { $this->db->order_by('Lote.Descripcion', $sord); }
        else if($sidx == 'Cantidad') { $this->db->order_by('Lote.Cantidad', $sord); }
        else if($sidx == 'Stock') { $this->db->order_by('Lote.Stock', $sord); }
        else if($sidx == 'Precio') { $this->db->order_by('Lote.Precio', $sord); }
        else if($sidx == 'Coste') { $this->db->order_by('Lote.Coste', $sord); }
        else if($sidx == 'Almacen') { $this->db->order_by('Almacen', $sord); }
        else if($sidx == 'Vendido') { $this->db->order_by('Lote.Vendido', $sord); }
        else { $this->db->order_by('Lote.Entrada', $sord); }
//        if($search_field == 'ID') { $this->db->like('Lote.ID', $search_string); }
//        if($search_field == 'Serial') { $this->db->like('Lote.Serial', $search_string); }
        if($search_strings) {
//            echo "ENTRA";
            $this->getSearch($search_strings);

        }
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result=$query->result();

        return $result;
    }

    public function countTotal($search_field, $search_string)
    {
        $this->db->select('Lote.ID, Lote.Serial, art.Nombre as Articulo, entr.Fecha as Entrada, Lote.Descripcion,Lote.Division, Lote.Cantidad, Lote.Stock, Lote.Precio, Lote.Coste, alm.Nombre as Almacen, Lote.Vendido');

        $this->db->from('lote Lote');
//        $this->db->from('articulo');
//        $this->db->from('entrada');
//        $this->db->from('almacen');

        $this->db->join('articulo art', 'art.ID = Lote.Articulo', 'left');
        $this->db->join('entrada entr', 'entr.ID = Lote.Entrada', 'left');
        $this->db->join('almacen alm', 'alm.ID = Lote.Almacen', 'left');
//        if($search_field == 'ID') { $this->db->like('lote.ID', $search_string); }
//        if($search_field == 'Serial') { $this->db->like('lote.Serial', $search_string); }

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
                        $this->db->like('Lote.ID', $value->data);
                    else
                        $this->db->where('Lote.ID', $value->data);
                    break;
                case 'Serial':
                    if ($value->op == 'ge')
                        $this->db->where('Lote.Serial >=', $value->data);
                    if ($value->op == 'le')
                        $this->db->where('Lote.Serial <=', $value->data);
                    else
                        $this->db->where('Lote.Serial', $value->data);
                    break;
                case 'Articulo':
                    if ($value->op == 'cn')
                        $this->db->like('art.Nombre', $value->data);
                    else
                        $this->db->where('art.Nombre', $value->data);
                    break;
                case 'Entrada':
                    if ($value->op == 'ge')
                        $this->db->where('entr.Fecha >=', $value->data);
                    else if ($value->op == 'le')
                        $this->db->where('entr.Fecha <=', $value->data);
                    else
                        $this->db->where('entr.Fecha', $value->data);
                    break;
                case 'Descripcion':
                    echo "i es igual a 2";
                    break;
                case 'Cantidad':
                    if ($value->op == 'ge')
                        $this->db->where('Lote.Cantidad >=', $value->data);
                    else if ($value->op == 'le')
                        $this->db->where('Lote.Cantidad <=', $value->data);
                    else
                        $this->db->where('Lote.Cantidad', $value->data);
                    break;
                case 'Stock':
                    if ($value->op == 'ge')
                        $this->db->where('Lote.Stock >=', $value->data);
                    else if ($value->op == 'le')
                        $this->db->where('Lote.Stock <=', $value->data);
                    else
                        $this->db->where('Lote.Stock', $value->data);
                    break;
                case 'Precio':
                    if ($value->op == 'ge')
                        $this->db->where('Lote.Precio >=', $value->data);
                    else if ($value->op == 'le')
                        $this->db->where('Lote.Precio <=', $value->data);
                    else
                        $this->db->where('Lote.Precio', $value->data);
                    break;
                case 'Coste':
                    if ($value->op == 'ge')
                        $this->db->where('Lote.Coste >=', $value->data);
                    else if ($value->op == 'le')
                        $this->db->where('Lote.Coste <=', $value->data);
                    else
                        $this->db->where('Lote.Coste', $value->data);
                    break;
                case 'Almacen':
                    $this->db->like('Almacen', $value->data);
                    break;
                case 'Vendido':
                    $this->db->like('Lote.Vendido', $value->data);
                    break;
//                case 'Estado':
//                    $this->db->like('Lote.ID', $value->data);
//                    break;
            }

        }
    }

}