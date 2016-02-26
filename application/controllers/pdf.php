<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller {


	 function __construct()
	 {
	   parent::__construct();
	   $this->load->model('m_peserta','',TRUE);
	   $this->load->model('m_pelatihan','',TRUE);
	   $this->load->model('m_penilaian','',TRUE);
	   $this->load->model('m_lainlain','',TRUE);
	   $this->load->model('m_pelatihan','',TRUE);
	   $this->load->model('m_peserta_has_pelatihan','',TRUE);
	  $this->load->model('m_pelatihan_has_pengajar','',TRUE);
	    
	 }

	public function index()
	{
		
	}

	public function pdfhasilpenilaian($id_pelatihan, $id_pengajar_pelatihan)
	{
		$this->load->library('m_pdf');
        $pdfFilePath = "Hasil Penilaian - ".$id_pengajar_pelatihan.".pdf";
		$par_peng['id_pelatihan_has_pengajar']=$id_pengajar_pelatihan;
		$data_pengajar=$this->m_pelatihan_has_pengajar->get_pelatihan_has_pengajar2($par_peng);

		$par_pelatihan['id_pelatihan']=$id_pelatihan;
		
		$result_penilaian= $this->m_penilaian->getResultPenilaian($id_pengajar_pelatihan);
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

		$data['result_penilaian']=$res_pen;
		$data['data_submited']=sizeof($result_penilaian);
		$parag['id_pelatihan_has_pengajar_fk']=$id_pengajar_pelatihan;
		$penilaian_pengajar=$this->m_penilaian->getpenilaianpengajar($parag);
		$data['penilaian_pengjar_kritik_saran']=$penilaian_pengajar;
		$data['data_pelatihan']=$this->m_pelatihan->getPelatihan($par_pelatihan);
		$data['data_pengajar']=$data_pengajar[0];
		$data['hari_mengisi']=$this->getHari($data_pengajar[0]['tanggal_mengisi']);
		$data['tanggal_mengisi']=$this->dateToNicer($data_pengajar[0]['tanggal_mengisi']);
		//$this->load->view('pdf/pdf_hasil_penilaian',$data);

		$pdf_body=$this->load->view('pdf/pdf_hasil_penilaian',$data, true);
	    $this->m_pdf->pdf->WriteHTML($pdf_body);
	        
        //$this->m_pdf->pdf->WriteHTML("SAKDJA");
        $this->m_pdf->pdf->Output($pdfFilePath, "D");   

	}

	function pdfpenilaian($id_pelatihan)
	{
		
		$data_pengajar=$this->m_pelatihan_has_pengajar->getPengajarPelatihan($id_pelatihan);

        $this->load->library('m_pdf');
        $pdfFilePath = "Form Penilaian - ".$id_pelatihan.".pdf";
        foreach ($data_pengajar as $key => $value) {
        	$par_pelatihan['id_pelatihan']=$id_pelatihan;
			$data['data_pelatihan']=$this->m_pelatihan->getPelatihan($par_pelatihan);
			$data['data_pengajar']=$value;
			$data['data_poin_penilaian']=$this->m_penilaian->getPointPenilaian($id_pelatihan);
			$data['hari_mengisi']=$this->getHari($value['tanggal_mengisi']);
			$data['tanggal_mengisi']=$this->dateToNicer($value['tanggal_mengisi']);
	        $pdf_body=$this->load->view('pdf/pdf_penilaian',$data, true);
	        $this->m_pdf->pdf->WriteHTML($pdf_body);
	        if ($key+1	<sizeof($data_pengajar)) {
	        	$this->m_pdf->pdf->WriteHTML("<pagebreak />");
	        }
        }
        //$this->m_pdf->pdf->WriteHTML("SAKDJA");
        $this->m_pdf->pdf->Output($pdfFilePath, "D");   

	}

	

	function pdfUndangan($id_peserta_has_pelatihan)
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
		$data['is_email']=0;
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
        $pdf_body=$this->load->view('pdf/pdf_undangan',$data, true);

        //	print_r($data);	
        //break 1;

        $pdfFilePath = 'Undangan Bimtek - '.$id_peserta_has_pelatihan.'.pdf';

        $this->load->library('m_pdf');

        $this->m_pdf->pdf->WriteHTML($pdf_body);
 
        $this->m_pdf->pdf->Output($pdfFilePath, "D");  		
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
		$data['is_email']=0;
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

        $pdfFilePath = 'Konfirmasi Bimtek - '.$id_peserta_has_pelatihan.'.pdf';

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

}
