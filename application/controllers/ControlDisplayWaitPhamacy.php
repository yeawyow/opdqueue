<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ControlDisplayWaitPhamacy extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
        $this->load->view('ControlDisplayWaitPhamacy_view');
    } 

    public function displayControlRoom2(){
        $this->load->view('ControlDisplayWaitPhamacy_view2');
    }

    public function getPatientName(){
        $cur_date = date('Y-m-d');

        $hn = $this->input->post('hn');
       // $hn='000006216';
        
        $sql = $this->db->query(" SELECT  fname,lname,vn FROM ovst o
        LEFT JOIN patient pt ON pt.hn=o.hn
        WHERE o.hn= $hn AND vstdate='$cur_date' ");

        foreach($sql->result() as $a){
            $fname = $a->fname;
            $lname = $a->lname;
        }

        $text = $fname;
        $lang = "th-TH";
        $file = "./audio/" . $text .".mp3";

        if (!file_exists($file))
        {
            $mp3 = file_get_contents(
            'https://translate.google.com/translate_tts?ie=UTF-8&q='. urlencode($text) .'&tl='. $lang .'&client=tw-ob');
            file_put_contents($file, $mp3);
        }

        $text = $lname;
        $lang = "th-TH";
        $file = "./audio/" . $text .".mp3";

        if (!file_exists($file))
        {
            $mp3 = file_get_contents(
            'https://translate.google.com/translate_tts?ie=UTF-8&q='. urlencode($text) .'&tl='. $lang .'&client=tw-ob');
            file_put_contents($file, $mp3);
        }

        echo json_encode($sql->result());

    }

    public function getOrder(){

        $data = array(
            'vn'=>$this->input->get('fvn'),
            'comname'=>$this->input->get('fcomputername'),
            'depcode'=>$this->input->get('fdepartment')
        );

        $this->db->replace('wanorn_queue_phama', $data);

        redirect('index.php/DisplayWaitExamination/closepage');
    }

	public function updateDispense(){
        
        $data = array(
            'status'=>'Y'
        );

        $this->db->where('vn', $this->input->post('vn'));
        $this->db->update('wanorn_queue_phama', $data);
        echo $this->db->affected_rows();
    }

		
}