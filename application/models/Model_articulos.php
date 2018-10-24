<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 27/08/2018
 * Time: 16:50
 */

class Model_articulos extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getArticuloData($id = null)
    {
        if($id) {
            $sql = "SELECT * FROM articulo where ID = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM articulo ORDER BY ID DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

//    public function getActiveProductData()
//    {
//        $sql = "SELECT * FROM entradas WHERE availability = ? ORDER BY id DESC";
//        $query = $this->db->query($sql, array(1));
//        return $query->result_array();
//    }

    public function create($data){
        if($data) {
            $insert = $this->db->insert('articulo', $data);
            return ($insert == true) ? true : false;
        }
    }

    public function update($data, $id)
    {
        if($data && $id) {
            $this->db->where('ID', $id);
            $update = $this->db->update('articulo', $data);
            return ($update == true) ? true : false;
        }
    }

    public function remove($id)
    {
        if($id) {
            $this->db->where('ID', $id);
            $delete = $this->db->delete('articulo');
            return ($delete == true) ? true : false;
        }
    }

    public function countTotalArticulos()
    {
        $sql = "SELECT * FROM articulo";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }


    public function getArticuloDataFilterPagination($sidx, $sord, $start, $limit, $search_field, $search_string)
    {
//        $this->db->select('lote.ID, lote.Serial, lote.Articulo, lote.Entrada, lote.Descripcion, lote.Cantidad, lote.Stock, lote.Precio, lote.Coste, lote.Almacen, lote.Vendido');
        $this->db->select('Articulo.ID,Articulo.Serial, Articulo.Nombre, fam.Nombre as Familia, Articulo.Activo as Activo,Articulo.Descripcion');

        $this->db->from('articulo Articulo');
        $this->db->join('familia fam','fam.ID = Articulo.Familia','left');

        if($sidx == 'ID') { $this->db->order_by('Articulo.ID', $sord); }
        else if($sidx == 'Nombre') { $this->db->order_by('Articulo.Nombre', $sord); }
        else if($sidx == 'Codigo') { $this->db->order_by('Articulo.Serial', $sord); }
        else if($sidx == 'Familia') { $this->db->order_by('Familia', $sord); }
        else if($sidx == 'Estado') { $this->db->order_by('Articulo.Activo', $sord); }
        else if($sidx == 'Descripcion') { $this->db->order_by('Articulo.Descripcion', $sord); }
        else { $this->db->order_by('Articulo.ID', $sord); }
        if($search_field == 'ID') { $this->db->like('Articulo.ID', $search_string); }
        if($search_field == 'Nombre') { $this->db->like('Articulo.Nombre', $search_string); }

        $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result=$query->result();

        return $result;
    }

    public function countTotal($search_field, $search_string)
    {
        $this->db->select('Articulo.ID, Articulo.Serial, Articulo.Nombre, fam.Nombre as Familia, Articulo.Activo,Articulo.Descripcion');

        $this->db->from('articulo  Articulo');


        $this->db->join('familia fam','fam.ID = Articulo.Familia','left');

        if($search_field == 'ID') { $this->db->like('Articulo.ID', $search_string); }
        if($search_field == 'Nombre') { $this->db->like('Articulo.Nombre', $search_string); }

        $query = $this->db->get();
        return count($query->result());
    }

}