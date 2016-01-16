<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	 {
	   parent::__construct();
	   $this->load->model('m_peserta','',TRUE);
	   $this->load->model('m_pelatihan','',TRUE);
	   $this->load->model('m_lainlain','',TRUE);
	 
	   if($this->session->userdata('logged_in'))
	   {
	     $session_data = $this->session->userdata('logged_in');
	     $this->ses_nama= $session_data['name'];
	     $this->ses_username= $session_data['username'];
	     //print_r($session_data);
	   }
	   else
	   {
	     //If no session, redirect to login page
	     redirect('login', 'refresh');
	   }

	 }
	public function index()
	{
		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_username;
		$par['page']='Dashboard';
		$this->load->view('admin/main',$par);
	 	
	}

	public function managepeserta()
	{
		$par=null;
		if($_GET)
		{
			$par=$_GET;
		}
		
		if($par)
		{
			$data_peserta=$this->m_peserta->getPesertaLike($par);
			
		}else
		{
			$data_peserta=$this->m_peserta->getPeserta($par);
		}
		$par['peserta']=$data_peserta;
		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_username;
		$par['page']='Manage Peserta';
		$this->load->view('admin/main',$par);
	}

	public function hapusPeserta($id_peserta)
	{
		$par['id_peserta']=$id_peserta;
		if($this->m_peserta->hapusPeserta($par))
		{
			$this->session->set_flashdata('msg',"Hapus peserta berhasil.");
			
			//$this->managepeserta();
			redirect("admin/managepeserta");
			//print_r($data);
			//$this->load->view('upload_form', $error);
		}
		else
		{

			$this->session->set_flashdata('error',"Gagal hapus peserta");
			//$this->managepeserta();
			redirect("admin/managepeserta");
			//$this->load->view('upload_success', $data);
		}
	}

	public function ubahPeserta($id_peserta)
	{
		$par=$_POST;
		if($this->m_peserta->ubahPeserta($id_peserta,$par))
		{
			
			$this->session->set_flashdata('msg',"Ubah peserta berhasil.");
			//$this->managepeserta();
			redirect("admin/managepeserta");
			//print_r($data);
			//$this->load->view('upload_form', $error);
		}
		else
		{

			$this->session->set_flashdata('error',"Gagal ubah peserta");
			//$this->managepeserta();
			redirect("admin/managepeserta");
			//$this->load->view('upload_success', $data);
		}
	}

	public function ubahPelatihan($id_pelatihan)
	{
		$par=$_POST;
		print_r($par);
		
		if($this->m_pelatihan->ubahPelatihan($id_pelatihan,$par))
		{
			$this->session->set_flashdata('msg',"Ubah peserta pelatihan.");
			//$this->managepeserta();
			redirect("admin/managepelatihan");
			//print_r($data);
			//$this->load->view('upload_form', $error);
		}
		else
		{
			$this->session->set_flashdata('error',"Gagal ubah pelatihan");
			
			//$this->managepeserta();
			redirect("admin/managepelatihan");
			//$this->load->view('upload_success', $data);
		}
	}

	public function hapusPelatihan($id_pelatihan)
	{
		$par['id_pelatihan']=$id_pelatihan;
		if($this->m_pelatihan->hapusPelatihan($par))
		{
			$this->session->set_flashdata('msg',"Hapus pelatihan berhasil.");
			
			//$this->managepeserta();
			redirect("admin/managepelatihan");
			//print_r($data);
			//$this->load->view('upload_form', $error);
		}
		else
		{

			$this->session->set_flashdata('error',"Gagal hapus pelatihan");
			//$this->managepeserta();
			redirect("admin/managepelatihan");
			//$this->load->view('upload_success', $data);
		}
	}

	public function managepengajar()
	{
		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_username;
		$par['page']='Manage Pengajar';
		$this->load->view('admin/main',$par);
	}

	public function managepelatihan()
	{
		$par=null;
		if($_GET)
		{
			$par=$_GET;
		}
		
		if($par)
		{
			$data_pelatihan=$this->m_pelatihan->getPelatihanLike($par);	
			
		}else
		{
			$data_pelatihan=$this->m_pelatihan->getPelatihan($par);	
		}

		$par['pelatihan']=$data_pelatihan;	

		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_username;
		$par['page']='Manage Pelatihan';

		$this->load->view('admin/main',$par);
	}

	public function pendaftaranberkelompok($id_pelatihan=null)
	{

		$paramz['status']=1;
		
		$data_pelatihan_active=$this->m_pelatihan->getPelatihan($paramz);

		$para['id_pelatihan_fk']=$id_pelatihan;
		$data_excel=$this->m_lainlain->getUploadExcel($para);

		$par['pelatihan_active']=$data_pelatihan_active;
		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_username;
		$par['page']='Pendaftaran Berkelompok';

		$par['id_pelatihan']=$id_pelatihan;
		$par['data_excel']=$data_excel;

		$this->load->view('admin/main',$par);
	}

	public function logout()
	{
		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_username;
		$this->session->unset_userdata('logged_in');
	   	session_destroy();
	   	redirect('login', 'refresh');
	}

	public function uploadPic($id_peserta)
	{	
		$config['upload_path'] = './upload/peserta';
		$config['max_size']	= '1000';
		$config['allowed_types'] = 'jpeg|jpg';
		$config['encrypt_name'] = FALSE;
		$config['file_name'] = 'peserta_'.$id_peserta.'.jpg';
		$config['overwrite'] = TRUE;


		$this->load->library('upload', $config);
		$field_name = "userfile";
		if ( ! $this->upload->do_upload($field_name))
		{
			$data['status']=0;
			$data['data'] = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$this->upload->display_errors());
			//$this->managepeserta();
			redirect("admin/managepeserta");
			//print_r($data);
			//$this->load->view('upload_form', $error);
		}
		else
		{
			$data['status']=1;
			$data['data'] = array('upload_data' => $this->upload->data());
			//print_r($data);
			$this->session->set_flashdata('msg',"Upload gambar berhasil.");
			//$this->managepeserta();
			redirect("admin/managepeserta");
			//$this->load->view('upload_success', $data);
		}

		
	}

}
