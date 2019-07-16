<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.head')
</head>
<body style="background: #e4e4e4 ">
@include('layout.nav')
<div class="container p-3 border border-secondary rounded" style="padding: 10px;background: white">
    <div div class="page-header" style="text-align: center;">
        <h2>@yield('title')</h2>
    </div>
    <br>
    <main class="py-4">
        @yield('content')
    </main>
</div>

</body>
</html>
