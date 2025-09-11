@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Pet: {{ $pet->name }}</h1>
    <form method="POST" action="{{ route('admin.pets.update', $pet->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $pet->name }}" required>
        </div>
        <div class="mb-3">
            <label for="species">Specie</label>
            <input type="text" name="species" class="form-control" value="{{ $pet->species }}" required>
        </div>
        <div class="mb-3">
            <label for="sex">Sex</label>
            <select name="sex" class="form-control" required>
                <option value="male" {{ $pet->sex === 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $pet->sex === 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="age_years">Age (years)</label>
            <input type="number" name="age_years" class="form-control" value="{{ $pet->age_years }}" required>
        </div>
        <div class="mb-3">
            <label for="size">Size</label>
            <input type="text" name="size" class="form-control" value="{{ $pet->size }}" required>
        </div>
        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $pet->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="status">Status</label>
            <select name="status" class="form-control">
                <option value="available" {{ $pet->status === 'available' ? 'selected' : '' }}>Available</option>
                <option value="pending" {{ $pet->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="adopted" {{ $pet->status === 'adopted' ? 'selected' : '' }}>Adopted</option>
                <option value="rejected" {{ $pet->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.pets.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
