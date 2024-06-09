<?php
require_once 'Database.php';

class ChatModel extends Model
{
    protected static $_table_name = 'message';

    public function saveMessage($data, $date, $Teams_idTeam, $Users_idUser) {
        $db = Database::getInstance()->getDb();
        $stmt = $db->prepare("INSERT INTO message (data, date, Teams_idTeam, Users_idUser) VALUES (:data, :date, :Teams_idTeam, :Users_idUser)");
        return $stmt->execute([
            ':data' => $data,
            ':date' => $date,
            ':Teams_idTeam' => 1,
            ':Users_idUser' => $Users_idUser
        ]);
    }
    
    public function getMessages($Teams_idTeam) {
        $db = Database::getInstance()->getDb();
        $stmt = $db->prepare("SELECT message.*, users.name AS userName FROM message 
                              INNER JOIN users ON message.Users_idUser = idUsers 
                              WHERE message.Teams_idTeam = :Teams_idTeam 
                              ORDER BY message.date ASC");
        $stmt->execute([':Teams_idTeam' => $Teams_idTeam]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}