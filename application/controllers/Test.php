<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {


	 function __construct()
	 {
	   	parent::__construct();
	   	$this->load->model('m_peserta','',TRUE);
	   	$this->load->model('m_pelatihan','',TRUE);
	   	$this->load->model('m_lainlain','',TRUE);
	 	$this->load->model('m_pengajar','',TRUE);
	 	$this->load->model('m_pelatihan_has_pengajar','',TRUE);
	 	$this->load->model('m_peserta_has_pelatihan','',TRUE);
	 	$this->load->model('m_penilaian','',TRUE);
	 }

	public function index()
	{
		$this->load->view('v_test');
	}


	function pdftes($id_pelatihan)
	{

		//$this->load->view('pdf/pdf_undangan_header');
		$par_pelatihan['id_pelatihan']=$id_pelatihan;
		$data['data_pelatihan']=$this->m_pelatihan->getPelatihan($par_pelatihan);
		$data_pengajar=$this->m_pelatihan_has_pengajar->getPengajarPelatihan($id_pelatihan);
		$data['data_poin_penilaian']=$this->m_penilaian->getPointPenilaian($id_pelatihan);
		$data['data_pengajar']=$data_pengajar[0];
		//echo '<pre>';
		//print_r($data);
		//echo '</pre>';
		$this->load->view('pdf/pdf_penilaian', $data);
		//$this->load->view('pdf/pdf_undangan_footer');
	}

	function pdf($id_pelatihan)
	{
		
		$data_pengajar=$this->m_pelatihan_has_pengajar->getPengajarPelatihan($id_pelatihan);;

        $this->load->library('m_pdf');
        $pdfFilePath = "output_pdf_name.pdf";
        foreach ($data_pengajar as $key => $value) {
        	$par_pelatihan['id_pelatihan']=$id_pelatihan;
			$data['data_pelatihan']=$this->m_pelatihan->getPelatihan($par_pelatihan);
			$data['data_pengajar']=$value;
			$data['data_poin_penilaian']=$this->m_penilaian->getPointPenilaian($id_pelatihan);

	        $pdf_body=$this->load->view('pdf/pdf_penilaian',$data, true);
	        $this->m_pdf->pdf->WriteHTML($pdf_body);
	        if ($key-2<sizeof($data_pengajar)) {
	        	$this->m_pdf->pdf->WriteHTML("<pagebreak />");
	        }
        }
        //$this->m_pdf->pdf->WriteHTML("SAKDJA");
        $this->m_pdf->pdf->Output($pdfFilePath, "D");   

	}

	function sendMail()
	{
	    $config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'rakhmad.ikhsanudin@gmail.com', // change it to yours
		  'smtp_pass' => 'alakazam', // change it to yours
		  'mailtype' => 'html',
		  'charset' => 'iso-8859-1',
		  'wordwrap' => TRUE
		);

	      $message = 'asdasd';
	      $this->load->library('email', $config);
	      $this->email->initialize($config);
	      $this->email->set_newline("\r\n");
	      $this->email->from('rakhmad.ikhsanudin@gmail.com'); // change it to yours
	      $this->email->to('rakhmad.ikhsanudin@gmail.com');// change it to yours
	      $this->email->subject('Resume from JobsBuddy for your Job posting');
	      $this->email->message($message);
	      if($this->email->send())
	     {
	      echo 'Email sent.';
	     }
	     else
	    {
	     show_error($this->email->print_debugger());
	    }

	}

	public function testubah()
	{
		$pk='17';
		$par['sertifikat']='11111';
		$this->m_peserta_has_pelatihan->ubah_peserta_has_pelatihan($pk,$par);
	}

	
	public function xedit()
	{
		 //sleep(1); 
	    $this->load->model('m_peserta_has_pelatihan','',TRUE);
	    $pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];
	    
	    if(!empty($value)) {
	       	
	       	$par['sertifikat']=$value;
	        if($this->m_peserta_has_pelatihan->ubah_peserta_has_pelatihan($pk,$par))
	        {
	        //	eccho 'success';
	        }
	    } else {

	        header('HTTP/1.0 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}


}
