<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script>
    // Prevent flash of wrong theme
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
    <title>{{ config('app.name', 'SalaryNegotiator') }} - Win Better Job Offers</title>
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

        /* ===== ANIMATED BACKGROUND ===== */
        .parallax-bg {
            position: fixed;
            inset: 0;
            z-index: 0;
            overflow: hidden;
            pointer-events: none;
        }

        .parallax-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            transition: transform 0.3s ease-out;
            will-change: transform;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, #13ec5b33, transparent 70%);
            top: -10%;
            left: -5%;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, #13ec5b22, transparent 70%);
            top: 40%;
            right: -8%;
        }

        .orb-3 {
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, #4c9a6620, transparent 70%);
            bottom: 10%;
            left: 20%;
        }

        .orb-4 {
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, #13ec5b18, transparent 70%);
            top: 20%;
            left: 50%;
        }

        /* ===== FLOATING PARTICLES ===== */
        .particles-container {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: #13ec5b;
            border-radius: 50%;
            opacity: 0;
            animation: floatParticle linear infinite;
        }

        @keyframes floatParticle {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }

            10% {
                opacity: 0.6;
            }

            90% {
                opacity: 0.3;
            }

            100% {
                transform: translateY(-100px) scale(1);
                opacity: 0;
            }
        }

        /* ===== SCROLL REVEAL ===== */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-delay-1 {
            transition-delay: 0.1s;
        }

        .reveal-delay-2 {
            transition-delay: 0.2s;
        }

        .reveal-delay-3 {
            transition-delay: 0.3s;
        }

        .reveal-delay-4 {
            transition-delay: 0.4s;
        }

        .reveal-delay-5 {
            transition-delay: 0.5s;
        }

        /* ===== HERO TEXT ANIMATION ===== */
        .hero-word {
            display: inline-block;
            opacity: 0;
            transform: translateY(30px) rotateX(-10deg);
            animation: heroWordIn 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes heroWordIn {
            to {
                opacity: 1;
                transform: translateY(0) rotateX(0);
            }
        }

        /* ===== 3D TILT CARD ===== */
        .tilt-card {
            transform-style: preserve-3d;
            transition: transform 0.15s ease-out, box-shadow 0.3s ease;
        }

        .tilt-card:hover {
            box-shadow: 0 20px 40px -10px rgba(19, 236, 91, 0.15);
        }

        .tilt-card .tilt-inner {
            transform: translateZ(20px);
        }

        /* ===== MAGNETIC BUTTON ===== */
        .magnetic-btn {
            transition: transform 0.2s ease-out;
            position: relative;
            overflow: hidden;
        }

        .magnetic-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at var(--mouse-x, 50%) var(--mouse-y, 50%), rgba(255, 255, 255, 0.3) 0%, transparent 60%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .magnetic-btn:hover::before {
            opacity: 1;
        }

        /* ===== GRADIENT PULSE ===== */
        .gradient-pulse {
            background-size: 200% 200%;
            animation: gradientShift 8s ease infinite;
        }

        @keyframes gradientShift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        /* ===== COUNTER ===== */
        .counter-value {
            display: inline-block;
            font-variant-numeric: tabular-nums;
        }

        /* ===== GLOW LINE ===== */
        .glow-line {
            position: relative;
            overflow: hidden;
        }

        .glow-line::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(19, 236, 91, 0.2), transparent);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        /* ===== NAVBAR GLASS ===== */
        header.scrolled {
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
        }

        /* ===== ICON RIPPLE ===== */
        .icon-box {
            position: relative;
            overflow: hidden;
        }

        .icon-box::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: radial-gradient(circle, #13ec5b44, transparent 70%);
            transform: scale(0);
            transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .icon-box:hover::after {
            transform: scale(2.5);
        }

        /* ===== CURSOR GLOW ===== */
        .cursor-glow {
            position: fixed;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(19, 236, 91, 0.06), transparent 70%);
            pointer-events: none;
            z-index: 1;
            transform: translate(-50%, -50%);
            transition: opacity 0.3s ease;
        }

        /* ===== STAT BAR ===== */
        .stat-bar-fill {
            width: 0%;
            transition: width 1.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .stat-bar-fill.animated {
            width: var(--fill-width);
        }

        /* ===== TYPING TEXT ===== */
        .typing-cursor {
            display: inline-block;
            width: 2px;
            height: 1.1em;
            background: #13ec5b;
            margin-left: 2px;
            animation: blink 1s step-end infinite;
            vertical-align: text-bottom;
        }

        @keyframes blink {
            50% {
                opacity: 0;
            }
        }

        /* ===== SMOOTH SCROLL ===== */
        html {
            scroll-behavior: smooth;
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
    class="bg-background-light dark:bg-background-dark font-display text-navy-deep transition-colors duration-300 relative">

    <!-- Cursor Glow -->
    <div class="cursor-glow" id="cursorGlow"></div>

    <!-- Parallax Background Orbs -->
    <div class="parallax-bg" id="parallaxBg">
        <div class="parallax-orb orb-1" data-speed="0.03"></div>
        <div class="parallax-orb orb-2" data-speed="0.05"></div>
        <div class="parallax-orb orb-3" data-speed="0.02"></div>
        <div class="parallax-orb orb-4" data-speed="0.04"></div>
    </div>

    <!-- Floating Particles -->
    <div class="particles-container" id="particles"></div>

    <!-- Top Navigation Bar -->
    <header
        class="sticky top-0 z-50 w-full bg-white/80 dark:bg-background-dark/80 backdrop-blur-md border-b border-primary/10 transition-shadow duration-300"
        id="navbar">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name', 'LowBall') }} Logo"
                    class="h-8 w-auto rounded-lg">
                <h1 class="text-xl font-800 tracking-tight text-navy-deep dark:text-slate-100">
                    {{ config('app.name', 'SalaryNegotiator') }}
                </h1>
            </div>
            <nav class="hidden md:flex items-center gap-10">
                <a class="text-sm font-semibold text-navy-deep hover:text-primary transition-colors dark:text-slate-300 relative group"
                    href="#features">
                    Features
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a class="text-sm font-semibold text-navy-deep hover:text-primary transition-colors dark:text-slate-300 relative group"
                    href="#process">
                    Pricing
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a class="text-sm font-semibold text-navy-deep hover:text-primary transition-colors dark:text-slate-300 relative group"
                    href="#stats">
                    Testimonials
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-primary transition-all duration-300 group-hover:w-full"></span>
                </a>
            </nav>
            <div class="flex items-center gap-2 sm:gap-4">
                <!-- Dark Mode Toggle -->
                <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
                    <div class="theme-toggle-circle">
                        <span class="material-symbols-outlined theme-toggle-icon icon-sun">light_mode</span>
                        <span class="material-symbols-outlined theme-toggle-icon icon-moon">dark_mode</span>
                    </div>
                </button>

                @auth
                    <a href="{{ route('saved-offers') }}"
                        class="hidden sm:block px-5 py-2.5 text-sm font-bold text-navy-deep hover:text-primary transition-colors dark:text-slate-100">Dashboard</a>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}"
                            class="hidden sm:block px-5 py-2.5 text-sm font-bold text-navy-deep hover:text-primary transition-colors dark:text-slate-100">Login</a>
                    @endif
                @endauth
                <a href="{{ route('offer-details') }}"
                    class="magnetic-btn hidden sm:block bg-primary hover:bg-primary/90 text-navy-deep px-6 py-2.5 rounded-lg text-sm font-bold shadow-lg shadow-primary/20 transition-all relative z-10">
                    Start Your Negotiation
                </a>
            </div>
        </div>
    </header>

    <main class="relative z-10">
        <!-- Hero Section -->
        <section class="relative pt-20 pb-32 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="flex flex-col gap-8">
                    <div
                        class="reveal inline-flex items-center gap-2 bg-primary/10 text-sage-green px-4 py-1.5 rounded-full w-fit border border-primary/20">
                        <span class="material-symbols-outlined text-sm">verified</span>
                        <span class="text-xs font-bold uppercase tracking-wider">Trusted by 5,000+ professionals</span>
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-black leading-[1.1] tracking-tight text-navy-deep dark:text-slate-100"
                        id="heroTitle">
                        <!-- Words injected via JS for staggered animation -->
                    </h1>
                    <p
                        class="reveal reveal-delay-3 text-lg lg:text-xl text-sage-green dark:text-slate-400 max-w-xl leading-relaxed">
                        Leverage AI-powered coaching and data-backed strategies to increase your total compensation by
                        <span class="text-primary font-bold">15-30%</span> on your next job offer.
                    </p>
                    <div class="reveal reveal-delay-4 flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ route('offer-details') }}"
                            class="magnetic-btn bg-primary hover:bg-primary/90 text-navy-deep px-8 py-4 rounded-xl text-lg font-bold shadow-xl shadow-primary/30 transition-all gradient-pulse relative z-10 text-center"
                            style="background: linear-gradient(135deg, #13ec5b, #0fcc4e, #13ec5b);">
                            Start Your Negotiation
                        </a>
                        <button
                            class="magnetic-btn flex items-center justify-center gap-2 px-8 py-4 rounded-xl border-2 border-primary/30 text-navy-deep dark:text-slate-100 font-bold hover:bg-primary/5 hover:border-primary transition-all relative z-10">
                            <span class="material-symbols-outlined">play_circle</span>
                            See How It Works
                        </button>
                    </div>

                    <!-- Live Stats Mini Bar -->
                    <div class="reveal reveal-delay-5 flex items-center gap-8 pt-4">
                        <div class="flex flex-col">
                            <span class="text-3xl font-black text-navy-deep dark:text-white">
                                $<span class="counter-value" data-target="18400" data-prefix="">0</span>
                            </span>
                            <span class="text-xs text-sage-green font-semibold uppercase tracking-wider">Avg.
                                Increase</span>
                        </div>
                        <div class="w-px h-10 bg-primary/20"></div>
                        <div class="flex flex-col">
                            <span class="text-3xl font-black text-navy-deep dark:text-white">
                                <span class="counter-value" data-target="5000">0</span>+
                            </span>
                            <span class="text-xs text-sage-green font-semibold uppercase tracking-wider">Users</span>
                        </div>
                        <div class="w-px h-10 bg-primary/20"></div>
                        <div class="flex flex-col">
                            <span class="text-3xl font-black text-navy-deep dark:text-white">
                                <span class="counter-value" data-target="94">0</span>%
                            </span>
                            <span class="text-xs text-sage-green font-semibold uppercase tracking-wider">Success
                                Rate</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Right — Interactive Mock Dashboard -->
                <div class="relative reveal reveal-delay-2">
                    <div class="absolute -inset-4 bg-primary/20 blur-3xl rounded-full animate-pulse"></div>
                    <div class="tilt-card relative rounded-2xl border border-primary/20 shadow-2xl overflow-hidden bg-white dark:bg-slate-900"
                        id="heroCard">
                        <div class="w-full bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900 flex flex-col p-8 gap-4"
                            style="aspect-ratio: 4/3;">
                            <!-- Simulated AI Chat Interface -->
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-3 h-3 rounded-full bg-red-400"></div>
                                <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                                <div class="w-3 h-3 rounded-full bg-green-400"></div>
                                <span class="ml-3 text-xs font-semibold text-slate-400">SalaryNegotiator AI</span>
                            </div>
                            <div class="flex-1 grid grid-cols-3 gap-4">
                                <div
                                    class="col-span-2 bg-white dark:bg-slate-700 rounded-xl shadow-sm border border-slate-200 dark:border-slate-600 p-5 flex flex-col gap-3 overflow-hidden">
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-6 h-6 rounded-full bg-primary/30 flex items-center justify-center">
                                            <span class="material-symbols-outlined text-primary"
                                                style="font-size: 14px;">smart_toy</span>
                                        </div>
                                        <div class="h-3 w-24 bg-slate-200 dark:bg-slate-600 rounded"></div>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="h-2.5 w-full bg-slate-100 dark:bg-slate-500 rounded"></div>
                                        <div class="h-2.5 w-full bg-slate-100 dark:bg-slate-500 rounded"></div>
                                        <div class="h-2.5 w-3/4 bg-slate-100 dark:bg-slate-500 rounded"></div>
                                    </div>
                                    <div class="mt-2 p-3 rounded-lg bg-primary/10 border border-primary/20">
                                        <p class="text-xs font-mono text-navy-deep dark:text-slate-300" id="typingText">
                                        </p>
                                    </div>
                                    <div
                                        class="mt-auto h-10 w-full bg-primary/80 rounded-lg flex items-center justify-center">
                                        <span class="text-xs font-bold text-navy-deep">Generate Counter-Offer →</span>
                                    </div>
                                </div>
                                <div class="col-span-1 space-y-3">
                                    <div class="p-3 bg-primary/10 rounded-xl border border-primary/20">
                                        <p class="text-xs font-bold text-navy-deep dark:text-slate-200 mb-2">Market Rate
                                        </p>
                                        <div class="stat-bar-fill h-2 bg-primary rounded-full"
                                            style="--fill-width: 78%;"></div>
                                        <p class="text-xs text-sage-green mt-1">78th percentile</p>
                                    </div>
                                    <div class="p-3 bg-slate-100 dark:bg-slate-700 rounded-xl">
                                        <p class="text-xs font-bold text-navy-deep dark:text-slate-200 mb-2">Leverage
                                        </p>
                                        <div class="stat-bar-fill h-2 bg-emerald-400 rounded-full"
                                            style="--fill-width: 92%;"></div>
                                        <p class="text-xs text-sage-green mt-1">Strong position</p>
                                    </div>
                                    <div class="p-3 bg-slate-100 dark:bg-slate-700 rounded-xl">
                                        <p class="text-xs font-bold text-navy-deep dark:text-slate-200 mb-2">Confidence
                                        </p>
                                        <div class="stat-bar-fill h-2 bg-sky-400 rounded-full"
                                            style="--fill-width: 85%;"></div>
                                        <p class="text-xs text-sage-green mt-1">AI recommended</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="py-24 bg-white dark:bg-background-dark/50 relative" id="process">
            <!-- Section divider glow -->
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-1/2 h-px glow-line"></div>

            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col items-center text-center gap-4 mb-16">
                    <h2 class="reveal text-primary font-bold tracking-widest uppercase text-sm">Our Process</h2>
                    <h3 class="reveal reveal-delay-1 text-4xl font-black text-navy-deep dark:text-slate-100">3 Steps to
                        a Higher Salary</h3>
                    <p class="reveal reveal-delay-2 text-sage-green dark:text-slate-400 max-w-2xl leading-relaxed">
                        Our AI-driven process helps you navigate tough conversations with confidence and data.
                    </p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <!-- Step 1 -->
                    <div class="reveal reveal-delay-1 tilt-card flex flex-col gap-6 group p-6 rounded-2xl border border-transparent hover:border-primary/20 transition-all duration-300 hover:bg-primary/5 cursor-default"
                        data-tilt>
                        <div class="tilt-inner">
                            <div
                                class="icon-box w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-navy-deep transition-all duration-500">
                                <span
                                    class="material-symbols-outlined text-3xl font-bold relative z-10">cloud_upload</span>
                            </div>
                            <div class="space-y-3 mt-6">
                                <h4 class="text-xl font-bold text-navy-deep dark:text-slate-100">1. Upload your offer
                                </h4>
                                <p class="text-sage-green dark:text-slate-400 leading-relaxed">
                                    Securely share your current job offer details with our encrypted platform. We
                                    analyze market rates instantly.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Step 2 -->
                    <div class="reveal reveal-delay-2 tilt-card flex flex-col gap-6 group p-6 rounded-2xl border border-transparent hover:border-primary/20 transition-all duration-300 hover:bg-primary/5 cursor-default"
                        data-tilt>
                        <div class="tilt-inner">
                            <div
                                class="icon-box w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-navy-deep transition-all duration-500">
                                <span
                                    class="material-symbols-outlined text-3xl font-bold relative z-10">psychology</span>
                            </div>
                            <div class="space-y-3 mt-6">
                                <h4 class="text-xl font-bold text-navy-deep dark:text-slate-100">2. Get AI-Coaching</h4>
                                <p class="text-sage-green dark:text-slate-400 leading-relaxed">
                                    Receive a personalized script and data-backed negotiation strategy tailored to your
                                    specific role and company.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Step 3 -->
                    <div class="reveal reveal-delay-3 tilt-card flex flex-col gap-6 group p-6 rounded-2xl border border-transparent hover:border-primary/20 transition-all duration-300 hover:bg-primary/5 cursor-default"
                        data-tilt>
                        <div class="tilt-inner">
                            <div
                                class="icon-box w-16 h-16 rounded-2xl bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-navy-deep transition-all duration-500">
                                <span
                                    class="material-symbols-outlined text-3xl font-bold relative z-10">handshake</span>
                            </div>
                            <div class="space-y-3 mt-6">
                                <h4 class="text-xl font-bold text-navy-deep dark:text-slate-100">3. Secure the bag</h4>
                                <p class="text-sage-green dark:text-slate-400 leading-relaxed">
                                    Confidently negotiate using our expert tactics. Most users sign their improved offer
                                    within 48 hours.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="py-24 relative" id="stats">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div
                        class="reveal reveal-delay-1 text-center p-8 rounded-2xl border border-primary/10 hover:border-primary/30 transition-all hover:shadow-lg hover:shadow-primary/5 group">
                        <div class="text-4xl font-black text-primary mb-2">
                            $<span class="counter-value" data-target="2400000">0</span>
                        </div>
                        <p class="text-sm text-sage-green group-hover:text-navy-deep transition-colors">Total Negotiated
                        </p>
                    </div>
                    <div
                        class="reveal reveal-delay-2 text-center p-8 rounded-2xl border border-primary/10 hover:border-primary/30 transition-all hover:shadow-lg hover:shadow-primary/5 group">
                        <div class="text-4xl font-black text-primary mb-2">
                            <span class="counter-value" data-target="48">0</span>hrs
                        </div>
                        <p class="text-sm text-sage-green group-hover:text-navy-deep transition-colors">Avg. Close Time
                        </p>
                    </div>
                    <div
                        class="reveal reveal-delay-3 text-center p-8 rounded-2xl border border-primary/10 hover:border-primary/30 transition-all hover:shadow-lg hover:shadow-primary/5 group">
                        <div class="text-4xl font-black text-primary mb-2">
                            <span class="counter-value" data-target="150">0</span>+
                        </div>
                        <p class="text-sm text-sage-green group-hover:text-navy-deep transition-colors">Companies
                            Covered</p>
                    </div>
                    <div
                        class="reveal reveal-delay-4 text-center p-8 rounded-2xl border border-primary/10 hover:border-primary/30 transition-all hover:shadow-lg hover:shadow-primary/5 group">
                        <div class="text-4xl font-black text-primary mb-2">
                            <span class="counter-value" data-target="4.9">0</span>★
                        </div>
                        <p class="text-sm text-sage-green group-hover:text-navy-deep transition-colors">User Rating</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final CTA Section -->
        <section class="py-24 reveal">
            <div class="max-w-5xl mx-auto px-6">
                <div
                    class="bg-navy-deep dark:bg-primary/5 rounded-[2rem] p-12 lg:p-20 text-center relative overflow-hidden border border-primary/20 group">
                    <!-- Animated Background Pattern -->
                    <div class="absolute inset-0 opacity-10 pointer-events-none transition-all duration-700 group-hover:opacity-20"
                        style="background-image: radial-gradient(#13ec5b 1px, transparent 1px); background-size: 20px 20px;">
                    </div>
                    <!-- Moving Gradient Overlay -->
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none"
                        style="background: radial-gradient(circle at 50% 50%, rgba(19,236,91,0.08), transparent 60%);">
                    </div>

                    <div class="relative z-10 flex flex-col items-center gap-8">
                        <h2
                            class="text-4xl lg:text-5xl font-black text-white dark:text-slate-100 max-w-2xl leading-tight">
                            Ready to earn what you're actually worth?
                        </h2>
                        <p class="text-primary/80 text-lg max-w-xl">
                            Join thousands of professionals who used {{ config('app.name', 'SalaryNegotiator') }} to
                            increase their offers by an average of $18,400.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 mt-4">
                            <a href="{{ route('offer-details') }}"
                                class="magnetic-btn bg-primary hover:bg-primary/90 text-navy-deep px-10 py-4 rounded-xl text-lg font-bold shadow-2xl shadow-primary/40 transition-all hover:scale-105 relative z-10 text-center">
                                Start Your Negotiation Now
                            </a>
                        </div>
                        <p class="text-slate-400 text-sm italic flex items-center gap-2">
                            <span class="material-symbols-outlined text-xs">lock</span>
                            100% Secure &amp; Confidential Analysis
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-background-dark border-t border-primary/10 py-16 relative z-10">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="col-span-1 md:col-span-1 flex flex-col gap-6">
                <div class="flex items-center gap-3">
                    <div class="bg-primary/20 p-2 rounded-lg flex items-center justify-center">
                        <span
                            class="material-symbols-outlined text-navy-deep dark:text-primary font-bold">payments</span>
                    </div>
                    <span
                        class="text-xl font-800 tracking-tight text-navy-deep dark:text-slate-100">{{ config('app.name', 'SalaryNegotiator') }}</span>
                </div>
                <p class="text-sage-green text-sm leading-relaxed">
                    The world's first AI-powered salary negotiation coach designed for modern job seekers.
                </p>
            </div>
            <div>
                <h5 class="font-bold mb-6 dark:text-slate-100">Product</h5>
                <ul class="space-y-4 text-sm text-sage-green dark:text-slate-400">
                    <li><a class="hover:text-primary transition-colors hover:translate-x-1 inline-block duration-200"
                            href="#">How it Works</a></li>
                    <li><a class="hover:text-primary transition-colors hover:translate-x-1 inline-block duration-200"
                            href="#">AI Coaching</a></li>
                    <li><a class="hover:text-primary transition-colors hover:translate-x-1 inline-block duration-200"
                            href="#">Data Security</a></li>
                    <li><a class="hover:text-primary transition-colors hover:translate-x-1 inline-block duration-200"
                            href="#">Pricing</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-bold mb-6 dark:text-slate-100">Company</h5>
                <ul class="space-y-4 text-sm text-sage-green dark:text-slate-400">
                    <li><a class="hover:text-primary transition-colors hover:translate-x-1 inline-block duration-200"
                            href="#">About Us</a></li>
                    <li><a class="hover:text-primary transition-colors hover:translate-x-1 inline-block duration-200"
                            href="#">Career Blog</a></li>
                    <li><a class="hover:text-primary transition-colors hover:translate-x-1 inline-block duration-200"
                            href="#">Privacy Policy</a></li>
                    <li><a class="hover:text-primary transition-colors hover:translate-x-1 inline-block duration-200"
                            href="#">Terms of Service</a></li>
                </ul>
            </div>
            <div>
                <h5 class="font-bold mb-6 dark:text-slate-100">Connect</h5>
                <div class="flex gap-4 mb-6">
                    <a class="w-10 h-10 rounded-lg border border-primary/20 flex items-center justify-center text-sage-green hover:bg-primary hover:text-navy-deep hover:scale-110 transition-all duration-300"
                        href="#">
                        <span class="material-symbols-outlined">alternate_email</span>
                    </a>
                    <a class="w-10 h-10 rounded-lg border border-primary/20 flex items-center justify-center text-sage-green hover:bg-primary hover:text-navy-deep hover:scale-110 transition-all duration-300"
                        href="#">
                        <span class="material-symbols-outlined">share</span>
                    </a>
                </div>
                <p class="text-xs text-slate-400">&copy; {{ date('Y') }} {{ config('app.name', 'SalaryNegotiator') }}
                    Inc. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // ===== 1. PARALLAX BACKGROUND — cursor tracking =====
            const orbs = document.querySelectorAll('.parallax-orb');
            const cursorGlow = document.getElementById('cursorGlow');

            document.addEventListener('mousemove', (e) => {
                const cx = e.clientX;
                const cy = e.clientY;
                const hw = window.innerWidth / 2;
                const hh = window.innerHeight / 2;

                orbs.forEach(orb => {
                    const speed = parseFloat(orb.dataset.speed);
                    const x = (cx - hw) * speed;
                    const y = (cy - hh) * speed;
                    orb.style.transform = `translate(${x}px, ${y}px)`;
                });

                // Cursor glow follow
                cursorGlow.style.left = cx + 'px';
                cursorGlow.style.top = cy + 'px';
            });

            // ===== 2. FLOATING PARTICLES =====
            const particlesContainer = document.getElementById('particles');
            function createParticle() {
                const p = document.createElement('div');
                p.classList.add('particle');
                p.style.left = Math.random() * 100 + '%';
                p.style.animationDuration = (8 + Math.random() * 12) + 's';
                p.style.width = p.style.height = (2 + Math.random() * 4) + 'px';
                p.style.opacity = 0;
                particlesContainer.appendChild(p);
                setTimeout(() => p.remove(), 20000);
            }
            setInterval(createParticle, 600);

            // ===== 3. SCROLL REVEAL =====
            const revealEls = document.querySelectorAll('.reveal');
            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.15 });
            revealEls.forEach(el => revealObserver.observe(el));

            // ===== 4. HERO TEXT STAGGERED ANIMATION =====
            const heroTitle = document.getElementById('heroTitle');
            const words = ["Don't", "Leave", "Money", "<br/>", "On", "The", "Table."];
            const accentWords = ["Negotiate", "Better."];
            let allHTML = '';
            words.forEach((w, i) => {
                if (w === '<br/>') {
                    allHTML += '<br/>';
                } else {
                    allHTML += `<span class="hero-word" style="animation-delay: ${i * 0.1}s">${w} </span>`;
                }
            });
            allHTML += '<span class="text-primary italic">';
            accentWords.forEach((w, i) => {
                allHTML += `<span class="hero-word" style="animation-delay: ${(words.length + i) * 0.1}s">${w} </span>`;
            });
            allHTML += '</span>';
            heroTitle.innerHTML = allHTML;

            // ===== 5. 3D TILT ON CARDS =====
            const tiltCards = document.querySelectorAll('[data-tilt]');
            tiltCards.forEach(card => {
                card.addEventListener('mousemove', (e) => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const cx = rect.width / 2;
                    const cy = rect.height / 2;
                    const rotateX = ((y - cy) / cy) * -8;
                    const rotateY = ((x - cx) / cx) * 8;
                    card.style.transform = `perspective(800px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'perspective(800px) rotateX(0) rotateY(0) scale(1)';
                });
            });

            // Hero card tilt
            const heroCard = document.getElementById('heroCard');
            if (heroCard) {
                heroCard.addEventListener('mousemove', (e) => {
                    const rect = heroCard.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    const cx = rect.width / 2;
                    const cy = rect.height / 2;
                    const rotateX = ((y - cy) / cy) * -5;
                    const rotateY = ((x - cx) / cx) * 5;
                    heroCard.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
                });
                heroCard.addEventListener('mouseleave', () => {
                    heroCard.style.transform = 'perspective(1000px) rotateX(0) rotateY(0)';
                });
            }

            // ===== 6. ANIMATED COUNTERS =====
            const counters = document.querySelectorAll('.counter-value');
            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        if (el.dataset.counted) return;
                        el.dataset.counted = 'true';
                        const target = parseFloat(el.dataset.target);
                        const isFloat = target % 1 !== 0;
                        const duration = 2000;
                        const start = performance.now();
                        function tick(now) {
                            const elapsed = now - start;
                            const progress = Math.min(elapsed / duration, 1);
                            const eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
                            const current = eased * target;
                            if (target >= 10000) {
                                el.textContent = Math.floor(current).toLocaleString();
                            } else if (isFloat) {
                                el.textContent = current.toFixed(1);
                            } else {
                                el.textContent = Math.floor(current);
                            }
                            if (progress < 1) requestAnimationFrame(tick);
                        }
                        requestAnimationFrame(tick);
                    }
                });
            }, { threshold: 0.5 });
            counters.forEach(c => counterObserver.observe(c));

            // ===== 7. STAT BAR ANIMATION =====
            const statBars = document.querySelectorAll('.stat-bar-fill');
            const barObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animated');
                    }
                });
            }, { threshold: 0.5 });
            statBars.forEach(b => barObserver.observe(b));

            // ===== 8. MAGNETIC BUTTONS =====
            const magneticBtns = document.querySelectorAll('.magnetic-btn');
            magneticBtns.forEach(btn => {
                btn.addEventListener('mousemove', (e) => {
                    const rect = btn.getBoundingClientRect();
                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;
                    btn.style.transform = `translate(${x * 0.15}px, ${y * 0.15}px)`;
                    btn.style.setProperty('--mouse-x', ((e.clientX - rect.left) / rect.width * 100) + '%');
                    btn.style.setProperty('--mouse-y', ((e.clientY - rect.top) / rect.height * 100) + '%');
                });
                btn.addEventListener('mouseleave', () => {
                    btn.style.transform = 'translate(0, 0)';
                });
            });

            // ===== 9. TYPING TEXT IN MOCK DASHBOARD =====
            const typingEl = document.getElementById('typingText');
            const typingTexts = [
                "Based on market data, your offer is 22% below median...",
                "Recommended counter: $142,000 base + $30K signing bonus",
                "Confidence level: HIGH — 3 competing offers detected",
                "Script ready: \"I appreciate the offer, however...\""
            ];
            let textIdx = 0;
            let charIdx = 0;
            let deleting = false;

            function typeLoop() {
                const currentText = typingTexts[textIdx];
                if (!deleting) {
                    typingEl.innerHTML = currentText.substring(0, charIdx) + '<span class="typing-cursor"></span>';
                    charIdx++;
                    if (charIdx > currentText.length) {
                        deleting = true;
                        setTimeout(typeLoop, 2000);
                        return;
                    }
                    setTimeout(typeLoop, 35 + Math.random() * 30);
                } else {
                    typingEl.innerHTML = currentText.substring(0, charIdx) + '<span class="typing-cursor"></span>';
                    charIdx--;
                    if (charIdx < 0) {
                        deleting = false;
                        textIdx = (textIdx + 1) % typingTexts.length;
                        charIdx = 0;
                        setTimeout(typeLoop, 500);
                        return;
                    }
                    setTimeout(typeLoop, 20);
                }
            }
            setTimeout(typeLoop, 1000);

            // ===== 10. NAVBAR SCROLL SHADOW =====
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // ===== 11. DARK MODE TOGGLE =====
            const themeToggle = document.getElementById('themeToggle');
            themeToggle.addEventListener('click', () => {
                const html = document.documentElement;
                const isDark = html.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            });

        });
    </script>
</body>

</html>