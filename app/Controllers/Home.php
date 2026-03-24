<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return $this->renderPage('pages/mainpage', 'Home', 'dashboard', [
            'metaDescription' => 'AI Simulator is an interactive learning lab for machine learning, deep learning, and reinforcement learning with hands-on visual experiments.',
            'metaOgImage' => '/assets/brand/og-image2.png',
        ]);
    }

    public function products(): string
    {
        return $this->renderPage('pages/products', 'Products', 'products');
    }

    public function orders(): string
    {
        return $this->renderPage('pages/orders', 'Orders', 'orders');
    }

    public function reports(): string
    {
        return $this->renderPage('pages/reports', 'Reports', 'reports');
    }

    public function linearRegression(): string
    {
        return $this->renderPage('pages/linear_regression', 'Linear Regression', 'linear_regression', [
            'metaDescription' => 'Explore linear regression with interactive points, gradient descent, and live loss curves.',
        ]);
    }

    public function logisticRegression(): string
    {
        return $this->renderPage('pages/logistic_regression', 'Logistic Regression', 'logistic_regression', [
            'metaDescription' => 'Visualize logistic regression with sigmoid boundaries, cross-entropy loss, and training controls.',
        ]);
    }

    public function decisionTree(): string
    {
        return $this->renderPage('pages/decision_tree', 'Decision Tree', 'decision_tree', [
            'metaDescription' => 'Build an interactive decision tree and inspect splits, regions, and Gini impurity.',
        ]);
    }

    public function kMeans(): string
    {
        return $this->renderPage('pages/k_means', 'K-Means Clustering', 'k_means', [
            'metaDescription' => 'Learn K-Means clustering with live centroids, Voronoi regions, and inertia curves.',
        ]);
    }

    public function knn(): string
    {
        return $this->renderPage('pages/knn', 'K-Nearest Neighbors', 'knn', [
            'metaDescription' => 'Explore K-NN classification with decision regions, weighted voting, and neighbor inspection.',
        ]);
    }

    public function svm(): string
    {
        return $this->renderPage('pages/svm', 'Support Vector Machine', 'svm', [
            'metaDescription' => 'Compare linear SVM and kernel perceptron models with interactive decision boundaries.',
        ]);
    }

    public function cnnBinary(): string
    {
        return $this->renderPage('pages/cnn_binary', 'CNN Binary Classifier', 'cnn_binary', [
            'metaDescription' => 'Train a tiny CNN for binary image classification with filter and feature map visualizations.',
        ]);
    }

    public function cnnMnist(): string
    {
        return $this->renderPage('pages/cnn_mnist', 'CNN MNIST Classifier', 'cnn_mnist', [
            'metaDescription' => 'Train a compact CNN on MNIST digits, then draw digits to test live inference.',
        ]);
    }

    public function nnRegression(): string
    {
        return $this->renderPage('pages/nn_regression', 'Nonlinear Neural Regression', 'nn_regression', [
            'metaDescription' => 'Fit nonlinear regression with a multilayer perceptron and observe overfitting behavior.',
        ]);
    }

    public function xorLab(): string
    {
        return $this->renderPage('pages/xor_lab', 'XOR Neural Lab', 'xor_lab', [
            'metaDescription' => 'Explore XOR classification with a simple neural network and interactive training controls.',
        ]);
    }

    public function webLlm(): string
    {
        return $this->renderPage('pages/web_llm', 'Tiny Web LLM', 'web_llm', [
            'metaDescription' => 'Experiment with a tiny web-based language model simulation and token sampling.',
        ]);
    }

    public function gridWorld(): string
    {
        return $this->renderPage('pages/grid_world', 'Grid World', 'grid_world', [
            'metaDescription' => 'Learn reinforcement learning fundamentals with a grid world environment.',
        ]);
    }

    public function nSlotBandit(): string
    {
        return $this->renderPage('pages/n_slot_bandit', 'N-Slot Bandit', 'n_slot_bandit', [
            'metaDescription' => 'Explore exploration vs exploitation with a multi-armed bandit simulator.',
        ]);
    }

    public function quantization(): string
    {
        return $this->renderPage('pages/quantization', 'Quantization Lab', 'quantization', [
            'metaDescription' => 'Learn weight quantization with interactive matrices, low-bit formats, and error heatmaps.',
        ]);
    }

    public function pruning(): string
    {
        return $this->renderPage('pages/pruning', 'Pruning Lab', 'pruning', [
            'metaDescription' => 'Explore pruning strategies, sparsity masks, and compression trade-offs in a hands-on simulator.',
        ]);
    }

    public function sparseMatrix(): string
    {
        return $this->renderPage('pages/sparse_matrix', 'Sparse Matrix Lab', 'sparse_matrix', [
            'metaDescription' => 'Encode sparse matrices with COO/CSR/CSC and compare compression ratios.',
        ]);
    }

    protected function renderPage(string $view, string $pageTitle, string $activeMenu = '', array $data = []): string
    {
        return view($view, [
            'pageTitle'      => $pageTitle,
            'activeMenu'     => $activeMenu,
            'metaDescription'=> $data['metaDescription'] ?? null,
            'metaCanonical'  => $data['metaCanonical'] ?? null,
            'metaOgImage'    => $data['metaOgImage'] ?? null,
            'metaRobots'     => $data['metaRobots'] ?? null,
            'metaOgType'     => $data['metaOgType'] ?? null,
            'metaTwitterCard'=> $data['metaTwitterCard'] ?? null,
        ]);
    }
}
