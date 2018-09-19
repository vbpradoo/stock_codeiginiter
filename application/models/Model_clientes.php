<?php

class Model_clientes extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /* get the brand data */
    public function getClienteData($id = null)
    {
        if($id) {
            $sql = "SELECT * FROM cliente where id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT * FROM cliente ORDER BY id DESC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function create($data)
    {
        if($data) {
            $insert = $this->db->insert('cliente', $data);
            return ($insert == true) ? true : false;
        }
    }

    public function update($data, $id)
    {
        if($data && $id) {
            $this->db->where('id', $id);
            $update = $this->db->update('cliente', $data);
            return ($update == true) ? true : false;
        }
    }

    public function remove($id)
    {
        if($id) {
            $this->db->where('id', $id);
            $delete = $this->db->delete('cliente');
            return ($delete == true) ? true : false;
        }
    }

    public function countTotalClientes()
    {
        $sql = "SELECT * FROM cliente";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

}