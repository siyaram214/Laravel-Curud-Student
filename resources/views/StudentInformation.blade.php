<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Information Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100">
  <div class="container mt-10">
    <h2 class="text-center text-2xl font-semibold mb-6">Student Information Form</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <div class="text-right my-3">
      <button type="button"  class="btn btn-primary" id="addField"><i class="fas fa-plus"></i> Add Row</button>
    </div>
    <form  action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <section>
        <div class="overflow-x-auto shadow-md rounded-lg bg-white">
          <table class="table table-bordered table-striped" id="studentTable">
            <thead class="bg-gray-200">
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
            <tbody id="dynamicFields">
              @foreach ($students as $student)
          <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$student->name}}</td>
            <td>{{$student->rollNumber}}</td>
            <td>{{$student->batchNo}}</td>
            <td>{{$student->age}}</td>
            <td>{{$student->gender}}</td>
            <td>{{$student->email}}</td>
            <td>{{$student->phone}}</td>
            <td>{{$student->address}}</td>
            <td>{{$student->fatherName}}</td>
            <td>{{$student->motherName}}</td>
            <td>{{$student->date}}</td>
            <td>{{$student->admissionDate}}</td>
            <td>{{$student->class}}</td>
            <td>{{$student->section}}</td>
            <td>{{$student->collegeName}}</td>
            <td>{{$student->department}}</td>
            <td>{{$student->guardiaName}}</td>
            <td>{{$student->guardianContact}}</td>
            <td>{{$student->attachment}}</td>
            <td>
              <a href="{{route('student.delete', $student->id)}}"><i class="fa fa-trash" aria-hidden="true"></i></a>
          </td>
          <td>
        
          </tr>
      @endforeach
      <tr id="rows">
        <td> </td>
        <td><input type="text" class="form-control w-64" name="name" ></td>
        <td><input type="text" class="form-control w-64" name="rollNumber" ></td>
        <td><input type="text" class="form-control w-64" name="batchNo" ></td>
        <td><input type="text" class="form-control w-64" name="age" ></td>
        <td><input type="text" class="form-control w-64" name="gender" ></td>
        <td><input type="email" class="form-control w-64" name="email" ></td>
        <td><input type="text" class="form-control w-64" name="phone" ></td>
        <td><input type="text" class="form-control w-64" name="address" ></td>
        <td><input type="text" class="form-control w-64" name="fatherName" ></td>
        <td><input type="text" class="form-control w-64" name="motherName" ></td>
        <td><input type="date" class="form-control w-64" name="date" ></td>
        <td><input type="date" class="form-control w-64" name="admissionDate" ></td>
        <td><input type="text" class="form-control w-64" name="class" ></td>
        <td><input type="text" class="form-control w-64" name="section"></td>
        <td><input type="text" class="form-control w-64" name="collegeName" ></td>
        <td>
          <select class="form-control w-64" name="department" >
            <option value="">Select--</option>
            <option value="Computer Science">Computer Science</option>
            <option value="Electrical Engineering">Electrical Engineering</option>
            <option value="Mechanical Engineering">Mechanical Engineering</option>
            <option value="Civil Engineering">Civil Engineering</option>
            <option value="Business Administration">Business Administration</option>
            <option value="Mathematics">Mathematics</option>
          </select>
        </td>
        <td><input type="text" class="form-control w-64" name="guardiaName" ></td>
        <td><input type="text" class="form-control w-64" name="guardianContact" ></td>
        <td><input type="file" class="form-control w-64" name="attachment" ></td>
      </tr>
            </tbody>
          </table>
        </div>
      </section>
      <div class="text-center mt-4">
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </form>
  </div>

  <script>
  <script>
function get(el) {
  return document.getElementById(el);
}
var addEvent = function() {
  if (window.addEventListener) {
    return function(el, type, fn) {
      el.addEventListener(type, fn, false);
    };
  } else if (window.attachEvent) {
    return function(el, type, fn) {
      var f = function() {
        fn.call(el, window.event);
      };
      el.attachEvent('on' + type, f);
    };
  }
}();

addEvent(window, 'load', function() {
  addEvent(get('addField'), 'click', addRow);
  var rows = get('rows');
  var counter = 0;
  function addRow() {
    var el = document.createElement('div');
    rows.appendChild(el);
    rows.innerHTML = 'row number ' + (++counter) + ' has been added';
  }
});  
  </script>
  
  
</body>

</html>
