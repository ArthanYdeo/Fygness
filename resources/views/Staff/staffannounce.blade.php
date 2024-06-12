@extends('layout.app')
@section('content')

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Announcement</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('announcements.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" type="text" class="form-control" name="title" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea id="content" class="form-control" name="content" rows="4" required></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>