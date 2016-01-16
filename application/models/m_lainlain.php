<?php
  Class M_lainlain extends CI_Model
  {
  		function upload_slx($par)
   		{
   			return $this->db->insert('upload_excel', $par);
   		}

  		function getUploadExcel($par)
   		{
   			$data = $this->db->get_where('upload_excel', $par);
      		return $data -> result_array();
   		}
	}
?>