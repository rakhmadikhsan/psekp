<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exc extends CI_Controller {


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

	public function reportExcelPelatihan($id_pelatihan)
	{

		$paramza['id_pelatihan']=$id_pelatihan;
		$data_pelatihan=$this->m_pelatihan->getPelatihan($paramza);

		$data_peserta=$this->m_pelatihan->getPesertaPelatihan($id_pelatihan);

		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Report Pelatihan');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'DAFTAR PESERTA');
		$this->excel->getActiveSheet()->setCellValue('A2', $data_pelatihan[0]['nama_pelatihan']);
		$datenice_start=$this->dateToNicer($data_pelatihan[0]['date_mulai']);
		$datenice_end=$this->dateToNicer($data_pelatihan[0]['date_selesai']);
		$this->excel->getActiveSheet()->setCellValue('A3', $datenice_start.' - '.$datenice_end);
		//change the font size

		//$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setSize(20);
		//make the font become bold
		//$this->excel->getActiveSheet()->getStyle('B2')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:E1');
		$this->excel->getActiveSheet()->mergeCells('A2:E2');
		$this->excel->getActiveSheet()->mergeCells('A3:E3');
		
		$style = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        )
	    );
	    $this->excel->getActiveSheet()->getStyle("A1:A3")->applyFromArray($style);
		//set aligment to center for that merged cell (A1 to D1)
		//$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(4.71);
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(40.57);
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(47);
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(44.14);
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);

		$this->excel->getActiveSheet()->setCellValue('A6', 'No');
		$this->excel->getActiveSheet()->setCellValue('B6', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('C6', 'Instansi');
		$this->excel->getActiveSheet()->setCellValue('D6', 'Pemda');
		$this->excel->getActiveSheet()->setCellValue('E6', 'No Telepon');
				

        $this->excel->getActiveSheet()->getStyle('A6')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('B6')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('C6')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('D6')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('E6')->getFont()->setBold(true);
		
		$style_border =  array(
            'borders' => array(
                'allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $style_text = array(
		    'font'  => array(
		        'size'  => 11,
		        'name'  => 'Georgia'
		    ));


        //$sheet->getStyle("A6:E6")->applyFromArray($style_border);

		$row_num=7;

		foreach ($data_peserta as $key => $value) {
			
			$this->excel->getActiveSheet()->setCellValue('A'.$row_num, $key+1);
			$this->excel->getActiveSheet()->setCellValue('B'.$row_num, $value['nama']);
			$this->excel->getActiveSheet()->setCellValue('C'.$row_num, $value['instansi']);
			$this->excel->getActiveSheet()->setCellValue('D'.$row_num, $value['daerah']);
			$this->excel->getActiveSheet()->setCellValue('E'.$row_num, $value['telepon']);
			$row_num++;
		}

		$this->excel->getActiveSheet()->getStyle("A6:E".($row_num-1))->applyFromArray($style_border);
		

		$this->excel->getActiveSheet()->getStyle("A6:E6")->applyFromArray($style);
		$this->excel->getActiveSheet()->getStyle("A7:A".($row_num-1))->applyFromArray($style);
		$this->excel->getActiveSheet()->getStyle("A1:E".($row_num-1))->applyFromArray($style_text);
		
		$filename='report_pelatihan - '.$data_pelatihan[0]['nama_pelatihan'].'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		            
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}


}
