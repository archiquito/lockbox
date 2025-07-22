<?php

namespace App\Controllers;

use App\Models\Notes;
use Core\Validation;

class NotesController
{
    public function index()
    {
        $id = $_GET['id'] ?? null;

        $notes = Notes::getAllNotes();
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
        $notes = Notes::getAllNotes();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $validate = Validation::validate([
                'title' => ['required', 'min:3'],
                'note' => ['required'],
            ], $_POST);

            if ($validate->validateFail()) {
                flash()->make('noteValidation', $validate->arrValidations);

                return view('notes-make', ['user' => auth()['name']]);
            }
            Notes::create([
                'title' => $_POST['title'],
                'note' => encrypt($_POST['note']),
                'user_id' => auth()['id'],
            ]);

            flash()->make('msg', 'Nota criada com sucesso!');

            return redirect('/notes');
        }

        return view('notes-make', ['user' => auth()['name'], 'notes' => $notes]);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $title = $_POST['title'];
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
            Notes::update([
                'title' => $title,
                'note' => encrypt($note),
                'id' => $id,
                'user_id' => $userId,

            ]);
            flash()->make('msg', 'Nota atualizada com sucesso!');
            $selectedNote = Notes::getNote($id);

            return redirect('/notes?id=' . $selectedNote->id);
        }
    }

    public function delete()
    {
        $id = $_GET['id'];

        Notes::delete($id);
        flash()->make('msg', 'Nota deletada com sucesso!');

        return redirect('/notes');
    }
}
