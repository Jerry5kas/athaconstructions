<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    

    @vite('resources/css/app.css')
  </head>
  <body>

  <x-header />
   <div>
    {{$slot}}
   </div>


    <script src="//unpkg.com/alpinejs" defer></script>
  </body>
</html>
