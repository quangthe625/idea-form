<?php

namespace App\Livewire;

use App\Models\Note;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class NoteManage extends Component
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
        $notes = Note::with('user')
            ->withCount('likes')
            ->where('user_id', Auth::id())
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->when($this->sortByLikes, function ($query) {
                return $query->orderBy('likes_count', $this->sortByLikes);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.note-manage', [
            'notes' => $notes,
        ]);
    }
}