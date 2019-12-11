<?php

class Messages extends Controller
{
    public function __construct() {
        !isUserLogged() ? redirect('users.login') : $this->model('Message');
    }

    public function index() {
        $this->view('messages.index');
    }

    public function message($id) {

        // Get message with its replies
        $data = $this->model->getMessageWithReplies($id);

        if (!empty($data) && $data[0]->message_parent_id == 0) {

            $message = $data[0];
            $isMessageOwner = $message->user_id == $_SESSION['user_id'] ? true : false;
            $message->replies = [];

            foreach($data as $item) {
                if ($item->message_parent_id == $message->id) {
                    $message->replies[] = $item;
                }
            }
    
            foreach($message->replies as $k => $reply) {
                $this->prepareMessage($data, $reply);
            }
    
            $this->view('messages.message', ['message' => $message, 'isMessageOwner' => $isMessageOwner]);
            
        } else {
            $this->view('404');
        }

    }

    // To store message or reply
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'):

            // Get data
            $data = $_POST;
            $data = sanitize($data);
           
            // Check if message is empty
            if (empty($data['message'])):
                $data['message_err'] = 'Plaese write a message.';
            elseif (strlen($data['message']) <= 20):
                $data['message_err'] = 'message must be more than 30 characters.';
            else:
                $data['message_err'] = '';
            endif;

            // Store Or Back with errors
            if (empty($data['message_err'])):
                $data['user_id'] = $_SESSION['user_id'];

                // Choose If Message Or Reply [Store]
                if (!isset($data['replyId'])):
                    $this->model->addMessage($data);
                    flash('msg', 'Message is Added Successfully!');
                    redirect('home');
                else:
                    $this->model->addReply($data, $data['replyId']);
                    $msgId = $data['msgId'];
                    flash('msg', 'Reply is Added Successfully!');
                    redirect("messages.message.$msgId");
                endif;

            else:
                // Choose If Message Or Reply [Back]
                if (!isset($data['replyId'])):
                    $this->view('messages.index', ['data' => $data]);
                else:
                    $this->view('messages.reply', ['data' => $data]);
                endif;
                    
            endif;

        else:
            redirect('users.login');
        endif;
    }

    public function reply($id, $msgId) {
        $data['replyId'] = $id; 
        $data['msgId'] = $msgId;
        $this->view('messages.reply', ['data' => $data]);
    }

    public function edit($msgId = null) {
        $message = $this->model->getMessage($msgId);

        if (!empty($message) && $message->user_id == $_SESSION['user_id']) {
            $this->view('messages.edit', ['data' => [], 'message' => $message]);
        } else {
            $this->view('404');
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST'):

            // Get data
            $data = $_POST;
            $data = sanitize($data);
           
            // Check if message is empty
            if (empty($data['message'])):
                $data['message_err'] = 'Plaese write a message.';
            elseif (strlen($data['message']) <= 20):
                $data['message_err'] = 'message must be more than 30 characters.';
            else:
                $data['message_err'] = '';
            endif;

            // Update Or Back with errors
            if (empty($data['message_err'])):
                $this->model->updateMessage($data['msgId'], $data['message']);
                flash('msg', 'Message is Updated Successfully!');
                redirect('home');
            else:
                $this->view('messages.edit', ['data' => $data]);
            endif;

        else:
            redirect('users.login');
        endif;
    }

    public function delete($id = null) {
        $msg = $this->model->getMessage($id);
        if (!empty($msg) && $msg->user_id == $_SESSION['user_id'] ) {
            $this->model->deleteMessage($id);
            flash('msg', 'Message is Deleted Successfully!');
            redirect('home');
        } else {
            $this->view('404');
        }
    }

    private function prepareMessage($data, $reply) {
        $reply->replies = [];
        foreach($data as $k => $val) {
            if ($val->message_parent_id == $reply->id) {
                $reply->replies[] = $val;

                foreach($reply->replies as $i => $v) {
                    $this->prepareMessage($data, $v);
                }
            }
        }
    }
}