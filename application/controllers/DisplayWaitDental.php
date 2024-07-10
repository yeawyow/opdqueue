<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayWaitDental extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
        $cur_date = date('Y-m-d'); 
        //echo $cur_date;
        //$this->$hosxp = $this->load->database('hosxp', TRUE); 
        $queue = $this->load->database('queue',true);

        $queue->select('value_name');
        $queue->where('id', 'dep_Exam_monitor');
        $queue->from('sys_value');
        $query = $queue->get()->result();

        foreach($query as $val){
            
            $qdep =$val->value_name;
        }

        $queue->select('sub_queue');
        $queue->from('sys_configs');
        $data['q'] = $queue->get()->row();


        $sql = $this->db->query("SELECT   ovst.hn,ovst.vn,ovst.`vstdate`,ovst.`oqueue`,ovst.`main_dep_queue`,ovst.`pt_priority`,
        SUBSTRING(CONCAT(ovstost.name,' [',spclty.name,']'),1,250) AS ovstname,t.pdx AS icdcode,icd101.name AS icdname,
        patient.birthday,CONCAT(patient.pname,' ',patient.fname,' ', patient.lname) AS ptname,dtmain.dn,kd.department AS department_name  
        , r.vn AS rx_vn,t.rcpno_list ,dl.dt_list,pty.name AS pttype_name  
        FROM ovst  
        LEFT OUTER JOIN vn_stat t ON t.vn=ovst.vn  
        LEFT OUTER JOIN spclty ON spclty.spclty=ovst.spclty  
        LEFT OUTER JOIN patient ON ovst.hn=patient.hn 
        LEFT OUTER JOIN ovstost ON ovst.ovstost=ovstost.ovstost  
        LEFT OUTER JOIN icd101 ON icd101.code=t.pdx  
        LEFT OUTER JOIN dtmain ON dtmain.vn = ovst.vn AND dtmain.tm_no = 1  
        LEFT OUTER JOIN pttype pty ON pty.pttype = ovst.pttype  
        LEFT OUTER JOIN kskdepartment kd ON kd.depcode = ovst.cur_dep  
        LEFT OUTER JOIN rx_operator r ON r.vn=ovst.vn AND r.pay='Y'  
        LEFT OUTER JOIN dt_list dl ON dl.vn=ovst.vn  
        WHERE  ovst.vstdate='$cur_date'  
        AND (ovst.pt_priority ='0' OR ovst.pt_priority IS NULL)
        AND ovst.cur_dep='005'
        ORDER BY ovst.pt_priority DESC,ovst.`main_dep_queue` -- ovst.cur_dep_time,ovst.vsttime
        ");

        $sql2 = $this->db->query("SELECT   ovst.hn,ovst.vn,ovst.`vstdate`,ovst.`oqueue`,ovst.`main_dep_queue`,ovst.`pt_priority`,
            SUBSTRING(CONCAT(ovstost.name,' [',spclty.name,']'),1,250) AS ovstname,t.pdx AS icdcode,icd101.name AS icdname,
            patient.birthday,CONCAT(patient.pname,' ',patient.fname,' ', patient.lname) AS ptname,dtmain.dn,kd.department AS department_name  
            , r.vn AS rx_vn,t.rcpno_list ,dl.dt_list,pty.name AS pttype_name  
            FROM ovst  
            LEFT OUTER JOIN vn_stat t ON t.vn=ovst.vn  
            LEFT OUTER JOIN spclty ON spclty.spclty=ovst.spclty  
            LEFT OUTER JOIN patient ON ovst.hn=patient.hn 
            LEFT OUTER JOIN ovstost ON ovst.ovstost=ovstost.ovstost  
            LEFT OUTER JOIN icd101 ON icd101.code=t.pdx  
            LEFT OUTER JOIN dtmain ON dtmain.vn = ovst.vn AND dtmain.tm_no = 1  
            LEFT OUTER JOIN pttype pty ON pty.pttype = ovst.pttype  
            LEFT OUTER JOIN kskdepartment kd ON kd.depcode = ovst.cur_dep  
            LEFT OUTER JOIN rx_operator r ON r.vn=ovst.vn AND r.pay='Y'  
            LEFT OUTER JOIN dt_list dl ON dl.vn=ovst.vn  
            WHERE  ovst.vstdate='$cur_date'  
            AND ovst.pt_priority IN('1','2')
            AND ovst.cur_dep='005'
            ORDER BY ovst.pt_priority DESC,ovst.`main_dep_queue`");

        $data['pt'] = $sql->result();
        $data['priority'] = $sql2->result();
        //print_r($sql->result());

        $this->load->view('DisplayWaitDental_view',$data);
        

    } 

    public function getPatientName(){
        $cur_date = date('Y-m-d');

        $queue = $this->input->post('q');
        
        $sql = $this->db->query(" SELECT  fname,lname FROM ovst o
        LEFT JOIN patient pt ON pt.hn=o.hn
        WHERE oqueue= $queue AND vstdate='$cur_date' ");

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

    public function getComputerName(){

        $data = array(
            'vn'=>$this->input->get('fvn'),
            'comname'=>$this->input->get('fcomputername'),
            'depcode'=>$this->input->get('fdepartment')
        );

        $this->db->replace('wanorn_queue_computername', $data);
        redirect('index.php/DisplayWaitExamination/closepage');
    }

	public function closepage(){
        
        $this->load->view("close_popup_veiw");
    }	
}