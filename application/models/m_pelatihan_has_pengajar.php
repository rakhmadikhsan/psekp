<?php
	Class M_pelatihan_has_pengajar extends CI_Model
  	{
    	function tambah_pelatihan_has_pengajar($par)
   		{
      		return $this->db->insert('pelatihan_has_pengajar', $par); 
   		}
   	

   	 	function getPengajarPelatihan($id_pelatihan)
    	{
      		$this->db->select('*')
      		->from('pengajar')
      		->join('pelatihan_has_pengajar', 'pengajar.id_pengajar = pelatihan_has_pengajar.id_pengajar_fk')
      		
      		->where('pelatihan_has_pengajar.id_pelatihan_fk',$id_pelatihan);
      		$data = $this->db->get();
       		return $data -> result_array();
    	}

      function get_pelatihan_has_pengajar($par)
      {
            $data = $this->db->get_where('pelatihan_has_pengajar', $par);
          return $data -> result_array();
      }

      function get_pelatihan_has_pengajar2($par)
      {

          $data= $this->db->select('*')->
          from('pelatihan_has_pengajar')
          ->join('pengajar', 'pelatihan_has_pengajar.id_pengajar_fk=pengajar.id_pengajar')
          ->where($par)->get();
          return $data -> result_array();
      }

    	function hapus_pelatihan_has_pengajar($par)
    	{
    		 return $this->db->delete('pelatihan_has_pengajar', $par);
    	}
	}
?>