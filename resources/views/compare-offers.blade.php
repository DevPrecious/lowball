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
    @include('components.meta', ['title' => 'Offer Comparison | ' . config('app.name', 'LowBall')])
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

        .meter-glow-green {
            box-shadow: 0 0 20px rgba(19, 236, 91, 0.2);
        }

        .meter-glow-red {
            box-shadow: 0 0 20px rgba(239, 68, 68, 0.2);
        }

        .winner-glow {
            background-color: rgba(19, 236, 91, 0.05);
            border: 1px solid rgba(19, 236, 91, 0.2);
            position: relative;
            overflow: hidden;
        }

        .winner-glow::after {
            content: 'WINNER';
            position: absolute;
            top: 0.5rem;
            right: 1rem;
            font-size: 10px;
            font-weight: 900;
            color: #13ec5b;
            letter-spacing: 0.1em;
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
                <a class="flex items-center gap-3 px-4 py-3 text-slate-600 dark:text-slate-400 hover:bg-slate-50 dark:hover:bg-white/5 rounded-lg transition-all group"
                    href="{{ route('settings') }}">
                    <span
                        class="material-symbols-outlined text-xl group-hover:text-primary transition-colors">settings</span>
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
                        <h2 class="text-xl sm:text-2xl font-black tracking-tight">Offer Comparison</h2>
                        <p class="text-sm text-sage-green dark:text-slate-400 hidden sm:block">Head-to-head analysis for
                            better leverage</p>
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
                </div>
            </header>

            <section class="p-8 max-w-6xl mx-auto w-full">
                <!-- Side-by-side Comparison -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <!-- Offer A -->
                    <div class="space-y-6">
                        <div
                            class="bg-white dark:bg-[#162a1d] p-8 rounded-3xl border border-slate-200 dark:border-primary/10 relative">
                            <div class="mb-8">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">OFFER A</span>
                                <h3 class="text-2xl font-black mt-1">{{ $offerA->job_title }}</h3>
                                <p class="text-lg font-bold text-sage-green">{{ $offerA->company_name }}</p>
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-between items-end">
                                    <p class="text-xs uppercase tracking-widest text-slate-400 font-bold">Lowball Meter
                                    </p>
                                    <span
                                        class="text-sm font-black {{ $offerA->lowball_text_color }}">{{ $offerA->lowball_label }}</span>
                                </div>
                                <div
                                    class="h-4 w-full bg-slate-100 dark:bg-white/5 rounded-full overflow-hidden flex border border-slate-200 dark:border-white/10">
                                    <div class="h-full {{ $offerA->lowball_color }} relative"
                                        style="width: {{ $offerA->lowball_score }}%">
                                        <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                                    </div>
                                </div>
                                <p class="text-xs text-slate-500 italic mt-2">Score: {{ $offerA->lowball_score }}/100
                                    based on AI Analysis</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div
                                class="{{ $offerA->salary >= $offerB->salary ? 'winner-glow' : 'bg-white dark:bg-[#162a1d] border border-slate-200 dark:border-primary/10' }} p-5 rounded-2xl flex flex-col">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Base
                                    Salary</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="text-2xl font-black">${{ number_format($offerA->salary) }}</span>
                                    <span class="text-sm text-slate-400 font-medium">/ yr</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Offer B -->
                    <div class="space-y-6">
                        <div
                            class="bg-white dark:bg-[#162a1d] p-8 rounded-3xl border border-slate-200 dark:border-primary/10 relative">
                            <div class="mb-8">
                                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">OFFER B</span>
                                <h3 class="text-2xl font-black mt-1">{{ $offerB->job_title }}</h3>
                                <p class="text-lg font-bold text-sage-green">{{ $offerB->company_name }}</p>
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-between items-end">
                                    <p class="text-xs uppercase tracking-widest text-slate-400 font-bold">Lowball Meter
                                    </p>
                                    <span
                                        class="text-sm font-black {{ $offerB->lowball_text_color }}">{{ $offerB->lowball_label }}</span>
                                </div>
                                <div
                                    class="h-4 w-full bg-slate-100 dark:bg-white/5 rounded-full overflow-hidden border border-slate-200 dark:border-white/10">
                                    <div class="h-full {{ $offerB->lowball_color }}"
                                        style="width: {{ $offerB->lowball_score }}%"></div>
                                </div>
                                <p class="text-xs text-slate-500 italic mt-2">Score: {{ $offerB->lowball_score }}/100
                                    based on AI Analysis</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div
                                class="{{ $offerB->salary > $offerA->salary ? 'winner-glow' : 'bg-white dark:bg-[#162a1d] border border-slate-200 dark:border-primary/10' }} p-5 rounded-2xl flex flex-col">
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Base
                                    Salary</span>
                                <div class="flex items-baseline gap-2 mt-1">
                                    <span class="text-2xl font-black">${{ number_format($offerB->salary) }}</span>
                                    <span class="text-sm text-slate-400 font-medium">/ yr</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- AI Strategic Recommendation -->
                <div
                    class="bg-navy-deep text-white p-8 rounded-3xl border border-primary/20 relative overflow-hidden shadow-2xl">
                    <div class="absolute top-0 right-0 p-8 opacity-10">
                        <span class="material-symbols-outlined text-9xl">psychology</span>
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-navy-deep">
                                <span class="material-symbols-outlined font-bold">bolt</span>
                            </div>
                            <h4 class="text-xl font-black uppercase tracking-tighter">AI Strategic Recommendation</h4>
                        </div>
                        <div class="grid md:grid-cols-3 gap-8">
                            <div class="md:col-span-2 space-y-4">
                                @if($offerA->salary >= $offerB->salary)
                                    <p class="text-slate-300 leading-relaxed text-lg">
                                        Offer A (<span class="text-primary font-bold">{{ $offerA->company_name }}</span>) is
                                        your
                                        strongest leverage point for salary, currently beating Offer B by
                                        ${{ number_format($offerA->salary - $offerB->salary) }}.
                                        This provides an excellent baseline for further negotiations.
                                    </p>
                                    <p class="text-slate-300 leading-relaxed">
                                        <span class="font-bold text-white">The Strategy:</span> Use the base salary from
                                        {{ $offerA->company_name }} to force an increase at {{ $offerB->company_name }} if
                                        that is your preferred role, or accept {{ $offerA->company_name }}'s strong starting
                                        position.
                                    </p>
                                @else
                                    <p class="text-slate-300 leading-relaxed text-lg">
                                        Offer B (<span class="text-primary font-bold">{{ $offerB->company_name }}</span>) is
                                        your
                                        strongest leverage point for salary, currently beating Offer A by
                                        ${{ number_format($offerB->salary - $offerA->salary) }}.
                                        This provides an excellent baseline for further negotiations.
                                    </p>
                                    <p class="text-slate-300 leading-relaxed">
                                        <span class="font-bold text-white">The Strategy:</span> Use the base salary from
                                        {{ $offerB->company_name }} to force an increase at {{ $offerA->company_name }} if
                                        that is your preferred role, or accept {{ $offerB->company_name }}'s strong starting
                                        position.
                                    </p>
                                @endif
                            </div>
                            <div
                                class="bg-white/5 border border-white/10 rounded-2xl p-6 flex flex-col justify-center text-center">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Primary
                                    Target</p>
                                <p class="text-3xl font-black text-primary mb-1">Offer
                                    {{ $offerA->salary >= $offerB->salary ? 'A' : 'B' }}
                                </p>
                                <p class="text-xs text-slate-400">Highest Salary Baseline</p>
                                <a href="{{ route('comparison', $offerA->salary >= $offerB->salary ? $offerA->id : $offerB->id) }}"
                                    class="mt-6 bg-white text-navy-deep py-3 rounded-xl font-bold text-sm hover:bg-primary transition-colors block text-center">Generate
                                    Script</a>
                            </div>
                        </div>
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