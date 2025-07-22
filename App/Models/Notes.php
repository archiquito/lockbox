<?php

namespace App\Models;

use Core\Database;

class Notes
{
    public $id;

    public $title;

    public $note;

    public $user_id;

    public $created_at;

    public $updated_at;

    public static function create($data)
    {
        $DBCONN = new Database(config('database'));
        $sql = 'INSERT INTO notes (title, note, user_id) VALUES (:title, :note, :user_id)';
        $DBCONN->query(
            query: $sql,
            params: $data

        );
    }

    public static function update($data)
    {
        $DBCONN = new Database(config('database'));
        $sql = 'UPDATE notes SET title = :title, note = :note, updated_at = :updated_at WHERE id = :id AND user_id = :user_id';
        $DBCONN->query(
            query: $sql,
            params: array_merge($data, ['updated_at' => date('Y-m-d H:i:s')])
        );
    }

    public static function delete($id)
    {
        $DBCONN = new Database(config('database'));
        $sql = 'DELETE FROM notes WHERE id = :id AND user_id = :user_id';
        $DBCONN->query(
            query: $sql,
            params: [
                'id' => $id,
                'user_id' => auth()['id'],
            ]
        );
    }

    public static function getAllNotes()
    {
        $DBCONN = new Database(config('database'));
        $search = $_GET['search'] ?? '';
        $strCleaner = strtolower($search);
        $sql = 'SELECT * FROM notes WHERE LOWER(title) like :search AND user_id=:user_id ORDER BY created_at DESC';
        $result = $DBCONN->query(query: $sql, class: Notes::class, params: ['search' => "%$strCleaner%", 'user_id' => auth()['id']])->fetchAll();
        if (! $result) {
            return [];
        }

        return $result;
    }

    public static function getNote($id)
    {
        $DBCONN = new Database(config('database'));
        $sql = 'SELECT * FROM notes WHERE id=:id AND user_id=:user_id';

        return $DBCONN->query(query: $sql, class: Notes::class, params: ['id' => $id, 'user_id' => auth()['id']])->fetch();
    }

    public function note()
    {
        if (session()->get('uncrypt')) {
            return decrypt($this->note);
        }

        return str_repeat('•', strlen($this->note));
    }

    public function title()
    {
        if (session()->get('uncrypt')) {
            return decrypt($this->title);
        }

        return str_repeat('•', strlen($this->title));
    }
}
