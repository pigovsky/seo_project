<?php
class Editable extends CI_Controller {

    var $table;

    function __construct(){
	parent::__construct();
	$this->load->database();
	$this->load->helper(array('form', 'url'));
	$this->load->library('session');
    }

    protected function preparePost(){
        return $_POST;
    }

    public function inserting(){
        $this->forAdminOnly();

        $this->db->insert($this->table, $this->preparePost());
        $this->prepareView(
            'edit_success',
            array ('what'=>$this->table,
                   'upload_data'=>$_POST,
                   'isadded'=>true,
                   'id'=>$this->db->insert_id()
            ));
    }

    public function updating(){
        $this->forAdminOnly();
        $id = $_POST['id'];

        $data = $this->preparePost();
        $this->db->where('id', $id );
        $this->db->update($this->table, $data );
        $this->prepareView(
            'edit_success',
            array ('what'=>$this->table,
                   'upload_data'=>$_POST,
                   'isadded'=>FALSE,
                   'id'=>$id
            ));
    }

    public function remove($id){
        $this->forAdminOnly();
        $this->db->delete($this->table,
                        array('id'=>$id) );
        redirect($this->table);
    }

    public function getRowById($id, $table = FALSE){
        if ($table==FALSE)
            $table = $this->table;
        $row = $this->db->get_where($table,
                array('id'=>$id)
                )->result();

        return $row[0];
    }


    public function prepareView(
        $body=FALSE,
        $data = array(),
        $subdomain = array('metatitle'=>'',
                           'metadescription'=>'',
                           'metakeywords'=>'',
                           'city'=>'unknown city',
                           'state'=>'unknown state',
                           'pagetitle'=>'Admin panel',
                           'trade'=>'unknown trade',
                           'img1'=>'/images/logo-trg.gif',
                           'trade_id'=>0
                            )
	){
        $isadmin= $this->session->userdata('isadmin');
        $login= $this->session->userdata('login');
        $opts = array(  'siteurl'=>Editable::domain,
                        'isadmin'=>$isadmin,
                        'login'=>$login,
                        'page'=>FALSE,
                        'searching_form'=>FALSE);
        foreach ($data as $key=>$val)
            $opts[$key]=$val;
        foreach ($subdomain as $key=>$val)
            $opts[$key]=$val;


        if ($body!=FALSE){
            $opts['page']=
                Editable::views_dir.$body.'.php';
            $this->load->view(Editable::template_dir.'146/default',
                $opts);
        }
        else
            $this->load->view(Editable::template_dir.'index',
                $opts);
    }

    const template_dir = 'template/';
    const views_dir = 'application/views/';
    const domain = 'http://totalrenovationgroup.com/';
    const subtradedelimiter = '|';
    const numberOfImages = 3;

    public function getIdVal($tab,$col){
        $r=
            $this->db->get($tab)->result();

        foreach ($r as $val){
            $val = get_object_vars($val);
            $a[$val['id']]=$val[$col];
        }
        return $a;
    }

    public function forAdminOnly(){
        $isadmin= $this->session->userdata('isadmin');
            if (!$isadmin)
                    redirect('admin/login');
    }

    public function getUniversals(){		
        return
            array(
                'error' =>'',
                'universal'=>$this->getIdVal('universal', '_value'),
                'sd'=>FALSE,
                'trades'=>$this->getIdVal('trade', 'trade')
            );
    }
}

?>
