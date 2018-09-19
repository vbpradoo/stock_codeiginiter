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

    public function create($data)
    {
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
}