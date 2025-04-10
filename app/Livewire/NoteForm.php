<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteForm extends Component
{
    public $show = false;
    public $title;
    public $text;
    public $id;

    #[On('open-form')]

    public function open($title = '', $text = '', $id = '')
    {
        $this->title = $title;
        $this->text = $text;
        $this->id = $id;
        $this->show = true;
    }

    public function close()
    {
        $this->show = false;
    }

    public function save()
    {
        $note = new Note();
        //update
        $note = Note::find($this->id) ?? new Note();

        $note->title = $this->title;
        $note->text = $this->text;
        $note->user_id = Auth::id();
        $note->save();

        $this->dispatch('save');

        $this->dispatch('note-created');
        $this->reset();
        $this->close();
    }

    public function render()
    {
        return view('livewire.note-form');
    }
}
