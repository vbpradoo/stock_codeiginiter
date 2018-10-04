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

    public function getClientesDataFilteringPagination($sidx, $sord, $start, $limit, $search_field, $search_string)
    {
        $this->db->select('*');

        $this->db->from('cliente');

        if($sidx == 'ID') { $this->db->order_by('cliente.ID', $sord); }
        else if($sidx == 'Nombre') { $this->db->order_by('cliente.Nombre', $sord); }
        else if($sidx == 'Correo') { $this->db->order_by('cliente.Correo', $sord); }
        else if($sidx == 'Telefono') { $this->db->order_by('cliente.Telefono', $sord); }
        else if($sidx == 'Empresa') { $this->db->order_by('cliente.Empresa', $sord); }
        else { $this->db->order_by('cliente.ID', $sord); }
//        if($search_field == 'ID') { $this->db->like('Articulo.ID', $search_string); }
//        if($search_field == 'Nombre') { $this->db->like('Articulo.Nombre', $search_string); }

        $this->db->limit($limit, $start);
        $query = $this->db->get();
        $result=$query->result();

        return $result;
    }

    public function countTotal($search_field, $search_string)
    {
        $this->db->select('*');

        $this->db->from('cliente');


//        if($search_field == 'ID') { $this->db->like('Articulo.ID', $search_string); }
//        if($search_field == 'Nombre') { $this->db->like('Articulo.Nombre', $search_string); }

        $query = $this->db->get();
        return count($query->result());
    }

}