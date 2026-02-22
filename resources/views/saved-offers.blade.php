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
    @include('components.meta', ['title' => 'Saved Offers | ' . config('app.name', 'LowBall')])
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

        .meter-bar {
            height: 0.5rem;
            border-radius: 9999px;
            overflow: hidden;
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
                <a class="flex items-center gap-3 px-4 py-3 sidebar-link-active rounded-lg transition-all"
                    href="{{ route('saved-offers') }}">
                    <span class="material-symbols-outlined text-xl">account_balance_wallet</span>
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
                    <div>
                        <h2 class="text-xl sm:text-2xl font-black tracking-tight">Saved Offers</h2>
                        <p class="text-sm text-sage-green dark:text-slate-400 hidden sm:block">Track and compare your
                            active job opportunities</p>
                    </div>
                </div>
                <div class="flex items-center gap-6">
                    <!-- Dark Mode Toggle -->
                    <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
                        <div class="theme-toggle-circle">
                            <span class="material-symbols-outlined theme-toggle-icon icon-sun">light_mode</span>
                            <span class="material-symbols-outlined theme-toggle-icon icon-moon">dark_mode</span>
                        </div>
                    </button>
                    <div class="relative hidden sm:block">
                        <span
                            class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-lg">search</span>
                        <input id="searchInput"
                            class="pl-10 pr-4 py-2 bg-slate-100 dark:bg-white/5 border-none rounded-lg text-sm focus:ring-2 focus:ring-primary w-64"
                            placeholder="Search offers..." type="text" />
                    </div>
                    <div class="flex items-center gap-3 border-l border-slate-200 dark:border-white/10 pl-6">
                        <div
                            class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold">
                            {{ collect(explode(' ', Auth::user()->name))->map(fn($w) => strtoupper(mb_substr($w, 0, 1)))->take(2)->implode('') }}
                        </div>
                    </div>
                </div>
            </header>

            <section class="p-4 sm:p-8">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 mb-8">
                    <div class="flex flex-wrap items-center gap-4">
                        <span id="selectedCount" class="text-sm font-semibold text-slate-500">2 of 3 Selected</span>
                        <a href="{{ route('compare-offers') }}" id="compareBtn"
                            class="bg-navy-deep dark:bg-primary text-white dark:text-navy-deep px-6 py-2.5 rounded-lg text-sm font-bold shadow-lg shadow-primary/10 hover:opacity-90 transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">compare_arrows</span>
                            Compare Offers
                        </a>
                    </div>
                    <a href="{{ route('offer-details') }}"
                        class="flex items-center gap-2 text-primary font-bold text-sm hover:underline">
                        <span class="material-symbols-outlined text-lg">add_circle</span>
                        Add New Offer
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @forelse ($offers as $offer)
                        <!-- Offer Card -->
                        <div
                            class="offer-card group relative bg-white dark:bg-[#162a1d] rounded-2xl border border-slate-200 dark:border-primary/10 p-6 hover:shadow-xl hover:shadow-primary/5 transition-all cursor-pointer ring-2 ring-transparent hover:ring-primary/40">
                            <div class="absolute top-4 right-4">
                                <input
                                    class="offer-checkbox w-5 h-5 rounded text-primary focus:ring-primary bg-slate-100 dark:bg-white/10 border-none cursor-pointer"
                                    type="checkbox" value="{{ $offer->id }}" />
                            </div>
                            <div class="flex items-center gap-4 mb-6">
                                <div
                                    class="w-12 h-12 bg-slate-100 dark:bg-white/5 rounded-xl flex items-center justify-center overflow-hidden">
                                    <span class="material-symbols-outlined text-slate-400">domain</span>
                                </div>
                                <div>
                                    <h3 class="font-bold text-lg leading-tight">{{ $offer->job_title }}</h3>
                                    <p class="text-sm text-sage-green">{{ $offer->company_name }}</p>
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-xs uppercase tracking-widest text-slate-400 font-bold mb-1">Offered
                                        Salary</p>
                                    <p class="text-2xl font-black text-navy-deep dark:text-white">
                                        ${{ number_format($offer->salary) }} <span
                                            class="text-sm font-medium text-slate-400">/ yr</span></p>
                                </div>
                                <div>
                                    <div class="flex justify-between items-end mb-2">
                                        <p class="text-xs uppercase tracking-widest text-slate-400 font-bold">Lowball Meter
                                        </p>
                                        <span
                                            class="text-xs font-bold {{ $offer->lowball_text_color }}">{{ $offer->lowball_label }}</span>
                                    </div>
                                    <div class="meter-bar bg-slate-200 dark:bg-slate-700">
                                        <div class="{{ $offer->lowball_color }} h-full rounded-full"
                                            style="width: {{ $offer->lowball_score }}%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="mt-8 pt-6 border-t border-slate-100 dark:border-white/5 flex items-center justify-between">
                                <span class="text-xs text-slate-400">Added {{ $offer->created_at->diffForHumans() }}</span>
                                <a href="{{ route('comparison', $offer->id) }}"
                                    class="text-primary text-sm font-bold flex items-center gap-1 hover:gap-2 transition-all">
                                    View Strategy <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <!-- Empty State (shown when no offers) -->
                    @endforelse

                    <!-- Add New Offer Card -->
                    <a href="{{ route('offer-details') }}"
                        class="group bg-slate-100/50 dark:bg-white/5 rounded-2xl border-2 border-dashed border-slate-300 dark:border-white/10 p-6 flex flex-col items-center justify-center text-center gap-4 hover:border-primary/50 transition-all cursor-pointer min-h-[340px]">
                        <div
                            class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center text-primary group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-3xl">add</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Add Another Offer</h4>
                            <p class="text-sm text-slate-400 px-8">Upload a PDF or enter details manually to get your
                                AI-powered rating.</p>
                        </div>
                    </a>
                </div>

                <!-- Summary Stats -->
                <div class="mt-12 grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div
                        class="bg-white dark:bg-[#162a1d] p-6 rounded-2xl border border-slate-200 dark:border-primary/10">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Average Offer</p>
                        <p class="text-3xl font-black">{{ $offers->count() > 0 ? '$' . number_format($avgOffer) : '—' }}
                        </p>
                    </div>
                    <div
                        class="bg-white dark:bg-[#162a1d] p-6 rounded-2xl border border-slate-200 dark:border-primary/10">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Negotiation Leverage
                        </p>
                        <p class="text-3xl font-black text-primary">{{ $leverage }}</p>
                    </div>
                    <div
                        class="bg-white dark:bg-[#162a1d] p-6 rounded-2xl border border-slate-200 dark:border-primary/10">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Market Percentile</p>
                        <p class="text-3xl font-black">{{ $percentile > 0 ? $percentile . 'th' : '—' }}</p>
                    </div>
                    <div
                        class="bg-white dark:bg-[#162a1d] p-6 rounded-2xl border border-slate-200 dark:border-primary/10">
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Potential Upside</p>
                        <p class="text-3xl font-black text-primary">
                            {{ $potentialUpside > 0 ? '+$' . number_format($potentialUpside) : '—' }}
                        </p>
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

            // Max 2 checkbox selection
            const MAX_SELECTED = 2;
            const checkboxes = document.querySelectorAll('.offer-checkbox');
            const countLabel = document.getElementById('selectedCount');
            const compareBtn = document.getElementById('compareBtn');

            function updateCheckboxState() {
                const checked = document.querySelectorAll('.offer-checkbox:checked');
                const count = checked.length;
                const total = checkboxes.length;

                // Update counter
                countLabel.textContent = `${count} of ${total} Selected`;

                // Disable unchecked boxes when 2 are selected
                checkboxes.forEach(cb => {
                    if (!cb.checked && count >= MAX_SELECTED) {
                        cb.disabled = true;
                        cb.closest('.group').style.opacity = '0.5';
                    } else {
                        cb.disabled = false;
                        cb.closest('.group').style.opacity = '1';
                    }
                });

                // Show/hide compare button and update href
                if (count === MAX_SELECTED) {
                    compareBtn.style.opacity = '1';
                    compareBtn.style.pointerEvents = 'auto';

                    const params = new URLSearchParams();
                    checked.forEach(cb => params.append('ids[]', cb.value));
                    compareBtn.href = "{{ route('compare-offers') }}?" + params.toString();
                } else {
                    compareBtn.style.opacity = '0.4';
                    compareBtn.style.pointerEvents = 'none';
                    compareBtn.href = "#";
                }
            }

            checkboxes.forEach(cb => cb.addEventListener('change', updateCheckboxState));
            updateCheckboxState(); // run on load

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const offerCards = document.querySelectorAll('.offer-card');

            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    const searchTerm = e.target.value.toLowerCase();

                    offerCards.forEach(card => {
                        const title = card.querySelector('h3').textContent.toLowerCase();
                        const company = card.querySelector('h3 + p').textContent.toLowerCase();

                        if (title.includes(searchTerm) || company.includes(searchTerm)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }

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
                    // small delay to allow display:block to apply before animating opacity
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