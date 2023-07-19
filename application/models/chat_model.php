<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat_model extends CI_Model
{
    public function getChatHistory()
    {
        $this->db->select('*');
        $this->db->from('order_chat');
        $this->db->order_by('timestamp', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function insertMessage($data)
    {
        $this->db->insert('order_chat', $data);
    }
}
