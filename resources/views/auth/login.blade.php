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
                radial-gradient(circle at 25% 25%, rgba(255,255,255,0.02) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(255,255,255,0.02) 0%, transparent 50%);
        }
    </style>
</head>
<body class="bg-[#0A0A0A] min-h-screen flex items-center justify-center font-sans">
    <div class="w-full max-w-md px-6">
        <!-- Logo/Icon -->
        <div class="flex justify-center mb-8">
            <img src="{{ asset('logo.png') }}" alt="logo RSUD" class="h-30 w-30 object-contain">
        </div>

        <!-- Login Title -->
        <div class="text-center mb-4">
            <p class="text-[#A1A1A1] text-sm mb-2">Login untuk memanajemen inventaris RSUD</p>
        </div>

        <!-- Login Form -->
        <div class="border-[#121212] border-2 rounded-2xl p-5 shadow-2xl">
            <div class="mb-6">
                <h1 class="text-[#FFFFFF] text-2xl font-semibold mb-2">Login</h1>
                <p class="text-[#A1A1A1] text-sm">Masukan kredensial kamu untuk mengakses dashboard.</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <!-- Username Field -->
                <div>
                    <label for="username" class="block text-[#FFFFFF] text-sm font-medium mb-2">
                        Username
                    </label>
                    <x-input 
                        type="text" 
                        name="username" 
                        id="username"
                        placeholder="Masukan username mu" 
                        icon="gg:user"
                        required
                        value="{{ old('username') }}"
                        class="{{ $errors->has('username') ? 'border-red-500 focus:ring-red-500' : '' }}"
                    />
                    
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-[#FFFFFF] text-sm font-medium mb-2">
                        Password
                    </label>
                    <x-input 
                        type="password" 
                        name="password" 
                        id="password"
                        placeholder="Masukan password mu" 
                        icon="uil:lock"
                        required
                        class="{{ $errors->has('password') ? 'border-red-500 focus:ring-red-500' : '' }}"
                    />
                    
                </div>

                <!-- Login Button -->
                <div class="pt-4">
                    <x-button 
                        type="submit" 
                        variant="primary" 
                        icon="mdi:login" 
                        iconPosition="left"
                        class="w-full text-base font-semibold py-4"
                    >
                        Login
                    </x-button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8">
            <p class="text-[#A1A1A1] text-sm">RSUD Inventaris System</p>
            <p class="text-[#A1A1A1] text-xs mt-1">© 2025 RSUD</p>
        </div>
    </div>
</body>
</html>