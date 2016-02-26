
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi extends CI_Controller {


	 function __construct()
	 {
	   parent::__construct();
	   $this->load->model('m_peserta_has_pelatihan','',TRUE);
	   $this->load->model('m_pelatihan','',TRUE);

	 }
	public function index()
	{
		$this->load->helper(array('form'));
		$this->load->view('konfirmasi');
	}

	public function doKonfirmasi()
	{
		$this->load->library('form_validation');

	   $this->form_validation->set_rules('NIP', 'NIP', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('id_peserta', 'id_peserta', 'trim|required|xss_clean|callback_check_database');

	   print_r($_POST);
	   if($this->form_validation->run() == FALSE)
	   {
	     //Field validation failed.  User redirected to login page
	     redirect('konfirmasi');
	   }
	   else
	   {
	     //Go to private area
	     redirect('konfirmasi/dataKonfirmasi');
	   }
	}

	function check_database($id_peserta)
	 {

	   $nip = $this->input->post('NIP');

	   $result = $this->m_peserta_has_pelatihan->konfirmasiPeserta($nip, $id_peserta);

	   if(sizeof($result)!=0)
	   {
	   	//echo $this->m_peserta_has_pelatihan->getSisaQuota($result[0]['id_pelatihan_fk']);
	   	//break 1;
	   	//cek quota
	   	if ($this->m_peserta_has_pelatihan->getSisaQuota($result[0]['id_pelatihan_fk'])>0) {
	   		$par['status_kehadiran']=1;
	   		if($this->m_peserta_has_pelatihan->ubah_peserta_has_pelatihan($id_peserta, $par))
	   		{
	   			$sess_array = array(
		         'id_peserta' => $result[0]['id_peserta_has_pelatihan'],
		         'nip' => $result[0]['nip'],
		         'nama' => $result[0]['nama'],
		         'id_pelatihan' => $result[0]['id_pelatihan_fk']
		       	);
		       //print_r($result);
		       //echo $result[0]['id_user'];
		       //die();
		       	$this->session->set_userdata('sukses_konfirmasi', $sess_array);
	   		}
	   		else
	   		{
	   			$this->session->set_flashdata('error',"Konfirmasi gagal.");
	      		redirect('konfirmasi');		
	   		}
	   	}else
	   	{
	   		$this->session->set_flashdata('error',"Tidak ada quota tersisa	.");
	      	redirect('konfirmasi');

	   	}
	   	
		   	
	     
	   }
	   else
	   {
	     $this->session->set_flashdata('error',"NIP atau id peserta salah.");
	      redirect('konfirmasi');
	   }
	 }

	 function datakonfirmasi()
	 {
	 	if($this->session->userdata('sukses_konfirmasi'))
	   {
	     $session_data = $this->session->userdata('sukses_konfirmasi');
	     $this->ses_nip= $session_data['nip'];
	     $this->ses_nama= $session_data['nama'];
	     $this->ses_id_peserta= $session_data['id_peserta'];
	     $this->ses_id_pelatihan= $session_data['id_pelatihan'];
	     //print_r($session_data);
	   }
	   else
	   {
	     //If no session, redirect to login page
	     redirect('konfirmasi');
	   }

	   $par['id_pelatihan']=$this->ses_id_pelatihan;
	   $data_pelatihan=$this->m_pelatihan->getPelatihan($par);
	   $data['data_pelatihan']=$data_pelatihan;
	   $data['nama']=$this->ses_nama;
	   $data['nip']=$this->ses_nip;
	   $data['mulai_selesai']=$this->getHari($data_pelatihan[0]['date_mulai']).', '.$this->dateToNicer($data_pelatihan[0]['date_mulai']).' - '.$this->getHari($data_pelatihan[0]['date_selesai']).', '.$this->dateToNicer($data_pelatihan[0]['date_selesai']);
	   $data['jam_mulai_selesai']=substr($data_pelatihan[0]['time_mulai'], 0,5).' - '.substr($data_pelatihan[0]['time_selesai'], 0,5);
	   $data['id_peserta']=$this->ses_id_peserta;
	   $this->load->view('konfirmasi_sukses',$data);
	   //echo $this->ses_nama.'\n'.$this->ses_nip.'\n'.$this->ses_id_peserta;

	 }

	 function getHari($tanggal)
		{
			$day = date('D', strtotime($tanggal));
			$dayList = array(
				'Sun' => 'Minggu',
				'Mon' => 'Senin',
				'Tue' => 'Selasa',
				'Wed' => 'Rabu',
				'Thu' => 'Kamis',
				'Fri' => 'Jumat',
				'Sat' => 'Sabtu'
			);

			return $dayList[$day];
		}

		public function dateToNicer($date)
		{
			$day=date('d', strtotime($date));
			$month=date('M', strtotime($date));
			$year=date('Y', strtotime($date));;

			$monthList = array(
				'' => 'null',
				'Jan' => 'Januari',
				'Feb' => 'Februari',
				'Mar' => 'Maret',
				'Apr' => 'April',
				'May' => 'Mei',
				'Jun' => 'Juni',
				'Jul' => 'Juli',
				'Aug' => 'Agustus',
				'Sep' => 'Septermber',
				'Oct' => 'Oktober',
				'Nov' => 'November',
				'Dec' => 'Desember'
			);	

			return $day.' '.$monthList[$month].' '.$year;
		}
	 

}
