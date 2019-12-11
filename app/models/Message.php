<?php

class Message
{
    private $_db;
    private $_table = 'messages';

    public function __construct() {
        $this->_db = new Database;
    }

    public function addMessage($data) {
        $this->_db->query("
                        INSERT INTO $this->_table
                        (message_parent_id, user_id, message)
                        VALUES
                        (:pId, :uId, :msg)
                    ");

        $this->_db->bind(':pId', '0');
        $this->_db->bind(':uId', $data['user_id']);
        $this->_db->bind(':msg', $data['message']);

        return $this->_db->execute();
    }

    public function addReply($data, $id) {
        $this->_db->query("
                        INSERT INTO $this->_table
                        (message_parent_id, user_id, message)
                        VALUES
                        (:pId, :uId, :msg)
                    ");

        $this->_db->bind(':pId', $id);
        $this->_db->bind(':uId', $data['user_id']);
        $this->_db->bind(':msg', $data['message']);

        return $this->_db->execute();
    }

    public function getMessage($id)
    {
        $this->_db->query("SELECT * FROM $this->_table WHERE id = :id");
        $this->_db->bind(':id', $id);
        return $this->_db->one();
        
    }

    public function getMessageWithReplies($id)
    {
        $this->_db->query("
                        WITH RECURSIVE cte_message AS (
                            SELECT id,
                                message_parent_id,
                                user_id,
                                message,
                                created_at
                            From guestbook.messages
                            WHERE id = :id
                            UNION ALL
                            SELECT m.id,
                                m.message_parent_id,
                                m.user_id,
                                m.message,
                                m.created_at
                            FROM guestbook.messages m, cte_message cm
                            WHERE
                                cm.id = m.message_parent_id
                        )
                        SELECT cte_m.*,
                            u.id as uId, u.name 
                        From cte_message cte_m
                        LEFT JOIN users u
                        ON cte_m.user_id = u.id 
                        ORDER BY message_parent_id ASC;
                    ");
        $this->_db->bind(':id', $id);
        return $this->_db->getAll();
        
    }
}   