<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class empleado_model extends CI_Model 
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
            $query = $this->db->get('empleados');
            return $query->result_array();
        }
        $this->db->order_by('id', 'asc');
        $query = $this->db->get_where('empleados', array('tipo_empleado' => $nombre));
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
        $this->db->delete('empleados', array('id' => $id));
    }
    function get_empleado_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('empleados');
        return $query->result_array();
    }

    function search_type_employe($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('tiposempleados');
        return $query->result_array();
    }

    function update($id, $nombres, $apellidos, $correo)
    {
        $this->db->where('id', $id);
        $this->db->set('nombres', $nombres);
        $this->db->set('apellidos', $apellidos);
        $this->db->set('correo', $correo);

        return $this->db->update('empleados');
    }
}
