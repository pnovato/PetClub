@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="forgot_password_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="forgot_password_form">
                    <h3>Forgot Password</h3>
                    <form method="POST" action="{{ route('password.reset') }}">
                    @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Set new password
                            </button>
                        </div>
                        <div class="form-group">
                            <a class="btn btn-link" href="{{ route('login') }}">
                                Back to Login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection