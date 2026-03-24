<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CI4 Tailwind Sidebar</title>
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style {csp-style-nonce}>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800" x-data="{ open: false }">
    <div class="flex min-h-screen">
        <div
            class="fixed inset-0 z-30 bg-slate-900/50 lg:hidden"
            x-show="open"
            x-transition.opacity
            x-cloak
            @click="open = false"
        ></div>

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
                <a href="#" class="flex items-center gap-3 rounded-xl px-3 py-2.5 bg-slate-900 text-white">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 10.5l9-7 9 7M5.25 9.75V20.25h13.5V9.75"/></svg>
                    <span>Dashboard</span>
                </a>

                <div x-data="{ subOpen: true }" class="rounded-xl border border-slate-200">
                    <button @click="subOpen = !subOpen" class="w-full flex items-center justify-between px-3 py-2.5 hover:bg-slate-50 rounded-xl">
                        <span class="flex items-center gap-3">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M20.25 7.5l-8.25-4.5-8.25 4.5 8.25 4.5 8.25-4.5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 12l8.25 4.5 8.25-4.5M3.75 16.5l8.25 4.5 8.25-4.5"/></svg>
                            <span>Product Management</span>
                        </span>
                        <svg class="h-4 w-4 transition-transform" :class="subOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="subOpen" x-transition class="px-2 pb-2 space-y-1">
                        <a href="#" class="block rounded-lg px-10 py-2 text-sm text-slate-600 hover:bg-slate-100">All Products</a>
                        <a href="#" class="block rounded-lg px-10 py-2 text-sm text-slate-600 hover:bg-slate-100">Categories</a>
                        <a href="#" class="block rounded-lg px-10 py-2 text-sm text-slate-600 hover:bg-slate-100">Inventory</a>
                    </div>
                </div>

                <div x-data="{ subOpen: false }" class="rounded-xl border border-slate-200">
                    <button @click="subOpen = !subOpen" class="w-full flex items-center justify-between px-3 py-2.5 hover:bg-slate-50 rounded-xl">
                        <span class="flex items-center gap-3">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
                            <span>Order Management</span>
                        </span>
                        <svg class="h-4 w-4 transition-transform" :class="subOpen ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="subOpen" x-transition class="px-2 pb-2 space-y-1">
                        <a href="#" class="block rounded-lg px-10 py-2 text-sm text-slate-600 hover:bg-slate-100">Order List</a>
                        <a href="#" class="block rounded-lg px-10 py-2 text-sm text-slate-600 hover:bg-slate-100">Returns</a>
                    </div>
                </div>

                <a href="/workspace" class="flex items-center gap-3 rounded-xl px-3 py-2.5 hover:bg-slate-100">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M10.5 6h9m-9 6h9m-9 6h9M4.5 6h.008v.008H4.5V6zm0 6h.008v.008H4.5V12zm0 6h.008v.008H4.5V18z"/></svg>
                    <span>Workspace Page</span>
                </a>
            </nav>
        </aside>

        <div class="flex-1 lg:ml-0">
            <header class="h-16 bg-white border-b border-slate-200 px-4 lg:px-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button class="lg:hidden p-2 rounded-md hover:bg-slate-100" @click="open = true" aria-label="Open menu">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
                    </button>
                    <h1 class="text-lg font-semibold">Welcome</h1>
                </div>
                <div class="text-sm text-slate-500">Tailwind CDN + Responsive Sidebar</div>
            </header>

            <main class="p-4 lg:p-6">
                <div class="rounded-2xl bg-white border border-slate-200 p-6 shadow-sm">
                    <h2 class="text-xl font-semibold mb-2">Two-Level Left Menu</h2>
                    <p class="text-slate-600">On mobile, the menu slides in from the left when you tap the hamburger button.</p>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
