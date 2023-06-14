@extends('admin.admin')
@section('admin')
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="mb-3">
                        <div class="mb-3 d-flex justify-content-between">   
                            <div>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#createEmployeeModal">Create Employee</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Email Address</th>
                                        <th>Department</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="searchResults">
                                    @foreach($users as $index => $user)
                                    <tr>
                                        <td>{{ $user->empID }}</td>
                                        <td>{{ $user->empLastName }}, {{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->empDept }}</td>
                                        <td>{{ $user->usertype }}</td>
                                        <td>{{ $user->empStatus }}</td>
                                        <td>
                                            <div>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteEmployeeModal{{ $index }}">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Delete Employee Modal for each row -->
                                    <div class="modal fade" id="deleteEmployeeModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteEmployeeModalLabel{{ $index }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <form action="{{ route('employees.destroy', $user->id) }}" method="POST" style="display: inline">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteEmployeeModalLabel{{ $index }}">Delete Employee</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Are you sure you want to delete the following employee?</p>
                                                    <p><strong>Employee Name:</strong> {{ $user->empName }}</p>
                                                    <p><strong>Department:</strong> {{ $user->empDept }}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$users->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Create Employee Modal -->
    <div class="modal fade" id="createEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="createEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createEmployeeModalLabel">Create Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('userCreate')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="createEmployeeID">Employee ID</label>
                            <input name= "empID" type="text" class="form-control" id="createEmployeeID" placeholder="Enter employee ID">
                            <span class="error" id="createEmployeeIDError"></span>
                        </div>
                        <div class="form-group">
                            <label for="createFullName">First Name</label>
                            <input name= "name" type="text" class="form-control" id="createFullName" placeholder="Enter first name">
                            <span class="error" id="createFullNameError"></span>
                        </div>
                        <div class="form-group">
                            <label for="createLastName">Last Name</label>
                            <input name= "empLastName" type="text" class="form-control" id="createLastName" placeholder="Enter last name">
                            <span class="error" id="createLastNameError"></span>
                        </div>
                        <div class="form-group">
                            <label  for="createEmail">Email Address</label>
                            <input name= "email" type="email" class="form-control" id="createEmail" placeholder="Enter email address">
                            <span class="error" id="createEmailError"></span>
                        </div>
                        <div class="form-group">
                            <label for="createDepartment">Department</label>
                            <input name= "empDept" type="text" class="form-control" id="createDepartment" placeholder="Enter department">
                            <span class="error" id="createDepartmentError"></span>
                        </div>
                        <div class="form-group">
                            <label for="createPassword">Password</label>
                            <input name= "password" type="password" class="form-control" id="createPassword" placeholder="Enter Password">
                            <span class="error" id="createPasswordError"></span>
                        </div>
                        <div class="form-group">
                            <label for="createUserType">User Type</label>
                            <select name= "usertype" class="form-control" id="createUserType">
                                <option value="employee">Employee</option>    
                                <option value="admin">HR Admin</option>
                            </select>
                            <span class="error" id="createUserTypeError"></span>
                        </div>
                        <div class="form-group">
                            <label for="createStatus">Status</label>
                            <select name= "empStatus" class="form-control" id="createStatus">
                                <option value="Regular">Regular</option>
                                <option value="Probationary">Probationary</option>
                                <option value="Contractual">Contractual</option>
                                <option value="Project-Based">Project-Based</option>
                            </select>
                            <span class="error" id="createStatusError"></span>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="createEmployeeButton">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#createEmployeeButton").prop("disabled", true);

            function validateCreateForm() {
                var firstName = $("#createFullName").val();
                var lastName = $("#createLastName").val();
                var email = $("#createEmail").val();
                var department = $("#createDepartment").val();
                var password = $("#createPassword").val();
                var userType = $("#createUserType").val();
                var status = $("#createStatus").val();
                var employeeID = $("#createEmployeeID").val();
                
                var isValid = true;

                if (employeeID.trim() === "") {
                    $("#createEmployeeIDError").text("Employee ID is required.");
                    isValid = false;
                } else {
                    $("#createEmployeeIDError").text("");
                }
                if (firstName.trim() === "") {
                    $("#createFullNameError").text("First name is required.");
                    isValid = false;
                } else {
                    $("#createFullNameError").text("");
                }

                if (lastName.trim() === "") {
                    $("#createLastNameError").text("Last name is required.");
                    isValid = false;
                } else {
                    $("#createLastNameError").text("");
                }

                if (email.trim() === "") {
                    $("#createEmailError").text("Email is required.");
                    isValid = false;
                } else {
                    $("#createEmailError").text("");
                }
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    $("#createEmailError").text("Invalid email format.");
                    isValid = false;
                } else {
                    $("#createEmailError").text("");
                }

                if (department.trim() === "") {
                    $("#createDepartmentError").text("Department is required.");
                    isValid = false;
                } else {
                    $("#createDepartmentError").text("");
                }

                if (password.trim() === "") {
                    $("#createPasswordError").text("Password is required.");
                    isValid = false;
                } else {
                    $("#createPasswordError").text("");
                }

                if (userType === "") {
                    $("#createUserTypeError").text("User type is required.");
                    isValid = false;
                } else {
                    $("#createUserTypeError").text("");
                }

                if (status === "") {
                    $("#createStatusError").text("Status is required.");
                    isValid = false;
                } else {
                    $("#createStatusError").text("");
                }

                if (isValid) {
                    $("#createEmployeeButton").prop("disabled", false);
                } else {
                    $("#createEmployeeButton").prop("disabled", true);
                }
            }

            $("#createFullName, #createLastName, #createEmail, #createDepartment, #createPassword, #createUserType, #createStatus, #createEmployeeID").on("input", validateCreateForm);

            validateCreateForm();

            $("#createEmployeeModal").on("hidden.bs.modal", function() {
                $("#createFullNameError").text("");
                $("#createLastNameError").text("");
                $("#createEmailError").text("");
                $("#createDepartmentError").text("");
                $("#createPasswordError").text("");
                $("#createUserTypeError").text("");
                $("#createStatusError").text("");
                $("#createEmployeeButton").prop("disabled", true);
            });

            $(".edit-employee-btn").prop("disabled", true);

            function validateEditForm(modalIndex) {
                var fullName = $("#fullName" + modalIndex).val();
                var lastName = $("#lastName" + modalIndex).val();
                var email = $("#email" + modalIndex).val();
                var department = $("#department" + modalIndex).val();
                var userType = $("#userType" + modalIndex).val();
                var status = $("#status" + modalIndex).val();
                var employeeID = $("#employeeID" + modalIndex).val();

                var isValid = true;
                if (employeeID.trim() === "") {
                    $("#employeeID" + modalIndex + "Error").text("Employee ID is required.");
                    isValid = false;
                } else {
                    $("#employeeID" + modalIndex + "Error").text("");
                }
                if (fullName.trim() === "") {
                    $("#fullName" + modalIndex + "Error").text("Fitst name is required.");
                    isValid = false;
                } else {
                    $("#fullName" + modalIndex + "Error").text("");
                }
                if (fullName.trim() === "") {
                    $("#lastName" + modalIndex + "Error").text("Last name is required.");
                    isValid = false;
                } else {
                    $("#fullName" + modalIndex + "Error").text("");
                }

                if (email.trim() === "") {
                    $("#email" + modalIndex + "Error").text("Email is required.");
                    isValid = false;
                } else {
                    $("#email" + modalIndex + "Error").text("");
                }

                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    $("#email" + modalIndex + "Error").text("Invalid email format.");
                    isValid = false;
                } else {
                    $("#email" + modalIndex + "Error").text("");
                }

                if (department.trim() === "") {
                    $("#department" + modalIndex + "Error").text("Department is required.");
                    isValid = false;
                } else {
                    $("#department" + modalIndex + "Error").text("");
                }

                if (userType === "") {
                    $("#userType" + modalIndex + "Error").text("User type is required.");
                    isValid = false;
                } else {
                    $("#userType" + modalIndex + "Error").text("");
                }

                if (status === "") {
                    $("#status" + modalIndex + "Error").text("Status is required.");
                    isValid = false;
                } else {
                    $("#status" + modalIndex + "Error").text("");
                }

                if (isValid) {
                    $("#editEmployeeButton" + modalIndex).prop("disabled", false);
                } else {
                    $("#editEmployeeButton" + modalIndex).prop("disabled", true);
                }
            }

            $(".edit-employee-modal input, .edit-employee-modal select").on("input", function() {
                var modalIndex = $(this).data("modal-index");
                validateEditForm(modalIndex);
            });

            $(".edit-employee-modal").each(function() {
                var modalIndex = $(this).find(".edit-employee-btn").data("modal-index");
                validateEditForm(modalIndex);
            });

            $(".edit-employee-modal").on("hidden.bs.modal", function() {
                var modalIndex = $(this).find(".edit-employee-btn").data("modal-index");
                $("#lastName" + modalIndex + "Error").text("");
                $("#employeeID" + modalIndex + "Error").text("");
                $("#fullName" + modalIndex + "Error").text("");
                $("#email" + modalIndex + "Error").text("");
                $("#department" + modalIndex + "Error").text("");
                $("#userType" + modalIndex + "Error").text("");
                $("#status" + modalIndex + "Error").text("");
                $("#editEmployeeButton" + modalIndex).prop("disabled", true);
            });

            $(".edit-employee-btn").click(function() {
                var modalIndex = $(this).data("modal-index");
                
            });

            $(".modal-footer .btn-danger").click(function() {
                
            });
        });
    </script>
</body>


@endsection