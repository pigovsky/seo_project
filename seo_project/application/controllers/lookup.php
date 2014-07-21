<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once ('welcome.php');

class Lookup extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url'));
		$this->load->library('session');             
	}

        var $maximal_number_of_variants = 100;

        public function validate($id=0){            
            
            $city = trim($_REQUEST['city']);
            $trade_id = $_REQUEST['trade_id'];
            
            $query = $this->db->get_where('subdomain',
                    array('city'=>$city,
                          'trade_id'=>$trade_id
                        ))->result();
            if (sizeof($query)>0){
                $query=$query[0];
                if ($query->id!=$id){
                    $trade = $this->db->get_where('trade',
                        array('id'=>$trade_id))->result();
                    $trade = $trade[0];
                    echo 'the city-trade "'.$city.'"'.
                        '-"'.$trade->trade.'" pair'.
                        ' is already in use';
                    return;
                }
            }
            echo 'OK';
        }

	public function index($field){
            $this->db->distinct();
            $this->db->select($field);
            $this->db->like(
               array ($field=>$_GET['query']));
            $query = $this->db->get('subdomain',
               $this->maximal_number_of_variants);
            foreach ($query->result() as $row){
                $row = get_object_vars($row);
                echo $row[$field]."\n";
            }
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
