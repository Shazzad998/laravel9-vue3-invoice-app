<!DOCTYPE html>
<html  lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    {{-- Boxicon CDN --}}
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    @vite('resources/css/app.css')


  </head>
  <body>

    <div id="app">

        <div class=" text-4xl text-black dark:text-white">
            asdfsadfsadfasdf
        </div>

        <div>

            <router-view></router-view>


        </div>


    </div>

    {{-- <script src="{{ asset('assets/js/charts-lines.js') }}" defer></script>
    <script src="{{ asset('assets/js/charts-pie.js') }}" defer></script>
    <script src="{{ asset('assets/js/charts-bars.js') }}" defer></script> --}}
    {{-- <script src="{{ asset('assets/js/focus-trap.js') }}" defer></script> --}}

    @vite('resources/js/app.js')
  </body>

</html>
