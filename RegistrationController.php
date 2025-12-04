<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash; // Used for encrypting the password

class RegistrationController extends Controller
{
    // Function to show the registration form (maps to register.blade.php)
    public function showForm()
    {
        return view('register');
    }

    // Function to handle the form submission
    public function submitForm(Request $request)
    {
        // 1. VALIDATION (This generates the "field is required" errors)
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email', // Check uniqueness in 'students' table
            'password' => 'required|min:8|confirmed', // 'confirmed' checks for a matching 'password_confirmation' field
            'contact_number' => 'required|numeric|digits:10',
            'college' => 'required|string|max:255',
            'program' => 'required|string|max:255',
        ]);

        // 2. DATA STORAGE
        Student::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encrypt the password before saving!
            'contact_number' => $request->contact_number,
            'college' => $request->college,
            'program' => $request->program,
            // Make sure these keys match the fillable property in your Student Model
        ]);

        // 3. REDIRECTION (Redirect to the summary page)
        return redirect()->route('students.index')
                         ->with('success', 'Action successful! Showing all student records.');
    }
}
