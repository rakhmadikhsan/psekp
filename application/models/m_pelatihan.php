<?php
  Class M_pelatihan extends CI_Model
  {
    function getPelatihan($par)
   {

      $data = $this->db->get_where('pelatihan', $par);
      return $data -> result_array();
   }

   function getPelatihanLike($par)
   {
   	 $this->db->like($par);
      $data = $this->db->get('pelatihan');
       return $data -> result_array();
   }

   function ubahPelatihan($id_pelatihan, $par)
   {
   	 $this->db->where('id_pelatihan', $id_pelatihan);
      $data=$this->db->update('pelatihan', $par);
      return $data;
   }
 function hapusPelatihan($par)
    {
      return $this->db->delete('pelatihan', $par);
    }

  
  }

?>