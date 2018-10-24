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


    public function getProovedoresDataFilteringPagination($sidx, $sord, $start, $limit, $search_field, $search_string)
    {
        $this->db->select('*');

        $this->db->from('proovedor');

        if($sidx == 'ID') { $this->db->order_by('proovedor.ID', $sord); }
        else if($sidx == 'Nombre') { $this->db->order_by('proovedor.Nombre', $sord); }
        else if($sidx == 'NIF') { $this->db->order_by('proovedor.NIF', $sord); }
        else if($sidx == 'Correo') { $this->db->order_by('proovedor.Correo', $sord); }
        else if($sidx == 'Telefono') { $this->db->order_by('proovedor.Telefono', $sord); }
        else if($sidx == 'Empresa') { $this->db->order_by('proovedor.Empresa', $sord); }
        else { $this->db->order_by('proovedor.ID', $sord); }
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

        $this->db->from('proovedor');


//        if($search_field == 'ID') { $this->db->like('Articulo.ID', $search_string); }
//        if($search_field == 'Nombre') { $this->db->like('Articulo.Nombre', $search_string); }

        $query = $this->db->get();
        return count($query->result());
    }

}