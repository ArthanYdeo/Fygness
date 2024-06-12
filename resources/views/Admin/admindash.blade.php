@extends('layout.app')
@section('content')

<div class="container-fluid mt-5">
    <div class="row">
        <!-- ./col -->
        <div class="col-12 col-md-2 mb-3">
            <!-- small box -->
            <div class="small-box square-box" style="background-color: #272539; padding: 30px;">
                <div class="inner">
                    <h3 style="font-size: 24px; color: white;">Total: {{ $getUser->total() }}</h3>
                    <p style="color: white;">User Lists</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check" style="color: white;"></i>
                </div>
                <a href="{{ url('admin/users') }}" class="small-box-footer" style="color: white;">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-12 col-md-2 mb-3">
            <!-- small box -->
            <div class="small-box square-box" style="background-color: #37326C; padding: 30px;">
                <div class="inner">
                    <h3 style="font-size: 24px; color: white;">Total: {{ $getStaff->total() }}</h3>
                    <p style="color: white;">Staff Lists</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person" style="color: white;"></i>
                </div>
                <a href="{{ url('/admin/staff') }}" class="small-box-footer" style="color: white;">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-12 col-md-2 mb-3">
            <!-- small box -->
            <div class="small-box square-box" style="background-color: #567856; padding: 30px;">
                <div class="inner">
                    <h3 style="font-size: 24px; color: white;">Total: {{ $getTrainer->total() }}</h3>
                    <p style="color: white;">Trainer List</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person" style="color: white;"></i>
                </div>
                <a href="{{ url('/admin/staff') }}" class="small-box-footer" style="color: white;">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-12 col-md-2 mb-3">
            <!-- small box -->
            <div class="small-box square-box" style="background-color: #5095A4; padding: 30px;">
                <div class="inner">
                    <h3 style="font-size: 24px; color: white;">Total: {{ $announcements->total() }}</h3>
                    <p style="color: white;">Announcements</p>
                </div>
                <div class="icon">
                    <i class="ion ion-speakerphone" style="color: white;"></i>
                </div>
                <a href="{{ route('admin.announcements.index') }}" class="small-box-footer" style="color: white;">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-12 col-md-2 mb-3">
            <!-- small box -->
            <div class="small-box square-box" style="background-color: #50a489; padding: 30px;">
                <div class="inner">
                    <h3 style="font-size: 24px; color: white;">Total: {{ $totalGyms }}</h3>
                    <p style="color: white;">Registered Gyms</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dumbbell" style="color: white;"></i>
                </div>
                <a href="{{ route('gyms.index') }}" class="small-box-footer" style="color: white;">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
</div>

@endsection
