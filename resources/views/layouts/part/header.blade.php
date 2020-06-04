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
                                @if(Request::url() === route('home'))
                                        <li data-menuanchor="slide01" class="active"><a href="#slide01">Dasbor</a></li>
                                    @if(Auth::user()->status == 0)
                                        <li data-menuanchor="slide02"><a href="#slide02">Lengkapi Data</a></li>
                                        <li data-menuanchor="slide03"><a href="#slide03">@yield('transaction', 'Pembayaran')</a></li>
                                    @endif
                                        <li data-menuanchor="{{ (Auth::user()->status == 0)?"#slide04":"#slide02"}}"><a href="{{ (Auth::user()->status == 0)?"#slide04":"#slide02"}}">Submit Pendaftaran</a></li>
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
                                        @endauth
                                    @endif
                                @else
                                    <li data-menuanchor="slide01" class="active"><a href="{{ route('welcome') }}#slide01">Beranda</a></li>
                                    <li data-menuanchor="slide02"><a href="{{ route('welcome') }}#slide02">Tentang Kami</a></li>
                                    <li data-menuanchor="slide03"><a href="{{ route('welcome') }}#slide03">Info Lomba</a></li>
                                    @if (Route::has('login'))
                                        @auth     
                                            <li><a href="{{ route('home') }}">
                                                Area Peserta
                                                </a>
                                            </li>
                                        @else
                                            @if (Route::has('register'))
                                                <li><a href="{{ route('register') }}">Daftar</a></li>
                                            @endif

                                            <li><a href="{{ route('login') }}">Login</a></li>
                                        @endauth
                                    @endif
                                @endif
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>