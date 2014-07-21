<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once 'editable.php';


class Welcome extends Editable {
	function __construct()
	{
		parent::__construct();
                
	}
	
        public function getComaSeparatedVals($tab,$col){
            $this->db->distinct();
            $i=0;
            foreach ($this->db->get($tab)->result() as $c){
                $c=get_object_vars($c);
                $vals[$i++]=$c[$col];
            }
            return implode(', ', $vals);
        }

	public function show($id)
	{
                $cities = $this->getComaSeparatedVals('subdomain','city');
                $trades = $this->getComaSeparatedVals('trade', 'trade');                

		$subdomain = $this->getRowById($id, 'subdomain');
		$uni = $this->db->get('universal')->result();
		
		// transform $subdomain object to array:		
		$all=get_object_vars($subdomain);
                $all['cities']=$cities;
                $all['trades']=$trades;
                $trade=$this->db->get_where('trade',
                    array('id'=>$all['trade_id']) )->result();
                if (sizeof($trade)>0){
                    $trade = $trade[0];
                    foreach($trade as $key=>$val)
                        $all[$key]=$val;
                }
                $all['Trade']=ucfirst($all['trade']);
		// add http path to images:
		for ($i = 1; $i<=Welcome::numberOfImages; $i++)
			$all['img'.$i] = base_url(). 'img/'. $all['img'.$i];

		foreach ($uni as $val){
			$all[$val->id]=$val->_value;
		}

		$subtrades = explode(Editable::subtradedelimiter, $all['subtrade']);
                $all['subtrades']=implode(', ', $subtrades);
                $all['sub-trades']=$all['subtrades'];
		foreach($subtrades as $i => $subtrade){
			$all['subtrade' . ($i+1)]=$subtrade;
		}

		for($i=0;$i<2; $i++) // this loop
		// is necessary to be able to use recursive
		// usage of tags 
		// (only recursy deepness of two is allowed), 
		// for example we can specify:
		// 
		// body=some text. %universalbody%
		// universalbody=%company% is the best in the world!
		// company=Total renovation group
		//
		// here %body% will be replaced with 
		// "some text. %company% is the best in the world!"
		// and %company% will be replaced with 
		// "Total renovation group"
		// So the final resulting string will be
		// "some text. Total renovation group is the best
		// in the world!"
		// Infinite recursy is bad idea, because one can
		// write
		// body=%company%
		// company=%body%
		// and the script this way will be broken.
			foreach ($all as $akey => $aval){
				foreach($all as $key => $val){
					$val=str_replace('%'.$akey.'%', $aval, $val);
					$all[$key]=$val;
				}
			}
		
		$this->prepareView(
                    FALSE,
                    array(),
                    $all);
	}
	
	public function index()
	{
		$subdomain = $this->db->get_where('subdomain',
			array('subdomain'=>$_SERVER['HTTP_HOST']) )
				->result();
		$isadmin= $this->session->userdata('isadmin');
		
		if (sizeof($subdomain)==0 || $isadmin)
			redirect('subdomain/all');			
		else
			$this->show($subdomain[0]->id);
	}
}


