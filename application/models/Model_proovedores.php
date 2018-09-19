<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 08/09/2018
 * Time: 4:35
 */

class Model_proovedores extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /* get the brand data */
    public function getProovedorData($id = null)
    {
        if ($id) {
            $sql = "SELECT * FROM proovedor where ID = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM proovedor ORDER BY ID DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function create($data)
    {
        if ($data) {
            $insert = $this->db->insert('proovedor', $data);
            return ($insert == true) ? true : false;
        }
    }

    public function update($data, $id)
    {
        if ($data && $id) {
            $this->db->where('ID', $id);
            $update = $this->db->update('proovedor', $data);
            return ($update == true) ? true : false;
        }
    }

    public function remove($id)
    {
        if ($id) {
            $this->db->where('ID', $id);
            $delete = $this->db->delete('proovedor');
            return ($delete == true) ? true : false;
        }
    }

    public function countTotalProovedores()
    {
        $sql = "SELECT * FROM proovedor";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

}