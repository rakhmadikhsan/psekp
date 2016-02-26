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

  
    function getPesertaPelatihan($id_pelatihan)
    {
      $this->db->select('*')
      ->from('peserta')
      ->join('peserta_has_pelatihan', 'peserta.id_peserta = peserta_has_pelatihan.id_peserta_fk')
      ->where('peserta_has_pelatihan.id_pelatihan_fk',$id_pelatihan);
      $data = $this->db->get();
       return $data -> result_array();
    }

    function tambahPelatihan($par)
    {
      $data= $this->db->insert('pelatihan', $par);    
       return $data;
    }


  }



?>