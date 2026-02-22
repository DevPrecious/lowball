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
    <title>Offer Details | {{ config('app.name', 'SalaryNegotiator') }}</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Manrope', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
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

        /* Experience button active state */
        .exp-btn.active {
            border-color: #13ec5b;
            background-color: rgba(19, 236, 91, 0.1);
            font-weight: 700;
        }
    </style>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen transition-colors duration-300 flex flex-col">
    <!-- Top Navigation Bar -->
    <header
        class="sticky top-0 z-50 w-full border-b border-primary/10 bg-white/80 dark:bg-background-dark/80 backdrop-blur-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'LowBall') }} Logo"
                        class="h-8 w-auto rounded-lg">
                    <h2 class="text-xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100">
                        {{ config('app.name', 'SalaryNegotiator') }}
                    </h2>
                </a>
                <div class="flex items-center gap-3">
                    <!-- Dark Mode Toggle -->
                    <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
                        <div class="theme-toggle-circle">
                            <span class="material-symbols-outlined theme-toggle-icon icon-sun">light_mode</span>
                            <span class="material-symbols-outlined theme-toggle-icon icon-moon">dark_mode</span>
                        </div>
                    </button>

                    @auth
                        <a href="{{ route('settings') }}"
                            class="flex items-center gap-2 px-3 py-1.5 rounded-lg bg-primary/10 hover:bg-primary/20 text-slate-900 dark:text-slate-100 transition-all font-medium text-sm">
                            <span class="material-symbols-outlined text-lg">account_circle</span>
                            <span class="hidden sm:inline">My Profile</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="flex flex-col items-center justify-start pt-12 pb-24 px-4 flex-1">

        <!-- Form Card -->
        <div
            class="w-full max-w-[600px] bg-white dark:bg-slate-900/50 border border-slate-200 dark:border-slate-800 rounded-xl shadow-xl shadow-primary/5 p-8 sm:p-12">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-extrabold text-slate-900 dark:text-slate-100 mb-3">Tell us about the role</h1>
                <p class="text-slate-500 dark:text-slate-400">Please provide the details of your job offer to get
                    started.</p>
            </div>

            <form class="space-y-6" method="POST" action="{{ route('offer.evaluate') }}">
                @csrf
                <!-- Job Title -->
                <div class="group">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Job Title</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">work</span>
                        <input name="job_title" required
                            class="w-full pl-12 pr-4 py-4 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-slate-100 placeholder:text-slate-400"
                            placeholder="e.g. Senior Product Designer" type="text" />
                    </div>
                </div>

                <!-- Company Name -->
                <div class="group">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Company Name</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">domain</span>
                        <input name="company_name" required
                            class="w-full pl-12 pr-4 py-4 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-slate-100 placeholder:text-slate-400"
                            placeholder="e.g. TechFlow Systems" type="text" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Offered Salary -->
                    <div class="group">
                        <label
                            class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 flex items-center gap-1">
                            Offered Salary
                            <span class="material-symbols-outlined text-xs text-slate-400 cursor-help"
                                title="Base annual salary before bonuses">info</span>
                        </label>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-slate-400 group-focus-within:text-primary">$</span>
                            <input name="salary" required
                                class="w-full pl-8 pr-4 py-4 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-slate-100 placeholder:text-slate-400"
                                placeholder="120000" type="number" step="any" />
                        </div>
                    </div>
                    <!-- Current Salary -->
                    <div class="group">
                        <label
                            class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2 flex items-center gap-1">
                            Current Salary
                            <span class="material-symbols-outlined text-xs text-slate-400 cursor-help"
                                title="This helps AI understand your leverage">help</span>
                        </label>
                        <div class="relative">
                            <span
                                class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-slate-400 group-focus-within:text-primary">$</span>
                            <input name="current_salary"
                                class="w-full pl-8 pr-4 py-4 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-slate-100 placeholder:text-slate-400"
                                placeholder="105000" type="number" step="any" />
                        </div>
                    </div>
                </div>

                <!-- Location -->
                <div class="group">
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Location</label>
                    <div class="relative">
                        <span
                            class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-primary transition-colors">location_on</span>
                        <input name="location"
                            class="w-full pl-12 pr-4 py-4 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all text-slate-900 dark:text-slate-100 placeholder:text-slate-400"
                            placeholder="City, Country" type="text" />
                    </div>
                </div>

                <!-- Experience Level -->
                <div>
                    <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-4">Years of
                        Experience</label>
                    <div class="flex flex-wrap gap-3">
                        <input type="hidden" name="experience" id="experienceInput" value="0-2">
                        <button
                            class="exp-btn active flex-1 min-w-[100px] py-3 px-4 rounded-lg border-2 border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 font-medium transition-all text-sm"
                            type="button" data-value="0-2">
                            0-2 Years
                        </button>
                        <button
                            class="exp-btn flex-1 min-w-[100px] py-3 px-4 rounded-lg border-2 border-slate-200 dark:border-slate-700 hover:border-primary/50 text-slate-600 dark:text-slate-400 font-medium transition-all text-sm"
                            type="button" data-value="3-5">
                            3-5 Years
                        </button>
                        <button
                            class="exp-btn flex-1 min-w-[100px] py-3 px-4 rounded-lg border-2 border-slate-200 dark:border-slate-700 hover:border-primary/50 text-slate-600 dark:text-slate-400 font-medium transition-all text-sm"
                            type="button" data-value="6-10">
                            6-10 Years
                        </button>
                        <button
                            class="exp-btn flex-1 min-w-[100px] py-3 px-4 rounded-lg border-2 border-slate-200 dark:border-slate-700 hover:border-primary/50 text-slate-600 dark:text-slate-400 font-medium transition-all text-sm"
                            type="button" data-value="10+">
                            10+ Years
                        </button>
                    </div>
                </div>

                <!-- Navigation Controls -->
                <div class="flex items-center justify-between pt-8 gap-4">
                    <a href="{{ route('home') }}"
                        class="px-8 py-4 rounded-lg text-slate-500 dark:text-slate-400 font-bold hover:bg-slate-100 dark:hover:bg-slate-800 transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined">arrow_back</span>
                        Back
                    </a>
                    <button type="submit"
                        onclick="this.classList.add('opacity-75', 'cursor-wait'); this.innerHTML = 'Evaluating...'; this.form.submit()"
                        class="flex-1 max-w-[240px] px-8 py-4 rounded-lg bg-primary hover:brightness-110 text-background-dark font-extrabold shadow-lg shadow-primary/25 transition-all text-center">
                        Evaluate Offer
                    </button>
                </div>
            </form>

            <!-- Confidentiality Note -->
            <div
                class="mt-12 flex items-center justify-center gap-2 text-xs text-slate-400 uppercase tracking-widest font-semibold">
                <span class="material-symbols-outlined text-sm">lock</span>
                End-to-end encrypted &amp; private
            </div>
        </div>

        <!-- Secondary Info Section -->
        <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 w-full max-w-[960px]">
            <div class="flex flex-col items-center text-center p-4">
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4 text-primary">
                    <span class="material-symbols-outlined">analytics</span>
                </div>
                <h3 class="font-bold text-slate-900 dark:text-slate-100 mb-2">Market Benchmarking</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">We compare your offer against 50k+
                    data points for your specific role and location.</p>
            </div>
            <div class="flex flex-col items-center text-center p-4">
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4 text-primary">
                    <span class="material-symbols-outlined">psychology</span>
                </div>
                <h3 class="font-bold text-slate-900 dark:text-slate-100 mb-2">AI Strategy</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Tailored negotiation tactics based
                    on the company's size and current market health.</p>
            </div>
            <div class="flex flex-col items-center text-center p-4">
                <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mb-4 text-primary">
                    <span class="material-symbols-outlined">verified_user</span>
                </div>
                <h3 class="font-bold text-slate-900 dark:text-slate-100 mb-2">Confidence Score</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed">Know exactly how much room you
                    have to push for a higher base salary or bonus.</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="w-full border-t border-slate-200 dark:border-slate-800 py-8 px-4 mt-auto">
        <div
            class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4 text-slate-400 text-sm">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'SalaryNegotiator') }}. Empowering job seekers everywhere.
            </p>
            <div class="flex items-center gap-6">
                <a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
                <a class="hover:text-primary transition-colors" href="#">Terms of Service</a>
                <a class="hover:text-primary transition-colors" href="#">Support</a>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Dark mode toggle
            const themeToggle = document.getElementById('themeToggle');
            themeToggle.addEventListener('click', () => {
                const isDark = document.documentElement.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            });

            // Experience level buttons
            const expBtns = document.querySelectorAll('.exp-btn');
            const expInput = document.getElementById('experienceInput');
            expBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    expBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    expInput.value = btn.dataset.value;
                });
            });
        });
    </script>
</body>

</html>