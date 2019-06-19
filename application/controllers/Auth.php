<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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
    $this->session->unset_userdata('id');
    $this->session->unset_userdata('username');

    $this->form_validation->set_rules('username', 'Username', 'required|trim', [
      'required' => "Field Tidak Boleh Kosong"
    ]);
    $this->form_validation->set_rules('password', 'Password', 'required|trim', [
      'required' => "Field Tidak Boleh Kosong"
    ]);
    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Priority Apps - Masuk';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/login', $data);
      $this->load->view('templates/auth_footer', $data);
    } else {
      $this->_login();
    }
  }
  private function _login()
  {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $user = $this->db->get_where('data_user', ['username' => $username])->row_array();

    if ($user != null) {
      if (password_verify($password, $user['password'])) {
        $data = [
          'id' => $user['id'],
          'username' => $user['username']
        ];
        $this->session->set_userdata($data);
        redirect('dashboard');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Maaf! Kata Sandi Salah </div>');
        redirect('/auth');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Maaf! Pengguna Tidak Ditemukan </div>');
      redirect('/auth');
    }
  }
  public function register()
  {
    $this->form_validation->set_rules('nama_depan', 'Nama_Depan', 'required|trim', [
      'required' => "Field Tidak Boleh Kosong"
    ]);
    $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[data_user.username]', [
      'required' => "Field Tidak Boleh Kosong",
      'is_unique' => "Username Telah Digunakan"
    ]);
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[data_user.email]', [
      'required' => "Field Tidak Boleh Kosong",
      'is_unique' => "Email Telah Terdaftar",
      'valid_email' => "Email yang Dimasukkan Tidak Sesuai"
    ]);
    $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
      'required' => "Field Tidak Boleh Kosong",
      'matches' => "Kata Sandi Tidak Sama!",
      'min_length' => "Kata Sandi Terlalu Pendek!"
    ]);
    $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

    if ($this->form_validation->run() == false) {
      $data['judul'] = 'Priority Apps - Daftar';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('auth/register', $data);
      $this->load->view('templates/auth_footer', $data);
    } else {
      $data = [
        'username' => htmlspecialchars($this->input->post('username', true)),
        'nama_depan' => htmlspecialchars($this->input->post('nama_depan', true)),
        'nama_belakang' => htmlspecialchars($this->input->post('nama_belakang', true)),
        'email' => htmlspecialchars($this->input->post('email', true)),
        'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
      ];
      $this->db->insert('data_user', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Selamat! Akun Anda Berhasil Terdaftar, Silahkan Lakukan Login untuk Dapat Menggunakan Sistem </div>');
      redirect('/auth');
    }
  }
  public function logout()
  {
    $this->session->unset_userdata('id');
    $this->session->unset_userdata('username');
    redirect('/auth');
  }
}
