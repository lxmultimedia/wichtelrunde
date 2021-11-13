<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

    <title>Klaroweb Wichteln</title>

    <!-- Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
      rel="stylesheet"
    />

    @livewireStyles
  </head>
  <body class="antialiased">
    <div
      id="t"
      class="
        relative
        flex flex-col
        items-top
        justify-center
        min-h-screen
        dark:bg-gray-900
        sm:items-center
        py-4
        sm:pt-0
      "
    >
      @include("partials._header");
      {{ $slot }}
      <p class="text-center text-lg" style="color: #e61f5c">
        &copy;2021 <a href="https://www.klaroweb.ch">Klaroweb</a>. All rights
        reserved.
      </p>
    </div>
    @livewireScripts
  </body>
</html>
