<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 27/08/2018
 * Time: 16:50
 */

class Model_familia extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getFamiliaData($id = null)
    {
        if($id) {
            $sql = "SELECT * FROM familia where ID = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM familia ORDER BY ID DESC";
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
            $insert = $this->db->insert('familia', $data);
            return ($insert == true) ? true : false;
        }
    }

    public function update($data, $id)
    {
        if($data && $id) {
            $this->db->where('ID', $id);
            $update = $this->db->update('familia', $data);
            return ($update == true) ? true : false;
        }
    }

    public function remove($id)
    {
        if($id) {
            $this->db->where('ID', $id);
            $delete = $this->db->delete('familia');
            return ($delete == true) ? true : false;
        }
    }

    public function countTotalFamilia()
    {
        $sql = "SELECT * FROM familia";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }



    public function fetchFamiliaDataFilteringPagination($sidx, $sord, $start, $limit, $search_field, $search_string)
    {
//        $this->db->select('lote.ID, lote.Serial, lote.Articulo, lote.Entrada, lote.Descripcion, lote.Cantidad, lote.Stock, lote.Precio, lote.Coste, lote.Almacen, lote.Vendido');
        $this->db->select('Familia.ID, Familia.Nombre,Familia.Descripcion');

        $this->db->from('familia Familia');

        if($sidx == 'ID') { $this->db->order_by('Familia.ID', $sord); }
        else if($sidx == 'Nombre') { $this->db->order_by('Familia.Nombre', $sord); }
        else if($sidx == 'Descripcion') { $this->db->order_by('Familia.Descripcion', $sord); }
        else { $this->db->order_by('Familia.ID', $sord); }
//        if($search_field == 'ID') { $this->db->like('Articulo.ID', $search_string); }
//        if($search_field == 'Nombre') { $this->db->like('Articulo.Nombre', $search_string); }

        $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result=$query->result();

        return $result;
    }

    public function countTotal($search_field, $search_string)
    {
        $this->db->select('Familia.ID, Familia.Nombre,Familia.Descripcion');

        $this->db->from('familia Familia');


//        if($search_field == 'ID') { $this->db->like('Familia.ID', $search_string); }
//        if($search_field == 'Nombre') { $this->db->like('Articulo.Nombre', $search_string); }

        $query = $this->db->get();
        return count($query->result());
    }

}