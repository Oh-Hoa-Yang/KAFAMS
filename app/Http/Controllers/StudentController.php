<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
  public function index()
  {
    $userId = Auth::id();
    $datas = Student::where('user_id', $userId)->paginate(8);
    return view('manageStdIDVerification.stdRegistrationPage', compact('datas'));
  }

  public function create()
  {
    return view('manageStdIDVerification.stdAddForm');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'stdName' => 'required|string',
      'motherIC' => 'required|file|mimes:pdf',
      'fatherIC' => 'required|file|mimes:pdf',
      'stdIC' => 'required|file|mimes:pdf',
      'stdBirthCert' => 'required|file|mimes:pdf',
    ]);

    // Handle file uploads with original filenames
    $motherICPath = $request->file('motherIC')->storeAs('documents', $request->file('motherIC')->getClientOriginalName(), 'public');
    $fatherICPath = $request->file('fatherIC')->storeAs('documents', $request->file('fatherIC')->getClientOriginalName(), 'public');
    $stdICPath = $request->file('stdIC')->storeAs('documents', $request->file('stdIC')->getClientOriginalName(), 'public');
    $stdBirthCertPath = $request->file('stdBirthCert')->storeAs('documents', $request->file('stdBirthCert')->getClientOriginalName(), 'public');

    // Create the student record
    Student::create([
      'user_id' => auth()->id(),
      'stdName' => $validated['stdName'],
      'motherIC' => $motherICPath,
      'fatherIC' => $fatherICPath,
      'stdIC' => $stdICPath,
      'stdBirthCert' => $stdBirthCertPath,
      'status' => 'Pending',
    ]);

    return redirect()->route('students.index')
      ->with('success', 'Student Information Is Submitted!');
  }


 //Student Verification Page 
  public function indexAdmin()
  {
    $datas = Student::orderByRaw("FIELD(status,'Pending','Approved','Rejected')")->paginate(8);
    return view('manageStdIDVerification.stdVerificationPage', compact('datas'));
  }

  public function update(Request $request, Student $student)
  {
    $validated = $request->validate([
      'status' => 'required|string|max:255',
    ]);

    $student->update([
      'status' => $validated['status'],
    ]);

    return redirect()->route('students.indexAdmin')->with('success', 'Verification Status updated successfully!');
  }

  public function destroy(Student $student)
  {
    $student->delete();
    return redirect()->route('students.indexAdmin')->with('success', 'Student application deleted successfully!');
  }
}
