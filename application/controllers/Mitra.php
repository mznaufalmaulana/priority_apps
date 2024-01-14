<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mitra extends CI_Controller
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
        $data['judul'] = 'Redanis - Mitra';
        $data['judul_halaman'] = 'Mitra';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mitra/index', $data);
        $this->load->view('templates/footer', $data);
    }

    public function add()
    {
        $id = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('dt_user', ['id' => $id])->row_array();
        $data['judul'] = 'Redanis - Tambah Mitra';
        $data['judul_halaman'] = 'Tambah Mitra';
		$data['type'] = 'add';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mitra/add', $data);
        $this->load->view('templates/footer', $data);
    }

    public function edit($idMitra)
    {
        $id = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('dt_user', ['id' => $id])->row_array();
        $data['judul'] = 'Redanis - Draft Mitra';
        $data['judul_halaman'] = 'Edit Mitra';
        $data['type'] = 'edit';

		$id = $this->input->post('id');
        $data['mitra'] = $this->db->get_where('dt_partnership', ['id' => $idMitra])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('mitra/add', $data);
        $this->load->view('templates/footer', $data);
    }

	public function saveMitra(){
		$this->form_validation->set_rules('partnerName', 'Partner Name', 'required|trim', [
            'required' => "Field Tidak Boleh Kosong"
        ]);
        $this->form_validation->set_rules('partnerAddress', 'Partner Address', 'required|trim', [
            'required' => "Field Tidak Boleh Kosong"
        ]);
        $this->form_validation->set_rules('partnerDistrict', 'Partner District', 'required|trim', [
            'required' => "Field Tidak Boleh Kosong"
        ]);
        $this->form_validation->set_rules('partnerCity', 'Partner City', 'required|trim', [
            'required' => "Field Tidak Boleh Kosong"
        ]);
        $this->form_validation->set_rules('partnerPhone', 'Partner Phone', 'required|trim', [
            'required' => "Field Tidak Boleh Kosong"
        ]);
        // $this->form_validation->set_rules('partnerLocation', 'Partner Location', 'required|trim', [
        //     'required' => "Field Tidak Boleh Kosong"
        // ]);
        // $this->form_validation->set_rules('partnerImage', 'Partner Image', 'required|trim', [
        //     'required' => "Field Tidak Boleh Kosong"
        // ]);

        if ($this->form_validation->run() == false) {
			$id = $this->session->userdata('id');
            $data['user'] = $this->db->get_where('dt_user', ['id' => $id])->row_array();
            $data['judul'] = 'Priority Apps - Tambah Mitra';
            $data['judul_halaman'] = 'Tambah Mitra';
			$data['type'] = 'add';

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('mitra/add', $data);
            $this->load->view('templates/footer', $data);
        } else {
			$this->_insert_dt_partnership();
            redirect('mitra/index');
        }
	}
	
	private function _insert_dt_partnership()
    {
		$idMitra = $this->input->post('idMitra');
		$dt['partner_type'] = $this->input->post('partnerType');
		$dt['partner_name'] = $this->input->post('partnerName');
		$dt['partner_address'] = $this->input->post('partnerAddress');
		$dt['partner_district'] = $this->input->post('partnerDistrict');
		$dt['partner_city'] = $this->input->post('partnerCity');
		$dt['partner_phone'] = $this->input->post('partnerPhone');
		
		if ($dt['partner_type'] === '1') {
			$config = array(
				'upload_path' => './assets/images/public/mitra',
				'allowed_types' => 'png|jpeg|jpg',
				'encrypt_name' => TRUE,
			);
			
			$this->upload->initialize($config);
			
			if ($this->upload->do_upload('partnerImage')) {
				$data = array('upload_data' => $this->upload->data());
			}
			
			$dt['partner_location'] = $this->input->post('partnerLocation');
			$dt['partner_image'] = $data['upload_data']['full_path'];
		}

        $dt['created_at'] = date('y-m-d h:i:s');

		$dt_update = $this->db->get_where('dt_partnership', ['id' => $idMitra])->row_array();

        if (!isset($dt_update)) {
            $this->db->insert('dt_partnership', $dt);
        } else {
            $this->db->where('id', $idMitra);
            $this->db->update('dt_partnership', $dt);
        }
    }

	public function deleteMitra()
	{
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $result = $this->db->delete('dt_partnership');
        echo json_encode($result);
	}
}
