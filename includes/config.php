<?php

$siteConfig = [
    'name'  => 'Su Myat Noe',
    'title' => 'Software Developer',
    'email' => 'sumyatnoe3878@gmail.com',
    'phone' => '+959782846436',
    'phone_display' => '+959 7828 46436',
    'address' => '21/460, Aung Zay Yone St, Shwe Pauk Kan, Myanmar',
    'github'   => 'https://github.com/SuMyatNoe148',
    'linkedin' => 'https://linkedin.com/in/su-myat-noe-399aa0415',
    'cv_file'  => 'SuMyatNoe.pdf',
    'profile_image' => 'su.png',
];

$socialLinks = [
    ['url' => $siteConfig['github'],   'icon' => 'fab fa-github',      'target' => '_blank'],
    ['url' => $siteConfig['linkedin'], 'icon' => 'fab fa-linkedin-in', 'target' => '_blank'],
    ['url' => 'mailto:' . $siteConfig['email'], 'icon' => 'fas fa-envelope', 'target' => ''],
    ['url' => 'tel:' . $siteConfig['phone'],    'icon' => 'fas fa-phone',    'target' => ''],
];

$skills = [
    ['name' => 'PHP',               'icon' => 'fab fa-php',            'percent' => 90],
    ['name' => 'C# / .NET',         'icon' => 'fas fa-code',           'percent' => 85],
    ['name' => 'MySQL / SQL Server', 'icon' => 'fas fa-database',      'percent' => 88],
    ['name' => 'JavaScript',        'icon' => 'fab fa-js',             'percent' => 80],
];

$skillCards = [
    ['icon' => 'fab fa-php',             'name' => 'PHP'],
    ['icon' => 'fas fa-code',            'name' => 'C#'],
    ['icon' => 'fab fa-microsoft',       'name' => '.NET'],
    ['icon' => 'fas fa-database',        'name' => 'MySQL'],
    ['icon' => 'fas fa-server',          'name' => 'SQL Server'],
    ['icon' => 'fab fa-js',              'name' => 'JavaScript'],
    ['icon' => 'fab fa-git-alt',         'name' => 'Git & GitHub'],
    ['icon' => 'fas fa-layer-group',     'name' => 'MVC'],
    ['icon' => 'fas fa-sitemap',         'name' => 'Clean Architecture'],
    ['icon' => 'fas fa-project-diagram', 'name' => 'DDD'],
    ['icon' => 'fab fa-html5',           'name' => 'HTML5'],
    ['icon' => 'fab fa-css3-alt',        'name' => 'CSS3'],
];

$projects = [
    [
        'image'    => 'media_library.png',
        'alt'      => 'Media Library System',
        'category' => 'web',
        'label'    => 'Web App',
        'title'    => 'Media Library System',
        'desc'     => 'Digital media management platform with authentication, notifications, and Stripe payment integration. Built with PHP, MySQL, JavaScript.',
        'link'     => 'https://github.com/SuMyatNoe148',
    ],
    [
        'image'    => 'EMS.png',
        'alt'      => 'Employee Management System',
        'category' => 'web',
        'label'    => 'ASP.Net',
        'title'    => 'Employee Management System',
        'desc'     => 'Employee management platform with CRUD operations, user management, and reporting features. Built with ASP.NET, SQL Management Studio, JavaScript.',
        'link'     => 'https://github.com/SuMyatNoe148',
    ],
    [
        'image'    => 'CSRB.png',
        'alt'      => 'CS Reference Book',
        'category' => 'web',
        'label'    => 'Web App',
        'title'    => 'CS Reference Book',
        'desc'     => 'Educational platform for organizing and accessing computer science learning resources. Built with PHP, MySQL.',
        'link'     => 'https://github.com/SuMyatNoe148',
    ],
    [
        'image'    => 'IQTest.png',
        'alt'      => 'IQ Testing System',
        'category' => 'desktop',
        'label'    => 'Desktop App',
        'title'    => 'IQ Testing System',
        'desc'     => 'Desktop application for timed IQ assessments, automatic scoring, and report generation. Built with C#, WinForms, SQL Server.',
        'link'     => 'https://github.com/SuMyatNoe148',
    ],
    [
        'image'    => 'abyss.png',
        'alt'      => 'Abyss.Net E-Commerce',
        'category' => 'web',
        'label'    => 'Web App',
        'title'    => 'Abyss.Net &ndash; E-Commerce',
        'desc'     => 'Full-stack fashion e-commerce platform with layered architecture (Domain, Application, Infrastructure, Presentation). Features product management, customer authentication, shopping cart, and database integration. Built with PHP, Next.js, SQL Server.',
        'link'     => 'https://github.com/SuMyatNoe148',
    ],
];

$stats = [
    ['target' => 5, 'label' => 'Projects Completed'],
    ['target' => 3, 'label' => 'Years Teaching'],
    ['target' => 10, 'label' => 'Technical Skills'],
];
