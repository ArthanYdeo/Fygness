@extends('layout.app')
@section('content')

<h1 class="text-center">Registered Members List <i class="fas fa-users"></i></h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">User Lists</div>

                <div class="card-body">
                    <table class='table table-bordered table-hover'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Subscriptions</th>
                                <th>Plan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->subscriptions as $subscription)
                                            {{ $subscription->subscription_type }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($user->subscriptions as $subscription)
                                            {{ $subscription->duration }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" onclick="editUser({{ $user->id }})"><i class='fas fa-edit'></i> Edit</button>
                                        <form action="{{ route('users.delete', $user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
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

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="full_name">Full Name</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Contact Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                    </div>

                    <div class="form-group">
                        <label for="email   ">Email Address</label>
                        <input type="text" class="form-control" id="email" name="email" required>
                    </div>
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
function editUser(userId) {
    $.get(`/admin/users/${userId}/edit`, function(user) {
        $('#full_name').val(user.full_name);
        $('#phone_number').val(user.phone_number);
        // Add other fields as necessary
        $('#editUserForm').attr('action', `/admin/users/${userId}`);
        $('#editUserModal').modal('show');
    });
}
</script>

@endsection
