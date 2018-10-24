<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 28/08/2018
 * Time: 23:53
 */

class Model_divisiones extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getDivisionData($id = null)
    {
        if ($id) {
            $sql = "SELECT * FROM division where ID in ?";
            $query = $this->db->query($sql,array($id));
            return $query->result_array();
        }

        $sql = "SELECT * FROM division ORDER BY ID DESC";
        $query = $this->db->query($sql);
        return $query->result_array();

    }

    public function getDivisionDataById($id = null)
    {
        if($id) {
            $sql = "SELECT * FROM division where ID = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM division ORDER BY ID DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getDivisionDataByLote($id = null){
        if ($id) {
            $sql = "SELECT * FROM division where Lote = ?";
            $query = $this->db->query($sql,array($id));
            return $query->result_array();
        }
    }

//    public function getStockDivisionDataByLote($id = null){
//        if ($id) {
//            $sql = "SELECT * FROM division where Lote = ?";
//            $query = $this->db->query($sql,array($id));
//            return $query->result_array();
//        }
//    }



//    public function getDivisionByArray($id = null)
//    {
//            $sql = "SELECT * FROM division where ID = ?";
//            $query = $this->db->query($sql, array($id));
//            return $query->row_array();
//            //echo $result;
//            //return $result;
//        }
////        $sql = "SELECT * FROM division ORDER BY ID DESC";
////        $query = $this->db->query($sql);
////        return $query->result_array();
//
//    }


//    public function getActiveProductData()
//    {
//        $sql = "SELECT * FROM entradas WHERE availability = ? ORDER BY id DESC";
//        $query = $this->db->query($sql, array(1));
//        return $query->result_array();
//    }

    public function create($data)
    {
        if ($data) {
            $insert = $this->db->insert('division', $data);
            return ($insert == true) ? true : false;
        }
    }

    public function createDiv($data)
    {
        if ($data) {
            $insert = $this->db->insert('division', $data);
            if($insert)
                return $this->db->insert_id();
            else
                return false;
        }
    }

    public function updateDiv($data, $id)
    {
        if ($data && $id) {
            $this->db->where('ID', $id);
            $update = $this->db->update('division', $data);
            if($update)
                return $this->db->insert_id();
            else
                return false;
        }
    }


    public function update($data, $id)
    {
        if ($data && $id) {
            $this->db->where('ID', $id);
            $update = $this->db->update('division', $data);
            return ($update == true) ? true : false;
        }
    }



    public function remove($id)
    {
        if ($id) {
            $this->db->where('ID', $id);
            $delete = $this->db->delete('division');
            return ($delete == true) ? true : false;
        }
    }

    public function countTotalDivisions()
    {
        $sql = "SELECT * FROM division";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }



}