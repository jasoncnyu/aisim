<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/products', 'Home::products');
$routes->get('/orders', 'Home::orders');
$routes->get('/reports', 'Home::reports');
$routes->get('/linear-regression', 'Home::linearRegression');
$routes->get('/logistic-regression', 'Home::logisticRegression');
$routes->get('/decision-tree', 'Home::decisionTree');
$routes->get('/k-means', 'Home::kMeans');
$routes->get('/knn', 'Home::knn');
$routes->get('/svm', 'Home::svm');
$routes->get('/cnn-binary', 'Home::cnnBinary');
$routes->get('/cnn-mnist', 'Home::cnnMnist');
$routes->get('/nn-regression', 'Home::nnRegression');
$routes->get('/xor', 'Home::xorLab');
$routes->get('/web-llm', 'Home::webLlm');
$routes->get('/grid-world', 'Home::gridWorld');
$routes->get('/n-slot', 'Home::nSlotBandit');
$routes->get('/quantization', 'Home::quantization');
$routes->get('/pruning', 'Home::pruning');
$routes->get('/sparse-matrix', 'Home::sparseMatrix');
$routes->get('/sitemap.xml', 'Sitemap::index');

// Locale-prefixed routes for non-English languages (e.g., /de/, /es/)
$routes->addPlaceholder('locale', 'es|ko|zh|pt|ja|fr|de|ar|id|vi|tr|ru|it|hi|uk');
$routes->group('{locale}', static function ($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('products', 'Home::products');
    $routes->get('orders', 'Home::orders');
    $routes->get('reports', 'Home::reports');
    $routes->get('linear-regression', 'Home::linearRegression');
    $routes->get('logistic-regression', 'Home::logisticRegression');
    $routes->get('decision-tree', 'Home::decisionTree');
    $routes->get('k-means', 'Home::kMeans');
    $routes->get('knn', 'Home::knn');
    $routes->get('svm', 'Home::svm');
    $routes->get('cnn-binary', 'Home::cnnBinary');
    $routes->get('cnn-mnist', 'Home::cnnMnist');
    $routes->get('nn-regression', 'Home::nnRegression');
    $routes->get('xor', 'Home::xorLab');
    $routes->get('web-llm', 'Home::webLlm');
    $routes->get('grid-world', 'Home::gridWorld');
    $routes->get('n-slot', 'Home::nSlotBandit');
    $routes->get('quantization', 'Home::quantization');
    $routes->get('pruning', 'Home::pruning');
    $routes->get('sparse-matrix', 'Home::sparseMatrix');
    $routes->get('sitemap.xml', 'Sitemap::index');
});
