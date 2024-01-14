<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
		$this->load->library('upload');
    }

    public function index()
    {
        $id = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('dt_user', ['id' => $id])->row_array();
        $data['judul'] = 'Redanis - Daftar Pertanyaan';
        $data['judul_halaman'] = 'Daftar Pertanyaan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('question/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detail($idQuestion)
    {
        $id = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('dt_user', ['id' => $id])->row_array();
        $data['judul'] = 'Redanis - Detail Pertanyaan';
        $data['judul_halaman'] = 'Detail Pertanyaan';
        $data['type'] = 'edit';

		$id = $this->input->post('id');
        $data['question'] = $this->db->get_where('dt_customer', ['id' => $idQuestion])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('question/detail', $data);
        $this->load->view('templates/footer', $data);
    }

	public function updateStatus()
	{
        $id = $this->input->post('id');
		$dt['status'] = 1;
        $this->db->where('id', $id);
        $result = $this->db->update('dt_customer', $dt);
        echo json_encode($result);
	}
}
