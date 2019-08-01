<div class="shadow py-0 mb-5 sticky-top border-bottom border-dark" style="background: white">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light ">

            <div>
                <a class="navbar-brand font-weight-bold" href="/">
                    <div style="color: #FF5733;">
                        <i class="fas fa-tasks"></i>
                        TASKS
                    </div>
                </a>
            </div>

            <div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars" style="color: #FF5733"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav mr-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/projects">My projects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="/tasks">My tasks</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-dark" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>

        </nav>
    </div>
</div>

