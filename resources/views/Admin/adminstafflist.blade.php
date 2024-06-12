@extends('layout.app')
@section('content')

<h1 class="text-center">GYM's Staff List <i class="fas fa-briefcase"></i></h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Staff Lists</div>

                <div class="card-body">
                    <table class='table table-bordered table-hover'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Designation</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staff as $key => $staffMember)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $staffMember->full_name }}</td>
                                    <td>{{ $staffMember->designation }}</td>
                                    <td>{{ $staffMember->email }}</td>
                                    <td>{{ $staffMember-> phone_number}}</td>
                                    <td>
                                        <!-- Edit button -->
                                        <button class="btn btn-primary btn-sm" onclick="editStaffMember({{ $staffMember->id }})"><i class='fas fa-edit'></i> Edit</button>
                                        <!-- Delete button -->
                                        <form action="{{ route('staff.destroy', $staffMember->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this staff member?')"><i class='fas fa-trash'></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Staff Member Modal -->
<div class="modal fade" id="editStaffMemberModal" tabindex="-1" aria-labelledby="editStaffMemberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStaffMemberModalLabel">Edit Staff Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editStaffMemberForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                    </div>
                    <div class="form-group">
                    <label for="designation">Designation</label>
                    <select class="form-control" id="designation" name="designation" required>
                        <option value="">Select Designation</option>
                        <option value="Gym Trainer">Gym Trainer</option>
                        <option value="Counter">Counter</option>
                        <!-- Add more options if needed -->
                    </select>
                </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <!-- Add other fields as necessary -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editStaffMember(staffMemberId) {
    $.get(`/admin/staff/${staffMemberId}/edit`, function(staffMember) {
        $('#full_name').val(staffMember.full_name);
        $('#designation').val(staffMember.designation);
        $('#email').val(staffMember.email);
        // Add other fields as necessary
        $('#editStaffMemberForm').attr('action', `/admin/staff/${staffMemberId}`);
        $('#editStaffMemberModal').modal('show');
    });
}
</script>

@endsection
