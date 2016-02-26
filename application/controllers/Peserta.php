<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');
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
	     $this->ses_id= $session_data['id'];
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
		$jadwal=$this->m_peserta_has_pelatihan->getJadwal();

		foreach ($jadwal as $key => $value) {
			$date_mulai=$value['date_mulai'];
			$date_selesai=$value['date_selesai'];
			$jadwal[$key]['date_nice']=$this->getHari($date_mulai).', '.$this->dateToNicer($date_mulai).' - '.$this->getHari($date_selesai).', '.$this->dateToNicer($date_selesai);
			$jadwal[$key]['time_nice']=substr($value['time_mulai'], 0,5).' - '.substr($value['time_selesai'], 0,5);
		}

		$par['jadwal']=$jadwal;
		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_nip;
		$par['page']='Dashboard';
		$this->load->view('peserta/main',$par);
	 	
	}

	function sendMail($id_peserta_has_pelatihan)
	{
		$datauntukPDF=$this->m_peserta_has_pelatihan->getForPrintPDF($id_peserta_has_pelatihan);
		//print_r($datauntukPDF);
		//break 1;
		$data = [];

		$day_mulai = date('D', strtotime($datauntukPDF[0]['date_mulai']));
		$day_selesai = date('D', strtotime($datauntukPDF[0]['date_selesai']));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu'
		);
		$data['is_email']=1;
		$data['hari_mulai']=$dayList[$day_mulai];
		$data['hari_selesai']=$dayList[$day_selesai];
		$data['id_peserta_has_pelatihan']=$datauntukPDF[0]['id_peserta_has_pelatihan'];
		$data['nama']=$datauntukPDF[0]['nama'];
		$data['instansi']=$datauntukPDF[0]['instansi'];
		$data['daerah']=$datauntukPDF[0]['daerah'];
		$data['email']=$datauntukPDF[0]['email'];
		$data['hp']=$datauntukPDF[0]['hp'];
        $data['telepon']=$datauntukPDF[0]['telepon'];
        $data['nama_pelatihan']=$datauntukPDF[0]['nama_pelatihan'];
        $data['date_selesai']=$this->dateToNicer($datauntukPDF[0]['date_selesai']);
        $data['date_mulai']=$this->dateToNicer($datauntukPDF[0]['date_mulai']);
        $data['time_mulai']=substr($datauntukPDF[0]['time_mulai'], 0,5);
        $data['time_selesai']=substr($datauntukPDF[0]['time_selesai'], 0,5);
        $data['timestamp']=$this->dateToNicer($datauntukPDF[0]['timestamp']);
        $data['kode_surat']=$datauntukPDF[0]['kode_surat'];
        $data['tempat']=$datauntukPDF[0]['tempat'];
        $message=$this->load->view('pdf/pdf_undangan',$data, true);


	    $config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'rakhmad.ikhsanudin@gmail.com', // change it to yours
		  'smtp_pass' => 'alakazam', // change it to yours
		  'mailtype' => 'html',
		  'wordwarp' => TRUE,
		  'charset' => 'utf-8',
		  'priority' => '1',
		  'wordwrap' => TRUE
		);

	      $this->load->library('email', $config);
	      $this->email->initialize($config);
	      $this->email->set_newline("\r\n");
	      $this->email->from('rakhmad.ikhsanudin@gmail.com'); // change it to yours
	      $this->email->to($datauntukPDF[0]['email']);// change it to yours
	      $this->email->subject('Undangan Bimtek');
	      $this->email->message($message);
	      if($this->email->send())
	     {
	      //echo 'Email sent.';
	     	$result['status']=1;
	     	$result['id_peserta_has_pelatihan']=$id_peserta_has_pelatihan;
	     	$result['msg']='sukses';
	     	return $result;
	     }
	     else
	    {	
	    	$result['id_peserta_has_pelatihan']=$id_peserta_has_pelatihan;
	    	$result['status']=0;
	    	$result['msg']=$this->email->print_debugger();
	    	return $result;

	     	//show_error($this->email->print_debugger());
	    }

	}

	function pdfKonfirmasi($id_peserta_has_pelatihan)
	{

		$datauntukPDF=$this->m_peserta_has_pelatihan->getForPrintPDF($id_peserta_has_pelatihan);
		//print_r($datauntukPDF);
		//break 1;
		$data = [];

		$day_mulai = date('D', strtotime($datauntukPDF[0]['date_mulai']));
		$day_selesai = date('D', strtotime($datauntukPDF[0]['date_selesai']));
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu'
		);
		$data['hari_mulai']=$dayList[$day_mulai];
		$data['hari_selesai']=$dayList[$day_selesai];
		$data['id_peserta_has_pelatihan']=$datauntukPDF[0]['id_peserta_has_pelatihan'];
		$data['nama']=$datauntukPDF[0]['nama'];
		$data['instansi']=$datauntukPDF[0]['instansi'];
		$data['daerah']=$datauntukPDF[0]['daerah'];
		$data['email']=$datauntukPDF[0]['email'];
		$data['hp']=$datauntukPDF[0]['hp'];
        $data['telepon']=$datauntukPDF[0]['telepon'];
        $data['nama_pelatihan']=$datauntukPDF[0]['nama_pelatihan'];
        $data['date_selesai']=$this->dateToNicer($datauntukPDF[0]['date_selesai']);
        $data['date_mulai']=$this->dateToNicer($datauntukPDF[0]['date_mulai']);
        $data['time_mulai']=substr($datauntukPDF[0]['time_mulai'], 0,5);
        $data['time_selesai']=substr($datauntukPDF[0]['time_selesai'], 0,5);
        $data['timestamp']=$this->dateToNicer($datauntukPDF[0]['timestamp']);
        $data['kode_surat']=$datauntukPDF[0]['kode_surat'];
        $data['tempat']=$datauntukPDF[0]['tempat'];
        $pdf_body=$this->load->view('pdf/pdf_konfirmasi',$data, true);

        //	print_r($data);	
        //break 1;

        $pdfFilePath = "output_pdf_name.pdf";

        $this->load->library('m_pdf');

        $this->m_pdf->pdf->WriteHTML($pdf_body);
 
        $this->m_pdf->pdf->Output($pdfFilePath, "D");   
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
				$par['status']=1;

				$upload_xls=$this->m_lainlain->upload_slx($par);
				if($upload_xls)
				{
					//isset($par['status']);
					//$par['status_kehadiran']=1;
					//loop register
					$data_resu_email=null;
					$data_registerall=$this->registerAll($filename,$par);
					if (sizeof($data_registerall['php'])>0) {
						# code...
						foreach ($data_registerall['php'] as $key => $value) {
							# code...
							$resu_email=$this->sendMail($value);
							$data_resu_email[]=$resu_email;
						}
						print_r($data_resu_email);
					
					}
					print_r($data_registerall);
					
					//$this->session->set_flashdata('msg', print_r($data_registerall));
					//redirect("peserta");
					
					

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


		}
		
	}

	public function registerAll($filename,$par)
	{
		$file = './upload/mendaftar/'.$filename;
		$this->load->library('excel');
		$objPHPExcel = PHPExcel_IOFactory::load($file);

		$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
		$data_excel=null;
		foreach ($cell_collection as $cell) {
		    $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
		    $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
		    $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
		    //header will/should be in row 1 only. of course this can be modified to suit your need.
		    
		    if(($column=="A") && $data_value=="")
		    {
		    	 break 1;
		    }

		    if($row>4)
		    {
		    	$data_excel[$row][$column] = $data_value;
		    	
		    }
		}

		$i=0;
		foreach ($data_excel as $key => $value) {
			$data_register[$i]['nip']=$value['B'];
			$data_register[$i]['nama']=$value['C'];
			$data_register[$i]['instansi']=$value['D'];
			$data_register[$i]['daerah']=$value['E'];
			$data_register[$i]['email']=$value['F'];
			$data_register[$i]['hp']=$value['G'];
			$data_register[$i]['telepon']=$value['H'];
			$data_register[$i]['fax']=$value['I'];
			$data_register[$i]['alamat']=$value['J'];
			$data_register[$i]['status']=1;
			$i++;
		}
		//$jumlah_peserta=$this->m_peserta_has_pelatihan->cek_jumlah_peserta($par['id_pelatihan_fk']);
		//$parpelat['id_pelatihan']=$par['id_pelatihan_fk'];
		//$quota=$this->m_pelatihan->getPelatihan($parpelat);
		//$sisa_quota=$quota-$jumlah_peserta;
		$sisa_quota=$this->m_peserta_has_pelatihan->getSisaQuota($par['id_pelatihan_fk']);
		if($sisa_quota>=sizeof($data_register))
		{
			$result = $this->m_peserta->registerAll($data_register,$par);
			//$result= 'dodaftarall';
		}
		else
		{
			$result['result']=0;
			$result['msg']= "Quota yang tersisa tidak mencukupi. Tersisa ".$sisa_quota." quota.";
		}

		//echo '<pre>';
		//print_r($data_register);
		//echo '</pre>';

		return $result;
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
			
			$data_peserta=$this->m_peserta_has_pelatihan->getPesertaHasPelatihan($par);
			if(sizeof($data_peserta)==0)
			{
				$par['payment']=1;
				//$par['status']=1;
				//cek apakah sudah terdaftar
				
				$reg=$this->m_peserta_has_pelatihan->register($par);
				if($reg=='sukses')
				{
					$this->session->set_flashdata('msg',"Anda terdaftar pada Pelatihan.");
					redirect("peserta/mendaftarpelatihan");
				}else {
					//$this->mendaftarpelatihan();
					$this->session->set_flashdata('error',$reg);
					redirect("peserta/mendaftarpelatihan");
				}	
			}else
			{
				$this->session->set_flashdata('error',"anda telah mendaftar di pelatihan ini");
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
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(30);

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


		$this->excel->getActiveSheet()->freezePane('M5');
		$this->excel->getActiveSheet()->getProtection()->setSheet(true); 
		$this->excel->getActiveSheet()->getProtection()->setPassword('passspkp');
		$this->excel->getActiveSheet()->getStyle('A5:L1000')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
		
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

		$riwayat_pelatihan=$this->m_peserta_has_pelatihan->getRiwayatPelatihan($this->ses_id);

		foreach ($riwayat_pelatihan as $key => $value) {
			$date_start=$value['date_mulai'];
			$date_end=$value['date_selesai'];
			$riwayat_pelatihan[$key]['date_nice']=$this->dateToNicer($date_start).' - '.$this->dateToNicer($date_end);
		}

		$par['riwayat_pelatihan']=$riwayat_pelatihan;
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
	   	//redirect('loginpeserta', 'refresh');
		redirect('main', 'refresh');
	}

}
