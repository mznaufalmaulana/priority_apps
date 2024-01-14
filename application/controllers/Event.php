<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Event extends CI_Controller
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
		$data['judul'] = 'Redanis - Event';
		$data['judul_halaman'] = 'Event';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('event/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function add()
	{
		$id = $this->session->userdata('id');
		$data['user'] = $this->db->get_where('dt_user', ['id' => $id])->row_array();
		$data['judul'] = 'Redanis - Tambah Event';
		$data['judul_halaman'] = 'Tambah Event';
		$data['type'] = 'add';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('event/add', $data);
		$this->load->view('templates/footer', $data);
	}

	public function edit($idEvent)
	{
		$id = $this->session->userdata('id');
		$data['user'] = $this->db->get_where('dt_user', ['id' => $id])->row_array();
		$data['judul'] = 'Redanis - Draft Event';
		$data['judul_halaman'] = 'Edit Event';
		$data['type'] = 'edit';

		$id = $this->input->post('id');
		$data['event'] = $this->db->get_where('dt_event', ['id' => $idEvent])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('event/add', $data);
		$this->load->view('templates/footer', $data);
	}

	public function saveEvent()
	{
		$this->form_validation->set_rules('title', 'Title', 'required|trim', [
			'required' => "Field Tidak Boleh Kosong"
		]);
		$this->form_validation->set_rules('description', 'Description', 'required|trim', [
			'required' => "Field Tidak Boleh Kosong"
		]);

		if ($this->form_validation->run() == false) {
			$id = $this->session->userdata('id');
			$data['user'] = $this->db->get_where('dt_user', ['id' => $id])->row_array();
			$data['judul'] = 'Priority Apps - Tambah Proyek';
			$data['judul_halaman'] = 'Tambah Proyek';
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('event/add', $data);
			$this->load->view('templates/footer', $data);
		} else {
			$this->_insert_dt_event();
			redirect('event/index');
		}
	}

	private function _insert_dt_event()
	{
		$config = array(
			'upload_path' => './assets/images/public/event',
			'allowed_types' => 'png|jpeg|jpg',
			'encrypt_name' => TRUE,
		);

		$this->upload->initialize($config);

		if ($this->upload->do_upload('event_img')) {
			$data = array('upload_data' => $this->upload->data());
		}

		$idEvent = $this->input->post('idEvent');
		$dt['title'] = $this->input->post('title');
		$dt['description'] = $this->input->post('description');
		$dt['image'] = $data['upload_data']['full_path'];
		$dt['created_at'] = date('y-m-d h:i:s');

		$dt_update = $this->db->get_where('dt_event', ['id' => $idEvent])->row_array();

		if (!isset($dt_update)) {
			$this->db->insert('dt_event', $dt);
		} else {
			$this->db->where('id', $idEvent);
			$this->db->update('dt_event', $dt);
		}
	}

	public function deleteEvent()
	{
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $result = $this->db->delete('dt_event');
        echo json_encode($result);
	}
}
