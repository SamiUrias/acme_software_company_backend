<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app">
        <div class="container" style="border: 1px solid red">
            <header>
                Acme
            </header>

            <nav>
                <router-link to="/">Home</router-link>
                <router-link to="/about">About</router-link>
            </nav>
            <main>
                <router-view></router-view>
            </main>

        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>