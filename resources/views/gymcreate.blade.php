@extends('layout.app')
@section('content')
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">Create Gym</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('gyms.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="inclusion">Inclusions</label>
                            <textarea class="form-control" id="inclusion" name="inclusion" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="owner">Owner</label>
                            <input type="text" class="form-control" id="owner" name="owner" required>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="address" name="address" required>
                                <!-- Google Maps link -->
                                <div class="input-group-append">
                                    <a href="#" id="map-link" class="btn btn-outline-primary" target="_blank">View Map</a>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" pattern="[0-9]*" title="Please enter only numeric characters" maxlength="11" required>
                        <small class="form-text text-muted">Please enter exactly 11 numbers.</small>
                        </div>

                        <div class="form-group">
                            <label for="logo">Logo</label>
                            <input type="file" class="form-control-file" id="logo" name="logo">
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to open Google Maps when the View Map button is clicked
    document.getElementById('map-link').addEventListener('click', function(event) {
        event.preventDefault();
        var address = document.getElementById('address').value;
        var encodedAddress = encodeURIComponent(address);
        var googleMapsUrl = 'https://www.google.com/maps/search/?api=1&query=' + encodedAddress;
        window.open(googleMapsUrl, '_blank');
    });

    // Function to prevent non-numeric input in the phone number field
    document.getElementById('phone_number').addEventListener('input', function(event) {
        var phoneNumber = event.target.value;
        var numericPhoneNumber = phoneNumber.replace(/\D/g, '');
        event.target.value = numericPhoneNumber;
    });

</script>

</body>
@endsection
