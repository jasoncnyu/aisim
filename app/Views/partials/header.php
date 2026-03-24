<header class="h-16 bg-white border-b border-slate-200 px-4 lg:px-6 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <button class="lg:hidden p-2 rounded-md hover:bg-slate-100" @click="open = true" aria-label="Open menu">
            <i class="fa-solid fa-bars fa-lg"></i>
        </button>
        <h1 class="text-lg font-semibold"><?= esc($pageTitle ?? 'Dashboard') ?></h1>
    </div>
    <div class="flex flex-1 items-center justify-end gap-4">
        <div class="w-full max-w-[360px]">
            <script async src="https://cse.google.com/cse.js?cx=618df43a560b642b3"></script>
            <div class="gcse-search"></div>
        </div>
        
        <!-- Language Selector -->
        <div class="relative" x-data="{ langOpen: false }" @keydown.escape.window="langOpen = false">
            <button class="px-3 py-2 rounded-md hover:bg-slate-100 flex items-center gap-2 text-sm font-medium" @click="langOpen = !langOpen" aria-haspopup="true" :aria-expanded="langOpen.toString()">
                <i class="fa-solid fa-language fa-lg"></i>
                <span class="hidden sm:inline"><?= strtoupper(currentLang()) ?></span>
            </button>
            
            <!-- Dropdown Menu -->
            <div class="absolute right-0 mt-2 w-48 bg-white border border-slate-200 rounded-lg shadow-lg z-50" x-show="langOpen" x-transition.origin.top.right x-cloak @click.outside="langOpen = false">
                <?php foreach (getSupportedLanguages() as $code => $name): ?>
                    <a href="<?= esc(langUrl($code)) ?>" class="block px-4 py-2 text-sm hover:bg-slate-100 <?= currentLang() === $code ? 'bg-slate-50 font-semibold' : '' ?> <?= $code === 'ar' ? 'text-right' : '' ?>">
                        <?= getLanguageName($code, true) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</header>
