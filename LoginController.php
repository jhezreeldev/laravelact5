<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class LoginController extends Controller
{
    // ⭐ Show login page
    public function index()
    {
        return view('login');
    }

    // ⭐ Handle login form submission
    public function handleLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Simple fixed login — (you can change the email/pass)
        if ($request->email === "admin@gmail.com" && $request->password === "123456") {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid login credentials']);
    }



    // -------------------------------------------------------
    // YOUR ORIGINAL WORKING CODE (unchanged)
    // -------------------------------------------------------

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name'     => 'required',
            'middle_initial' => 'nullable|max:1',
            'last_name'      => 'required',
            'email'          => 'required|email',
            'contact_number' => 'required|digits:11',
            'college'        => 'required',
            'program'        => 'required',
        ]);

        Student::create($validated);

        session()->put('data', $validated);

        return redirect()->route('register.summary')
            ->with('success', 'Student added successfully!');
    }


    public function dashboard()
    {
        $users = DB::table('students')->get();
        $total = $users->count();

        return view('dashboard', compact('users', 'total'));
    }


    public function edit($id)
    {
        $user = DB::table('students')->where('student_id', $id)->first();
        return view('edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|regex:/^[a-zA-Z]+(\s+[a-zA-Z]+)*$/',
            'middle_initial' => 'nullable|regex:/^[A-Z]$/',
            'last_name' => 'required|regex:/^[a-zA-Z]+(\s+[a-zA-Z]+)*$/',
            'email' => 'required|email|unique:users,email,' . $id,
            'contact_number' => 'required|numeric|digits:11',
            'college' => 'required|in:College of Informatics and Computing Studies,College of Engineering and Architecture,College of Arts and Sciences,College of Business Administration,College of Nursing',
            'program' => 'required|in:BS CS,BS IT,BS CE,BS A,BS Psych',
        ]);

        DB::table('students')->where('student_id', $id)->update([
            'first_name' => $request->first_name,
            'middle_initial' => $request->middle_initial,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact_number'  => $request->contact_number,
            'college' => $request->college,
            'program' => $request->program,
            'updated_at' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Student updated successfully');
    }


    public function destroy($id)
    {
        DB::table('students')->where('student_id', $id)->delete();
        return redirect()->route('dashboard')->with('success', 'Student deleted successfully');
    }
}
