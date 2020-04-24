<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.13.0/js/all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar is-primary" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <div class="navbar-item">
                    Washing manager
                </div>

                <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navMenu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>
            <div class="navbar-menu" id="navMenu">
                <div class="navbar-end">
                    <a class="navbar-item" href="{{ route('index') }}">Home</a>
                    <a class="navbar-item" href="{{ route('group.index') }}">Gruppi</a>
                    <a class="navbar-item" href="{{ route('vehicle.index') }}">Veicoli</a>
                    <a class="navbar-item" href="{{ route('schedule.index') }}">Calendario</a>
                </div>
            </div>
        </nav>
        <section class="section">
            <div class="container">
                @yield('content')
            </div>
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
        
        // Get all "navbar-burger" elements
        const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
        
        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {
        
          // Add a click event on each of them
          $navbarBurgers.forEach( el => {
            el.addEventListener('click', () => {
        
              // Get the target from the "data-target" attribute
              const target = el.dataset.target;
              const $target = document.getElementById(target);
        
              // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
              el.classList.toggle('is-active');
              $target.classList.toggle('is-active');
        
            });
          });
        }
        
        });

        var app = new Vue({
            el: '#app',
            data: {
                vehicles: 0
                }
                })
        </script>
</body>
</html>