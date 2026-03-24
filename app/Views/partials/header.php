<header class="h-16 bg-white border-b border-slate-200 px-4 lg:px-6 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <button class="lg:hidden p-2 rounded-md hover:bg-slate-100" @click="open = true" aria-label="Open menu">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/></svg>
        </button>
        <h1 class="text-lg font-semibold"><?= esc($pageTitle ?? 'Dashboard') ?></h1>
    </div>
    <div class="flex flex-1 items-center justify-end gap-4">
        <div class="w-full max-w-[360px]">
            <script async src="https://cse.google.com/cse.js?cx=618df43a560b642b3"></script>
            <div class="gcse-search"></div>
        </div>
        
        <!-- Language Selector -->
        <div class="relative group">
            <button class="px-3 py-2 rounded-md hover:bg-slate-100 flex items-center gap-2 text-sm font-medium">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21a9.004 9.004 0 008.716-6.747M12 21c-1.657 0-3.247-.245-4.779-.707m0 0a9.002 9.002 0 01-8.716-6.747M12 21l.707-4.707M12 3a9.004 9.004 0 008.716 6.747m0 0c1.763.432 3.328 1.152 4.659 2.132m0 0a9.002 9.002 0 01-8.716 6.747M12 3l.707 4.707M12 3a8.976 8.976 0 00-4.779.707m0 0a9.002 9.002 0 01-8.716 6.747"/></svg>
                <span class="hidden sm:inline"><?= strtoupper(currentLang()) ?></span>
            </button>
            
            <!-- Dropdown Menu -->
            <div class="absolute right-0 mt-2 w-48 bg-white border border-slate-200 rounded-lg shadow-lg invisible group-hover:visible z-50">
                <?php foreach (getSupportedLanguages() as $code => $name): ?>
                    <a href="?lang=<?= $code ?>" class="block px-4 py-2 text-sm hover:bg-slate-100 <?= currentLang() === $code ? 'bg-slate-50 font-semibold' : '' ?> <?= $code === 'ar' ? 'text-right' : '' ?>">
                        <?= getLanguageName($code, true) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</header>

