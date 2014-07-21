<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'editable.php';

class Subdomain extends Editable {
	function __construct()
	{
		parent::__construct();		
		$this->load->library('pagination');
                $this->upload_path='./img';
		$this->per_page=50; // Number of subdomains per page
                $this->domainname = FALSE;
                $this->table='subdomain';
	}

        private function configureUpload(){
		$config['upload_path'] = $this->upload_path;
		$config['allowed_types'] = '*';
		$config['encrypt_name']=true;		
		$this->load->library('upload', $config);
	}

        public function csv(){
            $this->forAdminOnly();
            $this->configureUpload();
            if ($this->upload->do_upload('csvfile')){
                $data = $this->upload->data();
                //print_r($data);
		$full_path = $data['full_path'];
                $fp = fopen ($full_path, "r");

                while (!feof ($fp)) {
                    $line = fgets($fp);
                    $line = explode(',', $line);
                    foreach ($line as $k=>$v)
                        if(is_string($v))
                            $line[$k]=trim($v);
                    if (strcasecmp('State', $line[0])==0)
                            continue;
                    if(sizeof($line)<4)
                        break;
                    $State=$line[0];
                    $City=$line[1];
                    $Trade=$line[2];
                    $SubTrades=$line[3];

                    $trade_id = $this->db->get_where('trade',
				array('trade'=>$Trade) )->result();
                    if (sizeof($trade_id)<=0){
                        echo 'The trade '.$Trade.
                            'is unknown. Add it using admin panel'.
                        ' and try again, please.';
                        return ;
                    }
                    $trade_id=$trade_id[0];
                    $trade_id=$trade_id->id;

                    $subdomain =
                        $this->generateSubdomainName(
                            $City, $Trade);
                    
                    $data=array('city'=>$City,
                        'state'=>$State,
                        'trade_id'=>$trade_id,
                        'subtrade'=>$SubTrades,
                        'subdomain'=>$subdomain,
                        'subdomaincontent'=>'%templatecontent% %tradecontent%');
                    
                    $this->db->where(
                            array($this->table => $subdomain));                                
                    if ($this->db->count_all_results($this->table)>0){
                        $this->db->where(
                            array($this->table => $data[$this->table]));
                        $this->db->update($this->table,$data);
                    }
                    else
                        $this->db->insert($this->table, $data);
                }
                
                fclose($fp);
                chmod($full_path,0777);
                unlink($full_path);
                redirect('subdomain/all');
            }
            else
                echo $this->upload->display_errors();
                    
        }

        public function show($id){
            redirect('welcome/show/'.$id);
        }

        private function getSubdomainInfo($id){
            $subdomain = $this->db->get_where('subdomain',
				array('id'=>$id) )->result();

            $subdomain = $subdomain[0];
            $subdomain->subtrade = explode(Editable::subtradedelimiter,
                    $subdomain->subtrade);
            return $subdomain;
        }

        protected function preparePost(){

            foreach($_POST as $key=>$val){
                if(is_string($val))
                    $_POST[$key]=trim($val);
            }

            $_POST['subtrade']=implode(Editable::subtradedelimiter,
                    $_POST['subtrade']);

            //print_r($_POST);

            $trade = $this->getRowById($_POST['trade_id'], 'trade');
                        
            $_POST['subdomain']=$this->generateSubdomainName(
                    $_POST['city'], $trade->trade);
            
            return $_POST;
        }

        var $domainname = FALSE;

        public function generateSubdomainName($city,$trade){
            if ($this->domainname==FALSE){
                $q = $this->getRowById('domain', 'universal');                
                $this->domainname=$q->_value;
            }
            return str_replace(array(' ','\t'),
                    '', strtolower(
                         $city.
                         $trade.'.'.$this->domainname ));
        }

	public function edit($id){
		$this->forAdminOnly();		
		$data = $this->getUniversals();
		$data['sd']=$this->getSubdomainInfo($id);
		$this->prepareView(
                    'subdomain/insert_page',
                    $data);
	}
	
	
	public function insert(){
		$this->forAdminOnly();
		$this->prepareView(
                    'subdomain/insert_page',
                    $this->getUniversals());
	}

	public function change_universals(){
		$this->forAdminOnly();

		$this->prepareView(                    
                    'universal/change_universals',
                    $this->getUniversals());
	}        

	public function changing_universals(){
		$this->forAdminOnly();
		foreach($_POST as $key => $val){
			$this->db->where('id', $key);
			$data = array ('_value'=>$val);
			$this->db->update('universal', $data); 
		}
		redirect('subdomain/change_universals');
	}

        
	private function getSearchRequest(){
		return $this->session->userdata('sarch_request');
	}

	private function searchHelper(){
		$search_request = $this->getSearchRequest();
		// The function userdata returns FALSE (boolean) 
		// if the item you are trying to access does not exist.
		if ($search_request==FALSE)
			return;                
                
                // Next cycle is to fix session
                // search bug and shall be removed
                // in final version of the app
                foreach ($this->search_cols as $key)                                      
                    $q ['subdomain.'.$key]=
                        $search_request[$key];                

                if ($search_request['take_trade']==1)
                    $this->db->where(
                         array ('trade_id'=>
                            $search_request['trade_id']));                   
                $this->db->like($q);
	}

        var $search_cols = array ('city','state','subdomain');

        public function index(){
            $this->all();
        }

	public function all($p=0, $search=0){
		$config['base_url'] = base_url().'index.php/subdomain/all/';		
		if ($search==1){ // $search==1 when search is changed or started
                        $sarch_request['take_trade']=0;
                        foreach ($_REQUEST as $key => $val)
                            if(in_array($key,
                                    array_merge($this->search_cols,
                                            array('trade_id','take_trade'))))
                                $sarch_request[$key]=$val;
			$this->session->set_userdata(
				array('sarch_request'=>$sarch_request));
		}
		$this->searchHelper();
		$this->db->select('count(*) as cnt');
		$query = $this->db->get('subdomain')->result();
		$cnt = $query[0]->cnt;
		//echo $cnt;
		$config['total_rows'] = $cnt;
		$config['per_page'] = $this->per_page;
		$this->pagination->initialize($config);
		
		$isadmin= $this->session->userdata('isadmin');
		$table_cols = array('subdomain', 'city','state','trade');
                $this->db->select( 'subdomain.id as id,subdomain, city,state,trade');
		$this->searchHelper();
                $this->db->join('trade', 'trade.id = subdomain.trade_id');
		$query = $this->db->get('subdomain',
                    $this->per_page,
                    $p);
		$this->prepareView(
                    
                    'welcome_message',
                    array('subdomains'=>
                        $query->result(),
                        'isadmin'=>$isadmin,
                        'table_cols'=>$table_cols,
                        'last_search'=>$this->getSearchRequest(),
                        'searching_form'=>true,
                        'trades'=>$this->getIdVal('trade', 'trade')
                    ));
	}

        
	
}


