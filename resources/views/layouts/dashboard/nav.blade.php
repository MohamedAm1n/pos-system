<body dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}" class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center"> 
            
            <img class="animation__shake" src="{{ asset('dashboard/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
        </div>
        {{-- main-header navbar navbar-expand navbar-white navbar-light --}}

        <nav class="navbar navbar-expand main-header navbar-light">



            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('dashboard.index') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#"> <i class="fas fa-solid fa-bell"></i>
                        </a>
                    </li> --}}
                    <li class="nav-item dropdown-notifications">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-solid fa-bell"></i>
                            <span data-count="1">1</span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            
                        <li class="scrollable-container"></li>
                            
                        </div>
                    </li>


                    {{-- Language dropdown --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Lang
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)

                            <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>

                            @endforeach
                        </div>
                    </li>    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown link
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        
                            <a class="dropdown-item">
                                <form action="{{ route('logout') }}" method="POST">
                                    @method('POST')
                                    @csrf
                                    <button class="submit">
                                        <i class="fas fa-sign-out-alt"></i>Logout
                                    </button>
                                </form>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>


