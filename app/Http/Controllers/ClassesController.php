<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $classes = Classes::when($search, function ($query, $search) {
            $query->where('name', 'LIKE', "%$search%")
                ->orWhere('section', 'LIKE', "%$search%");
        })
            ->paginate(5);

         $subjects = Subject::pluck('name', 'id');
        return view('classes.index', compact('classes','subjects'));
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('classes.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'section' => 'required',
            'subject_id' => 'required|array',
            'subject_id.*' => 'exists:subjects,id',

        ]);

        Classes::create($request->only('name', 'section', 'subject_id'));

        return redirect()->route('classes.index')->with('success', 'Class added successfully');
    }

    public function edit($id)
    {
        $class = Classes::findOrFail($id);
        $subjects = Subject::all();
        return view('classes.edit', compact('class', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $class = Classes::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'section' => 'required',
            'subject_id' => 'required|array',
            'subject_id.*' => 'exists:subjects,id',
        ]);

        $class->update($request->only('name', 'section', 'subject_id'));

        return redirect()->route('classes.index')->with('success', 'Class updated successfully');
    }

    public function destroy($id)
    {
        Classes::findOrFail($id)->delete();

        return redirect()->route('classes.index')->with('success', 'Class deleted');
    }
}
