<!-- Primary Meta Tags -->
<title>{{ $title ?? config('app.name', 'LowBall') }}</title>
<meta name="title" content="{{ $title ?? config('app.name', 'LowBall') }}" />
<meta name="description"
    content="{{ $description ?? 'Evaluate your tech job offer and never get lowballed again. AI-powered compensation analyzer.' }}" />

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website" />
<meta property="og:url" content="{{ request()->url() }}" />
<meta property="og:title" content="{{ $title ?? config('app.name', 'LowBall') }}" />
<meta property="og:description"
    content="{{ $description ?? 'Evaluate your tech job offer and never get lowballed again. AI-powered compensation analyzer.' }}" />
<meta property="og:image" content="{{ asset('lowball_app_logo.png') }}" />

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image" />
<meta property="twitter:url" content="{{ request()->url() }}" />
<meta property="twitter:title" content="{{ $title ?? config('app.name', 'LowBall') }}" />
<meta property="twitter:description"
    content="{{ $description ?? 'Evaluate your tech job offer and never get lowballed again. AI-powered compensation analyzer.' }}" />
<meta property="twitter:image" content="{{ asset('lowball_app_logo.png') }}" />