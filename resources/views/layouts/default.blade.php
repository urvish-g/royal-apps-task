<!doctype html>
<html>
  <head>
    @include('includes.head')
  </head>
  <body>
    <div class="container">
      <header class="row">
        @include('includes.header')
      </header>
      <body>
        <div id="main" class="row">
          @yield('content')
        </div>
      </body>
      <footer class="row">
      </footer>
    </div>
    @stack('after-scripts')
  </body>
</html>