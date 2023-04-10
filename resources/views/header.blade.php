<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">See our product and choose what to purchase</h4>
          <p class="text-muted">text text text text text text</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">text</h4>
          <ul class="list-unstyled">
            <li><a href="#" class="text-white">text 1</a></li>
            <li><a href="#" class="text-white">text 2</a></li>
            <li><a href="#" class="text-white">text 3</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="#" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>e-commerce</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <span style="color: white; padding-right: 10px;">User: {{ auth()->user()->name }}</span>
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration: none">Log in</a>

                @if (Route::has('register'))
                    <span style="color: white">/</span> <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline" style="text-decoration: none">Register</a>
                @endif
            @endauth
        </div>
   @endif
  </div>

</header>
