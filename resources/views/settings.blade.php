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
    <title>Settings | {{ config('app.name', 'SalaryNegotiator') }}</title>
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

        .sidebar-link-active {
            background-color: rgba(19, 236, 91, 0.1);
            color: #13ec5b;
            border-right: 4px solid #13ec5b;
        }

        .settings-card {
            background: white;
            border-radius: 1rem;
            border: 1px solid #e2e8f0;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .dark .settings-card {
            background: #162a1d;
            border-color: rgba(19, 236, 91, 0.1);
        }

        .input-field {
            width: 100%;
            padding: 0.625rem 1rem;
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
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0.5rem;
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
    class="bg-background-light dark:bg-background-dark font-display text-navy-deep dark:text-slate-100 transition-colors duration-300">
    <div class="flex min-h-screen relative w-full overflow-x-hidden">
        <!-- Mobile Sidebar Backdrop -->
        <div id="sidebarBackdrop"
            class="fixed inset-0 bg-navy-deep/80 backdrop-blur-sm z-40 hidden md:hidden opacity-0 transition-opacity duration-300">
        </div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-64 border-r border-slate-200 dark:border-primary/10 bg-white dark:bg-navy-deep flex flex-col fixed md:sticky top-0 h-screen z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300">
            <div class="flex items-center justify-between p-6">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'LowBall') }} Logo"
                        class="h-8 w-auto rounded-lg">
                    <span
                        class="text-lg font-extrabold tracking-tight">{{ config('app.name', 'SalaryNegotiator') }}</span>
                </a>
                <button id="closeSidebarBtn" class="md:hidden text-slate-500 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <nav class="flex-1 mt-4 px-3 space-y-1">
                <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 rounded-lg transition-all group"
                    href="{{ route('saved-offers') }}">
                    <span
                        class="material-symbols-outlined text-xl group-hover:text-primary transition-colors">account_balance_wallet</span>
                    <span class="font-semibold text-sm">Saved Offers</span>
                </a>
                <a class="flex items-center gap-3 px-4 py-3 sidebar-link-active rounded-lg transition-all"
                    href="{{ route('settings') }}">
                    <span class="material-symbols-outlined text-xl">settings</span>
                    <span class="font-semibold text-sm">Settings</span>
                </a>
            </nav>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0">
            <header
                class="h-20 bg-white/80 dark:bg-navy-deep/80 backdrop-blur-md border-b border-slate-200 dark:border-primary/10 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-10 w-full">
                <div class="flex items-center gap-4">
                    <button id="mobileMenuBtn"
                        class="md:hidden text-slate-500 hover:text-primary transition-colors flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl">menu</span>
                    </button>
                    <a href="{{ route('saved-offers') }}"
                        class="w-10 h-10 rounded-full hover:bg-slate-100 dark:hover:bg-white/5 flex items-center justify-center">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </a>
                    <div>
                        <h2 class="text-xl sm:text-2xl font-black tracking-tight">Settings</h2>
                        <p class="text-sm text-sage-green dark:text-slate-400 hidden sm:block">Manage your account
                            preferences</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <!-- Dark Mode Toggle -->
                    <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
                        <div class="theme-toggle-circle">
                            <span class="material-symbols-outlined theme-toggle-icon icon-sun">light_mode</span>
                            <span class="material-symbols-outlined theme-toggle-icon icon-moon">dark_mode</span>
                        </div>
                    </button>
                    <button type="submit" form="profile-form"
                        class="hidden sm:block px-6 py-2.5 bg-primary text-navy-deep rounded-lg font-bold text-sm hover:opacity-90 shadow-lg shadow-primary/10">Save
                        All Changes</button>
                </div>
            </header>

            <section class="p-8 max-w-4xl mx-auto w-full">
                @if (session('success'))
                    <div
                        class="mb-6 bg-green-50 dark:bg-green-500/10 border border-green-200 dark:border-green-500/20 text-green-700 dark:text-green-400 px-4 py-3 rounded-lg flex items-center gap-3">
                        <span class="material-symbols-outlined">check_circle</span>
                        <p class="text-sm font-bold">{{ session('success') }}</p>
                    </div>
                @endif
                @if (session('error'))
                    <div
                        class="mb-6 bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-700 dark:text-red-400 px-4 py-3 rounded-lg flex items-center gap-3">
                        <span class="material-symbols-outlined">error</span>
                        <p class="text-sm font-bold">{{ session('error') }}</p>
                    </div>
                @endif

                <!-- Profile Settings -->
                <form id="profile-form" method="POST" action="{{ route('settings.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="settings-card mb-8">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="material-symbols-outlined text-sage-green">person</span>
                            <h3 class="text-lg font-bold">Profile Settings</h3>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="label-text">Full Name</label>
                                <input class="input-field" type="text" name="name"
                                    value="{{ old('name', Auth::user()->name) }}" />
                                @error('name')<p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="label-text">Email Address</label>
                                <input class="input-field" type="email" name="email"
                                    value="{{ old('email', Auth::user()->email) }}" />
                                @error('email')<p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="md:col-span-2">
                                <label class="label-text">Current Job Title</label>
                                <input class="input-field" type="text" name="job_title"
                                    value="{{ old('job_title', Auth::user()->job_title) }}" />
                                @error('job_title')<p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>


                <!-- Security -->
                <div class="settings-card">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-sage-green">security</span>
                        <h3 class="text-lg font-bold">Security</h3>
                    </div>
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold">Password</p>
                                <p class="text-xs text-slate-500">Last changed 4 months ago</p>
                            </div>
                            <a href="{{ route('reset-password') }}"
                                class="px-4 py-2 border border-slate-200 dark:border-white/10 rounded-lg text-xs font-bold hover:bg-slate-50 dark:hover:bg-white/5 transition-all">Reset
                                Password</a>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-6 pb-12">
                    <form method="POST" action="{{ route('logout') }}" class="order-2 sm:order-1 sm:w-auto">
                        @csrf
                        <button type="submit"
                            class="w-full flex justify-center items-center gap-2 px-6 py-2.5 bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-600 dark:text-red-400 rounded-lg font-bold text-sm hover:bg-red-100 dark:hover:bg-red-500/20 transition-all">
                            <span class="material-symbols-outlined text-lg">logout</span>
                            Log Out
                        </button>
                    </form>
                    <div class="flex flex-col sm:flex-row gap-4 order-1 sm:order-2">
                        <a href="{{ route('settings') }}"
                            class="px-6 py-2.5 text-slate-500 font-bold text-sm hover:text-navy-deep dark:hover:text-white transition-all text-center block">Discard
                            Changes</a>
                        <button type="submit" form="profile-form"
                            class="px-8 py-2.5 bg-primary text-navy-deep rounded-lg font-bold text-sm hover:opacity-90 shadow-lg shadow-primary/10">Save
                            Settings</button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Dark mode toggle
            const themeToggle = document.getElementById('themeToggle');
            themeToggle.addEventListener('click', () => {
                const isDark = document.documentElement.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            });

            // Mobile Sidebar Toggle
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const closeSidebarBtn = document.getElementById('closeSidebarBtn');
            const sidebar = document.getElementById('sidebar');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');

            function toggleSidebar() {
                const isClosed = sidebar.classList.contains('-translate-x-full');
                if (isClosed) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebarBackdrop.classList.remove('hidden');
                    setTimeout(() => sidebarBackdrop.classList.remove('opacity-0'), 10);
                    document.body.style.overflow = 'hidden';
                } else {
                    sidebar.classList.add('-translate-x-full');
                    sidebarBackdrop.classList.add('opacity-0');
                    setTimeout(() => sidebarBackdrop.classList.add('hidden'), 300);
                    document.body.style.overflow = '';
                }
            }

            if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', toggleSidebar);
            if (closeSidebarBtn) closeSidebarBtn.addEventListener('click', toggleSidebar);
            if (sidebarBackdrop) sidebarBackdrop.addEventListener('click', toggleSidebar);
        });
    </script>
</body>

</html>