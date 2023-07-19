<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load the model
        $this->load->model('chat_model');
    }

    public function index()
    {
        $this->load->view('chat');
    }

    public function get_chat_history()
    {
        $chat_history = $this->chat_model->getChatHistory();
        echo json_encode($chat_history);
    }

    public function insert_message()
    {
        $data = array(
            'sender_id' => $this->input->post('sender_id'),
            'receiver_id' => $this->input->post('receiver_id'),
            'message' => $this->input->post('message'),
            'timestamp' => date('Y-m-d H:i:s')
        );

        $this->chat_model->insertMessage($data);

        // Send the new message to all connected clients using WebSocket
        $this->send_message_via_websocket($data);

        // Respond to the AJAX request with a success message
        echo json_encode(array('status' => 'success'));
    }

    // Function to send the new message via WebSocket
    private function send_message_via_websocket($message)
    {
        // Load the Socket.io library
        require_once(APPPATH . 'libraries/socket.io/autoload.php');
        $socket_io = new SocketIO();
        $socket_io->initialize();
        $socket_io->emit('new_message', $message);
    }
}
