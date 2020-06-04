        <header id="header">
            <div class="container-fluid">
                <div class="navbar">
                    <a href="{{ route('welcome') }}" id="logo" ><img src="assets/images/logo.png"style="width=50px;height:50px;" alt="LOGO">PRPN 2020
                    </a>
                    <div class="navigation-row">
                        <nav id="navigation">
                            <button type="button" class="navbar-toggle"> <i class="fa fa-bars"></i> </button>
                            <div class="nav-box navbar-collapse">
                                <ul class="navigation-menu nav navbar-nav navbars" id="nav">
                                    <li data-menuanchor="slide01" class="active"><a href="#slide01">Dasbor</a></li>
                                    <li data-menuanchor="slide02"><a href="#slide02">Lengkapi Data</a></li>
                                    <li data-menuanchor="slide03"><a href="#slide03">Pembayaran</a></li>
                                    <li data-menuanchor="slide04"><a href="#slide04">Submit Pendaftaran</a></li>
                                    @if (Route::has('login'))
                                        @auth
                                            <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                Logout
                                                </a>
                                            </li>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                                </form>
                                        @else
                                            <li
                                            @if(Request::url() === route('login'))
                                            class="active"
                                            @endif
                                            ><a href="{{ route('login') }}">Login</a></li>

                                            @if (Route::has('register'))
                                                <li><a href="{{ route('register') }}">Register</a></li>
                                            @endif
                                        @endauth
                                    @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
