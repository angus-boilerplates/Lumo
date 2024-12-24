<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      x-data="{ darkMode: false }"
      x-bind:data-theme="darkMode ? 'dark' : 'light'"
      x-init="
          if (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches) {
              localStorage.setItem('darkMode', JSON.stringify(true));
          }
          darkMode = JSON.parse(localStorage.getItem('darkMode'));
          $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))
      ">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Favicon -->
        <link rel="icon" href="/assets/images/core/favicon.png">
        
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles stack -->
        @stack('styles')
    </head>
    {{ $slot }}
</html>
