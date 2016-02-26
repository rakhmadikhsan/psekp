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
	   $this->load->model('m_post','',TRUE);
	   $this->load->model('m_peserta','',TRUE);
	   $this->load->model('m_pelatihan','',TRUE);
	   $this->load->model('m_lainlain','',TRUE);
	 	$this->load->model('m_pengajar','',TRUE);
	 	$this->load->model('m_pelatihan_has_pengajar','',TRUE);
	 	$this->load->model('m_peserta_has_pelatihan','',TRUE);
	 	$this->load->model('m_penilaian','',TRUE);
	   if($this->session->userdata('logged_in'))
	   {
	     $session_data = $this->session->userdata('logged_in');
	     $this->ses_nama= $session_data['name'];
	     $this->ses_username= $session_data['username'];
	     $this->ses_role= $session_data['role'];
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
		$par['role']= $this->ses_role;
		if ($par['role']==1) {
			$par['page']='Dashboard';
		}else if ($par['role']==2) {
			$par['page']='Dashboard Penulis';
		}
		
		$this->load->view('admin/main',$par);
	}



	public function reportexcelpelatihan($id_pelatihan)
	{	
		$parPelatihan['id_pelatihan']=$id_pelatihan;
		$dataPelatihan=$this->m_pelatihan->getPelatihan($parPelatihan);


		$dataPesertaPelatihan=$this->m_pelatihan->getPesertaPelatihan($id_pelatihan);

		//print_r($dataPelatihan);
		//	print_r($dataPesertaPelatihan);


		
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Report Pelatihan');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('B2', $dataPelatihan[0]['nama_pelatihan']);
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
		
		$row_num=5;

		foreach ($dataPesertaPelatihan as $key => $value) {
			
			$this->excel->getActiveSheet()->setCellValue('A'.$row_num, $key+1);
			$this->excel->getActiveSheet()->setCellValue('B'.$row_num, $value['nip']);
			$this->excel->getActiveSheet()->setCellValue('C'.$row_num, $value['nama']);
			$this->excel->getActiveSheet()->setCellValue('D'.$row_num, $value['instansi']);
			$this->excel->getActiveSheet()->setCellValue('E'.$row_num, $value['daerah']);
			$this->excel->getActiveSheet()->setCellValue('F'.$row_num, $value['email']);
			$this->excel->getActiveSheet()->setCellValue('G'.$row_num, $value['hp']);
			$this->excel->getActiveSheet()->setCellValue('H'.$row_num, $value['telepon']);
			$this->excel->getActiveSheet()->setCellValue('I'.$row_num, $value['fax']);
			$this->excel->getActiveSheet()->setCellValue('J'.$row_num, $value['alamat']);
			$row_num++;
		}
		
		$filename='report_pelatihan - '.$this->getDatetimeNow().'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		            
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}

	function getDatetimeNow() {
	    $tz_object = new DateTimeZone('Asia/Jakarta');
	    //date_default_timezone_set('Brazil/East');

	    $datetime = new DateTime();
	    $datetime->setTimezone($tz_object);
	    return $datetime->format('Y-m-d h-i-s');
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
		$par['role']= $this->ses_role;
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

	public function ubahPengajar($id_pengajar)
	{
		$par=$_POST;
		$tanggal_lahir=$_POST['tanggal_lahir'];
		$exp_tanggal_lahir=explode(' - ', $tanggal_lahir);
		//$par['tanggal_lahir']=$exp_tanggal_lahir[0];
		$exp_tgl=explode('/', $exp_tanggal_lahir[0]);
		$par['tanggal_lahir']=$exp_tgl[2].'-'.$exp_tgl[0].'-'.$exp_tgl[1];
		//print_r(explode(' - ', $tanggal_lahir));
		//break 1;
		if($this->m_pengajar->ubahPengajar($id_pengajar,$par))
		{
			$this->session->set_flashdata('msg',"Ubah pengajar berhasil.");
			redirect("admin/managepengajar");
		}
		else
		{
			$this->session->set_flashdata('error',"Gagal ubah pengajar");
			redirect("admin/managepengajar");
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
		
		$datetimerange=$par['datetimerange'];
		unset($par['datetimerange']);

		$exp_datetimerange=explode(' - ',$datetimerange);
		$exp_start=explode(' ', $exp_datetimerange[0]);
		$exp_end=explode(' ', $exp_datetimerange[1]);
		$par['date_mulai']=$exp_start[0];
		$par['date_selesai']=$exp_end[0];
		$par['time_mulai']=$exp_start[1];
		$par['time_selesai']=$exp_end[1];
		//print_r($par);
		//echo '<br>';
		//print_r($exp_datetimerange);
		
		//break 1;		
		if($this->m_pelatihan->ubahPelatihan($id_pelatihan,$par))
		{
			$this->session->set_flashdata('msg',"Ubah pelatihan berhasil.");
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

	public function tambahnavsubnav()
	{
		print_r($_POST);



		if($_POST['subnav']=='')
		{
			$parNav['kategori_parent']=$_POST['nav'];
			$parNav['parent_another_link']=$_POST['link'];
			$parNav['status']=1;
			$parNav['deleteable']=1;
			
			if($this->m_post->tambahNav($parNav))
			{
				$this->session->set_flashdata('msg',"Tambah berhasil.");
				redirect("admin/navigasi");
			}
			else
			{
				$this->session->set_flashdata('error',"Gagal tambah.");
		
				redirect("admin/navigasi");
			}
		}else
		{
			$parNav['kategori_parent']=$_POST['nav'];
			$parNav['kategori']=$_POST['subnav'];
			$parNav['another_link']=$_POST['link'];
			$parNav['status']=1;
			$parNav['deleteable']=1;
			
			if($this->m_post->tambahSubNav($parNav))
			{
				$this->session->set_flashdata('msg',"Tambah berhasil.");
				redirect("admin/navigasi");
			}
			else
			{
				$this->session->set_flashdata('error',"Gagal tambah.");
		
				redirect("admin/navigasi");
			}
		}
	}

	public function tambahbannermitra()
	{

		if($this->m_post->tambahBannernMitra($_POST))
		{
			$this->session->set_flashdata('msg',"Tambah berhasil.");
			//$this->managepeserta();
			redirect("admin/bannerdanmitra");
			//print_r($data);
			//$this->load->view('upload_form', $error);
		}
		else
		{
			$this->session->set_flashdata('error',"Gagal tambah.");
	
			redirect("admin/bannerdanmitra");
		}
	}

	public function tambahPelatihan()
	{
		$par=$_POST;
		
		$datetimerange=$par['datetimerange'];
		unset($par['datetimerange']);

		$exp_datetimerange=explode(' - ',$datetimerange);
		$exp_start=explode(' ', $exp_datetimerange[0]);
		$exp_end=explode(' ', $exp_datetimerange[1]);
		$par['date_mulai']=$exp_start[0];
		$par['date_selesai']=$exp_end[0];
		$par['time_mulai']=$exp_start[1];
		$par['time_selesai']=$exp_end[1];
		//print_r($par);
		//echo '<br>';
		//print_r($exp_datetimerange);
		
		//break 1;		
		if($this->m_pelatihan->tambahPelatihan($par))
		{
			$this->session->set_flashdata('msg',"Tambah pelatihan berhasil.");
			//$this->managepeserta();
			redirect("admin/managepelatihan");
			//print_r($data);
			//$this->load->view('upload_form', $error);
		}
		else
		{
			$this->session->set_flashdata('error',"Gagal tambah pelatihan.");
			
			//$this->managepeserta();
			redirect("admin/managepelatihan");
			//$this->load->view('upload_success', $data);
		}
	}

	public function tambahPengajar()
	{
		$par=$_POST;

		$tgl_lahir=$_POST['tanggal_lahir'];
		$exp_tgl_lahir=explode("/", $tgl_lahir);
		$par['tanggal_lahir']=$exp_tgl_lahir[2].'-'.$exp_tgl_lahir[0].'-'.$exp_tgl_lahir[1];
		//print_r($par);
		//break 1;
		if($this->m_pengajar->tambahPengajar($par))
		{
			$this->session->set_flashdata('msg',"Tambah pengajar berhasil.");
			//$this->managepeserta();
			redirect("admin/managepengajar");
			//print_r($data);
			//$this->load->view('upload_form', $error);
		}
		else
		{
			$this->session->set_flashdata('error',"Gagal tambah pengajar.");
			
			//$this->managepeserta();
			redirect("admin/managepengajar");
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

	public function hapusPengajar($id_pengajar)
	{
		$par['id_pengajar']=$id_pengajar;
		if($this->m_pengajar->hapusPengajar($par))
		{
			$this->session->set_flashdata('msg',"Hapus pengajar berhasil.");
			
			redirect("admin/managepengajar");

		}
		else
		{

			$this->session->set_flashdata('error',"Gagal hapus pengajar");
			redirect("admin/managepengajar");
		}
	}

	public function managepengajar()
	{
		$par=null;
		if($_GET)
		{
			$par=$_GET;
		}
		
		if($par)
		{
			$data_pengajar=$this->m_pengajar->getPengajarLike($par);
			
		}else
		{
			$data_pengajar=$this->m_pengajar->getPengajar($par);
		}

		$parpengajar=null;

		$par['data_pengajar']=$data_pengajar;
		foreach ($par['data_pengajar'] as $key => $value) {
			if ($value['tanggal_lahir']!="") {
				$tgl=$value['tanggal_lahir'];
				$ex_tgl=explode("-", $tgl);
				$par['data_pengajar'][$key]['tanggal_lahir']=$ex_tgl[1].'/'.$ex_tgl[2].'/'.$ex_tgl[0];
			}
			
		}
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Manage Pengajar';
		//print_r($par['data_pengajar']);
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
		$par['role']= $this->ses_role;
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
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Pendaftaran Berkelompok';

		$par['id_pelatihan']=$id_pelatihan;
		$par['data_excel']=$data_excel;

		$this->load->view('admin/main',$par);
	}

	public function datapenilaian($id_pelatihan=null, $id_pengajar=null)
	{
		$paramz=null;
		$data_pelatihan_active=$this->m_pelatihan->getPelatihan($paramz);
		$paramza['id_pelatihan']=$id_pelatihan;
		$data_pelatihan=$this->m_pelatihan->getPelatihan($paramza);

		$data_pengajar=$this->m_pelatihan_has_pengajar->getPengajarPelatihan($id_pelatihan);

		$parapara['id_pelatihan_has_pengajar']=$id_pengajar;
		$pengajar=$this->m_pelatihan_has_pengajar->get_pelatihan_has_pengajar($parapara);


		$result_penilaian= $this->m_penilaian->getResultPenilaian($id_pengajar);
		$res_pen=[];
		$id_poin=0;
		$od_kat=0;
		foreach ($result_penilaian as $key => $value) {
			$res_pen[$value['id_kategori_point_fk']]['id_kategori']=$value['id_kategori_point_fk'];
			$res_pen[$value['id_kategori_point_fk']]['kategori']=$value['kategori_point'];
			$res_pen[$value['id_kategori_point_fk']]['point'][$value['id_pelatihan_has_point_penilaian_fk']]['id_point']=$value['id_pelatihan_has_point_penilaian_fk'];
			$res_pen[$value['id_kategori_point_fk']]['point'][$value['id_pelatihan_has_point_penilaian_fk']]['point']=$value['point_penilaian'];
			$res_pen[$value['id_kategori_point_fk']]['point'][$value['id_pelatihan_has_point_penilaian_fk']][$value['nilai']]=$value['jumlah'] ;

		}
		$paraz['id_pelatihan_has_pengajar_fk']=$id_pengajar;
		$data_submited=$this->m_penilaian->getPenilaianSubmited($paraz);

		$parphp['id_pelatihan_fk']=$id_pelatihan;
		$parphp['status_kehadiran']=1;
		$semua_peserta=$this->m_peserta_has_pelatihan->getPesertaHasPelatihan($parphp);

		$parag['id_pelatihan_has_pengajar_fk']=$id_pengajar;
		$penilaian_pengajar=$this->m_penilaian->getpenilaianpengajar($parag);
		$par['pelatihan_active']=$data_pelatihan_active;
		$par['data_pengajar']=$data_pengajar;
		$par['id_pelatihan']=$id_pelatihan;
		$par['data_pelatihan']=$data_pelatihan;
		$par['id_pelatihan']=$id_pelatihan;
		$par['id_pengajar']=$id_pengajar;
		$par['data_submited']=sizeof($data_submited);
		$par['jumlah_peserta']=sizeof($semua_peserta);
		$par['result_penilaian']=$res_pen;
		$par['penilaian_pengjar_kritik_saran']=$penilaian_pengajar;
		$par['pengajar']=$pengajar;
		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_username;
		$par['role']= $this->ses_role;
		$par['page']='Data Penilaian';
		$this->load->view('admin/main',$par);
	}

	public function penilaian($id_pelatihan=null)
	{
		$paramz=null;
		$data_pelatihan_active=$this->m_pelatihan->getPelatihan($paramz);

		$paramza['id_pelatihan']=$id_pelatihan;
		$data_pelatihan=$this->m_pelatihan->getPelatihan($paramza);


		$data_point=$this->m_penilaian->getPointPenilaian($id_pelatihan);
		// $data_point_penilaian=null;
		// $id_kategori_temp=null;
		// foreach ($data_point as $key => $value) {
		// 	$id_kategori=$value['id_kategori_point'];
		// 	$kategori=$value['kategori_point'];
		// 	if($value['id_kategori_point']!=$id_kategori_temp)
		// 	{
		// 		$data_kategori['id_kategori_poin']=$id_kategori;
		// 		$data_kategori['kategori_poin']=$kategori;
		// 		$data_poin=null;
		// 		foreach ($data_point as $key => $valu) {
		// 			if ($id_kategori==$valu['id_kategori_point']) {
		// 				$id_pelatihan_has_poin=$valu['id_pelatihan_has_point_penilaian'];
		// 				$id_point_penilaian=$valu['id_point_penilaian'];
		// 				$point_penilaian=$valu['point_penilaian'];
		// 				$dtPen['id_pelatihan_has_poin']=$id_pelatihan_has_poin;
		// 				$dtPen['id_point_penilaian']=$id_point_penilaian;
		// 				$dtPen['point_penilaian']=$point_penilaian;

		// 				$data_poin[]=$dtPen;
		// 			}
					
		// 		}
		// 		$data_kategori['points']=$data_poin;
		// 		$data_point_penilaian[]=$data_kategori;

		// 		$id_kategori_temp=$value['id_kategori_point'];
		// 	}
		// }

		// foreach ($data_point as $key => $valu) {
		// 	$id_kategori=$value['id_kategori_point'];
		// 	$id_pelatihan_has_poin=$value['id_pelatihan_has_point_penilaian'];
		// 	$id_point_penilaian=$value['id_point_penilaian'];
		// 	$point_penilaian=$value['point_penilaian'];

		// }
		$parkat=null;
		$kategori= $this->m_penilaian->getKategori($parkat);

		$parPo=null;
		$point= $this->m_penilaian->getpoint($parPo);

		$par['pelatihan_active']=$data_pelatihan_active;
		$par['data_point_penilaian']=$data_point;
		$par['data_kategori']=$kategori;
		$par['data_point']=$point;
		$par['data_pelatihan']=$data_pelatihan;
		$par['id_pelatihan']=$id_pelatihan;
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Penilaian';
		$this->load->view('admin/main',$par);
	}

	public function tambahkanpenilaian()
	{
		//echo '<pre>';
		//print_r($_POST);
		//echo '</pre>';
		$data=$_POST;
		$result=null;
		$par['id_pelatihan_has_pengajar_fk']=$data['id_pelatihan_has_pengajar'];
		$par['kritik_saran']=$data['kritik_saran'];

		foreach ($data['idaspek'] as $key => $value) {
			
			$par['detail'][$key]['id_pelatihan_has_point_penilaian_fk']=$value['id'];
			$par['detail'][$key]['nilai']=$value['nilai'];
			
		}

		
		$result=$this->m_penilaian->penilaian_pengajar($par);

		if($result)
		{
			$this->session->set_flashdata('msg',"Penilaian tersimpan.");
			redirect("admin/submitpenilaian/".$_POST['id_pelatihan'].'/'.$_POST['id_pelatihan_has_pengajar']);
		}
		else
		{

			$this->session->set_flashdata('error',"Gagal menyimpan penilaian.");
			//$this->managepeserta();
			redirect("admin/submitpenilaian/".$_POST['id_pelatihan'].'/'.$_POST['id_pelatihan_has_pengajar']);
			//$this->load->view('upload_success', $data);
		}
	}

	public function submitpenilaian($id_pelatihan=null,$id_pengajar=null)
	{
		$paramz=null;
		$data_pelatihan_active=$this->m_pelatihan->getPelatihan($paramz);

		$paramza['id_pelatihan']=$id_pelatihan;
		$data_pelatihan=$this->m_pelatihan->getPelatihan($paramza);


		$data_pengajar=$this->m_pelatihan_has_pengajar->getPengajarPelatihan($id_pelatihan);
		$data_point=$this->m_penilaian->getPointPenilaian($id_pelatihan);

		$paraz['id_pelatihan_has_pengajar_fk']=$id_pengajar;
		$data_submited=$this->m_penilaian->getPenilaianSubmited($paraz);

		//$data_penilaian=$this->m_penilaian->getpenilaian($id_pelatihan);

		//$data_pengajar_untuk_penilaian=$this->m_penilaian->data_pengajar_untuk_penilaian($id_pelatihan);

		//$par['data_penilaian']=$data_penilaian;

		$parphp['id_pelatihan_fk']=$id_pelatihan;
		$parphp['status_kehadiran']=1;
		$semua_peserta=$this->m_peserta_has_pelatihan->getPesertaHasPelatihan($parphp);

		$par['data_pengajar']=$data_pengajar;
		$par['pelatihan_active']=$data_pelatihan_active;
		$par['jumalh_peserta']=sizeof($semua_peserta);
		//$par['data_pengajar_untuk_penilaian']=$data_pengajar_untuk_penilaian;
		$par['data_point']=$data_point;
		$par['data_submited']=sizeof($data_submited);
		$par['data_pelatihan']=$data_pelatihan;
		$par['id_pelatihan']=$id_pelatihan;
		$par['id_pengajar']=$id_pengajar;
		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_username;
		$par['role']= $this->ses_role;
		$par['page']='Submit Penilaian';
		$this->load->view('admin/main',$par);
	}

	public function sertifikat($id_pelatihan=null)
	{
		$paramz=null;
		//$paramz['status']=1;
		$data_pelatihan_active=$this->m_pelatihan->getPelatihan($paramz);

		$data_peserta=$this->m_pelatihan->getPesertaPelatihan($id_pelatihan);

		$paramza['id_pelatihan']=$id_pelatihan;
		$data_pelatihan=$this->m_pelatihan->getPelatihan($paramza);

		$par['pelatihan_active']=$data_pelatihan_active;
		$par['data_pelatihan']=$data_pelatihan;
		$par['data_peserta']=$data_peserta;
		$par['id_pelatihan']=$id_pelatihan;
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Sertifikat';
		$this->load->view('admin/main',$par);
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

	public function semuapost()
	{
		$par=null;
		$dataPost= $this->m_post->getPost($par);


		$par['data_post']=$dataPost;
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Semua Post';
		$this->load->view('admin/main',$par);
	}
	public function beritapost()
	{
		$par['tipe']="1";
		$par['status']="1";
		$dataPost= $this->m_post->getPost($par);


		$par['data_post']=$dataPost;
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Berita Post';
		$this->load->view('admin/main',$par);
	}
	public function Pengumumanpost()
	{
		$par['tipe']="2";
		$par['status']="1";
		$dataPost= $this->m_post->getPost($par);


		$par['data_post']=$dataPost;
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Pengumuman Post';
		$this->load->view('admin/main',$par);
	}
	public function Agendapost()
	{
		$par['tipe']="3";
		$par['status']="1";
		$dataPost= $this->m_post->getPost($par);


		$par['data_post']=$dataPost;
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Agenda Post';
		$this->load->view('admin/main',$par);
	}

	public function linknavpost()
	{
		$par['tipe']="4";
		$par['status']="1";
		$dataPost= $this->m_post->getPost($par);


		$par['data_post']=$dataPost;
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Link Nav';
		$this->load->view('admin/main',$par);
	}

	public function draftpost()
	{
		
		$par['status']="0";
		$dataPost= $this->m_post->getPost($par);


		$par['data_post']=$dataPost;
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Draft';
		$this->load->view('admin/main',$par);
	}

	public function trashpost()
	{
		
		$par['status']="2";
		$dataPost= $this->m_post->getPost($par);


		$par['data_post']=$dataPost;
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Trash';
		$this->load->view('admin/main',$par);
	}

	public function editpost($id_post)
	{
		$para['id_post']=$id_post;
		$dataPost=$this->m_post->getPost($para);

		$par['data_post']=$dataPost[0];
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Edit Post';
		$this->load->view('admin/main',$par);
	}	

	public function tambahpost()
	{
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Tambah Post';
		$this->load->view('admin/main',$par);
	}

	public function doEditPost()
	{
		$id_post=$_POST['id_post'];
		
		$par['judul']=$_POST['judul'];
		$par['content']=$_POST['content'];
		$par['link']=$_POST['perma'];
		$par['tipe']=$_POST['tipe'];
		
		
		$ubahpost=$this->m_post->ubahpost($id_post, $par);
		if($ubahpost)
		{

			$this->session->set_flashdata('msg',"Sukses merubah post.");
			redirect("admin/editpost/".$id_post);
		}
		else
		{

			$this->session->set_flashdata('error',"Gagal merubah post.");
			//$this->managepeserta();
			redirect("admin/editpost/".$id_post);
			//$this->load->view('upload_success', $data);
		}
	}

	public function dohapus($id_post)
	{
		$par['id_post']=$id_post;
		$par['status']=2;
		
		
		$hapusPost=$this->m_post->ubahpost($id_post, $par);
		if($hapusPost)
		{

			$this->session->set_flashdata('msg',"Sukses hapus post.");
			redirect("admin/trashpost/");
		}
		else
		{
			$this->session->set_flashdata('error',"Gagal ubah post.");
			//$this->managepeserta();
			redirect("admin/trashpost/");
			//$this->load->view('upload_success', $data);
		}
	}

	public function dopublish($id_post)
	{
		$par['id_post']=$id_post;
		$par['status']=1;
		
		
		$publishpost=$this->m_post->ubahpost($id_post, $par);
		if($publishpost)
		{

			$this->session->set_flashdata('msg',"Sukses publish post.");
			redirect("admin/semuapost/");
		}
		else
		{
			$this->session->set_flashdata('error',"Gagal publish post.");
			//$this->managepeserta();
			redirect("admin/semuapost/");
			//$this->load->view('upload_success', $data);
		}
	}

	public function dounpublish($id_post)
	{
		$par['id_post']=$id_post;
		$par['status']=0;
		
		
		$publishpost=$this->m_post->ubahpost($id_post, $par);
		if($publishpost)
		{

			$this->session->set_flashdata('msg',"Sukses unpublish post.");
			redirect("admin/semuapost/");
		}
		else
		{
			$this->session->set_flashdata('error',"Gagal unpublish post.");
			//$this->managepeserta();
			redirect("admin/semuapost/");
			//$this->load->view('upload_success', $data);
		}
	}

	public function doTambahPost()
	{
		$par['judul']=$_POST['judul'];
		$par['content']=$_POST['content'];
		$par['link']=$_POST['perma'];
		$par['tipe']=$_POST['tipe'];
		$par['status']=1;
		

		$id_post_ins=$this->m_post->tambahPost($par);
		if($id_post_ins	)
		{
			$this->session->set_flashdata('msg',"Posting sukses.");
			redirect("admin/semuapost/");
		}
		else
		{

			$this->session->set_flashdata('error',"Gagal memposting.");
			//$this->managepeserta();
			redirect("admin/tambahpost/");
			//$this->load->view('upload_success', $data);
		}
	}

	public function doTambahDraft($par)
	{
		$par['judul']=$_POST['judul'];
		$par['content']=$_POST['content'];
		$par['link']=$_POST['perma'];
		$par['tipe']=$_POST['tipe'];
		$par['status']=0;
		

		$id_post_ins=$this->m_post->tambahPost($par);
		if($id_post_ins	)
		{
			$this->session->set_flashdata('msg',"Draft tersimpan.");
			redirect("admin/semuapost/");
		}
		else
		{

			$this->session->set_flashdata('error',"Gagal menyimpan draft.");
			//$this->managepeserta();
			redirect("admin/tambahpost/");
			//$this->load->view('upload_success', $data);
		}
	}

	public function navigasi()
	{
		$dataNavSemua=null;
		$dataNavParent=$this->m_post->getNavParent(null);
		foreach ($dataNavParent as $key => $value) {
			$parnavchild['id_kategori_parent']=$value['id_kategori_parent'];
			$datachild=$this->m_post->getNavChild($parnavchild);
			$dataNavSemua[$key]['parent']=$value;
			$dataNavSemua[$key]['child']=$datachild;
		}

		$par['nav']=$dataNavSemua;
		$par['nav_parent']=$dataNavSemua;
		$par['nav_child']=$dataNavSemua;
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Navigasi';
		$this->load->view('admin/main',$par);
	}	

	public function images()
	{
		$this->load->helper('directory');
		$map = directory_map('./upload/post_images');

		$par['map']=$map;

		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Images';
		$this->load->view('admin/main',$par);
	}

	public function setimages()
	{
		$para=null;
		$dataconfigimage=$this->m_post->getSetImages($para);

		$par['dataimageconfig']=$dataconfigimage;
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Set Images';
		$this->load->view('admin/main',$par);
	}

	public function bannerdanmitra()
	{
		$parbanner['tipe']=1;
		$databanner=$this->m_post->getbannerdanmitra($parbanner);

		$parmitra['tipe']=2;
		$datamitra=$this->m_post->getbannerdanmitra($parmitra);

		$par['banner']=$databanner;
		$par['mitra']=$datamitra;

		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Banner dan Mitra';
		$this->load->view('admin/main',$par);
	}

	public function xeditbannermitra($field)
	{
		 //sleep(1); 
	    //$this->load->model('m_peserta_has_pelatihan','',TRUE);
	    $pk = $_POST['pk'];
	    //$name = $_POST['name'];
	    $value = $_POST['value'];
	    
	    if(!empty($value)) {
	       	$par=null;
	       	if ($field==1) {
	       		$par['nama']=$value;
	       	}else if ($field==2) {
	       		$par['src']=$value;
	       	}else if ($field==3) {
	       		$par['link']=$value;
	       	}
	       	
	        if($this->m_post->ubah_bannerdanmitra($pk,$par))
	        {
	        //	eccho 'success';
	        }
	    } else {

	        header('HTTP/1.0 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}

	public function xeditNav($tipe)
	{
		$pk = $_POST['pk'];
	    $value = $_POST['value'];
	    
	    if(!empty($value)) {
	       	$par=null;
	       	if ($tipe==1) {
	       		$par['kategori_parent']=$value;
	       	}else if ($tipe==2)
	       	{
	       		$par['parent_another_link']=$value;
	       	}
	       	
	       	
	        if($this->m_post->ubahNav($pk,$par))
	        {
	        //	eccho 'success';
	        }
	    } else {

	        header('HTTP/1.0 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}

	public function xeditSubNav($tipe)
	{
		$pk = $_POST['pk'];
	    $value = $_POST['value'];
	    
	    if(!empty($value)) {
	       	$par=null;
	       	if ($tipe==1) {
	       		$par['kategori']=$value;
	       	}else if ($tipe==2)
	       	{
	       		$par['another_link']=$value;
	       	}
	       	
	       	
	        if($this->m_post->ubahSubNav($pk,$par))
	        {
	        //	eccho 'success';
	        }
	    } else {

	        header('HTTP/1.0 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}

	public function dosetimage()
	{
		//print_r($_POST);
		$id=$_POST['id'];
		$src= str_replace(base_url(), '', $_POST['src']);

		//echo $src;

		$par['src']=$src;

		$ubahimgconfig= $this->m_post->ubahimageconfig($id,$par);

		if($ubahimgconfig)
		{
			$this->session->set_flashdata('msg',"Ubah image config sukses.");
			redirect("admin/setimages");
		}
		else
		{
			$this->session->set_flashdata('error',"Gagal ubah image config");
			redirect("admin/setimages");
		}
	}

	public function detailpelatihan($id_pelatihan=null)
	{
		$paramz['status']=1;
		$data_pelatihan_active=$this->m_pelatihan->getPelatihan($paramz);

		$parpeng['status']=1;
		$data_pengajar_active=$this->m_pengajar->getPengajar($parpeng);

		$paramza['id_pelatihan']=$id_pelatihan;
		$data_pelatihan=$this->m_pelatihan->getPelatihan($paramza);


		$data_peserta=$this->m_pelatihan->getPesertaPelatihan($id_pelatihan);
		
		$data_pengajar=$this->m_pelatihan_has_pengajar->getPengajarPelatihan($id_pelatihan);

		$par['pelatihan_active']=$data_pelatihan_active;
		$par['data_pelatihan']=$data_pelatihan;

		$date_start_end=null;
		if(sizeof($data_pelatihan)!=0)
		{	$dt_start=$data_pelatihan[0]['date_mulai'];
			$dt_end=$data_pelatihan[0]['date_selesai'];
			$date_start_end= $this->getHari($dt_start).', '.$this->dateToNicer($dt_start).' - '.$this->getHari($dt_end).', '.$this->dateToNicer($dt_end);
		}
		$par['date_start_end']=$date_start_end;
		
		foreach ($data_pengajar as $key => $value) {
			$tgl_mengisi=$value['tanggal_mengisi'];
			$hari=$this->getHari($tgl_mengisi);
			$datenice=$this->dateToNicer($tgl_mengisi);
			$data_pengajar[$key]['date_nice']=$hari.', '.$datenice;
		}
		$par['data_pengajar']=$data_pengajar;
		$par['data_peserta']=$data_peserta;
		$par['pengajar_active']=$data_pengajar_active;
		$par['id_pelatihan']=$id_pelatihan;
		$par['name']= $this->ses_nama;
		$par['role']= $this->ses_role;
		$par['username']= $this->ses_username;
		$par['page']='Detail Pelatihan';
		$this->load->view('admin/main',$par);
	}

	public function tambahPointPenilaian()
	{
		$resIns=$this->m_penilaian->tambahPoinPenilaian($_GET);
		if($resIns)
		{
			$this->session->set_flashdata('msg',"Poin penilaian ditambahkan.");
			redirect("admin/penilaian/".$_GET['id_pelatihan']);
		}
		else
		{

			$this->session->set_flashdata('error',"Gagal menambah poin penilaian.");
			//$this->managepeserta();
			redirect("admin/penilaian/".$_GET['id_pelatihan']);
			//$this->load->view('upload_success', $data);
		}
	}

	public function tambahPenilaian()
	{
		//print_r($_POST);
		$par=$_POST;
		$id_pelatihan=$par['id_pelatihan'];
		unset($par['id_pelatihan']);
		$resIns=$this->m_penilaian->tambahPenilaian($par);
		$par['id_penilaian']=$resIns;
		echo json_encode($par);
		//echo $resIns;
		
		// if($resIns)
		// {
		// 	$this->session->set_flashdata('msg',"Penilaian ditambahkan.");
		// 	redirect("admin/submitpenilaian/".$id_pelatihan);
		// }
		// else
		// {
		// 	$this->session->set_flashdata('error',"Gagal menambah penilaian penilaian.");
		// 	redirect("admin/submitpenilaian/".$id_pelatihan);
		// }
		
	}

	public function tambahpelatihanhaspengajar()
	{
		$par=$_POST;
		$par=$_POST;
		$tgl_mengisi=$_POST['tanggal_mengisi'];
		$exp_tgl_mengisi=explode("/", $tgl_mengisi);
		$par['tanggal_mengisi']=$exp_tgl_mengisi[2].'-'.$exp_tgl_mengisi[0].'-'.$exp_tgl_mengisi[1];


		if($this->m_pelatihan_has_pengajar->tambah_pelatihan_has_pengajar($par))
		{
			$this->session->set_flashdata('msg',"Pengajar ditambahkan.");
			
			//$this->managepeserta();
			redirect("admin/detailpelatihan/".$_POST['id_pelatihan_fk']);
			//print_r($data);
			//$this->load->view('upload_form', $error);
		}
		else
		{

			$this->session->set_flashdata('error',"Gagal menambakan pengajar.");
			//$this->managepeserta();
			redirect("admin/detailpelatihan/".$_POST['id_pelatihan_fk']);
			//$this->load->view('upload_success', $data);
		}
	}

	public function hapuspesertahaspelatihanarray()
	{
		//echo json_encode($_POST);
		$id_kehadiran=$_POST['id_kehadiran'];
		if($this->m_peserta_has_pelatihan->hapus_kehadiran_array($id_kehadiran))
		{
			//$this->session->set_flashdata('msg',"Kehadiran peserta dihapus.");
			
			//$this->managepeserta();
			//redirect("admin/detailpelatihan/".$id_pelatihan);
			//print_r($data);
			//$this->load->view('upload_form', $error);
			echo 'sukses';
		}
		else
		{
			echo 'gagal';
			//$this->session->set_flashdata('error',"Gagal menghapus kehadiran.");
			//$this->managepeserta();
			//redirect("admin/detailpelatihan/".$id_pelatihan);
			//$this->load->view('upload_success', $data);
		}
		//redirect("admin/detailpelatihan/".$_POST['id_pelatihan']);
		//print_r($_POST);
	}

	public function hapuspoinpenilaian($id_pelatihan_has_point_penilaian,$id_pelatihan)
	{
		$par['id_pelatihan_has_point_penilaian']=$id_pelatihan_has_point_penilaian;
		if($this->m_penilaian->hapus_pointpenilaian($par))
		{
			$this->session->set_flashdata('msg',"Point penilaian dihapus.");
			
			//$this->managepeserta();
			redirect("admin/penilaian/".$id_pelatihan);
			//print_r($data);
			//$this->load->view('upload_form', $error);
		}
		else
		{

			$this->session->set_flashdata('error',"Gagal menghapus pont penilaian.");
			//$this->managepeserta();
			redirect("admin/penilaian/".$id_pelatihan);
			//$this->load->view('upload_success', $data);
		}
	}

	public function hapusNav($id_nav)
	{
		$par['id_kategori_parent']=$id_nav;
		if($this->m_post->hapusnavigasi($par))
		{
			$this->session->set_flashdata('msg',"Sukses menghapus.");
			redirect("admin/navigasi/");
		}
		else
		{
			$this->session->set_flashdata('error',"Gagal menghapus.");
			redirect("admin/navigasi/");
		}
	}

	public function hapussubnav($id_subnav)
	{
		$par['id_kategori']=$id_subnav;
		if($this->m_post->hapussubnavigasi($par))
		{
			$this->session->set_flashdata('msg',"Sukses menghapus.");
			redirect("admin/navigasi/");
		}
		else
		{
			$this->session->set_flashdata('error',"Gagal menghapus.");
			redirect("admin/navigasi/");
		}
	}

	public function hapusbannermitra($idbannermitra)
	{
		$par['id_bannernmitra']=$idbannermitra;
		if($this->m_post->hapusbannernmitra($par))
		{
			$this->session->set_flashdata('msg',"Sukses menghapus.");
			
			redirect("admin/bannerdanmitra/");
		}
		else
		{

			$this->session->set_flashdata('error',"Gagal menghapus.");
			redirect("admin/bannerdanmitra/");
		}
	}

	public function hapuspesertahaspelatihan($id_peserta_has_pelatihan,$id_pelatihan)
	{
		$par['id_peserta_has_pelatihan']=$id_peserta_has_pelatihan;
		if($this->m_peserta_has_pelatihan->hapus_peserta_has_pelatihan($par))
		{
			$this->session->set_flashdata('msg',"Kehadiran peserta dihapus.");
			
			//$this->managepeserta();
			redirect("admin/detailpelatihan/".$id_pelatihan);
			//print_r($data);
			//$this->load->view('upload_form', $error);
		}
		else
		{

			$this->session->set_flashdata('error',"Gagal menghapus kehadiran.");
			//$this->managepeserta();
			redirect("admin/detailpelatihan/".$id_pelatihan);
			//$this->load->view('upload_success', $data);
		}

	}

	public function hapuspelatihanhaspengajar($id_pelatihanhaspengajar,$id_pelatihan)
	{
		$par['id_pelatihan_has_pengajar']=$id_pelatihanhaspengajar;
		if($this->m_pelatihan_has_pengajar->hapus_pelatihan_has_pengajar($par))
		{
			$this->session->set_flashdata('msg',"Pengajar dihapus.");
			
			//$this->managepeserta();
			redirect("admin/detailpelatihan/".$id_pelatihan);
			//print_r($data);
			//$this->load->view('upload_form', $error);
		}
		else
		{

			$this->session->set_flashdata('error',"Gagal menghapus pengajar.");
			//$this->managepeserta();
			redirect("admin/detailpelatihan/".$id_pelatihan);
			//$this->load->view('upload_success', $data);
		}
	}

	public function logout()
	{
		$par['name']= $this->ses_nama;
		$par['username']= $this->ses_username;
		$this->session->unset_userdata('logged_in');
	   	session_destroy();
	   	redirect('login', 'refresh');
	}

	public function uploadDragdrop()
	{	
		$config['upload_path'] = './upload/post_images';
		$config['max_size']	= '10000';
		$config['allowed_types'] = 'bmp|jpg|png';
		$field_name = "userfile";
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload($field_name))
		{
			$error = array('error' => $this->upload->display_errors());
			//print_r($error);

			$this->session->set_flashdata('error',$error['error']);
			redirect("admin/images");
		}
		else
		{
			$this->session->set_flashdata('msg','image berhasil diupload');
			redirect("admin/images");
		}

		
	}

	public function uploadPic($id_peserta)
	{	
		$config['upload_path'] = './upload/peserta';
		$config['max_size']	= '1000';
		$config['allowed_types'] = 'bmp|jpg|png';
		$config['encrypt_name'] = TRUE;
		//$config['file_name'] = 'peserta_'.$id_peserta.'.jpg';
		$config['overwrite'] = TRUE;
		$new_name = 'peserta_'.$id_peserta;
		$config['file_name'] = $new_name;

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
			$parper['img']= $data['data']['upload_data']['file_name'];
			
			if($this->m_peserta->ubahPeserta($id_peserta,$parper))
			{
				// $configa['image_library'] = 'gd2';
				// $configa['source_image'] = './upload/peserta/'.$parper['img'];
				// //$config['create_thumb'] = TRUE;
				// //$config['file_name'] = $parper['img'];
				// //$config['maintain_ratio'] = TRUE;
				// $configa['width'] = 600;
				// $configa['height'] = 900;
				
				// //$config['master_dim'] = 'height';
				// $configa['overwrite'] = TRUE;

				// $this->load->library('image_lib', $configa); 

				// $this->image_lib->resize();

				//remove original file
				//@unlink( $config['source_image'] );

			}
			


			$this->session->set_flashdata('msg',"Upload gambar berhasil.");
			redirect("admin/managepeserta");
		}

		
	}

	public function uploadPicPengajar($id_pengajar)
	{	
		$config['upload_path'] = './upload/pengajar';
		$config['max_size']	= '1000';
		$config['allowed_types'] = 'bmp|jpg|png';
		$config['encrypt_name'] = TRUE;
		//$config['file_name'] = 'peserta_'.$id_peserta.'.jpg';
		$config['overwrite'] = TRUE;
		$new_name = 'pengajar'.$id_pengajar;
		$config['file_name'] = $new_name;

		$this->load->library('upload', $config);
		$field_name = "userfile";
		if ( ! $this->upload->do_upload($field_name))
		{
			$data['status']=0;
			$data['data'] = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('error',$this->upload->display_errors());
			//$this->managepeserta();
			redirect("admin/managepengajar");
			//print_r($data);
			//$this->load->view('upload_form', $error);
		}
		else
		{
			
			$data['status']=1;
			$data['data'] = array('upload_data' => $this->upload->data());
			$parpeng['img']= $data['data']['upload_data']['file_name'];
			$this->m_pengajar->ubahPengajar($id_pengajar,$parpeng);
			//print_r($data);
			$this->session->set_flashdata('msg',"Upload gambar berhasil.");
			redirect("admin/managepengajar");
		}

		
	}

}
