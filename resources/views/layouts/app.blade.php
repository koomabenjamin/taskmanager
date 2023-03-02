<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('layouts.header')
<body>
    <div id="app">
        @if (Auth::user())
            
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="text-center">
                  <img src="{{ URL('images/logo.png') }}" alt="Logo Here" class="img-custom-logo">
              </div>
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Flows List') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                      
                    </ul>

                    <div>
                      <?php date_default_timezone_set('Africa/Kampala'); ?>
                      <div class="text-center"><strong id="time">{!! date('h:i:s A') !!}</strong></div>
                      <strong>{!! date('dS F Y') !!}</strong>
                    </div>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                        @else
                            <li class="nav-item dropdown">
                                <div>Logged in as:</div>
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Sidebar Menu -->
      <nav class="col-sm-3 col-md-2 col-lg-2 float-left bg-dark pb-5 side-bar">
      
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
            <li class="nav-item">
              <a href="{{ route('tasks.index') }}" class="nav-link">
                <div>
                  <i class="bi bi-bandaid-fill"></i>
                  Tasks
                  <i class="right fas fa-angle-left"></i>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('projects.index') }}" class="nav-link">
                <div>
                  <i class="bi bi-wrench"></i>
                  Projects
                  <i class="right fas fa-angle-left"></i>
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('users.index') }}" class="nav-link">
                <div>
                  <i class="bi bi-cart-plus-fill"></i>
                  Users
                  <i class="right fas fa-angle-left"></i>
                </div>
              </a>
            </li>
          @endif
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
              <div>
                <i class="bi bi-person-x-fill"></i>
                Logout
                <i class="right fas fa-angle-left"></i>
              </div>
            </a>
          </li>
        </ul>
      </nav>
        @endif

        @if(Session::has('flash_message'))
          <div style="color:green; border:1px solid #aaa; padding:4px; margin-top:10px">
            {{ Session::get('flash_message') }}
          </div>
        @endif

        @if($errors->any())
          <div style="color:red; border:1px solid #aaa; padding:4px; margin-top:10px">
            @foreach($errors->all() as $error)
              <p>{{ $error }}</p>
            @endforeach
          </div>
        @endif
    
        @if (Auth::user())
          <main class="py-4 col-sm-9 col-md-10 col-lg-10 d-inline-block">
        @else
          <main class="py-4">
        @endif
            @yield('content')
        </main>
        
        @include('layouts.footer')
    </div>

    <script type="text/javascript">

    //Current Time
    var d = new Date(<?php echo time() * 1000 ?>);
    function digitalClock() {
      d.setTime(d.getTime() + 1000);
      var hrs = d.getHours();
      var mins = d.getMinutes();
      var secs = d.getSeconds();
      mins = (mins < 10 ? "0" : "") + mins;
      secs = (secs < 10 ? "0" : "") + secs;
      var apm = (hrs < 12) ? "AM" : "PM";
      hrs = (hrs > 12) ? hrs - 12 : hrs;
      hrs = (hrs == 0) ? 12 : hrs;
      var ctime = hrs + ":" + mins + ":" + secs + " " + apm;
      document.getElementById("time").firstChild.nodeValue = ctime;
    }
    window.onload = function() {
      digitalClock();
      setInterval('digitalClock()', 1000);
    }

 

  </script> 


</body>
</html>