@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
<div class="whole-wrap"> <!-- esse bloco deixa alinhado no centro, essa linha mais as duas de baixo  -->
		<div class="container box_1170">
			<div class="section-top-border">
                <h1>Verify your email</h1>
                    <p>We sent a verification link to <strong>{{ auth()->user()->email }}</strong>.</p>
                    @if (session('status') === 'verification-link-sent')
                        <p>New verification link sent.</p>
                    @endif
                    <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Resend Verification Email
                            </button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('logout') }}" style="margin-top:1rem">
                    @csrf
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Log Out
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
