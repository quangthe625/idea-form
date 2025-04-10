<?php

namespace App\Livewire;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class NoteApp extends Component
{
    public $search = '';
    public $query = '';

    public $sortByLikes = null;

    public $onlyMine = false;
    public $editable = true;

    public function searchNotes()
    {
        $this->query = $this->search;
    }

    public function updatedSortByLikes()
    {
        // Automatically triggered when sortByLikes changes
    }


    public function open()
    {
        $this->dispatch('open-form');
    }

    public function edit(Note $note)
    {
        // Pass data to the frontend (a Livewire or JS listener will handle the form)
        $this->dispatch('open-form', title: $note->title, text: $note->text, id: $note->id);
    }

    public function delete(Note $note)
    {
        if ($note->user_id !== Auth::id()) {
            abort(403);
        }

        $note->delete();

        // Refresh the component view
        $this->dispatch('$refresh');

        // Optional: show a flash message
        session()->flash('message', 'Note deleted successfully.');
    }

    #[On('note-created')] // Custom event fired after creating/updating a note
    public function refreshNotes()
    {
        $this->dispatch('$refresh');
    }

    public function render()
    {
        $query = Note::with('user')
            ->withCount('likes');

        if (!empty($this->search)) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->sortByLikes)) {
            $query->orderBy('likes_count', $this->sortByLikes);
        }

        $query->orderBy('created_at', 'desc');

        $notes = $query->get();

        return view('livewire.note-app', [
            'notes' => $notes
        ]);
    }
}