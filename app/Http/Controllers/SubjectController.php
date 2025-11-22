<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Subject::get();

            return DataTables::of($data)
                ->addIndexColumn()
             
                ->addColumn('action', function($row){
                    $editUrl = route('subjects.edit', $row->id);
                    $deleteUrl = route('subjects.delete', $row->id);
                    $csrf = csrf_field();
                    $method = method_field('DELETE');

                    $btn = "<a href='{$editUrl}' class='btn btn-sm btn-warning'>Edit</a> ";
                    $btn .= "<form action='{$deleteUrl}' method='POST' style='display:inline-block;'>
                                {$csrf}{$method}
                                <button class='btn btn-sm btn-danger' onclick='return confirm(\"Delete?\")'>Delete</button>
                             </form>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('subject.index'); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('subject.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Subject::create([
            'name' => $request->name,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject added successfully!');
    }

    /**
     * Show the form for editing a subject.
     */
    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
       
        return view('subject.edit',compact('subject'));
    }

    /**
     * Update a subject.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',            
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update([
            'name' => $request->name,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');
    }

        public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully!');
        
    }
}
