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
    <title>Reset Password | {{ config('app.name', 'SalaryNegotiator') }}</title>
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
            font-size: 0.875rem;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            outline: none;
            transition: all 0.2s;
        }

        .input-field:focus {
            border-color: #13ec5b;
            box-shadow: 0 0 0 3px rgba(19, 236, 91, 0.15);
        }

        .dark .input-field {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.1);
            color: #f1f5f9;
        }

        .label-text {
            display: block;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0.5rem;
            color: #64748b;
        }

        .dark .label-text {
            color: #94a3b8;
        }

        /* Password strength meter */
        .strength-bar {
            height: 4px;
            border-radius: 9999px;
            transition: all 0.3s;
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
    <div class="min-h-screen flex flex-col">
        <!-- Top Bar -->
        <header
            class="h-20 bg-white/80 dark:bg-navy-deep/80 backdrop-blur-md border-b border-slate-200 dark:border-primary/10 px-8 flex items-center justify-between sticky top-0 z-10">
            <div class="flex items-center gap-4">
                <a href="{{ route('settings') }}"
                    class="w-10 h-10 rounded-full hover:bg-slate-100 dark:hover:bg-white/5 flex items-center justify-center transition-all">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>
                <div>
                    <h2 class="text-2xl font-black tracking-tight">Reset Password</h2>
                    <p class="text-sm text-sage-green dark:text-slate-400">Update your account password</p>
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

        <!-- Main Content -->
        <main class="flex-1 flex items-start justify-center p-8">
            <div class="w-full max-w-lg">
                <!-- Lock Icon Header -->
                <div class="text-center mb-10">
                    <div class="w-20 h-20 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-6">
                        <span class="material-symbols-outlined text-primary text-4xl">lock_reset</span>
                    </div>
                    <h3 class="text-xl font-black mb-2">Create a New Password</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 max-w-sm mx-auto leading-relaxed">Your new
                        password must be different from previously used passwords and meet the security requirements
                        below.</p>
                </div>

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

                <!-- Password Form -->
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')
                    <div
                    class="bg-white dark:bg-[#162a1d] rounded-2xl border border-slate-200 dark:border-primary/10 p-8 space-y-6">
                    <!-- Current Password -->
                    <div>
                        <label class="label-text">Current Password</label>
                        <div class="relative">
                            <input class="input-field pr-12" type="password" id="currentPassword"
                                name="current_password" placeholder="Enter current password" required />
                            <button type="button"
                                class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors"
                                data-target="currentPassword">
                                <span class="material-symbols-outlined text-xl">visibility_off</span>
                            </button>
                        </div>
                        @error('current_password')<p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- New Password -->
                    <div>
                        <label class="label-text">New Password</label>
                        <div class="relative">
                            <input class="input-field pr-12" type="password" id="newPassword" name="password"
                                placeholder="Enter new password" required />
                            <button type="button"
                                class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors"
                                data-target="newPassword">
                                <span class="material-symbols-outlined text-xl">visibility_off</span>
                            </button>
                        </div>
                        @error('password')<p class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</p>@enderror
                        <!-- Password Strength -->
                        <div class="mt-3 space-y-2">
                            <div class="flex gap-1">
                                <div class="strength-bar flex-1 bg-slate-200 dark:bg-white/10" id="str1"></div>
                                <div class="strength-bar flex-1 bg-slate-200 dark:bg-white/10" id="str2"></div>
                                <div class="strength-bar flex-1 bg-slate-200 dark:bg-white/10" id="str3"></div>
                                <div class="strength-bar flex-1 bg-slate-200 dark:bg-white/10" id="str4"></div>
                            </div>
                            <p class="text-xs text-slate-400" id="strengthLabel">Enter a password to see strength</p>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="label-text">Confirm New Password</label>
                        <div class="relative">
                            <input class="input-field pr-12" type="password" id="confirmPassword"
                                name="password_confirmation" placeholder="Re-enter new password" required />
                            <button type="button"
                                class="toggle-password absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-primary transition-colors"
                                data-target="confirmPassword">
                                <span class="material-symbols-outlined text-xl">visibility_off</span>
                            </button>
                        </div>
                        <p class="text-xs mt-2 hidden" id="matchMsg"></p>
                    </div>

                    <!-- Requirements -->
                    <div
                        class="bg-slate-50 dark:bg-white/5 rounded-xl p-4 border border-slate-200 dark:border-white/10">
                        <p class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-3">
                            Password Requirements</p>
                        <div class="space-y-2">
                            <div class="flex items-center gap-2" id="req-length">
                                <span
                                    class="material-symbols-outlined text-sm text-slate-300 dark:text-slate-600">check_circle</span>
                                <span class="text-xs text-slate-500 dark:text-slate-400">At least 8 characters</span>
                            </div>
                            <div class="flex items-center gap-2" id="req-upper">
                                <span
                                    class="material-symbols-outlined text-sm text-slate-300 dark:text-slate-600">check_circle</span>
                                <span class="text-xs text-slate-500 dark:text-slate-400">One uppercase letter</span>
                            </div>
                            <div class="flex items-center gap-2" id="req-number">
                                <span
                                    class="material-symbols-outlined text-sm text-slate-300 dark:text-slate-600">check_circle</span>
                                <span class="text-xs text-slate-500 dark:text-slate-400">One number</span>
                            </div>
                            <div class="flex items-center gap-2" id="req-special">
                                <span
                                    class="material-symbols-outlined text-sm text-slate-300 dark:text-slate-600">check_circle</span>
                                <span class="text-xs text-slate-500 dark:text-slate-400">One special character
                                    (!@#$%)</span>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- Action Buttons -->
            <div class="mt-8 flex gap-4">
                <a href="{{ route('settings') }}"
                    class="px-6 py-3 text-slate-500 font-bold text-sm hover:text-navy-deep dark:hover:text-white transition-all rounded-lg hover:bg-slate-100 dark:hover:bg-white/5">Cancel</a>
                <button type="submit" id="updateBtn"
                    class="flex-1 px-8 py-3 bg-primary text-navy-deep rounded-xl font-bold text-sm hover:opacity-90 shadow-lg shadow-primary/10 transition-all opacity-40 pointer-events-none flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-lg">lock</span>
                    Update Password
                </button>
            </div>
            </form>
    </div>
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

            // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(btn => {
                btn.addEventListener('click', () => {
                    const input = document.getElementById(btn.dataset.target);
                    const icon = btn.querySelector('.material-symbols-outlined');
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.textContent = 'visibility';
                    } else {
                        input.type = 'password';
                        icon.textContent = 'visibility_off';
                    }
                });
            });

            // Password strength & requirements
            const newPw = document.getElementById('newPassword');
            const confirmPw = document.getElementById('confirmPassword');
            const bars = [document.getElementById('str1'), document.getElementById('str2'), document.getElementById('str3'), document.getElementById('str4')];
            const label = document.getElementById('strengthLabel');
            const matchMsg = document.getElementById('matchMsg');
            const updateBtn = document.getElementById('updateBtn');

            const reqs = {
                length: { el: document.getElementById('req-length'), test: pw => pw.length >= 8 },
                upper: { el: document.getElementById('req-upper'), test: pw => /[A-Z]/.test(pw) },
                number: { el: document.getElementById('req-number'), test: pw => /[0-9]/.test(pw) },
                special: { el: document.getElementById('req-special'), test: pw => /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(pw) },
            };

            function checkStrength() {
                const pw = newPw.value;
                let score = 0;

                Object.values(reqs).forEach(r => {
                    const passed = r.test(pw);
                    const icon = r.el.querySelector('.material-symbols-outlined');
                    if (passed) {
                        score++;
                        icon.textContent = 'check_circle';
                        icon.style.color = '#13ec5b';
                    } else {
                        icon.textContent = 'check_circle';
                        icon.style.color = '';
                    }
                });

                const colors = ['#ef4444', '#f59e0b', '#3b82f6', '#13ec5b'];
                const labels = ['Weak', 'Fair', 'Good', 'Strong'];

                bars.forEach((bar, i) => {
                    if (i < score) {
                        bar.style.backgroundColor = colors[score - 1];
                    } else {
                        bar.style.backgroundColor = '';
                    }
                });

                if (pw.length === 0) {
                    label.textContent = 'Enter a password to see strength';
                    label.style.color = '';
                } else {
                    label.textContent = labels[score - 1] || 'Too weak';
                    label.style.color = colors[score - 1] || '#ef4444';
                }

                checkMatch();
            }

            function checkMatch() {
                const pw = newPw.value;
                const cpw = confirmPw.value;

                if (cpw.length === 0) {
                    matchMsg.classList.add('hidden');
                } else if (pw === cpw) {
                    matchMsg.classList.remove('hidden');
                    matchMsg.textContent = '✓ Passwords match';
                    matchMsg.style.color = '#13ec5b';
                } else {
                    matchMsg.classList.remove('hidden');
                    matchMsg.textContent = '✗ Passwords do not match';
                    matchMsg.style.color = '#ef4444';
                }

                // Enable button when all requirements met and passwords match
                const allReqsMet = Object.values(reqs).every(r => r.test(pw));
                const passwordsMatch = pw === cpw && cpw.length > 0;
                const currentFilled = document.getElementById('currentPassword').value.length > 0;

                if (allReqsMet && passwordsMatch && currentFilled) {
                    updateBtn.style.opacity = '1';
                    updateBtn.style.pointerEvents = 'auto';
                } else {
                    updateBtn.style.opacity = '0.4';
                    updateBtn.style.pointerEvents = 'none';
                }
            }

            newPw.addEventListener('input', checkStrength);
            confirmPw.addEventListener('input', checkMatch);
            document.getElementById('currentPassword').addEventListener('input', checkMatch);
        });
    </script>
</body>

</html>