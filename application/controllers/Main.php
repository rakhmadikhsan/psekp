<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
	   $this->load->helper('dom');

	   	$dataimageconfig=$this->m_post->getSetImages(null);
		$datasetimage=null;
		foreach ($dataimageconfig as $key => $value) {
			$datasetimage[$value['image_config']]=$value['src'];
		}
	    
	    

	}

	function shorten_string($string, $wordsreturned)
	{
	    $retval = $string;  //  Just in case of a problem
	    $array = explode(" ", $string);
	    /*  Already short enough, return the whole thing*/
	    if (count($array)<=$wordsreturned)
	    {
	        $retval = $string;
	    }
	    /*  Need to chop of some words*/
	    else
	    {
	        array_splice($array, $wordsreturned);
	        $retval = implode(" ", $array)." ...";
	    }
	    return $retval;
	}

	public function parseInfoUGM()
	{
		
		$result=null;
		
		$xmlDoc = new DOMDocument();
		if (@$xmlDoc->load("http://ugm.ac.id/id/news/feed.xml") === false)
		{
			//echo 'gagal';
		}else
		{
			$posts = $xmlDoc->getElementsByTagName( "item" );
			foreach ($posts as $key => $value) {
				$judul = $value->getElementsByTagName( "title" );
	  			$judul = $judul->item(0)->nodeValue;

	  			$link = $value->getElementsByTagName( "link" );
	  			$link = $link->item(0)->nodeValue;

	  			$result[$key]['judul']=$judul;
	  			$result[$key]['link']=$link;		
			}
		}	
				
		return $result;
		// echo '<pre>';
		// print_r($result);
		// echo '</pre>';

		
	}

	public function index()
	{
		

		
		//$this->load->helper('form');
		//$this->lang->load('depan', 'bahasa');
		//$data['lang'] = $this->session->userdata('language');
		$databannermitra=$this->m_post->getbannerdanmitra(null);

		$dataHLandThumb=$this->m_post->getHLandThumb();
		$dataimageconfig=$this->m_post->getSetImages(null);
		$datasetimage=null;
		foreach ($dataimageconfig as $key => $value) {
			$datasetimage[$value['image_config']]=$value['src'];
		}

		foreach ($dataHLandThumb as $key => $value) {
			$content=$value['content'];
			$html = str_get_html($content);
			$img=base_url()."assets/img/photo23.jpg";
			$parag="";
			foreach($html->find('img') as $element) {
			   $img=$element->src;
			   break 1;
			}
			
			$parag=$html->plaintext;

			$dataHLandThumb[$key]['img']=$img;
			$dataHLandThumb[$key]['parag']=$this->shorten_string($parag, 20);
		}

		
		$dataNav=$this->m_post->getNav();
		$data['nav']=$dataNav;
		$data['page']='depan';

		$limit=10;
		$parBerita['status']=1;
		$parBerita['tipe']=1;
		$dataBerita=$this->m_post->getPosts($parBerita, $limit);

		$parPengumuman['status']=1;
		$parPengumuman['tipe']=2;
		$dataPengumuman=$this->m_post->getPosts($parPengumuman, $limit);

		$parAgenda['status']=1;
		$parAgenda['tipe']=3;
		$dataAgenda=$this->m_post->getPosts($parAgenda, $limit);

		$dataInnfougm=$this->parseInfoUGM();
		


		$data=null;
		$data['berita']=$dataBerita;
		$data['pengumuman']=$dataPengumuman;
		$data['agenda']=$dataAgenda;
		
		$data['hlthumb']=$dataHLandThumb;
		$data['setimage']=$datasetimage;
		$data['infougm']=$dataInnfougm;
		$data['bannermitra']=$databannermitra;

		$dataNav=$this->m_post->getNav();
		$data['nav']=$dataNav;
		$data['page']='depan';	
		$this->load->view('depan/mainbs',$data);

		
	}

	public function berita($page=1)
	{
		$tipe=1;
		$databannermitra=$this->m_post->getbannerdanmitra(null);
		$dataimageconfig=$this->m_post->getSetImages(null);
		$datasetimage=null;
		foreach ($dataimageconfig as $key => $value) {
			$datasetimage[$value['image_config']]=$value['src'];
		}
		$data['setimage']=$datasetimage;
		$data['bannermitra']=$databannermitra;

		$dataNav=$this->m_post->getNav();
		$data['nav']=$dataNav;
		$data['page']='Berita';	
		//$this->load->view('depan/mainbs',$data);


		$config["base_url"] = base_url() . "index.php/main/berita";
        $config["total_rows"] = $this->m_post->record_count($tipe);
        $config["per_page"] = 6;
        $config["uri_segment"] = 3;


        $config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";
		

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["artikel"] = $this->m_post->fetch_artikel($config["per_page"], $page, $tipe);

        foreach ($data["artikel"] as $key => $value) {
			$content=$value['content'];
			$html = str_get_html($content);
			//$img=base_url()."assets/img/photo23.jpg";
			$img="";
			$parag="";
			foreach($html->find('img') as $element) {
			   $img=$element->src;
			   break 1;
			}
			
			$parag=$html->plaintext;

			$data["artikel"][$key]['img']=$img;
			$data["artikel"][$key]['parag']=$this->shorten_string($parag, 70);
			$data['artikel'][$key]['datetime_nice']= $this->getHari($value['datetime_post']).', '.$this->dateToNicer($value['datetime_post']);
		}


        $data["links"] = $this->pagination->create_links();

        $this->load->view('depan/mainbs',$data);


	}

	public function pengumuman($page=1)
	{
		$tipe=2;
		$databannermitra=$this->m_post->getbannerdanmitra(null);
		$dataimageconfig=$this->m_post->getSetImages(null);
		$datasetimage=null;
		foreach ($dataimageconfig as $key => $value) {
			$datasetimage[$value['image_config']]=$value['src'];
		}
		$data['setimage']=$datasetimage;
		$data['bannermitra']=$databannermitra;

		$dataNav=$this->m_post->getNav();
		$data['nav']=$dataNav;
		$data['page']='Pengumuman';	
		//$this->load->view('depan/mainbs',$data);

		$config["base_url"] = base_url() . "index.php/main/pengumuman";
        $config["total_rows"] = $this->m_post->record_count($tipe);
        $config["per_page"] = 6;
        $config["uri_segment"] = 3;


        $config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";


        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["artikel"] = $this->m_post->fetch_artikel($config["per_page"], $page, $tipe);

        foreach ($data["artikel"] as $key => $value) {
			$content=$value['content'];
			$html = str_get_html($content);
			//$img=base_url()."assets/img/photo23.jpg";
			$img="";
			$parag="";
			foreach($html->find('img') as $element) {
			   $img=$element->src;
			   break 1;
			}
			
			$parag=$html->plaintext;

			$data["artikel"][$key]['img']=$img;
			$data["artikel"][$key]['parag']=$this->shorten_string($parag, 50);
			$data['artikel'][$key]['datetime_nice']= $this->getHari($value['datetime_post']).', '.$this->dateToNicer($value['datetime_post']);
		}

        $data["links"] = $this->pagination->create_links();

        $this->load->view('depan/mainbs',$data);
	}

	public function agenda($page=1)	
	{
		$tipe=3;
		$databannermitra=$this->m_post->getbannerdanmitra(null);
		$dataimageconfig=$this->m_post->getSetImages(null);
		$datasetimage=null;
		foreach ($dataimageconfig as $key => $value) {
			$datasetimage[$value['image_config']]=$value['src'];
		}
		$data['setimage']=$datasetimage;
		$data['bannermitra']=$databannermitra;

		$dataNav=$this->m_post->getNav();
		$data['nav']=$dataNav;
		$data['page']='Agenda';	
		//$this->load->view('depan/mainbs',$data);

		$config["base_url"] = base_url() . "index.php/main/agenda";
        $config["total_rows"] = $this->m_post->record_count($tipe);
        $config["per_page"] = 6;
        $config["uri_segment"] = 3;

        $config['full_tag_open'] = "<ul class='pagination'>";
		$config['full_tag_close'] ="</ul>";
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$config['next_tag_open'] = "<li>";
		$config['next_tagl_close'] = "</li>";
		$config['prev_tag_open'] = "<li>";
		$config['prev_tagl_close'] = "</li>";
		$config['first_tag_open'] = "<li>";
		$config['first_tagl_close'] = "</li>";
		$config['last_tag_open'] = "<li>";
		$config['last_tagl_close'] = "</li>";

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["artikel"] = $this->m_post->fetch_artikel($config["per_page"], $page, $tipe);

        foreach ($data["artikel"] as $key => $value) {
			$content=$value['content'];
			$html = str_get_html($content);
			//$img=base_url()."assets/img/photo23.jpg";
			$img="";
			$parag="";
			foreach($html->find('img') as $element) {
			   $img=$element->src;
			   break 1;
			}
			
			$parag=$html->plaintext;

			$data["artikel"][$key]['img']=$img;
			$data["artikel"][$key]['parag']=$this->shorten_string($parag, 50);
			$data['artikel'][$key]['datetime_nice']= $this->getHari($value['datetime_post']).', '.$this->dateToNicer($value['datetime_post']);
		}

        $data["links"] = $this->pagination->create_links();

        $this->load->view('depan/mainbs',$data);
	}

	public function post($linkjudul)
	{

 		$parBerita['status']=1;
		$parBerita['link']=$linkjudul;
		$limit=1;
		$dataBerita=$this->m_post->getPosts($parBerita,$limit);
		$data['post']=$dataBerita[0];
		$data['post']['datetime_nice']= $this->getHari($dataBerita[0]['datetime_post']).', '.$this->dateToNicer($dataBerita[0]['datetime_post']);

		$parsideartikel['status']=1;
		$parsideartikel['tipe']=$data['post']['tipe'];
		$limit=15;
		$dataSideArtikel=$this->m_post->getPosts($parsideartikel,$limit);
		$data['sideartikel']=$dataSideArtikel;

		$databannermitra=$this->m_post->getbannerdanmitra(null);
		$data['bannermitra']=$databannermitra;

		$dataimageconfig=$this->m_post->getSetImages(null);
		$datasetimage=null;
		foreach ($dataimageconfig as $key => $value) {
			$datasetimage[$value['image_config']]=$value['src'];
		}
		$data['setimage']=$datasetimage;
		
		$dataNav=$this->m_post->getNav();
		$data['nav']=$dataNav;
		$data['page']='post';	
		$this->load->view('depan/mainbs',$data);
		//print_r($dataBerita[0]);


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

	public function galeri()
	{
		$dataimageconfig=$this->m_post->getSetImages(null);
		$datasetimage=null;
		foreach ($dataimageconfig as $key => $value) {
			$datasetimage[$value['image_config']]=$value['src'];
		}

		$data['setimage']=$datasetimage;
		
		$dataNav=$this->m_post->getNav();
		$data['nav']=$dataNav;
		$data['page']='galeri';	
		$this->load->view('depan/mainbs',$data);
	}

	public function bs()
	{
		//$this->load->helper('form');
		//$this->lang->load('depan', 'bahasa');
		//$data['lang'] = $this->session->userdata('language');
		$parBerita['status']=1;
		$parBerita['tipe']=1;
		$dataBerita=$this->m_post($parBerita);

		$data=null;
		$data['berita']=$dataBerita;
		$this->load->view('depan/mainbs',$data);

		
	}

	function languages()
	{
	   extract($_POST);
	   $this->session->set_userdata('language', $dlang);
	   $redirect_url = base_url().$current;
	   redirect($redirect_url);	

	 
	}

}
