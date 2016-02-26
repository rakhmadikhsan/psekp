<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_en extends CI_Controller {

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

		$this->lang->load('message','en');

		
	    
	}

	public function testranslate()
	{
		echo "<br> English ke indonesia <br><br>";
		echo $this-> translate('hungry');
	}

	function curl($url, $params = array(), $is_coockie_set = false){
	    if(!$is_coockie_set){
	        /* STEP 1. buat temporary cookie untuk mengelabuhi google translate */
	        $ckfile = tempnam ("/tmp", "CURLCOOKIE");
	        /* STEP 2. masuk cookie */
	        $ch = curl_init ($url);
	        curl_setopt ($ch, CURLOPT_COOKIEJAR, $ckfile);
	        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	        $output = curl_exec ($ch);
	    }
	    $str = ''; $str_arr= array();
	    foreach($params as $key => $value)   {
	        $str_arr[] = urlencode($key)."=".urlencode($value);
	    }
	    if(!empty($str_arr)) $str = '?'.implode('&',$str_arr);
	    /* STEP 3. melihat isi dari cookie */
	    $Url = $url.$str;
	    $ch = curl_init ($Url);
	    curl_setopt ($ch, CURLOPT_COOKIEFILE, $ckfile);
	    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	    $output = curl_exec ($ch);
	    return $output;
	}
	function translate($word){
	    $word = urlencode($word);
	    // bahasa jepang
	    //$url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=ja&tl=id&ie=UTF-8&oe=UTF-8&multires=1&otf=2&pc=1&ssel=0&tsel=0&sc=1';
	     
	    // bahasa inggris
	    $url = 'http://translate.google.com/translate_a/t?client=t&text='.$word.'&hl=en&sl=en&tl=id&multires=1&otf=2&pc=1&ssel=0&tsel=0&sc=1';
	    $name_en = $this->curl($url);
	    print_r($name_en);
	    $name_en = explode('"',$name_en);
	    return  $name_en[1];
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


}
