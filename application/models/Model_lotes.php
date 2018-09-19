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
            $sql = "SELECT Division FROM lote where ID = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
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
            $sql = "SELECT * FROM lote where Serial = $nombre";
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

    public function countTotalEntries()
    {
        $sql = "SELECT * FROM lote";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
}