@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Pet</h1>
    <form method="POST" action="{{ route('admin.pets.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="species">Specie</label>
            <input type="text" name="species" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="sex">Sex</label>
            <select name="sex" class="form-control" required>
                <option value="male">Macho</option>
                <option value="female">Fêmea</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="age_years">Age (years)</label>
            <input type="number" name="age_years" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="size">Size</label>
            <input type="text" name="size" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="image">Image</label>
            <input type="file" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('admin.pets.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
