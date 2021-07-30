<?php

namespace App\Http\Controllers;

use App\Note;
use App\NoteSection;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function show(NoteSection $section)
    {
        return $section;
    }

    public function store()
    {

        $this->validate(request(), [
            'name' => 'required',
            'title' => 'required',
            'body' => 'required',
        ]);



        $note = auth()->user()->notes()->updateOrCreate(['name' => request('name')]);


        $section = $note->sections()->create([
            'title' => request('title'),
            'body' => request('body')
        ]);

        return ['message' => 'Note created', 'id' => $section->id];
    }

    public function update(NoteSection $section)
    {
        $section->update(request()->validate(['body' => 'required']));

        return ['message' => 'Successfully updated'];
    }

    public function delete(NoteSection $section)
    {
        $note = $section->note;
        $section->delete();

        if (!$note->sections()->count()) {
            $note->delete();
        }

        return ['message' => 'Successfully deleted'];
    }
}
