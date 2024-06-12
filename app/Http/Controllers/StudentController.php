<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
  // Display a listing of the student's information for the authenticated user
  public function index()
  {
    $userId = Auth::id();
    $datas = Student::where('user_id', $userId)->paginate(8); 
    return view('manageStdIDVerification.stdRegistrationPage', compact('datas'));
  }

  // Show the form for creating a new student record
  public function create()
  {
    return view('manageStdIDVerification.stdAddForm');
  }

  // Store a newly created student record in the database
  public function store(Request $request)
  {
    // Validate the incoming request data
    $validated = $request->validate([
      'stdName' => 'required|string',
      'motherIC' => 'required|file|mimes:pdf',
      'fatherIC' => 'required|file|mimes:pdf',
      'stdIC' => 'required|file|mimes:pdf',
      'stdBirthCert' => 'required|file|mimes:pdf',
    ]);

    // Handle file uploads and store with original filenames in the 'public/documents' directory
    $motherICPath = $request->file('motherIC')->storeAs('documents', $request->file('motherIC')->getClientOriginalName(), 'public');
    $fatherICPath = $request->file('fatherIC')->storeAs('documents', $request->file('fatherIC')->getClientOriginalName(), 'public');
    $stdICPath = $request->file('stdIC')->storeAs('documents', $request->file('stdIC')->getClientOriginalName(), 'public');
    $stdBirthCertPath = $request->file('stdBirthCert')->storeAs('documents', $request->file('stdBirthCert')->getClientOriginalName(), 'public');

    // Create a new student record with the validated data and file paths
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


 //Student Verification Page (Admin)
  public function indexAdmin()
  {
    $datas = Student::orderByRaw("FIELD(status,'Pending','Approved','Rejected')")->paginate(8);
    return view('manageStdIDVerification.stdVerificationPage', compact('datas'));
  }

  // Update the specified student's status
  public function update(Request $request, Student $student)
  {
    // Validate the incoming request data
    $validated = $request->validate([
      'status' => 'required|string|max:255',
    ]);

    // Update the student's status
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
