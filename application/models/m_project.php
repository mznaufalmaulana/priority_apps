<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_project extends CI_Model
{
    function set_req($data)
    {
        $result = $this->db->insert('temp_data_kebutuhan', $data);
        return $result;
    }
    function set_voting($data, $dt, $status)
    {
        if ($status == 'update') {
            $this->db->where('id_proyek', $data['id_proyek']);
            $this->db->where('id_jarak', $data['id_jarak']);
            $result = $this->db->update('data_voting', $data);

            $this->db->where('id_proyek', $dt['id_proyek']);
            $this->db->where('id_jarak', $dt['id_jarak']);
            $result = $this->db->update('data_voting', $dt);
        } else {
            $result = $this->db->insert('data_voting', $data);
            $result = $this->db->insert('data_voting', $dt);
        }

        return $result;
    }
    function get_data($id_proyek)
    {
        $this->db->select('id_kebutuhan');
        $this->db->from('data_kebutuhan');
        $this->db->where('id_proyek', $id_proyek);
        $result = $this->db->get()->result();

        return $result;
    }
    function set_priority($id_proyek, $priority)
    {
        $this->db->where('id_proyek', $id_proyek);
        $result = $this->db->update('data_proyek', $priority);

        return $result;
    }
}
