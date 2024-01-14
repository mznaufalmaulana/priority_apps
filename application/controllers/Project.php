<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project extends CI_Controller
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
            $this->load->view('project/add_project', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->_Insert_Temp_Project();
            redirect('project/draft');
        }
    }
    public function Draft()
    {
        $id = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('dt_user', ['id' => $id])->row_array();
        $data['judul'] = 'Priority Apps - Draft Proyek';
        $data['judul_halaman'] = 'Draft Proyek';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('project/draft', $data);
        $this->load->view('templates/footer', $data);
    }
    public function Edit_Project()
    {
        $id_proyek = $this->uri->segment(3, 0);
        $id = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('dt_user', ['id' => $id])->row_array();
        $data['judul'] = 'Priority Apps - Draft Proyek';
        $data['judul_halaman'] = 'Draft Proyek';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('project/add_requirement', $data);
        $this->load->view('templates/footer', $data);
    }
    public function Vote()
    {
        $id = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('dt_user', ['id' => $id])->row_array();
        $data['judul'] = 'Priority Apps - Hitung Proyek';
        $data['judul_halaman'] = 'Hitung Proyek';
		$data['options'] = $this->_data_voting();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('project/vote_project', $data);
        $this->load->view('templates/footer', $data);
    }
    public function Voting()
    {
        $id = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('dt_user', ['id' => $id])->row_array();
        $data['judul'] = 'Priority Apps - Hitung Proyek';
        $data['judul_halaman'] = 'Hitung Proyek';

        $id_proyek = $this->uri->segment(3, 0);
        $id = $this->session->userdata('id');
        $data['data_proyek'] = $this->db->get_where('data_proyek', ['id_proyek' => $id_proyek])->row_array();

        $result = $this->db->get_where('data_voting', ['id_proyek' => $id_proyek]);
        $data['data_voting'] = $result->num_rows();

        $this->db->select('*');
        $this->db->from('data_kebutuhan');
        $this->db->where('id_proyek', $id_proyek);
        $data['data_kebutuhan'] = $this->db->get()->result();

		$this->db->select('*');
        $this->db->from('data_voting');
        $this->db->where('id_proyek', $id_proyek);
        $data['data_voting'] = $this->db->get()->result();

		$data['options'] = $this->_data_voting();

		// var_dump($data['options']);die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('project/voting', $data);
        $this->load->view('templates/footer', $data);
    }
    public function Result_Voting()
    {
        $id = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('dt_user', ['id' => $id])->row_array();
        $data['judul'] = 'Priority Apps - Hasil Perhitungan';
        $data['judul_halaman'] = 'Hasil Perhitungan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('project/list_result_voting', $data);
        $this->load->view('templates/footer', $data);
    }
    public function Result()
    {
        $id = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('dt_user', ['id' => $id])->row_array();
        $data['judul'] = 'Priority Apps - Hasil Perhitungan';
        $data['judul_halaman'] = 'Hasil Perhitungan';

        $id_proyek = $this->uri->segment(3, 0);
        $id = $this->session->userdata('id');
        $data['data_proyek'] = $this->db->get_where('data_proyek', ['id_proyek' => $id_proyek])->row_array();

        $this->db->select('*');
        $this->db->from('data_kebutuhan');
        $this->db->where('id_proyek', $id_proyek);
        $data['data_kebutuhan'] = $this->db->get()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('project/result', $data);
        $this->load->view('templates/footer', $data);
    }
    private function _Insert_Temp_Project()
    {
        $id = $this->session->userdata('id');

        $data['id_proyek'] = $this->input->post('id_project');
        $data['nama_proyek'] = $this->input->post('title');
        $data['deskripsi_proyek'] = $this->input->post('description');
        $data['tgl_proyek'] = date('y-m-d h:i:s');
        $data['id_user'] = $id;

        $proyek = $this->db->get_where('temp_data_proyek', ['id_proyek' => $data['id_proyek']])->row_array();

        if (!isset($proyek)) {
            $this->db->insert('temp_data_proyek', $data);
        } else {
            $this->db->update('temp_data_proyek', $data);
            $this->db->where('temp_data_proyek', $data['id_proyek']);
        }
    }
    public function Insert_Temp_Req()
    {
        $message = '';
        $input = $this->input->post();
        $this->db->select('*');
        $this->db->from('temp_data_kebutuhan');
        $this->db->where('id_proyek', $input['id_proyek']);
        $jumlah = $this->db->count_all_results() + 1;

        $data['id_proyek'] = $input['id_proyek'];
        $data['id_kebutuhan'] = 'R' . $jumlah;
        $data['kalimat_kebutuhan'] = $input['kebutuhan'];
        $data['pemilik'] = $input['pemilik'];

        if ($input['kebutuhan'] != null && $input['pemilik'] != null) {
            $this->m->set_req($data);
        }
        $data_kebutuhan = $this->db->get_where('temp_data_kebutuhan', ['id_proyek' => $input['id_proyek']])->result();

        echo json_encode($data_kebutuhan);
    }

    // Edit Proyek
    public function Get_Data_Edit()
    {
        $id_proyek = $this->input->post('id_proyek');
        $data = $this->db->get_where('temp_data_proyek', ['id_proyek' => $id_proyek])->row_array();
        echo json_encode($data);
    }
    public function Save_Data_Edit()
    {
        $input = $this->input->post();
        $data['id_proyek'] = $input['id_proyek'];
        $data['nama_proyek'] = $input['title'];
        $data['deskripsi_proyek'] = $input['description'];

        $this->db->where('id_proyek', $data['id_proyek']);
        $this->db->update('temp_data_proyek', $data);

        redirect('project/draft');
    }
    public function Delete_Temp_Project()
    {
        $input = $this->input->post();
        $data['id_proyek'] = $input['id_proyek'];
        $this->db->where('id_proyek', $data['id_proyek']);
        $result = $this->db->delete('temp_data_proyek');
        echo json_encode($result);
    }

    // Edit Kebutuhan Proyek
    public function Get_Data_Edit_Req()
    {
        $id_proyek = $this->input->post('id_proyek');
        $id_kebutuhan = $this->input->post('id_kebutuhan');
        $data = $this->db->get_where('temp_data_kebutuhan', ['id_proyek' => $id_proyek, 'id_kebutuhan' => $id_kebutuhan])->row_array();
        echo json_encode($data);
    }
    public function Save_Data_Edit_Req()
    {
        $input = $this->input->post();
        $data['id_proyek'] = $input['id_proyek'];
        $data['id_kebutuhan'] = $input['id_kebutuhan'];
        $data['pemilik'] = $input['pemilik'];
        $data['kalimat_kebutuhan'] = $input['kebutuhan'];

        $this->db->where('id_proyek', $data['id_proyek']);
        $this->db->where('id_kebutuhan', $data['id_kebutuhan']);
        $this->db->update('temp_data_kebutuhan', $data);

        redirect('project/edit_project/' . $data['id_proyek']);
    }
    public function Delete_Req()
    {
        $input = $this->input->post();
        $data['id_proyek'] = $input['id_proyek'];
        $data['id_kebutuhan'] = $input['id_kebutuhan'];
        $this->db->where('id_proyek', $data['id_proyek']);
        $this->db->where('id_kebutuhan', $data['id_kebutuhan']);
        $result = $this->db->delete('temp_data_kebutuhan');
        echo json_encode($result);
    }

    // Menyimpan project
    public function Save_Data_Project()
    {
        $id = $this->session->userdata('id');

        $input = $this->input->post();
        $data['id_proyek'] = $input['id_proyek'];
        $data['nama_proyek'] = $input['nama_proyek'];
        $data['deskripsi_proyek'] = $input['deskripsi'];
        $data['tgl_proyek'] = date('y-m-d h:i:s');
        $data['id_user'] = $id;

        $this->db->select('*');
        $this->db->from('temp_data_kebutuhan');
        $this->db->where('id_proyek', $data['id_proyek']);
        $dt = $this->db->get()->result();

        $this->db->insert('data_proyek', $data);

        $this->db->insert_batch('data_kebutuhan', $dt);

        $this->db->where('id_proyek', $data['id_proyek']);
        $this->db->delete('temp_data_proyek');

        redirect('project/vote');
    }

    //mengabil data voting
    public function Get_Data_Voting()
    {
        $id_proyek = $this->input->post('id_proyek');

        $this->db->select('*');
        $this->db->from('data_kebutuhan');
        $this->db->where('id_proyek', $id_proyek);
        $data = $this->db->get()->result();

        echo json_encode($data);
    }
    public function Get_Total_Voting()
    {
        $id_proyek = $this->input->post('id_proyek');

        $result = $this->db->get_where('data_voting', ['id_proyek' => $id_proyek]);
        $data = $result->num_rows();

        echo json_encode($data);
    }
    public function set_data_voting()
    {
        $data['id_proyek'] = $this->input->post('id_proyek');
        $data['id_jarak'] = $this->input->post('id_kebutuhan');
        $data['status'] = $this->input->post('status');

        $jarak = $this->db->get_where('data_voting', ['id_proyek' => $data['id_proyek'], 'id_jarak' => $data['id_jarak']])->row_array();

        if (isset($jarak)) {
            $result = $this->m->set_voting($data, 'update');
        } else {
            $result = $this->m->set_voting($data, 'set');
        }

        echo json_encode($result);
    }
    public function Delete_Project()
    {
        $input = $this->input->post();
        $data['id_proyek'] = $input['id_proyek'];
        $this->db->where('id_proyek', $data['id_proyek']);
        $result = $this->db->delete('data_proyek');
        echo json_encode($result);
    }
	public function result_ahp()
	{
		$id_proyek = $this->input->post('id_proyek');

		// var_dump($id_proyek);die;

		$this->db->select('*');
        $this->db->from('data_voting');
        $this->db->where('id_proyek', $id_proyek);
        $this->db->order_by('id_jarak', "asc");
        $result = $this->db->get()->result();
		
		// var_dump($result);die;

		echo json_encode($result);
	}

	private function _data_voting() {
		$data1 = array();
		$data1['value'] = '1';
		$data1['option'] = 'Memiliki kepentingan yang sama';

		$data2 = array();
		$data2['value'] = '2';
		$data2['option'] = 'Hanya sedikit lebih penting';

		$data3 = array();
		$data3['value'] = '3';
		$data3['option'] = 'Sedikit lebih penting';

		$data4 = array();
		$data4['value'] = '4';
		$data4['option'] = 'Cukup lebih penting';

		$data5 = array();
		$data5['value'] = '5';
		$data5['option'] = 'Lebih penting';

		$data6 = array();
		$data6['value'] = '6';
		$data6['option'] = 'Cukup jelas lebih penting';

		$data7 = array();
		$data7['value'] = '7';
		$data7['option'] = 'Jelas lebih penting';

		$data8 = array();
		$data8['value'] = '8';
		$data8['option'] = 'Cukup mutlak penting';

		$data9 = array();
		$data9['value'] = '9';
		$data9['option'] = 'Mutlak penting';

		// Negatif

		$data10 = array();
		$data10['value'] = '0.5';
		$data10['option'] = 'Hanya sedikit tidak lebih penting';

		$data11 = array();
		$data11['value'] = '0.333';
		$data11['option'] = 'Sedikit tidak lebih penting';

		$data12 = array();
		$data12['value'] = '0.25';
		$data12['option'] = 'Tidak cukup lebih penting';

		$data13 = array();
		$data13['value'] = '0.2';
		$data13['option'] = 'Tidak lebih penting';

		$data14 = array();
		$data14['value'] = '0.167';
		$data14['option'] = 'Cukup jelas tidak lebih penting';

		$data15 = array();
		$data15['value'] = '0.143';
		$data15['option'] = 'Jelas tidak lebih penting';

		$data16 = array();
		$data16['value'] = '0.125';
		$data16['option'] = 'Cukup tidak mutlak penting';

		$data17 = array();
		$data17['value'] = '0.111';
		$data17['option'] = 'Mutlak tidak penting';

		$data = array($data1, $data2, $data3, $data4, $data5, $data6, $data7, $data8, $data9, $data10, $data11, $data12, $data13, $data14, $data15, $data16, $data17);

		// print_r($data); die;
		return $data;
	}
}
