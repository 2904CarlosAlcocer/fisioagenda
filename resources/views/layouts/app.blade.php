<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>FisioAgenda Pro v1.0</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>

        <footer class="bg-white border-t border-gray-100 py-4 text-center text-sm text-gray-400">
            FisioAgenda Pro v1.0 — Sistema de Gestión Clínica
        </footer>
    </div>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Excelente!',
                text: @json(session('success')),
                confirmButtonColor: '#ec4899',
                confirmButtonText: 'Aceptar',
                timer: 2500,
                timerProgressBar: true
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Ups...',
                text: @json(session('error')),
                confirmButtonColor: '#ec4899',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif

    @if($errors->any())
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Revisa los datos',
                html: `
                    <ul style="text-align:left;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                confirmButtonColor: '#ec4899',
                confirmButtonText: 'Entendido'
            });
        </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('.form-eliminar').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Eliminar registro?',
                        text: 'Esta acción no se puede deshacer.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ec4899',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            document.querySelectorAll('.form-marcar-enviado').forEach(form => {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Marcar como enviado?',
                        text: 'El recordatorio quedará registrado como enviado.',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#ec4899',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Sí, marcar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

        });
    </script>
</body>
</html>