<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <title>{{ config('app.name') }}</title>
</head>
<body>
<div id="app">
    <to-do></to-do>
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
