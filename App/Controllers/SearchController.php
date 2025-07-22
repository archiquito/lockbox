<?php

namespace App\Controllers;

use App\Models\Notes;
use Core\Database;

class SearchController
{
    public function __invoke()
    {

        $search = $_GET['search'] ?? '';
        $strCleaner = strToLower($search);
        $DBCONN = new Database(config('database'));
        $sql = "SELECT * FROM notes WHERE LOWER(title) like :search AND user_id=:user_id ORDER BY created_at DESC";
        $notes = $DBCONN->query(query: $sql, class: Notes::class, params: ['search' => "%$strCleaner%", 'user_id' => auth()['id']])->fetchAll();
        return view('notes', ['user' => auth()['name'], 'notes' => $notes]);
    }
}
