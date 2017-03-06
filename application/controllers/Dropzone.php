<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dropzone extends CI_Controller {
	public function index()
	{
		$this->load->view('dropzone/dropzone');
	}

	function upload()
    {
        $config['upload_path']      = './medias/images/';
        $config['allowed_types']    = "gif";//'jpg|png|gif';
        $config['width']            = 50;
        $config['height']           = 50;
        $this->load->library('upload',$config);

        if($this->upload->do_upload('userfile'))
        {
            $token=$this->input->post('token');
            $file_name=$this->upload->data('file_name');
//            $this->db->insert('file',array('file_name'=>$file_name,'token'=>$token));
        }
        else
        {
            $this->output->set_header("HTTP/1.0 400 Bad Request");
            echo "ไฟล์ไม่ถูกต้อง กรุณาตรวจสอบไฟล์ของคุณใหม่อีกครั้ง";
        }
    }
}
