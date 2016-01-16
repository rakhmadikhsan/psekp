<?php
  Class M_peserta extends CI_Model
  {
     function login($nip)
   {
     $this -> db -> where('nip', $nip);
     $this -> db -> limit(1);
     $data = $this -> db -> get('peserta');
   
     return $data -> result_array();
   }

   function register($par)
   {
    $par['status']=1;
      $data= $this->db->insert('peserta', $par);    
       return $data;
   
   }
    function getPeserta($par)
    {
      $data = $this->db->get_where('peserta', $par);
       return $data -> result_array();
    }

    function getPesertaLike($par)
    {
      $this->db->like($par);
      $data = $this->db->get('peserta');
       return $data -> result_array();
    }

    function hapusPeserta($par)
    {
      
      return $this->db->delete('peserta', $par);
    }

    function ubahPeserta($id_peserta,$par)
    {
      $this->db->where('id_peserta', $id_peserta);
      $data=$this->db->update('peserta', $par);
      return $data;
    }
  }

?>