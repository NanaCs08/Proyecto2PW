<?php
require_once 'Database.php';

class LogInModel extends Model
{
    protected static $_table_name = 'users';

    public function findUserByEmail($email)
    {
        $db = Database::getInstance()->getDb();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function registerUser($email, $password, $name, $Teams_idTeam, $apellido1, $apellido2) {
        $db = Database::getInstance()->getDb();
    
        // Verificar si el usuario ya existe
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            return false; // Usuario ya existe
        }
    
        // Insertar nuevo usuario
        $stmt = $db->prepare("INSERT INTO users (email, password, name, Teams_idTeam, apellido1, apellido2) VALUES (:email, :password, :name, :Teams_idTeam, :apellido1, :apellido2)");
        $result = $stmt->execute([
            ':email' => $email,
            ':password' => $password,
            ':name' => $name,
            ':Teams_idTeam' => 1,
            ':apellido1' => $apellido1,
            ':apellido2' => $apellido2
        ]);
    
        return $result;
    }

}