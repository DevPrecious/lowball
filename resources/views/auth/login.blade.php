<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script>
    (function () {
        const saved = localStorage.getItem('theme');
        if (saved === 'dark' || (!saved && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    })();
</script>

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    @include('components.meta', ['title' => 'Login | ' . config('app.name', 'LowBall')])
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .input-field {
            width: 100%;
            padding: 0.75rem 1rem;
            padding-left: 2.5rem;
            font-size: 0.875rem;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            outline: none;
            transition: all 0.2s;
        }

        .input-field:focus {
            border-color: #13ec5b;
            box-shadow: 0 0 0 2px rgba(19, 236, 91, 0.2);
        }

        .dark .input-field {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.1);
            color: #f1f5f9;
        }

        .label-text {
            display: block;
            font-size: 0.625rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0.375rem;
            color: #64748b;
        }

        .dark .label-text {
            color: #94a3b8;
        }

        /* ===== DARK MODE TOGGLE ===== */
        .theme-toggle {
            position: relative;
            width: 56px;
            height: 30px;
            border-radius: 9999px;
            background: #e2e8f0;
            border: 2px solid #cbd5e1;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            align-items: center;
            padding: 3px;
        }

        .dark .theme-toggle {
            background: #1e293b;
            border-color: #13ec5b40;
        }

        .theme-toggle-circle {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            transform: translateX(0);
        }

        .dark .theme-toggle-circle {
            transform: translateX(24px);
            background: #13ec5b;
            box-shadow: 0 0 12px rgba(19, 236, 91, 0.4);
        }

        .theme-toggle-icon {
            font-size: 14px !important;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .theme-toggle .icon-sun {
            opacity: 1;
            transform: rotate(0deg);
            color: #f59e0b;
        }

        .dark .theme-toggle .icon-sun {
            opacity: 0;
            transform: rotate(180deg);
        }

        .theme-toggle .icon-moon {
            opacity: 0;
            transform: rotate(-180deg);
            position: absolute;
            color: #0d1b12;
        }

        .dark .theme-toggle .icon-moon {
            opacity: 1;
            transform: rotate(0deg);
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display text-navy-deep dark:text-slate-100 min-h-screen flex items-center justify-center p-6 transition-colors duration-300">
    <!-- Dark mode toggle (top-right) -->
    <div class="fixed top-6 right-6 z-50">
        <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
            <div class="theme-toggle-circle">
                <span class="material-symbols-outlined theme-toggle-icon icon-sun">light_mode</span>
                <span class="material-symbols-outlined theme-toggle-icon icon-moon">dark_mode</span>
            </div>
        </button>
    </div>

    <div class="w-full max-w-md">
        <!-- Logo & Tagline -->
        <div class="flex flex-col items-center mb-10">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'LowBall') }} Logo"
                    class="h-16 w-auto mb-4 rounded-2xl shadow-xl shadow-primary/20">
            </a>
            <h1 class="text-2xl font-black tracking-tight">{{ config('app.name', 'SalaryNegotiator') }}</h1>
            <p class="text-slate-500 dark:text-slate-400 mt-1 font-medium text-sm">Land the offer you deserve.</p>
        </div>

        <!-- Login Card -->
        <div
            class="bg-white dark:bg-[#162a1d] rounded-3xl border border-slate-200 dark:border-primary/10 shadow-xl shadow-slate-200/50 dark:shadow-none p-8">
            <div class="mb-8">
                <h2 class="text-xl font-bold mb-1">Welcome back</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">Sign in to access your negotiation dashboard.</p>
            </div>

            <form class="space-y-5" method="POST" action="{{ route('login') }}">
                @csrf
                @if ($errors->any())
                    <div
                        class="bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 rounded-xl p-4 mb-2">
                        <p class="text-sm font-bold text-red-600 dark:text-red-400">{{ $errors->first() }}</p>
                    </div>
                @endif
                <div>
                    <label class="label-text">Email Address</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">mail</span>
                        <input class="input-field" name="email" value="{{ old('email') }}"
                            placeholder="alex@company.com" type="email" required />
                    </div>
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <div class="flex items-center justify-between">
                        <label class="label-text">Password</label>
                        <a href="{{ route('reset-password') }}"
                            class="text-[10px] font-bold text-sage-green dark:text-primary hover:underline uppercase tracking-widest">Forgot?</a>
                    </div>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">lock</span>
                        <input class="input-field" name="password" placeholder="••••••••" type="password" required />
                    </div>
                    @error('password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember"
                        class="w-4 h-4 rounded text-primary focus:ring-primary bg-slate-100 dark:bg-white/10 border-slate-300 dark:border-white/20 cursor-pointer" />
                    <label class="text-sm text-slate-500 dark:text-slate-400 font-medium cursor-pointer">Remember
                        me</label>
                </div>

                <!-- Submit -->
                <button
                    class="w-full bg-primary text-navy-deep py-4 rounded-xl font-black text-sm hover:opacity-90 shadow-lg shadow-primary/20 transition-all flex items-center justify-center gap-2 mt-4"
                    type="submit">
                    Sign In
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </button>
            </form>


        </div>

        <!-- Register Link -->
        <p class="text-center text-slate-500 dark:text-slate-400 text-sm mt-8">
            Don't have an account?
            <a class="text-sage-green dark:text-primary font-bold hover:underline" href="{{ route('register') }}">Create
                one</a>
        </p>

        <!-- Trust Icons -->
        <div class="mt-12 flex justify-center gap-8 opacity-40 grayscale contrast-125">
            <span class="material-symbols-outlined text-2xl">security</span>
            <span class="material-symbols-outlined text-2xl">verified_user</span>
            <span class="material-symbols-outlined text-2xl">lock</span>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggle = document.getElementById('themeToggle');
            themeToggle.addEventListener('click', () => {
                const isDark = document.documentElement.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            });
        });
    </script>
</body>

</html>