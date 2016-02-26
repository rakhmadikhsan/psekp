<?php
	Class M_pengajar extends CI_Model
  	{
   		function getPengajar($par)
   		{
     		$data = $this->db->get_where('pengajar', $par);
      		return $data -> result_array();
   		}

   		function tambahPengajar($par)
   		{
   			$data= $this->db->insert('pengajar', $par);    
       		return $data;
   		}
		function ubahPengajar($id_pengajar,$par)
    	{
      		$this->db->where('id_pengajar', $id_pengajar);
      		$data=$this->db->update('pengajar', $par);
      		return $data;
    	}

    	function getPengajarLike($par)
	    {
	      $this->db->like($par);
	      $data = $this->db->get('pengajar');
	       return $data -> result_array();
	    }

	     function hapusPengajar($par)
	    {
	      return $this->db->delete('pengajar', $par);
	    }

  	}

?>