<?php

namespace App\Controllers;

use Core\Database;
use Core\Validation;
use App\Models\Notes;

class NotesController
{
    public function index()
    {
        $id = $_GET['id'] ?? null;

        $notes = $this->getAllNotes();
        if ($id) {
            $filter = array_filter($notes, fn($note) => $note->id == $id);
            $selectedNote = array_pop($filter); // Get the first note that matches the ID
        } else {
            $selectedNote = $notes[0] ?? null; // Default to the first note if no ID is provided
        }
        return view('notes', ['user' => auth()['name'], 'notes' => $notes, 'selectedNote' => $selectedNote ?? null]);
    }

    public function make()
    {
        $notes = $this->getAllNotes();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $title =  $_POST['title'];
            $note = $_POST['note'];
            $userId = auth()['id'];

            $validate = Validation::validate([
                'title' => ['required', 'min:3'],
                'note' => ['required'],
            ], $_POST);

            if ($validate->validateFail()) {
                flash()->make('noteValidation', $validate->arrValidations);
                return view('notes-make', ['user' => auth()['name']]);
            }

            $DBCONN = new Database(config('database'));
            $sql = "INSERT INTO notes (title, note, user_id) VALUES (:title, :note, :user_id)";
            $DBCONN->query(
                query: $sql,
                params: [
                    'title' => $title,
                    'note' => $note,
                    'user_id' => $userId,
                ]
            );
            flash()->make('msg', 'Nota criada com sucesso!');
            return view('notes', ['user' => auth()['name'], 'notes' => $notes]);
        }

        return view('notes-make', ['user' => auth()['name'], 'notes' => $notes]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $title =  $_POST['title'];
            $note = $_POST['note'];
            $userId = auth()['id'];

            $validate = Validation::validate([
                'title' => ['required', 'min:3'],
                'note' => ['required'],
            ], $_POST);

            if ($validate->validateFail()) {
                flash()->make('noteValidation', $validate->arrValidations);
                return view('notes-make', ['user' => auth()['name']]);
            }

            $DBCONN = new Database(config('database'));
            $sql = "UPDATE notes SET title = :title, note = :note, updated_at = :updated_at WHERE id = :id AND user_id = :user_id";
            $DBCONN->query(
                query: $sql,
                params: [
                    'title' => $title,
                    'note' => $note,
                    'id' => $id,
                    'user_id' => $userId,
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );
            flash()->make('msg', 'Nota atualizada com sucesso!');
            $notes = $this->getAllNotes();
            $selectedNote = $this->getNote($id);
            return redirect('/notes?id=' . $selectedNote->id);
            //return view('notes', ['user' => auth()['name'], 'notes' => $notes, 'selectedNote' => $selectedNote]);
        }
    }

    private function getAllNotes()
    {
        $DBCONN = new Database(config('database'));
        $search = $_GET['search'] ?? '';
        $strCleaner = strToLower($search);
        $sql = "SELECT * FROM notes WHERE LOWER(title) like :search AND user_id=:user_id ORDER BY created_at DESC";
        $result = $DBCONN->query(query: $sql, class: Notes::class, params: ['search' => "%$strCleaner%", 'user_id' => auth()['id']])->fetchAll();
        if (!$result) {
            return [];
        }
        return $result;
    }

    private function getNote($id)
    {
        $DBCONN = new Database(config('database'));
        $sql = "SELECT * FROM notes WHERE id=:id AND user_id=:user_id";
        return $DBCONN->query(query: $sql, class: Notes::class, params: ['id' => $id, 'user_id' => auth()['id']])->fetch();
    }
}
