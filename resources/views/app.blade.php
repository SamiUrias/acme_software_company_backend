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
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">ACME</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <router-link class="nav-link" to="/">Home</router-link>
                        </li>

                        <li v-if="!$store.getters.authToken" class="nav-item "><!-- active -->
                            <router-link class="nav-link" to="/sign-in">Sign In</router-link>
                        </li>

                        <li v-if="!$store.getters.authToken" class="nav-item">
                            <a class="nav-link" href="#">Register</a>
                        </li>

                        <li v-if="$store.getters.authToken" class="nav-item "><!-- active -->
                            <span class="nav-link" @click="$store.dispatch('logout')">Log Out</span>
                        </li>

                    </ul>
                </div>
            </nav>

            <main>
                <router-view></router-view>
            </main>

        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
