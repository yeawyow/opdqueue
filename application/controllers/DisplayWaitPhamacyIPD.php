<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DisplayWaitPhamacyIPD extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		
	}

    public function index(){
        $cur_date = date('Y-m-d'); 
        $yy = date('Y');
        $Y = substr($yy+543,2).date('md');

        $queue = $this->load->database('queue',true);
        $queue->select('value_name');
        $queue->where('id', 'drug_ipd_room');
        $queue->from('sys_value');
        $query = $queue->get()->result();

        foreach($query as $val){
            
            $qdep =$val->value_name;
        }

        $queue = $this->load->database('queue',true);
        $queue->select('drug_queue');
        $queue->from('sys_configs');
        $data['q'] = $queue->get()->row();

        $sql = $this->db->query("SELECT v.vn,v.rx_queue,v.hn,v.pt_priority,pty.pcode,v.oqueue,(vns.rcpt_money-vns.paid_money) AS pmoney,
        v.cur_dep_time,q2.stock_department_queue_no,COUNT(s.vn) AS svn_count,    COUNT(r.vn) AS rx_count,COUNT(r1.vn) AS pay_count  ,
        COUNT(t.vn) AS finance_count,COUNT(r2.vn) AS rx_print_count   , k.department  , CONCAT(p.pname,p.fname,'  ',p.lname) AS ptname
        ,COUNT(op.icode)AS cc  
        FROM ovst v 
        LEFT OUTER JOIN patient p ON p.hn=v.hn  
        LEFT OUTER JOIN pq_doctor s ON s.vn=v.vn  
        LEFT OUTER JOIN rx_operator r ON r.vn=v.vn  
        LEFT OUTER JOIN rcpt_print t ON t.vn=v.vn 
        LEFT OUTER JOIN pttype pty ON pty.pttype = v.pttype  
        LEFT OUTER JOIN kskdepartment k ON k.depcode=v.last_dep  
        LEFT OUTER JOIN rx_operator r1 ON r1.vn=v.vn AND r1.pay='Y' 
        LEFT OUTER JOIN rx_operator r2 ON r2.vn=v.vn AND r2.rx_print='Y'  
        LEFT OUTER JOIN vn_stat vns ON vns.vn = v.vn  
        LEFT OUTER JOIN ovst_seq q2 ON q2.vn = v.vn AND q2.stock_department_id = 0 
        LEFT OUTER JOIN opitemrece op ON v.vn=op.vn AND icode LIKE'1%' 
        WHERE v.vstdate= '$cur_date' 
        AND  r.`rx_depcode` IN($qdep) -- in('030','083')
        -- AND (v.pt_priority = 0 )
        GROUP BY v.vn,v.rx_queue,v.hn,v.pt_priority,pty.pcode,v.oqueue,v.cur_dep_time,p.pname,p.fname,p.lname ,k.department,q2.stock_department_queue_no,vns.rcpt_money,vns.paid_money 
        ORDER BY v.pt_priority DESC,v.rx_queue,v.cur_dep_time ");

        $sql2 = $this->db->query("SELECT i.*  ,ou.name AS staff_name,t.hn,CONCAT(p.pname,p.fname,'  ',p.lname) AS ptname  ,w.name AS ward_name,d.bedno  
        FROM ipt_order_no  i  
        LEFT OUTER JOIN ipt t ON t.an = i.an  
        LEFT OUTER JOIN patient p ON p.hn = t.hn  
        LEFT OUTER JOIN ward w ON w.ward = i.ward  
        LEFT OUTER JOIN iptadm d ON d.an = t.an  
        LEFT OUTER JOIN medpay_ipd_head h ON h.med_rx_number = i.order_no  
        LEFT OUTER JOIN opduser ou ON ou.loginname = i.confirm_staff  
        WHERE i.rxdate = '$cur_date'   
        AND i.order_type IN ('Hme')  
        AND i.confirm_prepare='N'  
        ORDER BY i.ward,i.order_no ");


        $data['pt'] = $sql->result();
        $data['priority'] = $sql2->result();
        //echo json_encode($data);
        $this->load->view('DisplayWaitPhamacy_viewIPD',$data);
        

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

        //echo $fcomputername  = $this->input->get('fcomputername');
        //echo $fdepartment = $this->input->get('fdepartment');
        //echo $fvn = $this->input->get('fvn');

        $data = array(
            'vn'=>$this->input->get('fvn'),
            'comname'=>$this->input->get('fcomputername'),
            'depcode'=>$this->input->get('fdepartment')
        );

        
        $this->db->replace('wanorn_queue_phama', $data);
    }

    public function test(){
        echo  $cur_date = date('Y-m-d');
        echo $yy = date('Y');
        echo "<br />";
        $Y = substr($yy+543,2).date('md');
        $md = date('md');
       echo $Y;

    }
		
}
