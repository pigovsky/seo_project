<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'editable.php';

class Trade extends Editable {
	function __construct()
	{
		parent::__construct();		
                $this->upload_path = './img/';
                $this->table='trade';
	}
       
        public function edit_trades(){
            $this->forAdminOnly();
            $this->db->select('id,trade.trade');
            $this->prepareView(
                'trade/edit_trades',
                array('trades'=>
                  $this->getIdVal('trade',
                          'trade')));
        }

        public function edit($id){
            $this->forAdminOnly();

            $trade = $this->getRowById($id);

            $data = $this->getUniversals();
            $data['trade_to_edit']=$trade;
            $this->prepareView(
                'trade/edit',
                $data);
        }

        public function insert(){
            $this->forAdminOnly();

            $data = $this->getUniversals();
            $data['trade_to_edit']=FALSE;

            $this->prepareView(
                'trade/edit',
                $data);
        }

	public function index()
	{		
		$this->edit_trades();
	}

	private function removeImage($img){
                $filename = $this->upload_path.$img;
                //echo 'removing '.$filename;
                
		if (strlen($img)>0 &&
                    file_exists($filename))
                        unlink($filename);
                
	}

        public function remove($id){
		$this->forAdminOnly();
		$trade = $this->getRowById($id);
		$trade = get_object_vars($trade);
		for ($i=1; $i<=Editable::numberOfImages; $i++){
			$this->removeImage($trade['img'.$i]);
		}

		parent::remove($id);
	}

	public function updating(){                
		$this->configureUpload();
		$id = $_POST['id'];

		$trade = $this->getRowById($id);
		$trade = get_object_vars($trade);

		for ($i=1; $i<=Editable::numberOfImages; $i++)
			$this->uploadImage($i, $trade);			
                parent::updating();
	}

        private function uploadImage($i, $trade=FALSE){
            if (!$this->upload->do_upload('img'.$i))
		return;//echo $this->upload->display_errors();
            if ($trade!=FALSE)
                $this->removeImage($trade['img'.$i]); // delete the old picture
            $data = $this->upload->data();
            $config['source_image'] = $data['full_path'];
            chmod($data['full_path'],0777);
            $this->image_lib->resize();
            $_POST['img'.$i]=$data['file_name']; // store path to the new picture in db
        }

        public function show($id){
            redirect ('subdomain/all/0/1?city=&state=&subdomain=&take_trade=1&trade_id='.$id);
        }

	private function configureUpload(){
                $this->forAdminOnly();
		$config['upload_path'] = $this->upload_path;
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['encrypt_name']=true;
		$config['image_library'] = 'gd2';
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = TRUE;
		$config['width'] = 75;
		$config['height'] = 50;

		$this->load->library('image_lib', $config);
		$this->load->library('upload', $config);
	}

	public function inserting(){               		
		$this->configureUpload();
		for ($i=1; $i<=Editable::numberOfImages; $i++)
			$this->uploadImage($i);
		parent::inserting();
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
