<div class="ui large top fixed hidden menu">
    <div class="ui container">
        <a class="active item">TutoCode</a>
        @if(Auth::check())
            <div class="right menu">
                <div class="item">
                    <a href="{{ url('/logout') }}" class="ui orange button"
                       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Déconnexion
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        @else
            <div class="right menu">
                <div class="item">
                    <a href="{{ url('/login')}}" class="ui orange button">Connexion</a>
                </div>
                <div class="item">
                    <a href="{{ url('/register')}}" class="ui black button">Inscription</a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Sidebar Menu -->
<div class="ui vertical inverted sidebar menu">
    <a class="item">Connexion</a>
    <a href="{{ url('/register')}}" class="item">Inscription</a>
</div>