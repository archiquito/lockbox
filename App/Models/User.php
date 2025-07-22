<?php
namespace App\Models;
use Core\Database;

class User
{
    public $id;
    public $name;
    public $email;
    public $password;
    public $created_at;

    public static function getUserByEmail($email)
    {
        $DBCONN = new Database(config('database'));
        $sql = "SELECT * FROM users WHERE email = :email";
        return $DBCONN->query(query: $sql, class: self::class, params: ['email' => $email])->fetch();
    }

    public static function create($data)
    {
        $DBCONN = new Database(config('database'));
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $DBCONN->query(
            query: $sql,
            params: $data
        );
    }
}
