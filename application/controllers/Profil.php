<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->model('m_project', 'm');
  }
  public function index()
  {
    $id = $this->session->userdata('id');
    $data['user'] = $this->db->get_where('data_user', ['id' => $id])->row_array();
    $data['judul'] = 'Priority Apps - Profil';
    $data['judul_halaman'] = 'Profil';
    $data['proyek'] = $this->m->get_all_project($id);
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('auth/profil', $data);
    $this->load->view('templates/footer', $data);
  }
}
