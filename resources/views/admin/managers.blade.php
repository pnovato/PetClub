@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>My Profile</h2>
        <form method="POST" action="{{ route('admin.profile.update') }}" class="mt-4 mb-5">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="name" class="form-control" value="{{ old('name', auth()->user()->name) }}" required>
                </div>
                <div class="col-md-3">
                    <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                </div>
                <div class="col-md-3">
                    <input type="password" name="password" class="form-control" placeholder="New password(optional)">
                </div>
                <div class="col-md-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm new password">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Update Profile</button>
        </form>
        
    <h2>Management of Managers</h2>
    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-2">{{ session('error') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.managers.store') }}" class="mt-4 mb-5">
        @csrf
        <div class="row">
            <div class="col-md-3">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="col-md-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="col-md-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="col-md-3">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Add Manager</button>
    </form>
    <h4>List of Managers</h4>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($managers as $manager)
                <tr>
                    <td>{{ $manager->name }}</td>
                    <td>{{ $manager->email }}</td>
                    <td>
                        @if(auth()->id() !== $manager->id)
                        <form method="POST" action="{{ route('admin.managers.destroy', $manager->id) }}" onsubmit="return confirm('Are you sure you want to remove this manager?');" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                        @else
                        <em>Myself</em>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
