<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-DyZv+EX7+nIV05r13mT09nTpWZ0ZCdKt4hggk5y22rBoSoG9l+PHeD+4X5kHxD/r" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Open+Sans:wght@400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>@yield('title')</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/') }}">Library</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('categories') }}">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('books') }}">Books</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('authors') }}">Authors</a>
            </li>
          </ul>
          
          <ul class="navbar-nav ml-auto">
            @guest
              <!-- Show Login and Sign Up when not authenticated -->
              <li class="nav-item">
                <a class="nav-link" href="{{ route('showLogin') }}">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('showRegister') }}">Sign Up</a>
              </li>
            @endguest
            
            @auth
              <!-- Show User dropdown when authenticated -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{route('showChangePassword')}}">Change Password</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
            @endauth
          </ul>
        </div>
      </nav>
      
      <div class="">
        @yield('body')

        <div class="footer-section mt-5 py-4" style="background-color: #f8f9fa; border-top: 1px solid #ddd;">
          <p class="text-center mb-1" style="font-weight: 500; color: #333;">
              &copy; {{ date('Y') }} Your Library. All rights reserved.
          </p>
          <p class="text-center mb-0" style="font-size: 0.9rem; color: #555;">
              Designed and developed by 
              <a href="https://www.linkedin.com/in/driny/" target="_blank" style="color: #003366; font-weight: 600; text-decoration: none;">
                  Muhammad Aldriny
              </a>
          </p>
        </div>
      </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
  </body>
</html>
