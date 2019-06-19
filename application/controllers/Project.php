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
            $data['user'] = $this->db->get_where('data_user', ['id' => $id])->row_array();
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
        $data['user'] = $this->db->get_where('data_user', ['id' => $id])->row_array();
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
        $data['user'] = $this->db->get_where('data_user', ['id' => $id])->row_array();
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
        $data['user'] = $this->db->get_where('data_user', ['id' => $id])->row_array();
        $data['judul'] = 'Priority Apps - Hitung Proyek';
        $data['judul_halaman'] = 'Hitung Proyek';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('project/vote_project', $data);
        $this->load->view('templates/footer', $data);
    }
    public function Voting()
    {
        $id = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('data_user', ['id' => $id])->row_array();
        $data['judul'] = 'Priority Apps - Hitung Proyek';
        $data['judul_halaman'] = 'Hitung Proyek';

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
        $this->load->view('project/voting', $data);
        $this->load->view('templates/footer', $data);
    }
    public function Result_Voting()
    {
        $id = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('data_user', ['id' => $id])->row_array();
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
        $data['user'] = $this->db->get_where('data_user', ['id' => $id])->row_array();
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
            $this->db->insert('temp_data_kebutuhan', $data);
        }
        $data_kebutuhan = $this->db->get_where('temp_data_kebutuhan', ['id_proyek' => $input['id_proyek']])->result();

        // $no = 1;
        // foreach ($data_kebutuhan as $val) {
        //     $message .= "<tr>" .
        //         "<td align=\"center\">" . $no . "</td>
        //                         <td>" . $val->kalimat_kebutuhan . "</td>
        //                         <td>" . $val->pemilik . "</td>" +
        //         "</tr>";
        //     $no++;
        // }
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
    public function get_data_voting()
    {
        $id_proyek = $this->input->post('id_proyek');

        $this->db->select('*');
        $this->db->from('data_kebutuhan');
        $this->db->where('id_proyek', $id_proyek);
        $data = $this->db->get()->result();
        echo json_encode($data);
    }
    public function set_data_voting()
    {
        $data['id_proyek'] = $this->input->post('id_proyek');
        $data['id_jarak'] = $this->input->post('id_kebutuhan');
        $data['status'] = $this->input->post('status');

        $dt['id_proyek'] = $this->input->post('id_proyek');
        $dt['id_jarak'] = $this->input->post('id_kebutuhan2');
        $dt['status'] = $this->input->post('status2');

        $jarak = $this->db->get_where('data_voting', ['id_proyek' => $data['id_proyek'], 'id_jarak' => $data['id_jarak']])->row_array();

        if (isset($jarak)) {
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
}
