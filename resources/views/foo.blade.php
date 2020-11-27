<html>
  <head>
    @livewireStyles
  </head>
  <body>
          <h2>Laravel Livewire CRUD - ItSolutionStuff.com</h2>
             @if (session()->has('message'))
                 <div class="alert alert-success">
                     {{ session('message') }}
                 </div>
             @endif
             @livewire('patient')
    @livewireScripts
  </body>
</html>
