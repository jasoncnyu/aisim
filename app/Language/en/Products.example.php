<?php

// Example language file for future use
// Copy to: app/Language/{lang}/Products.php

return [
    'pageTitle' => 'Products',
    'heading' => 'Our Products',
    'description' => 'Explore our machine learning products and tools',
    
    'categories' => [
        'interactive_labs' => 'Interactive Labs',
        'visualization_tools' => 'Visualization Tools',
        'learning_modules' => 'Learning Modules',
    ],
    
    'products' => [
        [
            'id' => 1,
            'name' => 'Linear Regression Lab',
            'description' => 'Interactive lab for learning linear regression',
            'difficulty' => 'Beginner',
        ],
        [
            'id' => 2,
            'name' => 'CNN MNIST',
            'description' => 'Convolutional Neural Network for digit recognition',
            'difficulty' => 'Intermediate',
        ],
    ],
    
    'buttons' => [
        'view_details' => 'View Details',
        'try_now' => 'Try Now',
        'learn_more' => 'Learn More',
    ],
    
    'filters' => [
        'all' => 'All Products',
        'beginner' => 'Beginner',
        'intermediate' => 'Intermediate',
        'advanced' => 'Advanced',
    ],
];
