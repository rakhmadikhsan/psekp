<?php
  Class M_peserta_has_pelatihan extends CI_Model
  {
    function tambah_peserta_has_pelatihan($par)
   {
      return $this->db->insert('peserta_has_pelatihan', $par); 
   }



  	function cekQuota($id_pelatihan)
  	{
  		 $this->load->model('m_pelatihan','',TRUE);
  		 $parPelatihan['id_pelatihan']=$id_pelatihan;
  		 $data_pelatihan=$this->m_pelatihan->getPelatihan($parPelatihan);
  	
  		 $quota=$data_pelatihan[0]['quota'];

  		 $parPHP['id_pelatihan_fk']=$id_pelatihan;
  		 $dataPHP=$this->getPesertaHasPelatihan($parPHP);
  		
  		 $jumlahPeserta=count($dataPHP);

  		 if($jumlahPeserta<$quota)
  		 {
  		 	return TRUE;
  		 }else
  		 {
  		 	return FALSE;
  		 }
  	}

  	function getPesertaHasPelatihan($par)
  	{
  		$data = $this->db->get_where('peserta_has_pelatihan', $par);
      	return $data -> result_array();
  	}

  	function register($par)
  	{
  		$result="";
  		$this->db->trans_start();
		if($this->cekQuota($par['id_pelatihan_fk']))
		{
			$this->tambah_peserta_has_pelatihan($par);
			$result = 'sukses';
		}
		else{
			$result = "quota penuh";
		}

		if(!$this->db->trans_complete())
		{
			$result = "teransaksi gagal";
		}

		return $result;		
  	}
  }

?>