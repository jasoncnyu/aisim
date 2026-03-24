<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Sitemap extends Controller
{
    public function index()
    {
        $routes = [
            '/',
            '/products',
            '/orders',
            '/reports',
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

        $data = [
            'routes' => $routes,
            'lastmod' => date('Y-m-d'),
        ];

        return response()
            ->setHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->setBody(view('sitemap', $data));
    }
}
