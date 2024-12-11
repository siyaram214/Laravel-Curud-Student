<?php
namespace App\Http\Controllers;
use App\Models\Student_informatio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function index()
    {
        $details = Student_informatio::all();
        return view('form', compact('details'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $details = $request->input('details', []);

        if (!empty($details)) {
            foreach ($details as $detail) {
                $exitData = Student_informatio::find($detail['id']);
                if ($exitData) {
                    $fileName = null;
                    if ($request->hasFile("details.{$detail['id']}.attachment")) {
                        // Delete the old file if it exists
                        if ($existingRecord->attachment && File::exists(public_path("documents/{$existingRecord->attachment}"))) {
                            File::delete(public_path("documents/{$existingRecord->attachment}"));
                        }

                        // Store the new file
                        $file = $request->file("details.{$detail['id']}.attachment");
                        $fileName = time() . '.' . $file->getClientOriginalName();
                        $file->move(public_path('documents'), $fileName);

                        // Update the attachment field
                        $existingRecord->attachment = $fileName;
                    }

                    $exitData->name = $detail['name'];
                    $exitData->rollNumber = $detail['rollNumber'];
                    $exitData->batchNo = $detail['batchNo'];
                    $exitData->age = $detail['age'] ?? null;
                    $exitData->gender = $detail['gender'] ?? 'male';
                    $exitData->email = $detail['email'];
                    $exitData->phone = $detail['phone'];
                    $exitData->address = $detail['address'];
                    $exitData->fatherName = $detail['fatherName'] ?? null;
                    $exitData->motherName = $detail['motherName'] ?? null;
                    $exitData->date = $detail['date'];
                    $exitData->admissionDate = $detail['admissionDate'];
                    $exitData->class = $detail['class'];
                    $exitData->section = $detail['section'];
                    $exitData->collegeName = $detail['collegeName'];
                    $exitData->department = $detail['department'];
                    $exitData->guardiaName = $detail['guardiaName'];
                    $exitData->guardianContact = $detail['guardianContact'];
                    $exitData->attachment = $fileName;
                    $exitData->save();
                }
            }
        }

        if ($request->name) {
            foreach ($request->name as $index => $name) {
                //    echo $index->$name ."<br>";

                $fileName = null;
                if ($request->hasFile('attachment.' . $index)) {
                    $file = $request->file('attachment.' . $index);
                    $ext = $file->getClientOriginalExtension();
                    $fileName = time() . '_' . $index . '.' . $ext;
                    $file->move(public_path('documents'), $fileName);
                }

                // Create a new student record

                $student = new Student_informatio();
                $student->name = $request->name[$index];
                $student->rollNumber = $request->rollNumber[$index];
                $student->batchNo = $request->batchNo[$index];
                $student->age = $request->age[$index] ?? null;
                $student->gender = $request->gender[$index] ?? 'male';
                $student->email = $request->email[$index];
                $student->phone = $request->phone[$index];
                $student->address = $request->address[$index];
                $student->fatherName = $request->fatherName[$index] ?? null;
                $student->motherName = $request->motherName[$index] ?? null;
                $student->date = $request->date[$index];
                $student->admissionDate = $request->admissionDate[$index];
                $student->class = $request->class[$index];
                $student->section = $request->section[$index];
                $student->collegeName = $request->collegeName[$index];
                $student->department = $request->department[$index];
                $student->guardiaName = $request->guardiaName[$index];
                $student->guardianContact = $request->guardianContact[$index];
                $student->attachment = $fileName;
                $student->save();
            }
            return redirect()->route('home')->with('success', 'Student data stored successfully!');
        }
    }

    public function destroy($id)
    {
        $student = Student_informatio::find($id);
        $student->delete();
        return redirect()->route('home')->with('success', 'Student deleted successfully.');
    }

    // public function update(Request $request ,$id)
    // {

    //     $student = Student_informatio::find($id);
    //     $student->update($request->all());
    //     return redirect()->route('student.index')->with('sucess','Post update succesfully.');
    // }
    pubf
}

?>
