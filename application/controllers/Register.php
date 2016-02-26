<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {


	 function __construct()
	 {
	   parent::__construct();
	   $this->load->library('form_validation');
	   $this->load->model('m_peserta','',TRUE);
	 }

	public function index()
	{
		$this->load->helper(array('form'));
		$this->load->view('register');
	}

	public function doregister()
	{
	$rules = array(
		array('field'=>'nip','label'=>'NIP','rules'=>'trim|required|is_unique[peserta.nip]'),
		array('field'=>'nama','label'=>'Email','rules'=>'trim|required'),
		array('field'=>'hp','label'=>'Hp','rules'=>'trim|required'),
		array('field'=>'email','label'=>'Email','rules'=>'trim|required|valid_email|is_unique[peserta.email]'),
		array('field'=>'instansi','label'=>'Instansi','rules'=>'trim|required'),
		array('field'=>'daerah','label'=>'Daerah','rules'=>'trim|required'),
		array('field'=>'alamat','label'=>'Alamat','rules'=>'trim|required'),
		array('field'=>'telepon','label'=>'Telepon','rules'=>'trim|required'),
		array('field'=>'fax','label'=>'Fax','rules'=>'trim|required')
	);
	$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('register');
		}
		else
		{

			//print_r($_POST);
			$data_reg=$this->m_peserta->register($_POST);
			if($data_reg)
			{
				$this->session->set_flashdata('msg',"Selamat anda telah berhasil mendaftar sebagai peserta PSEKM. Gunakan NIP anda untuk melakukan login.");
				redirect("loginpeserta");
			}
			//$this->load->view('success');
		}
	}

}
