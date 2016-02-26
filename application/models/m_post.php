<?php
  Class M_post extends CI_Model
  {
  		function getPosts($par,$limit)
   		{
        //$this->db->orderby('id_post', 'desc');
   			//$data = $this->db->get_where('a_post', $par);
        $data = $this->db->from('a_post')->where($par)->order_by('id_post', 'DESC')->limit($limit)->get();
        return $data -> result_array();
   		}

      function getHLandThumb()
      {
        $this->db->where('status',1);
        $this->db->where('tipe !=',4);
        $this->db->order_by("datetime_post", "desc"); 
        $this->db->limit(15);
        $data = $this->db->get('a_post');
        return $data -> result_array();
      }

      function getNavParent($par)
      {
          $data = $this->db->get_where('a_kategori_parent', $par);
          return $data -> result_array();
      }

      function getNavChild($par)
      {
          $data = $this->db->get_where('a_kategori', $par);
          return $data -> result_array();
      }

      function getbannerdanmitra($par)
      {
          $data = $this->db->get_where('a_bannernmitra', $par);
          return $data -> result_array();
      }

      function tambahPost($par)
      {
        
        //$data= $this->db->insert('peserta', $par);    
        $this->db->insert('a_post', $par);    
        
        $insert_id = $this->db->insert_id();

        return  $insert_id;
      }

      function tambahBannernMitra($par)
      {
        $this->db->insert('a_bannernmitra', $par);    
        $insert_id = $this->db->insert_id();
        return  $insert_id;
      }

      function tambahNav($par)
      {
        $this->db->insert('a_kategori_parent', $par);    
        $insert_id = $this->db->insert_id();
        return  $insert_id;
      }

      function tambahNavChild($par)
      {
        $this->db->insert('a_kategori', $par);    
        $insert_id = $this->db->insert_id();
        return  $insert_id;
      }

      function tambahSubNav($par)
      {

        $nav=$par['kategori_parent'];
        $subnav=$par['kategori'];
        $link=$par['another_link'];

        $this->db->trans_start();
        $parNav['kategori_parent']=$nav;
        $dataNav=$this->getNavParent($parNav);
        if(sizeof($dataNav)<=0)
        {
          $parnav['kategori_parent']=$nav;
          $parnav['deleteable']=1;
          $parnav['status']=1;

          $id_nav=$this->tambahNav($parnav);
        }
        else
        {
          $id_nav=$dataNav[0]['id_kategori_parent'];
        }

        $parSubNav['id_kategori_parent']=$id_nav;
        $parSubNav['kategori']=$subnav;
        $parSubNav['deleteable']=1;
        $parSubNav['status']=1;
        $parSubNav['another_link']=$link;

        $id_subnav=$this->tambahNavChild($parSubNav);

        $result = $id_subnav;
        $this->db->trans_complete();
        if(!$this->db->trans_status())
        {
             $result = 0;
        }

        return $result;
      }

      function getPost($par)
      {
        $data = $this->db->get_where('a_post', $par);
        return $data -> result_array();
      }

      function getSetImages($par)
      {
        $data = $this->db->get_where('a_image_config', $par);
        return $data -> result_array();
      }

      function ubahpost($id_post,$par)
      {
        $this->db->where('id_post', $id_post);
        $data=$this->db->update('a_post', $par);
        return $data;
      }

      function ubahNav($id_nav,$par)
      {
        $this->db->where('id_kategori_parent', $id_nav);
        $data=$this->db->update('a_kategori_parent', $par);
        return $data;
      }

      function ubahSubNav($id_subnav, $par)
      {
        $this->db->where('id_kategori', $id_subnav);
        $data=$this->db->update('a_kategori', $par);
        return $data;
      }

      function ubah_bannerdanmitra($id_bannermitra, $par)
      {
        $this->db->where('id_bannernmitra', $id_bannermitra);
        $data=$this->db->update('a_bannernmitra', $par);
        return $data;
      }

      function ubahimageconfig($idimgconfig,$par)
      {
        $this->db->where('id_image_config', $idimgconfig);
        $data=$this->db->update('a_image_config', $par);
        return $data;
      }

  		function getUploadExcel($par)
   		{
   			$data = $this->db->get_where('upload_excel', $par);
      		return $data -> result_array();
   		}

      function getNav()
      {
        $parParent['a_kategori_parent.status']=1;
        $this->db->join('a_post','a_kategori_parent.parent_id_post=a_post.id_post','left');
         $daPare= $this->db->get_where('a_kategori_parent',$parParent);
         $parents=$daPare -> result_array();

        $result=null;
        foreach ($parents as $key => $value) {
           $result[$key]['parent']=$value;

           $parchild['a_kategori.status']=1;
           $parchild['id_kategori_parent']=$value['id_kategori_parent'];
           $this->db->join('a_post','a_kategori.id_post=a_post.id_post','left');
           $dachild=$this->db->get_where('a_kategori',$parchild);
           $result[$key]['childs']=$dachild -> result_array();
         }

         return $result;
      }

      function hapusbannernmitra($par)
      {
         return $this->db->delete('a_bannernmitra', $par); 
      }

      function hapusnavigasi($par)
      {
        return $this->db->delete('a_kategori_parent', $par); 
      }

      function hapussubnavigasi($par)
      {
        return $this->db->delete('a_kategori', $par); 
      }


      public function record_count($tipe) {
          
          $where['tipe']=$tipe;
          $where['status']=1;
          $this->db->where($where);
          $this->db->from('a_post');
          return $this->db->count_all_results();
      }

      public function fetch_artikel($limit, $start,$tipe) {
          $where['tipe']=$tipe;
          $where['status']=1;
          $this->db->where($where);
          $this->db->order_by('id_post', 'DESC');
          $this->db->limit($limit, $start);
          $query = $this->db->get("a_post");

          return $query-> result_array();
          // if ($query->num_rows() > 0) {
          //     foreach ($query->result() as $row) {
          //         $data[] = $row;
          //     }
          //     return $data;
          // }
          // return false;
     }
	}
?>