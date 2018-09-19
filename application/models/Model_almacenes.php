<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 28/08/2018
 * Time: 23:56
 */

class Model_almacenes extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAlmacenesData($id = null)
    {
        if($id) {
            $sql = "SELECT * FROM almacen where ID = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM almacen ORDER BY ID DESC";
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
            $insert = $this->db->insert('almacen', $data);
            return ($insert == true) ? true : false;
        }
    }

    public function update($data, $id)
    {
        if($data && $id) {
            $this->db->where('ID', $id);
            $update = $this->db->update('almacen', $data);
            return ($update == true) ? true : false;
        }
    }

    public function remove($id)
    {
        if($id) {
            $this->db->where('ID', $id);
            $delete = $this->db->delete('almacen');
            return ($delete == true) ? true : false;
        }
    }

    public function countTotalAlmacenes()
    {
        $sql = "SELECT * FROM almacen";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }


}