<!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> @yield('title') </title>

    @section('head-styles')
        <x-styles.bootstrap/>
        <x-styles.fontawesome/>
    @show

    @section('main-styles')
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    @show
</head>
<body class="@yield('body-class')">
@yield('content')

@section('bottom-scripts')
    <x-scripts.jquery/>
@show
</body>
</html>
