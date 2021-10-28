<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.materialdesignicons.com/5.7.55/css/materialdesignicons.min.css" rel="stylesheet">

    <title>Just Admin</title>
    @yield('head')
</head>

<body>
@inertia

{{--@routes--}}
<script>
    window.csrf_token = '{{ csrf_token()}}';
</script>
<script src="{{mix('/admin/main.js')}}"></script>

</body>
</html>