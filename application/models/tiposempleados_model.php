<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tiposempleados_model extends CI_Model 
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get($nombre = FALSE)
    {
        if ($nombre === FALSE)
        {
            $this->db->order_by('id', 'asc');
            $query = $this->db->get('tiposempleados');
            return $query->result_array();
        }
        $this->db->order_by('id', 'asc');
        $query = $this->db->get_where('tiposempleados', array('id' => $nombre));
        return $query->result_array();
    }
    
    public function add($data)
    {
        $data = array(
            'nombres'   => $data[1],
            'apellidos'   => $data[2],
            'correo'   => $data[0],
            'tipo_empleado'   => $data[3],
        );
        return $this->db->insert('empleados', $data);
    }
    public function delete($id)
    {
        $this->db->delete('editoriales', array('id' => $id));
    }
    function get_tipo_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tiposempleados');
        return $query->result_array();
    }

    function search_type_employe($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tiposempleados');
        return $query->result_array();
    }

    function update($id, $nombre)
    {
        $this->db->where('id', $id);
        $this->db->set('nombre', $nombre);
        return $this->db->update('editoriales');
    }
}
