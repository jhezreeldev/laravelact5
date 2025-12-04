<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource (Index/Summary Page).
     */
    public function index()
    {
        $students = Student::all(); 
        return view('summary', compact('students')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        // Tiyakin na ang $student ay nakuha gamit ang student_id
        return view('edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        // KINAKAILANGAN ITO: Ayusin ang unique validation rule
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            // FIXED: Gumagamit ng $student->student_id at 'student_id' column para sa exemption
            'email' => 'required|email|unique:students,email,' . $student->student_id . ',student_id', 
            'contact_number' => 'required|numeric|digits:10',
            'college' => 'required|string|max:255',
            'program' => 'required|string|max:255',
        ]);

        // Update the record
        $student->update($request->except(['password', 'password_confirmation'])); 
        
        return redirect()->route('students.index')
                         ->with('success', 'Student record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')
                         ->with('success', 'Student record deleted successfully!');
    }
}
