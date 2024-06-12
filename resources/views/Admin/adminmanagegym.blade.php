@extends('layout.app')

@section('content')
<div class="container">
    <h2>All Gyms</h2>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Owner</th>
                <th>Inclusions</th>
                <th>Contact</th>
                <th>Logo</th>
                <th>Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gyms as $gym)
                <tr>
                    <td>{{ $gym->id }}</td>
                    <td>{{ $gym->name }}</td>
                    <td>{{ $gym->owner }}</td>
                    <td>{{ $gym->inclusion }}</td>
                    <td>{{ $gym->phone_number }}</td>
                    <td><img src="{{ asset('uploads/' . $gym->logo) }}" alt="Gym Logo" style="max-width: 100px;"></td>
                    <td>{{ $gym->address }}</td>
                    <td>
                        <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" data-id="{{ $gym->id }}" data-name="{{ $gym->name }}" data-email="{{ $gym->email }}" data-inclusion="{{ $gym->inclusion }}" data-owner="{{ $gym->owner }}" data-address="{{ $gym->address }}" data-phone_number="{{ $gym->phone_number }}" data-logo="{{ $gym->logo }}">Edit</button>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="{{ $gym->id }}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editForm" method="POST" action="" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Gym</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-name">Gym Name:</label>
                        <input type="text" name="name" id="edit-name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email:</label>
                        <input type="email" name="email" id="edit-email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-inclusion">Inclusions:</label>
                        <textarea name="inclusion" id="edit-inclusion" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-owner">Owner:</label>
                        <input type="text" name="owner" id="edit-owner" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-address">Location:</label>
                        <input type="text" name="address" id="edit-address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-phone_number">Phone Number:</label>
                        <input type="text" name="phone_number" id="edit-phone_number" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-logo">Logo:</label>
                        <input type="file" name="logo" id="edit-logo" class="form-control">
                        <img id="edit-logo-preview" src="" alt="Current Logo" style="max-width: 100px; margin-top: 10px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Gym</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this gym?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');
        var email = button.data('email');
        var inclusion = button.data('inclusion');
        var owner = button.data('owner');
        var address = button.data('address');
        var phone_number = button.data('phone_number');
        var logo = button.data('logo');

        var modal = $(this);
        modal.find('.modal-body #edit-name').val(name);
        modal.find('.modal-body #edit-email').val(email);
        modal.find('.modal-body #edit-inclusion').val(inclusion);
        modal.find('.modal-body #edit-owner').val(owner);
        modal.find('.modal-body #edit-address').val(address);
        modal.find('.modal-body #edit-phone_number').val(phone_number);
        if (logo) {
            modal.find('.modal-body #edit-logo-preview').attr('src', '/uploads/' + logo);
        } else {
            modal.find('.modal-body #edit-logo-preview').attr('src', '');
        }
        $('#editForm').attr('action', '/gyms/' + id);
    });

    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');

        var modal = $(this);
        $('#deleteForm').attr('action', '/gyms/' + id);
    });
</script>
@endsection
