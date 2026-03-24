<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Sitemap extends Controller
{
    public function index()
    {
        $baseRoutes = [
            '/',
            '/linear-regression',
            '/logistic-regression',
            '/decision-tree',
            '/k-means',
            '/knn',
            '/svm',
            '/cnn-binary',
            '/cnn-mnist',
            '/nn-regression',
            '/xor',
            '/web-llm',
            '/grid-world',
            '/n-slot',
            '/quantization',
            '/pruning',
            '/sparse-matrix',
        ];

        $locales = config('App')->supportedLocales ?? ['en'];
        $routes = [];

        foreach ($baseRoutes as $path) {
            // Default locale (en) keeps the original path.
            $routes[] = $path;

            // Other locales are prefixed.
            foreach ($locales as $locale) {
                if ($locale === 'en') {
                    continue;
                }

                if ($path === '/') {
                    $routes[] = '/' . $locale;
                } else {
                    $routes[] = '/' . $locale . $path;
                }
            }
        }

        $data = [
            'routes' => $routes,
            'lastmod' => date('Y-m-d'),
        ];

        return response()
            ->setHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->setBody(view('sitemap', $data));
    }
}
