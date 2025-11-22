<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $student = Student::with('contact')->when($search, function ($query, $search) {
            $query->where('name', 'LIKE', "%$search%")
                  ->orWhere('roll_number', 'LIKE', "%$search%")
                  ->orWhereHas('contact', function ($q) use ($search) {
                      $q->where('contact_no', 'LIKE', "%$search%")
                        ->orWhere('email', 'LIKE', "%$search%");
                  });
        })
        ->paginate(5);
        // $student = Student::with('contact')->get();
        return view('student-list', compact('student'));
    }

    public function create(Request $request)
    {
        return view('form');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'roll_number' => 'required|integer',
            'name' => 'required|string',
            'contact_no' => 'required|digits:10',
            'email' => 'required|email',
        ]);

        $contact = Contact::create([
            'contact_no' => $request->contact_no,
            'email' => $request->email,
        ]);

        Student::create([
            'roll_number' => $request->roll_number,
            'name' => $request->name,
            'contact_id' => $contact->id,
        ]);

        return redirect()->route('student.list')->with('success', 'Student and contact saved successfully!');;
    }

    public function edit(Request $request, $id)
    {
        $student = Student::with('contact')->findOrFail($id);

        return view('edit', compact('student'));
    }


    public function update(Request $request, Student $student, $id)
    {
        $request->validate([
            'roll_number' => 'required|integer',
            'name' => 'required|string',
            'contact_no' => 'required|digits:10',
            'email' => 'required|email',
        ]);

        $student = Student::findOrFail($id);
        $contact = Contact::findOrFail($student->contact_id);

        $contact->update([
            'contact_no' => $request->contact_no,
            'email' => $request->email,
        ]);

        $student->update([
            'roll_number' => $request->roll_number,
            'name' => $request->name,
            'contact_id' => $contact->id,
        ]);

        return redirect()->route('student.list')->with('success', 'Student updated successfully!');
    }

    public function destroy(Student $student, $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->back()->with('success', 'Student deleted successfully!');
    }
}
