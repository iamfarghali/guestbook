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
        $this->_db->query("
                        SELECT * FROM $this->_table
                        WHERE id = :id");

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
                        ORDER BY message_parent_id ASC
                    ");
                    
        $this->_db->bind(':id', $id);
        return $this->_db->getAll();
        
    }

    public function getMessages() {
        $this->_db->query("
                    SELECT m.*,
                           u.id as uId, u.name 
                    FROM $this->_table m
                    LEFT JOIN users u
                    ON m.user_id = u.id 
                    WHERE message_parent_id = 0
                    ORDER BY created_at DESC
                ");
        return $this->_db->getAll();
    }

    public function getUserMessages($id) {
        $this->_db->query("
                    SELECT m.*,
                           u.id as uId, u.name 
                    FROM $this->_table m
                    LEFT JOIN users u
                    ON m.user_id = u.id 
                    WHERE m.user_id = :id AND message_parent_id = 0
                    ORDER BY created_at DESC
                ");
        $this->_db->bind(':id', $id);
        return $this->_db->getAll();
    }

    public function updateMessage($id, $message) {

        $this->_db->query("
            UPDATE $this->_table
            SET message = :msg
            WHERE id = :id
        ");
        
        $this->_db->bind(':msg', $message);
        $this->_db->bind(':id', $id);
        $this->_db->execute();
    }

    public function deleteMessage($id) {

        $this->_db->query("
            DELETE FROM messages WHERE id IN (
                WITH RECURSIVE cte_message AS (
                    SELECT id
                    From guestbook.messages
                    WHERE id = :id
                    UNION ALL
                    SELECT m.id
                    FROM guestbook.messages m, cte_message cm
                    WHERE
                        cm.id = m.message_parent_id
                )
                SELECT * From cte_message
            )
        ");
        
        $this->_db->bind(':id', $id);
        $this->_db->execute();
    }

    public function increaseReplyNumByOne($msgId) {

        $this->_db->query("
            UPDATE $this->_table
            SET new_reply_num = new_reply_num + 1
            WHERE id = :msgId
        ");
        $this->_db->bind(':msgId', $msgId);
        $this->_db->execute();
    }

    public function repliesHadSeen($msgId) {

        $this->_db->query("
            UPDATE $this->_table
            SET new_reply_num = 0
            WHERE id = :msgId
        ");
        $this->_db->bind(':msgId', $msgId);
        $this->_db->execute();
    }


}   