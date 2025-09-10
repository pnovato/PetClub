@extends('layouts.app')

@section('title', 'Verify Email')

@section('content')
<div class="whole-wrap"> <!-- esse bloco deixa alinhado no centro, essa linha mais as duas de baixo  -->
		<div class="container box_1170">
			<div class="section-top-border">
                <h1>Verifica o teu e-mail</h1>
                    <p>Enviámos um link de verificação para <strong>{{ auth()->user()->email }}</strong>.</p>
                    @if (session('status') === 'verification-link-sent')
                        <p>Foi enviado um novo link de verificação.</p>
                    @endif
                    <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Reenviar e-mail de verificação
                            </button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('logout') }}" style="margin-top:1rem">
                    @csrf
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Terminar sessão
                            </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
