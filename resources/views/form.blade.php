<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        input {
            outline: none;
            background: transparent;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-5">
        <h2 style="text-align: center">Student Information Form</h2><br>

        <!-- Error Display -->
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        @endif

        @if (session('success'))
            <p style="color:blue">{{ session('success') }}</p>
        @endif

        @php
            $today = date('Y-m-d');
            $count = $details->count();
        @endphp

        <!-- Add Row Button -->
        <button type="button" class="btn btn-primary mb-3" onclick="addRow()">Add Row</button>

        <!-- Student Form -->
        <form action="{{ route('form-submit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <table class="table table-bordered table-striped" id="studentForm">
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
                    @foreach ($details as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}<input type="hidden" name="details[{{ $detail->id }}][id]"
                                    value="{{ $detail->id }}"></td>
                            <td><input type="text" name="details[{{ $detail->id }}][name]"
                                    value="{{ $detail->name }}"></td>
                            <td><input type="text" name="details[{{ $detail->id }}][rollNumber]"
                                    value="{{ $detail->rollNumber }}"></td>
                            <td><input type="text" name="details[{{ $detail->id }}][batchNo]"
                                    value="{{ $detail->batchNo }}"></td>
                            <td><input type="number" name="details[{{ $detail->id }}][age]"
                                    value="{{ $detail->age }}"></td>
                            <td><input type="text" name="details[{{ $detail->id }}][gender]"
                                    value="{{ $detail->gender }}" readonly></td>
                            <td><input type="email" name="details[{{ $detail->id }}][email]"
                                    value="{{ $detail->email }}"></td>
                            <td><input type="text" name="details[{{ $detail->id }}][phone]"
                                    value="{{ $detail->phone }}"></td>
                            <td><input type="text" name="details[{{ $detail->id }}][address]"
                                    value="{{ $detail->address }}"></td>
                            <td><input type="text" name="details[{{ $detail->id }}][fatherName]"
                                    value="{{ $detail->fatherName }}"></td>
                            <td><input type="text" name="details[{{ $detail->id }}][motherName]"
                                    value="{{ $detail->motherName }}"></td>
                            <td><input type="date" name="details[{{ $detail->id }}][date]"
                                    value="{{ $detail->date }}"></td>
                            <td><input type="date" name="details[{{ $detail->id }}][admissionDate]"
                                    value="{{ $detail->admissionDate }}"></td>
                            <td><input type="text" name="details[{{ $detail->id }}][class]"
                                    value="{{ $detail->class }}"></td>
                            <td><input type="text" name="details[{{ $detail->id }}][section]"
                                    value="{{ $detail->section }}"></td>
                            <td><input type="text" name="details[{{ $detail->id }}][collegeName]"
                                    value="{{ $detail->collegeName }}"></td>
                            <td>
                                <select name="details[{{ $detail->id }}][department]">
                                    <option value="">Select</option>
                                    <option value="CS" {{ $detail->department == 'CS' ? 'selected' : '' }}>CS
                                    </option>
                                    <option value="IT" {{ $detail->department == 'IT' ? 'selected' : '' }}>IT
                                    </option>
                                    <option value="EC" {{ $detail->department == 'EC' ? 'selected' : '' }}>EC
                                    </option>
                                    <option value="ME" {{ $detail->department == 'ME' ? 'selected' : '' }}>ME
                                    </option>
                                </select>
                            </td>
                            <td>
                                <@if ($detail->attachment)
                                    @foreach (explode(',', $detail->attachment) as $file)
                                        <div class="d-flex align-items-center mb-1">
                                            <a href="{{ asset('documents/' . $file) }}"
                                                target="_blank">{{ $file }}</a>
                                            <form action="{{ route('delete-attachment', [$detail->id, $file]) }}"
                                                method="post" style="margin-left: 10px;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    @endforeach
                    @endif
                    <input type="file" name="attachment[{{ $detail->id }}][]" class="form-control" multiple>
                    </td>

                    <td><a href="{{ route('delete', $detail->id) }}">Remove</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>

    <!-- JavaScript -->
    <script>
        let rowCount = {{ $count }} + 1;

        function addRow() {
            const table = document.getElementById('studentForm').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.innerHTML = `
                <tr>
                    <td>${rowCount}</td>
                    <td><input type="text" name="name[]"></td>
                    <td><input type="text" name="rollNumber[]"></td>
                    <td><input type="text" name="batchNo[]"></td>
                    <td><input type="number" name="age[]"></td>
                    <td>
                        <input type="radio" name="gender[${rowCount}]" value="male" checked> Male
                        <input type="radio" name="gender[${rowCount}]" value="female"> Female
                    </td>
                    <td><input type="email" name="email[]"></td>
                    <td><input type="text" name="phone[]"></td>
                    <td><input type="text" name="address[]"></td>
                    <td><input type="text" name="fatherName[]"></td>
                    <td><input type="text" name="motherName[]"></td>
                    <td><input type="date" name="date[]"></td>
                    <td><input type="date" name="admissionDate[]"></td>
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
                    <td><input type="file" name="attachment[0][]" multiple></td>
                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
                </tr>
            `;
            rowCount++;
        }

        function removeRow(button) {
            button.closest('tr').remove();
        }
    </script>
</body>

</html>
