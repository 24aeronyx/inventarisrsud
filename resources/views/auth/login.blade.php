{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RSUD Inventaris System</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <style>
        body {
            background-image:
                radial-gradient(circle at 25% 25%, rgba(255, 255, 255, 0.02) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.02) 0%, transparent 50%);
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center font-sans">
    <div class="w-full max-w-md flex flex-col gap-8">
        <div class="flex flex-col items-center justify-center mb-4"><!-- Logo/Icon -->
            <div class="flex justify-center">
                <img src="{{ asset('logo.png') }}" alt="logo RSUD" class="h-20 w-20 object-contain">
            </div>
            <span class="text-center font-bold text-2xl ">RSUD Dr. Abdul Rivai</span>
        </div>

        <!-- Login Form -->
        <div class="px-5">
            <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-3">
                @csrf
                <x-input type="text" name="username" id="username" placeholder="Username" icon="gg:user" required
                    value="{{ old('username') }}"
                    class="{{ $errors->has('username') ? 'border-red-500 focus:ring-red-500' : '' }}" />
                <x-input type="password" name="password" id="password" placeholder="Password" icon="uil:lock" required
                    class="{{ $errors->has('password') ? 'border-red-500 focus:ring-red-500' : '' }}" />
                <!-- Login Button -->
                <div class="">
                    <x-button type="submit" variant="primary"
                        class="w-full text-base font-semibold py-2 bg-black text-white">
                        Login
                    </x-button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-[#A1A1A1] text-sm">Sistem Inventaris RSUD Dr. Abdul Rivai</p>
            <p class="text-[#A1A1A1] text-xs mt-1">©2026 RSUD</p>
        </div>
    </div>
</body>

</html>