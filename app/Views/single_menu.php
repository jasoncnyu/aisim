<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workspace Page</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style {csp-style-nonce}>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800" x-data="{ open: false }">
    <div class="flex min-h-screen">
        <div class="fixed inset-0 z-30 bg-slate-900/50 lg:hidden" x-show="open" x-transition.opacity x-cloak @click="open = false"></div>

        <aside
            class="fixed inset-y-0 left-0 z-40 w-72 bg-white border-r border-slate-200 shadow-xl transform transition-transform duration-300 lg:static lg:translate-x-0 lg:shadow-none"
            :class="open ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="h-16 px-5 flex items-center justify-between border-b border-slate-200">
                <div class="flex items-center gap-2">
                    <div class="h-8 w-8 rounded-lg bg-slate-900 text-white grid place-items-center font-semibold">C</div>
                    <p class="font-semibold">CI4 Admin</p>
                </div>
                <button class="lg:hidden p-2 rounded-md hover:bg-slate-100" @click="open = false" aria-label="Close menu">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <nav class="p-4 space-y-2 overflow-y-auto h-[calc(100vh-4rem)]">
                <a href="/workspace" class="flex items-center justify-between rounded-xl px-3 py-3 bg-slate-900 text-white shadow-sm">
                    <span class="flex items-center gap-3">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10.5l9-7 9 7M5.25 9.75V20.25h13.5V9.75"/></svg>
                        <span class="font-medium">Main Workspace</span>
                    </span>
                    <span class="rounded-md bg-white/20 px-2 py-0.5 text-xs">Active</span>
                </a>
                <a href="/" class="flex items-center gap-3 rounded-xl px-3 py-2.5 hover:bg-slate-100">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.5 6h9m-9 6h9m-9 6h9M4.5 6h.008v.008H4.5V6zm0 6h.008v.008H4.5V12zm0 6h.008v.008H4.5V18z"/></svg>
                    <span>Back to Welcome</span>
                </a>
            </nav>
        </aside>

        <div class="flex-1 lg:ml-0">
            <header class="h-16 bg-white border-b border-slate-200 px-4 lg:px-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button class="lg:hidden p-2 rounded-md hover:bg-slate-100" @click="open = true" aria-label="Open menu">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
                    </button>
                    <h1 class="text-lg font-semibold">Main Workspace</h1>
                </div>
                <div class="text-sm text-slate-500">Single Menu Layout</div>
            </header>

            <main class="p-4 lg:p-6">
                <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
                    <h2 class="text-xl font-semibold mb-2">Unified Single Menu</h2>
                    <p class="text-slate-600">This is the additional page with one menu item and consistent styling.</p>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
