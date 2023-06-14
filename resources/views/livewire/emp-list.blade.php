<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-3">
                    <div class="mb-3">
                        <div class="mb-3 d-flex justify-content-between">
                            <div>
                                <input type="text" class="form-control" placeholder="Search">
                            </div>
                            <div>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#createEmployeeModal">Create Employee</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Email Address</th>
                                        <th>Department</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $index => $user)
                                    <tr>
                                        <td>{{ $user->empLastName }}, {{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->empDept }}</td>
                                        <td>{{ $user->usertype }}</td>
                                        <td>{{ $user->empStatus }}</td>
                                        <td>
                                            <div>
                                                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editEmployeeModal{{ $index }}">Edit</button>
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteEmployeeModal{{ $index }}">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Edit Employee Modal for each row -->
                                    <div class="modal fade" id="editEmployeeModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="editEmployeeModalLabel{{ $index }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editEmployeeModalLabel{{ $index }}">Edit Employee</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="fullName{{ $index }}">Full Name</label>
                                                            <input type="text" class="form-control" id="fullName{{ $index }}" placeholder="Enter full name" value="{{ $user->empName }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email{{ $index }}">Email Address</label>
                                                            <input type="email" class="form-control" id="email{{ $index }}" placeholder="Enter email address" value="{{ $user->email }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="department{{ $index }}">Department</label>
                                                            <input type="text" class="form-control" id="department{{ $index }}" placeholder="Enter department" value="{{ $user->empDept }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="userType{{ $index }}">User Type</label>
                                                            <select class="form-control" id="userType{{ $index }}">
                                                                <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                                                                <option value="employee" {{ $user->usertype == 'employee' ? 'selected' : '' }}>Employee</option>
                                                                <option value="manager" {{ $user->usertype == 'manager' ? 'selected' : '' }}>Manager</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="status{{ $index }}">Status</label>
                                                            <select class="form-control" id="status{{ $index }}">
                                                                <option value="active" {{ $user->empStatus == 'active' ? 'selected' : '' }}>Active</option>
                                                                <option value="inactive" {{ $user->empStatus == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Employee Modal for each row -->
                                    <div class="modal fade" id="deleteEmployeeModal{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="deleteEmployeeModalLabel{{ $index }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
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
                                                    <button type="button" class="btn btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                    <form>
                        <div class="form-group">
                            <label for="createFullName">First Name</label>
                            <input wire:model="firstname" type="text" class="form-control" id="createFullName" placeholder="Enter first name">
                            @error('firstname') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="createLastName">Last Name</label>
                            <input wire:model="lastname" type="text" class="form-control" id="createLastName" placeholder="Enter last name">
                            @error('lastname') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="createEmail">Email Address</label>
                            <input wire:model="email" type="email" class="form-control" id="createEmail" placeholder="Enter email address">
                            @error('email') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="createDepartment">Department</label>
                            <input wire:model="department" type="text" class="form-control" id="createDepartment" placeholder="Enter department">
                            @error('department') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="createPassword">Password</label>
                            <input wire:model="password" type="password" class="form-control" id="createPassword" placeholder="Enter Password">
                            @error('password') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="createPasswordConfirmation">Confirm Password</label>
                            <input wire:model="password_confirmation" type="password" class="form-control" id="createPasswordConfirmation" placeholder="Confirm Password">
                            @error('password_confirmation') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="createUserType">User Type</label>
                            <select wire:model="usertype" class="form-control" id="createUserType">
                                <option value="employee">Employee</option>    
                                <option value="admin">HR Admin</option>
                            </select>
                            @error('usertype') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="createStatus">Status</label>
                            <select wire:model="status" class="form-control" id="createStatus">
                                <option value="Regular">Regular</option>
                                <option value="Probationary">Probationary</option>
                                <option value="Contractual">Contractual</option>
                                <option value="Project-Based">Project-Based</option>
                            </select>
                            @error('status') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="createEmployeeButton" disabled>Create</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</div>
