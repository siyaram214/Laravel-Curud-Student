<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Table</title>
    <!-- Include Bootstrap CSS -->

    <style>
        input{
            /* border: none; */
            outline: none;
            background: transparent;
        }
    </style>
</head>
<body>
    <div class="fluid-container mt-5">
        <h2 style="text-align: center">Student Information Form</h2><br>
        @if ($errors->any())
        @foreach($errors->all() as $error)
        <p>{{$error}}</p>
        @endforeach
        @endif
        @if (session('success'))
            <p style="color:blue">{{session('success')}}</p>
        @endif
        @php
            $today = date("Y-m-d");
            // echo $today;
            $min = $today;
            $max = $min;
            $endmin = $today;
        @endphp
     <button type="button" onclick="addRow()">Add Row</button>
     <form action="{{route('form-submit')}}" method="post" enctype="multipart/form-data" style="overflow-y: scroll">
        @csrf
        <table class="table table-bordered table-striped" id="studentFrom">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Roll Number</th>
                    <th>Batch No</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Father's Name</th>
                    <th>Mother's Name</th>
                    <th>Date</th>
                    <th>Admission Date</th>
                    <th>Class</th>
                    <th>Section</th>
                    <th>College Name</th>
                    <th>Department</th>
                    <th>Guardian Name</th>
                    <th>Guardian Contact</th>
                    <th>Attachment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
             @foreach($details as $detail)
                <tr>
                    <td>{{$loop->iteration}}<input type="hidden" name="details[{{$detail->id}}][id]" value="{{$detail->id}}"></td>


                    <td><input type="text" name="details[{{$detail->id}}][name]" value="{{$detail->name}}"></td>

                    <td><input type="text" name="details[{{$detail->id}}][rollNumber]" value="{{$detail->rollNumber}}"></td>
                    <td><input type="text" name="details[{{$detail->id}}][batchNo]" value="{{$detail->batchNo}}"></td>
                    <td><input type="date" name="details[{{$detail->id}}][age]" value="{{$detail->age}}"></td>
                    <td><input type="text" name="details[{{$detail->id}}][gender]" value="{{$detail->gender}}" readonly></td>
                    <td><input type="email" name="details[{{$detail->id}}][email]" value="{{$detail->email}}"></td>
                    <td><input type="text" name="details[{{$detail->id}}][phone]" value="{{$detail->phone}}"></td>
                    <td><input type="text" name="details[{{$detail->id}}][address]" value="{{$detail->address}}"></td>
                    <td><input type="text" name="details[{{$detail->id}}][fatherName]" value="{{$detail->fatherName}}"></td>
                    <td><input type="text" name="details[{{$detail->id}}][motherName]" value="{{$detail->motherName}}"></td>
                    <td><input type="date" name="details[{{$detail->id}}][date]" value="{{$detail->date}}"></td>
                    <td><input type="date" name="details[{{$detail->id}}][admissionDate]" value="{{$detail->admissionDate}}"></td>
                    <td><input type="text" name="details[{{$detail->id}}][class]" value="{{$detail->class}}"></td>
                    <td><input type="text" name="details[{{$detail->id}}][section]" value="{{$detail->section}}"></td>
                    <td><input type="text" name="details[{{$detail->id}}][collegeName]" value="{{$detail->collegeName}}"></td>
                    <td><select name="details[{{$detail->id}}][department]">
                        <option value="">Select</option>
                        <option value="CS" {{ $detail->department == 'CS' ? 'selected' : '' }}>CS</option>
                        <option value="IT" {{ $detail->department == 'IT' ? 'selected' : '' }}>IT</option>
                        <option value="EC" {{ $detail->department == 'EC' ? 'selected' : '' }}>EC</option>
                        <option value="ME" {{ $detail->department == 'ME' ? 'selected' : '' }}>ME</option>
                    </select></td>
                    <td><input type="text" name="details[{{$detail->id}}][guardiaName]" value="{{$detail->guardiaName}}"></td>
                    <td><input type="text" name="details[{{$detail->id}}][guardianContact]" value="{{$detail->guardianContact}}"></td>
                    <td><a href="{{asset('documents/'.$detail->attachment)}}" target="_blank">Show File</a></td>
                    <td><a href="{{route('delete',$detail->id)}}">remove</a></td>
                </tr>

                 @endforeach

               @php
               $count = $details->count();
               @endphp


                <!-- More rows can be added similarly -->
            </tbody>
        </table>
        <button type="submit">Submit</button>
    </form>

    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <script>
        let rowCount = 1;
        let sn = {{$count}} +1;
        function addRow() {
        const table = document.getElementById('studentFrom').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow();
        newRow.innerHTML = `
            <tr>
                <td>${sn}</td>
                <td><input type="text" name="name[]"></td>
                <td><input type="text" name="rollNumber[]"></td>
                <td><input type="text" name="batchNo[]"></td>
                <td><input type="date" name="age[]"></td>
                <td><input type="radio" name="gender[${rowCount}]" value="male" checked><label>Male</label>
                    <input type="radio" name="gender[${rowCount}]" value="female"><label for="">Female</label></td>
                <td><input type="email" name="email[]"></td>
                <td><input type="text" name="phone[]"></td>
                <td><input type="text" name="address[]"></td>
                <td><input type="text" name="fatherName[]"></td>
                <td><input type="text" name="motherName[]"></td>
                <td><input type="date" name="date[]" value="{{$today}}" min="{{$today}}" max="{{$today}}"></td>
                <td><input type="date" name="admissionDate[]" min="{{$today}}"></td>
                <td><input type="text" name="class[]"></td>
                <td><input type="text" name="section[]"></td>
                <td><input type="text" name="collegeName[]"></td>
                <td>
                    <select name="department[]">
                        <option value="">Select</option>
                        <option value="CS">CS</option>
                        <option value="IT">IT</option>
                        <option value="EC">EC</option>
                        <option value="ME">ME</option>
                    </select>
                </td>
                <td><input type="text" name="guardiaName[]"></td>
                <td><input type="text" name="guardianContact[]"></td>
                <td><input type="file" name="attachment[]"></td>
                <td><button type="button" class="btn btn-danger" onClick="removeRow(this)">Remove</button></td>
            </tr>
        `;
        sn++;
              rowCount++;

    }

    function removeRow(button) {
    const row = button.closest('tr');
    row.remove();
    rowCount--;
    sn--;
    }
    </script>

</body>
</html>
