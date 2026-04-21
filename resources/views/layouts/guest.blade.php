<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login &mdash; {{ config('app.name', 'Student Management Portal') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background: linear-gradient(135deg, #1B2A4A 0%, #243459 50%, #1B2A4A 100%) !important;
                min-height: 100vh;
            }
            .auth-card {
                border-top: 4px solid #C9A84C;
                border-radius: 16px;
                box-shadow: 0 20px 60px rgba(0,0,0,0.25);
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Logo & Title -->
            <div class="flex flex-col items-center mb-6">
                <a href="/">
                    <x-application-logo class="h-20 w-auto drop-shadow-lg" />
                </a>
                <div class="mt-3 text-center">
                    <p class="text-sm font-semibold" style="color:#C9A84C; letter-spacing:0.5px;">GORDON COLLEGE</p>
                    <p class="text-xs" style="color:rgba(255,255,255,0.5);">Student Management Portal</p>
                </div>
            </div>

            <div class="w-full sm:max-w-md px-6 py-7 bg-white overflow-hidden auth-card">
                {{ $slot }}
            </div>

            <p class="mt-6 text-xs" style="color:rgba(255,255,255,0.35);">
                &copy; {{ date('Y') }} Gordon College · Olongapo City
            </p>
        </div>
    </body>
</html>
