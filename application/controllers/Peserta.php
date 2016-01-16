<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta extends CI_Controller {

	function __construct()
	 {
	   parent::__construct();
	   $this->load->library('form_validation');
	   $this->load->model('m_peserta','',TRUE);
	   $this->load->model('m_pelatihan','',TRUE);
	   $this->load->model('m_lainlain','',TRUE);
	   $this->load->model('m_peserta_has_pelatihan','',TRUE);


	   if($this->session->userdata('logged_in_peserta'))
	   {
	     $session_data = $this->session->userdata('logged_in_peserta');
	     $this->ses_nama= $session_data['nama'];
	     $this->ses_nip= $session_data['nip'];
	     //print_r($session_data);
	   }
	   else
	   {
	     //If no session, redirect to login page
	     redirect('loginpeserta', 'refresh');
	   }

	 }
	public function index()
	{
		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_nip;
		$par['page']='Dashboard';
		$this->load->view('peserta/main',$par);
	 	
	}

	public function mendaftarpelatihan()
	{
		$this->load->helper(array('form'));
		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_nip;
		$par['page']='Mendaftar Pelatihan';

		$param['nip']=$this->ses_nip;
		$data_peserta=$this->m_peserta->getPeserta($param);

		$paramz['status']=1;
		$data_pelatihan_active=$this->m_pelatihan->getPelatihan($paramz);

		$par['peserta']=$data_peserta;
		$par['pelatihan_active']=$data_pelatihan_active;
				
		$this->load->view('peserta/main',$par);
	 	
	}

	function do_upload()
	{
		$config['upload_path'] = './upload/mendaftar';
		$config['max_size']	= '100';
		$config['allowed_types'] = 'xls|xlsx';
		$config['encrypt_name'] = TRUE;
		$new_name = time();
		$config['file_name'] = $new_name;

		$this->load->library('upload', $config);
		$field_name = "userfile";
		if ( ! $this->upload->do_upload($field_name))
		{
			$data['status']=0;
			$data['data'] = array('error' => $this->upload->display_errors());
			
			//$this->load->view('upload_form', $error);
		}
		else
		{
			$data['status']=1;
			$data['data'] = array('upload_data' => $this->upload->data());

			//$this->load->view('upload_success', $data);
		}

		return $data;
	}

	public function doregisterkelompok()
	{
		$rules = array(
			array('field'=>'nip','label'=>'NIP','rules'=>'trim|required'),
			array('field'=>'nama','label'=>'Nama','rules'=>'trim|required'),
			array('field'=>'id_pelatihan','label'=>'Pelatihan','rules'=>'required')
			
		);
		$this->form_validation->set_rules($rules);

		if($this->form_validation->run() == FALSE)
		{
			$this->mendaftarpelatihankelompok();
			//redirect("peserta/mendaftarpelatihan");
			//validation_errors();
		}
		else
		{
			//echo 'sukses';
			//upload
			$data_upload=$this->do_upload($_POST);
			if($data_upload['status']==1)
			{
				//print_r($data_upload);
				$filename=$data_upload['data']['upload_data']['file_name'];
				//echo $filename;
				$par['id_pelatihan_fk']=$_POST['id_pelatihan'];
				$par['id_peserta_fk']=$_POST['id_peserta'];
				$par['filename']=$filename;
				$par['status']=0;

				$upload_xls=$this->m_lainlain->upload_slx($par);
				if($upload_xls)
				{
					$this->session->set_flashdata('msg',"Anda telah terdaftar pada Pelatihan bla bla secara kelompok.");
					redirect("peserta");

				}else
				{
					$this->session->set_flashdata('error','gagal mendaftar');
					redirect("peserta/mendaftarpelatihankelompok");
				}
			}else
			{
				$this->session->set_flashdata('error',"gagal upload");
				redirect("peserta/mendaftarpelatihankelompok");
			}

			/*$par['id_pelatihan_fk']=$_POST['id_pelatihan'];
			$par['id_peserta_fk']=$_POST['id_peserta'];
			$par['payment']=1;
			$par['status']=1;

			$reg=$this->m_peserta_has_pelatihan->register($par);
			if($reg=='sukses')
			{
				$this->session->set_flashdata('msg',"Anda telah terdaftar pada Pelatihan bla bla.");
				redirect("peserta");
			}else {
				//$this->mendaftarpelatihan();
				$this->session->set_flashdata('error',$reg);
				redirect("peserta/mendaftarpelatihan");
			}
			*/
		}
		
	}

	public function doregister()
	{
		$rules = array(
			array('field'=>'nip','label'=>'NIP','rules'=>'trim|required'),
			array('field'=>'nama','label'=>'Nama','rules'=>'trim|required'),
			array('field'=>'id_pelatihan','label'=>'Pelatihan','rules'=>'required')
		);
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == FALSE)
		{
			$this->mendaftarpelatihan();
			//redirect("peserta/mendaftarpelatihan");
		}
		else
		{
			$par['id_pelatihan_fk']=$_POST['id_pelatihan'];
			$par['id_peserta_fk']=$_POST['id_peserta'];
			$par['payment']=1;
			$par['status']=1;

			$reg=$this->m_peserta_has_pelatihan->register($par);
			if($reg=='sukses')
			{
				$this->session->set_flashdata('msg',"Anda telah terdaftar pada Pelatihan bla bla.");
				redirect("peserta");
			}else {
				//$this->mendaftarpelatihan();
				$this->session->set_flashdata('error',$reg);
				redirect("peserta/mendaftarpelatihan");
			}
		}
	}

	function getDatetimeNow() {
	    $tz_object = new DateTimeZone('Asia/Jakarta');
	    //date_default_timezone_set('Brazil/East');

	    $datetime = new DateTime();
	    $datetime->setTimezone($tz_object);
	    return $datetime->format('Y-m-d h-i-s');
	}

	public function makeFileExcel()
	{
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('pendaftaran PSEKP');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('B2', 'PENDAFTARAN PSEKP');
		//change the font size
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(20);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('B2:F2');
		//set aligment to center for that merged cell (A1 to D1)
		//$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->setCellValue('A4', 'No');
		$this->excel->getActiveSheet()->setCellValue('B4', 'NIP');
		$this->excel->getActiveSheet()->setCellValue('C4', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('D4', 'Instansi');
		$this->excel->getActiveSheet()->setCellValue('E4', 'Daerah');
		$this->excel->getActiveSheet()->setCellValue('F4', 'Email');
		$this->excel->getActiveSheet()->setCellValue('G4', 'Hp');
		$this->excel->getActiveSheet()->setCellValue('H4', 'Telepon');
		$this->excel->getActiveSheet()->setCellValue('I4', 'Fax');
		$this->excel->getActiveSheet()->setCellValue('J4', 'Alamat');

		$this->excel->getActiveSheet()->getStyle('A4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('C4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('F4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('G4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('H4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('I4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('J4')->getFont()->setBold(true);
		
		
		$filename='psekp_daftar - '.$this->getDatetimeNow().'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		            
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');

	}


	public function riwayatpelatihan()
	{
		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_nip;
		$par['page']='Riwayat Pelatihan';
		$this->load->view('peserta/main',$par);
	 	
	}

	public function mendaftarpelatihankelompok()
	{
		$this->load->helper(array('form'));
		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_nip;

		$param['nip']=$this->ses_nip;
		$data_peserta=$this->m_peserta->getPeserta($param);

		$paramz['status']=1;
		$data_pelatihan_active=$this->m_pelatihan->getPelatihan($paramz);

		$par['peserta']=$data_peserta;
		$par['pelatihan_active']=$data_pelatihan_active;
		$par['page']='Mendaftar Pelatihan Kelompok';
		$this->load->view('peserta/main',$par);
	 	
	}

	public function logout()
	{
		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_nip;
		$this->session->unset_userdata('logged_in_peserta');
	   	session_destroy();
	   	redirect('loginpeserta', 'refresh');
	}

}
