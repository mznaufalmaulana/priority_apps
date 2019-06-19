<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
    $id = $this->session->userdata('id');
    $data['user'] = $this->db->get_where('data_user', ['id' => $id])->row_array();
    $data['judul'] = 'Priority Apps - Beranda';
    $data['judul_halaman'] = 'Beranda';
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('dashboard/dashboard', $data);
		$this->load->view('templates/footer', $data);
  }
}
