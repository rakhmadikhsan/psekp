<?php
	Class M_penilaian extends CI_Model
  	{
   		function getPointPenilaian($id_pelatihan)
   		{
      		$this->db->select('*')
      		->from('pelatihan_has_point_penilaian')
      		->join('point_penilaian', 'pelatihan_has_point_penilaian.id_point_penilaian_fk = point_penilaian.id_point_penilaian')
      		->join('kategori_point', 'pelatihan_has_point_penilaian.id_kategori_point_fk = kategori_point.id_kategori_point')
      		->where('pelatihan_has_point_penilaian.id_pelatihan_fk',$id_pelatihan)
      		->order_by('kategori_point.id_kategori_point');
      		$data = $this->db->get();
       		return $data -> result_array();
   		}

      function getpenilaian($id_pelatihan)
      {
          $this->db->select('*')
          ->from('penilaian')
          ->join('pelatihan_has_pengajar', 'penilaian.id_pelatihan_has_pengajar_fk = pelatihan_has_pengajar.id_pelatihan_has_pengajar')
          ->join('pengajar', 'pelatihan_has_pengajar.id_pengajar_fk = pengajar.id_pengajar')
          ->where('pelatihan_has_pengajar.id_pelatihan_fk',$id_pelatihan);
          
          $data = $this->db->get();
          return $data -> result_array();
      }

      function hapus_pointpenilaian($par)
      {
        return $this->db->delete('pelatihan_has_point_penilaian', $par);
      }

      function data_pengajar_untuk_penilaian($id_pelatihan)
      {
         $this->db->select('*')
          ->from('pelatihan_has_pengajar')
          ->join('pengajar', 'pelatihan_has_pengajar.id_pengajar_fk = pengajar.id_pengajar')
          ->where('pelatihan_has_pengajar.id_pelatihan_fk',$id_pelatihan);
          
          $data = $this->db->get();
          return $data -> result_array();
      }

      function getResultPenilaian($id_pengajar_pelatihan)
      {
         $this->db->select('point_penilaian.point_penilaian,kategori_point.kategori_point, detail_penilaian_pengajar.id_pelatihan_has_point_penilaian_fk, pelatihan_has_point_penilaian.id_kategori_point_fk, detail_penilaian_pengajar.nilai, COUNT(*) as jumlah')
         ->from('penilaian_pengajar')
         ->join('detail_penilaian_pengajar', 'penilaian_pengajar.id_penilaian_pengajar = detail_penilaian_pengajar.id_penilaian_pengajar_fk')
         ->join('pelatihan_has_point_penilaian', 'detail_penilaian_pengajar.id_pelatihan_has_point_penilaian_fk = pelatihan_has_point_penilaian.id_pelatihan_has_point_penilaian')
         ->join('kategori_point', 'pelatihan_has_point_penilaian.id_kategori_point_fk = kategori_point.id_kategori_point')
         ->join('point_penilaian', 'pelatihan_has_point_penilaian.id_point_penilaian_fk = point_penilaian.id_point_penilaian')
         ->where('penilaian_pengajar.id_pelatihan_has_pengajar_fk', $id_pengajar_pelatihan)
         ->group_by('detail_penilaian_pengajar.id_pelatihan_has_point_penilaian_fk') 
         ->group_by('detail_penilaian_pengajar.nilai')
         ->order_by('pelatihan_has_point_penilaian.id_kategori_point_fk', 'asc')   
         ->order_by('detail_penilaian_pengajar.id_pelatihan_has_point_penilaian_fk', 'asc')   
         ->order_by('detail_penilaian_pengajar.nilai', 'asc');

         $data = $this->db->get();
          return $data -> result_array();
      }

   		function getKategori($par)
   		{
   			$data = $this->db->get_where('kategori_point', $par);
      		return $data -> result_array();
   		}

      function getpenilaianpengajar($par)
      {
        $data = $this->db->get_where('penilaian_pengajar', $par);
          return $data -> result_array();
      }

      function getPenilaianSubmited($par)
      {
        $data = $this->db->get_where('penilaian_pengajar', $par);
          return $data -> result_array();
      }

		  function getpoint($par)
    	{
      		$data = $this->db->get_where('point_penilaian', $par);
      		return $data -> result_array();
    	}

      function tambahKategori($par)
      { 
        $this->db->insert('kategori_point', $par);    
        $insert_id = $this->db->insert_id();

        return  $insert_id;
      }

      function penilaian_pengajar($par)
      {
        $param=$par;
        unset($param['detail']);

        $this->db->trans_start();

        $id_tmbah_penilaian_pengajar=$this->tambah_penilaian_pengajar($param);
        if ($id_tmbah_penilaian_pengajar!=0) {
          foreach ($par['detail'] as $key => $value) {
            # code...
            $parama=$value;
            $parama['id_penilaian_pengajar_fk']=$id_tmbah_penilaian_pengajar;
            $this->tambah_deail_penilaian_penngajar($parama);
          }
        }else
        {
          $result=0;
        }
        $this->db->trans_complete();
        if(!$this->db->trans_status())
        {
             $result = 0;
        }else
        {
          $result=1;
        }

        return $result;
        
      }



      function tambah_deail_penilaian_penngajar($par)
      {
        $this->db->insert('detail_penilaian_pengajar', $par);    
        $insert_id = $this->db->insert_id();

        return  $insert_id; 
      }

      function tambah_penilaian_pengajar($par)
      {
        $this->db->insert('penilaian_pengajar', $par);    
        $insert_id = $this->db->insert_id();

        return  $insert_id;
      }





      function tambahPenilaian($par)
      { 
        $this->db->insert('penilaian', $par);    
        $insert_id = $this->db->insert_id();

        return  $insert_id;
      }      

      function tambahPointPenilaian($par)
      {
         $this->db->insert('point_penilaian', $par);    
        $insert_id = $this->db->insert_id();

        return  $insert_id;
      }

    	function tambahPoinPenilaian($par)
    	{
    		$id_pelatihan=$par['id_pelatihan'];
    		$kategori=$par['kategori'];
    		$poin=$par['poin'];

        $this->db->trans_start();
        $parKat['kategori_point']=$kategori;
        $data_kategori=$this->getKategori($parKat);
        if(sizeof($data_kategori)<=0)
        {
          $parKatIns['kategori_point']=$kategori;
          $id_kategori_fk=$this->tambahKategori($parKatIns);
        }
        else
        {
          $id_kategori_fk=$data_kategori[0]['id_kategori_point'];
        }

        $parPoint['point_penilaian']=$poin;
        $data_point_penilaian=$this->getpoint($parPoint);
        if (sizeof($data_point_penilaian)<=0) {
          $parPoinIns['point_penilaian']=$poin;
          $id_point_penilaian_fk=$this->tambahPointPenilaian($parPoinIns);
        }else
        {
          $id_point_penilaian_fk=$data_point_penilaian[0]['id_point_penilaian'];
        }

        $parPHPP['id_pelatihan_fk']=$id_pelatihan;
        $parPHPP['id_point_penilaian_fk']=$id_point_penilaian_fk;
        $parPHPP['id_kategori_point_fk']=$id_kategori_fk;
        $this->db->insert('pelatihan_has_point_penilaian', $parPHPP);    
        $insert_id = $this->db->insert_id();
        $result = $insert_id;
        $this->db->trans_complete();
        if(!$this->db->trans_status())
        {
             $result = 0;
        }

        return $result;
    		//1. cek apakah kategori sudah ada. 
    		// jika belum insert dan get id, jika sudah get id saja.
    		//2. cek apakah poin sudah ada
    		// jika belum insert dan get id, jika sudah get id saja.
    		//3. insert ke pelatihan has penilaian.

    	}


  	}

?>