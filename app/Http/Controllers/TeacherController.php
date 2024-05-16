<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;


class TeacherController extends Controller
{
    public function index()
    {
      $datas = User::where('role','teacher')->paginate(8);
      return view('manageAccountRegistration.teacherAccountPage', compact('datas'));
    }

    public function create()
    {
      return view('manageAccountRegistration.teacherAddForm');
    }

    public function store(Request $request)
    {
      //Validate the input data

      $validated = $request->validate([
        'name'=>'required|string',
        'email'=>'required|email',
        'password'=>'required|min:8|string',
        'staffID'=>'required|string',
        'role'=>'required|string',
      ]);


      //Create the user after validation
      User::create([
        'name'=> $validated['name'],
        'email'=>$validated['email'],
        'password'=>Hash::make($validated['password']),
        'staffID'=>$validated['staffID'],
        'role'=>$validated['role'],
      ]);

      return redirect()->route('manageAccountRegistration.index')->with('success', 'Teacher Account Is Added!');
    }


    public function edit(User $manageAccountRegistration)
    {
        return view('manageAccountRegistration.teacherEditForm', compact('manageAccountRegistration'));
    }

    public function update(Request $request, User $manageAccountRegistration)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $manageAccountRegistration->id,
            'password' => 'nullable|min:8|string',
            'staffID' => 'required|string',
            'role' => 'required|string',
        ]);

        $manageAccountRegistration->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'] ? Hash::make($validated['password']) : $manageAccountRegistration->password,
            'staffID' => $validated['staffID'],
            'role' => $validated['role'],
        ]);

        return redirect()->route('manageAccountRegistration.index')
            ->with('success', 'Teacher Account Updated!');
    }

    public function destroy(User $manageAccountRegistration)
    {
        $manageAccountRegistration->delete();
        return redirect()->route('manageAccountRegistration.index')
            ->with('success', 'Teacher Account Deleted!');
    }
}
