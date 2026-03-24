<!doctype html>
<?php $isRtl = currentLang() === 'ar'; ?>
<html lang="<?= currentLang() ?>"<?= $isRtl ? ' dir="rtl"' : '' ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $metaDescription = $metaDescription ?? 'AI Simulator is a hands-on learning platform for machine learning, deep learning, and reinforcement learning through interactive visual labs.'; ?>
    <?php $pageTitleText = esc($pageTitle ?? 'Home'); ?>
    <?php $siteName = 'AI Simulator'; ?>
    <title><?= $pageTitleText ?> | <?= $siteName ?></title>
    <meta name="description" content="<?= esc($metaDescription) ?>">
    <meta name="robots" content="<?= esc($metaRobots ?? 'index, follow') ?>">
    <meta property="og:site_name" content="<?= $siteName ?>">
    <meta property="og:title" content="<?= $pageTitleText ?> | <?= $siteName ?>">
    <meta property="og:description" content="<?= esc($metaDescription) ?>">
    <meta property="og:type" content="<?= esc($metaOgType ?? 'website') ?>">
    <meta property="og:url" content="<?= esc($metaCanonical ?? current_url()) ?>">
    <meta property="og:image" content="<?= esc($metaOgImage ?? '/assets/brand/og-image.png') ?>">
    <meta name="twitter:card" content="<?= esc($metaTwitterCard ?? 'summary_large_image') ?>">
    <meta name="twitter:title" content="<?= $pageTitleText ?> | <?= $siteName ?>">
    <meta name="twitter:description" content="<?= esc($metaDescription) ?>">
    <meta name="twitter:image" content="<?= esc($metaOgImage ?? '/assets/brand/og-image.png') ?>">
    <link rel="canonical" href="<?= esc($metaCanonical ?? current_url()) ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" referrerpolicy="no-referrer">
    <script type="application/ld+json">
        <?= json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $pageTitleText . ' | ' . $siteName,
            'description' => $metaDescription,
            'url' => $metaCanonical ?? current_url(),
            'isPartOf' => [
                '@type' => 'WebSite',
                'name' => $siteName,
                'url' => base_url(),
            ],
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
    </script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PZ7NJ68SMC"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-PZ7NJ68SMC');
    </script>
    <link rel="icon" type="image/svg+xml" href="/assets/brand/favicon.svg">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style {csp-style-nonce}>
        [x-cloak] { display: none !important; }
        .gsc-control-cse { padding: 0 !important; border: none !important; background: transparent !important; }
        .gsc-control-cse .gsc-input-box { border: 1px solid #e2e8f0 !important; border-radius: 0.5rem !important; background: #fff !important; height: 2.25rem !important; display: flex !important; align-items: center !important; }
        .gsc-control-cse .gsc-input-box table { margin: 0 !important; height: 100% !important; }
        .gsc-control-cse .gsc-input-box td { vertical-align: middle !important; }
        .gsc-control-cse .gsib_a { padding: 0 !important; }
        .gsc-control-cse input.gsc-input { padding: 0 0.5rem !important; font-size: 0.875rem !important; color: #0f172a !important; background: transparent !important; background-image: none !important; height: 2.25rem !important; line-height: 2.25rem !important; }
        .gsc-control-cse .gsc-search-button-v2 { padding: 0.25rem 0.5rem !important; border-radius: 0.5rem !important; border: none !important; background: #0f172a !important; }
        .gsc-control-cse .gsc-search-button-v2 svg { fill: #fff !important; }
        .gsc-control-cse .gsc-search-button-v2:hover { background: #1e293b !important; }
        .gsc-control-cse .gsc-branding { opacity: 0.7; }
    </style>
    <?= $this->renderSection('head') ?>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800" x-data="{ open: false }">
    <div class="flex min-h-screen">
        <div class="fixed inset-0 z-30 bg-slate-900/50 lg:hidden" x-show="open" x-transition.opacity x-cloak @click="open = false"></div>

        <?= view('partials/sidebar', ['activeMenu' => $activeMenu ?? 'dashboard']) ?>

        <div class="flex-1 lg:ml-0">
            <?= view('partials/header', ['pageTitle' => $pageTitle ?? 'Dashboard']) ?>

            <main class="p-4 lg:p-6">
                <?= $this->renderSection('content') ?>
            </main>

            <?= view('partials/footer') ?>
        </div>
    </div>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
