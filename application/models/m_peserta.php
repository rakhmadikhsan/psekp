<?php
  class m_peserta extends ci_model
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
      //$data= $this->db->insert('peserta', $par);    
      $this->db->insert('peserta', $par);    
      $insert_id = $this->db->insert_id();

      return  $insert_id;
      //return $data;
         
    }
    function getpeserta($par)
    {
      $data = $this->db->get_where('peserta', $par);
      return $data -> result_array();
    }

    function getpesertalike($par)
    {
      $this->db->like($par);
      $data = $this->db->get('peserta');
      return $data -> result_array();
    }

    function hapuspeserta($par)
    {
      
      return $this->db->delete('peserta', $par);
    }



    function ubahpeserta($id_peserta,$par)
    {
      $this->db->where('id_peserta', $id_peserta);
      $data=$this->db->update('peserta', $par);
      return $data;
    }

    function registerall($data_calon_peserta,$parExcel)
    {
      
      $this->load->model('m_peserta_has_pelatihan','',TRUE);
      $this->db->trans_start();
      $idid_peserta=null;
      $data=null;
      $i=0;
      foreach ($data_calon_peserta as $key => $value) {
        $parPeserta['nip']=$value['nip'];
        $data_peserta=$this->getPeserta($parPeserta);
        $id_peserta=null;
        if (sizeof($data_peserta)>0) {
          $id_peserta=$data_peserta[0]['id_peserta'];
          $this->ubahpeserta($id_peserta,$value);
          $idid_peserta[$i]=$id_peserta;
        }else
        {
          $id_reg=$this->register($value);
          $idid_peserta[$i]=$id_reg;
        }
        $data['peserta'][]=$idid_peserta[$i];
        $i++;
      }
      $data['php']=null;
      foreach ($idid_peserta as $key => $val) {
        $parpar['id_pelatihan_fk']=$parExcel['id_pelatihan_fk'];
        $parpar['id_peserta_fk']=$val;
        $parpar['payment']=1;
        $parpar['status_kehadiran']=0;
        $parpar['reff']=$parExcel['id_peserta_fk'];

        $parparcek['id_peserta_fk']=$val;
        $parparcek['id_pelatihan_fk']=$parExcel['id_pelatihan_fk'];

        $data_peserta_has_pelatihan=$this->m_peserta_has_pelatihan->getPesertaHasPelatihan($parparcek);
        if (sizeof($data_peserta_has_pelatihan)==0)
        {
            $id_php=$this->m_peserta_has_pelatihan->tambah_peserta_has_pelatihan($parpar);
            $data['php'][]=$id_php;
        }
          # code...
      }
      $this->db->trans_complete();
      $result=$this->db->trans_status();
      $data['result']=$result;
      $data['msg']='Sukses mendaftar peserta - peserta.';


      return $data;
    }
    


  }

?>