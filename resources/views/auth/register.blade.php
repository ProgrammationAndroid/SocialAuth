@extends('layouts.app')

@section('content')

<div class="ui container">
    <div class="ui grid two columns centered">
        <div class="column">

            <div class="ui horizontal divider">Via Reseaux Sociaux</div>
            <!-- Social buttons -->
            <div class="ui center aligned container">
                <a href="{{ url('/facebook') }}" class="ui circular facebook icon button">
                    <i class="facebook icon"></i>
                </a>
                <a href="{{ url('/twitter') }}" class="ui circular twitter icon button">
                    <i class="twitter icon"></i>
                </a>
                <a href="{{ url('/google') }}" class="ui circular google plus icon button">
                    <i class="google plus icon"></i>
                </a>
            </div>


            <div class="ui horizontal divider">Ou</div>

            <form method="post" action="{{ url('/register') }}" class="ui form @if(count($errors) > 0) error @endif">
                {{ csrf_field()}}
                <div class="field {{ $errors->has('name') ? 'error' : '' }}">
                    <label for="name">Pseudo</label>
                    <input type="text" name="name" value="{{ old('name') }}" required id="name">
                    @if($errors->has('name'))
                        <div class="ui pointing red basic label">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>


                <div class="field {{ $errors->has('email') ? 'error' : '' }}">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required id="email">
                    @if($errors->has('email'))
                        <div class="ui pointing red basic label">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="field {{ $errors->has('password') ? 'error' : '' }}">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" value="{{ old('password') }}" required id="password">
                    @if($errors->has('password'))
                        <div class="ui pointing red basic label">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div class="field">
                    <label for="password_confirmation">Confirmation du Mot de passe</label>
                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}"
                           required id="password_confirmation">
                </div>


                <button type="submit" class="ui button">S'inscrire</button>
            </form>
        </div>
    </div>
</div>


@endsection
