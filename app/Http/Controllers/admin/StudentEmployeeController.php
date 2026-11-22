<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\StudentEmployee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentEmployeeController extends Controller
{
    public function index()
    {
        $profiles = StudentEmployee::with(['user', 'department'])->latest()->paginate(10);

        return view('admin.student-employees.index', compact('profiles'));
    }

    public function create()
    {
        $users = User::whereIn('user_type', ['student', 'employee'])
            ->whereDoesntHave('studentEmployee')
            ->where('status', 1)
            ->get();

        $departments = Department::all();

        return view('admin.student-employees.create', compact('users', 'departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'       => ['required', 'exists:users,user_id', Rule::unique('student_employees', 'user_id')],
            'student_id'    => ['nullable', 'string', 'max:255', Rule::unique('student_employees', 'student_id')],
            'name'          => ['required', 'string', 'max:255'],
            'lastname'      => ['required', 'string', 'max:255'],
            'middlename'    => ['nullable', 'string', 'max:255'],
            'department_id' => ['required', 'exists:departments,id'],
        ]);

        StudentEmployee::create($validated);

        return redirect()->route('admin.student-employees.index')
            ->with('success', 'Profile created successfully.');
    }

    public function edit(StudentEmployee $studentEmployee)
    {
        $users = User::whereIn('user_type', ['student', 'employee'])->get();
        $departments = Department::all();

        return view('admin.student-employees.edit', compact('studentEmployee', 'users', 'departments'));
    }

    public function update(Request $request, StudentEmployee $studentEmployee)
    {
        $validated = $request->validate([
            'user_id'       => ['required', 'exists:users,user_id', Rule::unique('student_employees', 'user_id')->ignore($studentEmployee->id)],
            'student_id'    => ['nullable', 'string', 'max:255', Rule::unique('student_employees', 'student_id')->ignore($studentEmployee->id)],
            'name'          => ['required', 'string', 'max:255'],
            'lastname'      => ['required', 'string', 'max:255'],
            'middlename'    => ['nullable', 'string', 'max:255'],
            'department_id' => ['required', 'exists:departments,id'],
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
