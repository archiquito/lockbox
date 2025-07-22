<?php

namespace App\Controllers;

class CryptNotesController
{
    public function unCrypt()
    {
        session()->set('uncrypt', true);
        return redirect('/notes');
    }

    public function crypt()
    {
        session()->destroy('uncrypt');
        return redirect('/notes');
    }
}
