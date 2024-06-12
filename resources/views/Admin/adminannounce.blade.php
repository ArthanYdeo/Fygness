@extends('layout.app')
@section('content')



<h1 class="text-center">Announcement <i class="fas fa-bullhorn"></i></h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Announcements</div>

                <div class="card-body">
                <table class='table table-bordered table-hover'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Date</th>
                  <th>Title</th>
                  <th>Message</th>
                  <th>Manage</th>
                </tr>
              </thead>
              <tbody>
        @foreach ($announcements as $key => $announcement)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $announcement->created_at->format('Y-m-d H:i:s') }}</td>
                <td><strong>{{ $announcement->title}}</strong></td>
                <td>{{ $announcement->content }}</td>
                <td><div class='text-center'>
                <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <!-- Delete button -->
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this announcement?')"><i class='fas fa-trash'></i> Delete</button>
            </form>
            </div>
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


            
</body>
</html>