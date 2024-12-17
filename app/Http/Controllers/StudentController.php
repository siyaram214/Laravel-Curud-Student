<?php

namespace App\Http\Controllers;

use App\Models\Student_informatio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function index()
    {    
        $details = Student_informatio::all();
        return view('form', compact('details'));
    }

    public function store(Request $request)
{
    // Update existing records
    if ($request->has('details')) {
        foreach ($request->input('details') as $detail) {
            $existingRecord = Student_informatio::find($detail['id']);
            if ($existingRecord) {
                $fileName = $existingRecord->attachment;
                if ($request->hasFile("details.{$detail['id']}.attachment")) {
                    // Delete old file if exists
                    if ($existingRecord->attachment && File::exists(public_path("documents/{$existingRecord->attachment}"))) {
                        File::delete(public_path("documents/{$existingRecord->attachment}"));
                    }

                    // Handle new file upload
                    $files = $request->file("details.{$detail['id']}.attachment");
                    if (is_array($files)) {
                        $fileNames = [];
                        foreach ($files as $file) {
                            $fileName = time() . "_" . uniqid() . '.' . $file->getClientOriginalExtension();
                            $file->move(public_path('documents'), $fileName);
                            $fileNames[] = $fileName;
                        }
                        $fileName = implode(',', $fileNames); // Comma-separated filenames
                    } else {
                        $fileName = time() . "_" . uniqid() . '.' . $files->getClientOriginalExtension();
                        $files->move(public_path('documents'), $fileName);
                    }
                }

                // Update the student record
                $existingRecord->update([
                    'name' => $detail['name'],
                    'rollNumber' => $detail['rollNumber'],
                    'batchNo' => $detail['batchNo'],
                    'age' => $detail['age'] ?? null,
                    'gender' => $detail['gender'] ?? 'male',
                    'email' => $detail['email'],
                    'phone' => $detail['phone'],
                    'address' => $detail['address'],
                    'fatherName' => $detail['fatherName'] ?? null,
                    'motherName' => $detail['motherName'] ?? null,
                    'date' => $detail['date'],
                    'admissionDate' => $detail['admissionDate'],
                    'class' => $detail['class'],
                    'section' => $detail['section'],
                    'collegeName' => $detail['collegeName'],
                    'department' => $detail['department'],
                    'guardiaName' => $detail['guardiaName'],
                    'guardianContact' => $detail['guardianContact'],
                    'attachment' => $fileName, // Store multiple filenames
                ]);
            }
        }
    }

    // Add new records
    if ($request->has('name')) {
        foreach ($request->input('name') as $index => $name) {
            $fileName = null;

            // Handle new file uploads
            if ($request->hasFile("attachment.{$index}")) {
                $files = $request->file("attachment.{$index}");
                if (is_array($files)) {
                    $fileNames = [];
                    foreach ($files as $file) {
                        $fileName = time() . "_" . uniqid() . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('documents'), $fileName);
                        $fileNames[] = $fileName;
                    }
                    $fileName = implode(',', $fileNames); // Comma-separated filenames
                } else {
                    $fileName = time() . "_" . $index . '.' . $files->getClientOriginalExtension();
                    $files->move(public_path('documents'), $fileName);
                }
            }

            // Create a new student record
            Student_informatio::create([
                'name' => $request->input("name.{$index}"),
                'rollNumber' => $request->input("rollNumber.{$index}"),
                'batchNo' => $request->input("batchNo.{$index}"),
                'age' => $request->input("age.{$index}") ?? null,
                'gender' => $request->input("gender.{$index}") ?? 'male',
                'email' => $request->input("email.{$index}"),
                'phone' => $request->input("phone.{$index}"),
                'address' => $request->input("address.{$index}"),
                'fatherName' => $request->input("fatherName.{$index}") ?? null,
                'motherName' => $request->input("motherName.{$index}") ?? null,
                'date' => $request->input("date.{$index}"),
                'admissionDate' => $request->input("admissionDate.{$index}"),
                'class' => $request->input("class.{$index}"),
                'section' => $request->input("section.{$index}"),
                'collegeName' => $request->input("collegeName.{$index}"),
                'department' => $request->input("department.{$index}"),
                'guardiaName' => $request->input("guardiaName.{$index}"),
                'guardianContact' => $request->input("guardianContact.{$index}"),
                'attachment' => $fileName, // Store multiple filenames
            ]);
        }
    }

    return redirect()->route('home')->with('success', 'Student data saved successfully!');
}
    public function destroy($id)
    {
        $student = Student_informatio::find($id);

        // Delete the file if it exists
        if ($student->attachment && File::exists(public_path("documents/{$student->attachment}"))) {
            File::delete(public_path("documents/{$student->attachment}"));
        }

        $student->delete();
        return redirect()->route('home')->with('success', 'Student deleted successfully.');
    }
    public function deleteAttachment($id, $file)
{
    // Find the student record by ID
    $student = Student::findOrFail($id);

    // Get the attachments and remove the specified file
    $attachments = explode(',', $student->attachment);
    if (($key = array_search($file, $attachments)) !== false) {
        unset($attachments[$key]);
    }

    // Update the record with remaining attachments
    $student->attachment = implode(',', $attachments);
    $student->save();

    // Delete the file from storage
    $filePath = public_path('documents/' . $file);
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Redirect back with success message
    return redirect()->back()->with('success', 'Attachment deleted successfully');
}
}
