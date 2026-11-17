<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\StudentEmployee;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;

class StudentEmployeeController extends Controller
{
    public function index()
    {
        $profiles = StudentEmployee::with(['user', 'department'])->latest()->paginate(10);
        return view('admin.student-employees.index', compact('profiles'));
    }

    public function create()
    {
        $users = User::whereIn('role', ['student', 'employee'])
                     ->whereDoesntHave('studentEmployee') 
                     ->where('status', 1)
                     ->get();
                     
        $departments = Department::all();
        
        return view('admin.student-employees.create', compact('users', 'departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id|unique:student_employees,user_id',
            'department_id' => 'required|exists:departments,id',
            'student_id'    => 'nullable|string|unique:student_employees,student_id',
            'program'       => 'nullable|string',
        ]);

        StudentEmployee::create($validated);

        return redirect()->route('admin.student-employees.index')
                         ->with('success', 'Profile created successfully.');
    }

    public function edit(StudentEmployee $studentEmployee)
    {
        $users = User::whereIn('role', ['student', 'employee'])->get(); 
        $departments = Department::all();
        
        return view('admin.student-employees.edit', compact('studentEmployee', 'users', 'departments'));
    }

    public function update(Request $request, StudentEmployee $studentEmployee)
    {
        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id|unique:student_employees,user_id,' . $studentEmployee->id,
            'department_id' => 'required|exists:departments,id',
            'student_id'    => 'nullable|string|unique:student_employees,student_id,' . $studentEmployee->id,
            'program'       => 'nullable|string',
        ]);

        $studentEmployee->update($validated);

        return redirect()->route('admin.student-employees.index')
                         ->with('success', 'Profile updated successfully.');
    }

    public function destroy(StudentEmployee $studentEmployee)
    {
        $studentEmployee->delete();
        return redirect()->route('admin.student-employees.index')
                         ->with('success', 'Profile deleted successfully.');
    }
}