@include('partials.head')
<body>
    <div id="app">
        @include('partials.navbar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <section class="d-flex justify-content-center">
        <footer class="footer bg-dark">{{ date('Y') }}&copy; Kelpin Hartanto</footer>
    </section>
</body>
</html>
