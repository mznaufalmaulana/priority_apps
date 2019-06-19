<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_project extends CI_Model
{
    function get_all_project($id_user)
    {
        $this->db->select('*');
        // $this->db->distinct();
        $this->db->from('data_proyek');
        $this->db->where_in('id_user', $id_user);
        // $hasil1 = $this->db->get_compiled_select();

        // $this->db->select('*');
        // $this->db->distinct();
        // $this->db->from('temp_data_proyek');
        // $this->db->where_in('id_user', $id_user);
        // $hasil2 = $this->db->get_compiled_select();

        // $hasil = $this->db->query($hasil1 . " UNION " . $hasil2);\
        $hasil = $this->db->get();
        return $hasil->result();
    }
}
