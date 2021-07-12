{{--<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">--}}
{{--    <div class="container">--}}
{{--        <a class="navbar-brand" href="#">Ayat Amine</a>--}}
{{--        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">--}}
{{--            <span class="navbar-toggler-icon"></span>--}}
{{--        </button>--}}
{{--        <div class="collapse navbar-collapse" id="navbarResponsive">--}}
{{--            <ul class="navbar-nav ml-auto">--}}
{{--                <li class="nav-item active">--}}
{{--                    <router-link class="nav-link" to="/admin">Admin--}}
{{--                        <span class="sr-only">(current)</span>--}}
{{--                    </router-link>--}}
{{--                </li>--}}
{{--                <li class="nav-item active">--}}
{{--                    <router-link class="nav-link" to="/">Home--}}
{{--                        <span class="sr-only">(current)</span>--}}
{{--                    </router-link>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="">blog</a>--}}
{{--                </li>--}}
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link" href="">Contact</a>--}}
{{--                </li>--}}

{{--                @guest--}}

{{--                    <li class="nav-item reg-login-btn" data-toggle="modal" data-target="#login-modal">--}}
{{--                        <a class="btn btn-primary text-weight nav-link" href="#">{{ __('Login') }}</a>--}}
{{--                    </li>--}}
{{--                    @if (Route::has('register'))--}}

{{--                        <li class="nav-item register-btn reg-login-btn" data-toggle="modal" data-target="#register-modal">--}}
{{--                            <a class="btn btn-info nav-link" href="" data-toggle="modal" data-target="#register-modal"href="{{ route('register') }}">{{ __('Register') }}</a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                @else--}}
{{--                    <li class="nav-item dropdown">--}}
{{--                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                            {{ Auth::user()->name }}--}}
{{--                        </a>--}}

{{--                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
{{--                            <a class="dropdown-item" href="{{ route('logout') }}"--}}
{{--                               onclick="event.preventDefault();--}}
{{--                                                     document.getElementById('logout-form').submit();">--}}
{{--                                {{ __('Logout') }}--}}
{{--                            </a>--}}

{{--                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
{{--                                @csrf--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                @endguest--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</nav>--}}

