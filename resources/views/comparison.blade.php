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
    <title>AI Negotiation Strategy | {{ config('app.name', 'SalaryNegotiator') }}</title>
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
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

        .meter-gradient {
            background: linear-gradient(90deg, #ef4444 0%, #f59e0b 50%, #13ec5b 100%);
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

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
    <!-- Top Navigation Bar -->
    <header
        class="border-b border-slate-200 dark:border-slate-800 bg-white/80 dark:bg-background-dark/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <a href="{{ route('saved-offers') }}"
                        class="md:hidden w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-white/5 text-slate-500 hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                    </a>
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'LowBall') }} Logo"
                            class="h-8 w-auto rounded-lg">
                        <span
                            class="text-xl font-extrabold tracking-tight hidden sm:block">{{ config('app.name', 'SalaryNegotiator') }}</span>
                    </a>
                </div>
                <nav class="hidden md:flex space-x-8">
                    <a class="text-sm font-semibold hover:text-primary transition-colors"
                        href="{{ route('home') }}">Dashboard</a>
                    <a class="text-sm font-semibold hover:text-primary transition-colors"
                        href="{{ route('saved-offers') }}">My Negotiations</a>
                </nav>
                <div class="flex items-center gap-3">
                    <!-- Dark Mode Toggle -->
                    <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
                        <div class="theme-toggle-circle">
                            <span class="material-symbols-outlined theme-toggle-icon icon-sun">light_mode</span>
                            <span class="material-symbols-outlined theme-toggle-icon icon-moon">dark_mode</span>
                        </div>
                    </button>

                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Hero Section: Lowball Meter -->
        <div
            class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-8 mb-8">
            <div class="flex flex-col items-center text-center">
                <h1 class="text-3xl font-black mb-2">Strategy Report: {{ $offer->job_title }}</h1>
                <p class="text-slate-500 dark:text-slate-400 mb-8">Analysis for your offer from <span
                        class="font-bold text-slate-900 dark:text-slate-100">{{ $offer->company_name }}</span></p>
                <div class="relative w-full max-w-2xl">
                    <div class="flex justify-between text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">
                        <span>Insulting</span>
                        <span>Lowball</span>
                        <span>Fair</span>
                        <span>Exceptional</span>
                    </div>
                    <div class="h-4 w-full rounded-full meter-gradient relative overflow-hidden">
                        <!-- Needle indicator -->
                        <div class="absolute top-0 bottom-0 w-1 bg-slate-900 dark:bg-white z-10 shadow-xl"
                            style="left: {{ $offer->lowball_score }}%">
                            <div class="absolute -top-1 -left-1.5 h-3 w-4 bg-slate-900 dark:bg-white"></div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <span
                            class="inline-flex items-center rounded-full px-3 py-1 text-sm font-bold {{ $offer->lowball_text_color }} bg-slate-100 dark:bg-slate-800">
                            {{ $offer->lowball_label }}
                        </span>
                        <p class="mt-4 text-lg font-medium">This offer is <span
                                class="text-red-600 font-bold underline">12% below</span> the 50th percentile for NYC
                            tech hubs.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- KPI Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Suggested Counter -->
            <div
                class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm col-span-1 md:col-span-2">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-sm font-bold text-slate-500 uppercase tracking-tight">Suggested Counter-Offer</p>
                        <h3 class="text-4xl font-black text-slate-900 dark:text-white mt-1">
                            ${{ number_format($targetSalary) }} <span class="text-lg font-normal text-slate-400">/
                                yr</span></h3>
                    </div>
                    <button class="text-primary hover:bg-primary/10 p-2 rounded-lg transition-colors">
                        <span class="material-symbols-outlined">info</span>
                    </button>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-primary text-lg">check_circle</span>
                        <span>Matches top 75th percentile for your experience level.</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <span class="material-symbols-outlined text-primary text-lg">check_circle</span>
                        <span>Includes 15% adjustment for specific AI/ML domain expertise.</span>
                    </div>
                    <div class="p-3 bg-background-light dark:bg-slate-800 rounded-lg border-l-4 border-primary mt-4">
                        <p class="text-xs italic text-slate-600 dark:text-slate-300">"Data shows
                            {{ $offer->company_name }} has a history
                            of accepting counters within 8-10% of their initial offer for this tier."
                        </p>
                    </div>
                </div>
            </div>

            <!-- Confidence Score -->
            <div
                class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col items-center justify-center text-center">
                <p class="text-sm font-bold text-slate-500 uppercase tracking-tight mb-4">Negotiation Leverage</p>
                <div class="relative w-32 h-32">
                    <svg class="w-full h-full -rotate-90" viewBox="0 0 36 36">
                        <circle class="stroke-slate-200 dark:stroke-slate-800" cx="18" cy="18" fill="none" r="16"
                            stroke-width="3"></circle>
                        <circle class="stroke-primary" cx="18" cy="18" fill="none" r="16"
                            stroke-dasharray="{{ $offer->lowball_score }}, 100" stroke-linecap="round" stroke-width="3">
                        </circle>
                    </svg>
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                        <span class="text-3xl font-black">{{ $offer->lowball_score }}%</span>
                    </div>
                </div>
                <p class="mt-4 text-sm font-semibold">Offer Strength Score</p>
                <p class="text-xs text-slate-500 mt-1">Based on market scarcity &amp; benchmarks</p>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Action Assets (Tabs) -->
            <div class="lg:col-span-2 space-y-6">
                <div
                    class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="flex border-b border-slate-200 dark:border-slate-800">
                        <button
                            class="tab-btn flex-1 py-4 text-sm font-bold border-b-2 border-primary text-slate-900 dark:text-white transition-colors"
                            data-tab="email">Ready-to-send Email</button>
                        <button
                            class="tab-btn flex-1 py-4 text-sm font-bold text-slate-500 border-transparent hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors border-b-2"
                            data-tab="phone">Live Phone Script</button>
                    </div>
                    <div class="p-6 tab-content" id="tab-email">
                        <div
                            class="bg-background-light dark:bg-slate-950 p-4 rounded-lg font-mono text-sm leading-relaxed relative group">
                            <button
                                class="copy-btn absolute top-4 right-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-2 rounded hover:text-primary transition-colors"
                                title="Copy to clipboard">
                                <span class="material-symbols-outlined text-sm">content_copy</span>
                            </button>
                            <p class="text-slate-400 mb-4">Subject: Response to Offer - {{ $offer->job_title }} -
                                {{ auth()->user()->name }}
                            </p>
                            <p class="mb-4">Hi [Recruiter Name],</p>
                            <p class="mb-4">Thank you so much for the offer to join {{ $offer->company_name }}. I'm
                                incredibly excited
                                about the vision for the team and roadmap.</p>
                            <p class="mb-4">{{ $offer->strategy }}</p>
                            <p>I'm confident I can drive significant impact in this role, and I'm eager to find a path
                                that works for both of us.</p>
                            <br>
                            <p>Would you be open to a quick call tomorrow to discuss this in more detail?</p>
                            <br>
                            <p>Best regards,</p>
                            <p>{{ auth()->user()->name }}</p>
                        </div>

                    </div>

                    <div class="p-6 tab-content hidden" id="tab-phone">
                        <div
                            class="bg-background-light dark:bg-slate-950 p-4 rounded-lg font-mono text-sm leading-relaxed relative group">
                            <button
                                class="copy-btn absolute top-4 right-4 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 p-2 rounded hover:text-primary transition-colors"
                                title="Copy to clipboard">
                                <span class="material-symbols-outlined text-sm">content_copy</span>
                            </button>
                            <p
                                class="text-slate-500 dark:text-slate-400 font-sans text-xs uppercase tracking-wider mb-4 font-bold flex items-center gap-2">
                                <span class="material-symbols-outlined text-sm">phone_in_talk</span> Read this on the
                                call
                            </p>
                            <p class="text-lg leading-relaxed text-slate-800 dark:text-slate-200">
                                {{ $offer->phone_script }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Market Comparison -->
                <div
                    class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">equalizer</span> Market Context
                    </h3>
                    <div class="space-y-4">
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div><span
                                        class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full bg-slate-100 dark:bg-slate-800">Your
                                        Current Offer</span></div>
                                <div class="text-right"><span
                                        class="text-xs font-semibold inline-block text-slate-600">${{ number_format($offer->salary) }}</span>
                                </div>
                            </div>
                            <div
                                class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-slate-100 dark:bg-slate-800">
                                <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-400 rounded-full"
                                    style="width:{{ max(20, min(100, $offer->lowball_score)) }}%"></div>
                            </div>
                        </div>
                        <div class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div><span
                                        class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full bg-primary/20 text-primary">Target
                                        Range (75th Percentile)</span></div>
                                <div class="text-right"><span
                                        class="text-xs font-semibold inline-block text-primary">${{ number_format($targetSalary) }}</span>
                                </div>
                            </div>
                            <div
                                class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-slate-100 dark:bg-slate-800">
                                <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-primary rounded-full"
                                    style="width:75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Assets -->
            <div class="space-y-6">
                <!-- Talking Points -->
                <div
                    class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">chat_bubble</span> Top Rebuttals
                    </h3>
                    <ul class="space-y-4">
                        @forelse($offer->rebuttals ?? [] as $index => $rebuttal)
                            <li class="flex gap-3">
                                <span
                                    class="shrink-0 w-6 h-6 rounded-full bg-primary/20 text-primary flex items-center justify-center text-xs font-bold">{{ $index + 1 }}</span>
                                <p class="text-sm leading-snug">{{ $rebuttal }}</p>
                            </li>
                        @empty
                            <li class="flex gap-3 text-sm text-slate-500">No specific rebuttals generated.</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Red Flags -->
                <div
                    class="bg-red-50 dark:bg-red-900/10 rounded-xl border border-red-100 dark:border-red-900/30 shadow-sm p-6">
                    <h3 class="text-lg font-bold mb-4 flex items-center gap-2 text-red-700 dark:text-red-400">
                        <span class="material-symbols-outlined">dangerous</span> What NOT to Say
                    </h3>
                    <ul class="space-y-4 text-sm text-red-800 dark:text-red-300">
                        @forelse($offer->warnings ?? [] as $warning)
                            <li class="flex items-start gap-2">
                                <span class="material-symbols-outlined text-base mt-0.5">close</span>
                                <span>{{ $warning }}</span>
                            </li>
                        @empty
                            <li class="flex items-start gap-2 text-red-500">
                                <span>No specific warnings generated.</span>
                            </li>
                        @endforelse
                    </ul>
                </div>


            </div>
        </div>
    </main>

    <footer class="mt-12 py-8 border-t border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm text-slate-500">&copy; {{ date('Y') }} {{ config('app.name', 'SalaryNegotiator') }} •
                AI-Powered Negotiation Engine</p>
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

            // Tabs Logic
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const target = btn.dataset.tab;

                    // Update buttons styling
                    tabBtns.forEach(b => {
                        b.classList.remove('border-primary', 'text-slate-900', 'dark:text-white');
                        b.classList.add('border-transparent', 'text-slate-500');
                    });
                    btn.classList.remove('border-transparent', 'text-slate-500');
                    btn.classList.add('border-primary', 'text-slate-900', 'dark:text-white');

                    // Show corresponding content
                    tabContents.forEach(c => c.classList.add('hidden'));
                    document.getElementById('tab-' + target).classList.remove('hidden');
                });
            });

            // Copy buttons
            const copyBtns = document.querySelectorAll('.copy-btn');
            copyBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // Get the parent container and clone it to remove the button text from copied content
                    const container = btn.closest('.relative').cloneNode(true);
                    const buttonToRemove = container.querySelector('.copy-btn');
                    if (buttonToRemove) buttonToRemove.remove();

                    const textBlock = container.innerText.trim();

                    navigator.clipboard.writeText(textBlock).then(() => {
                        const icon = btn.querySelector('.material-symbols-outlined');
                        icon.textContent = 'check';
                        setTimeout(() => icon.textContent = 'content_copy', 2000);
                    });
                });
            });
        });
    </script>
</body>

</html>