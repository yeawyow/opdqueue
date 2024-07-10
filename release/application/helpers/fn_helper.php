<?php
    function getSubqueue() {
        $db2 = $this->load->database('queue', TRUE);
        $ci =& get_instance();
        $rs = $ci->db2->get('sys_configs');
        return $rs->row()->sub_queue;
    }

?>