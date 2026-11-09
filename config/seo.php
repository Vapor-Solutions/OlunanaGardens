<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Canonical origin
    |--------------------------------------------------------------------------
    |
    | The one public address search engines should treat as the site. Used for
    | <link rel="canonical">, the sitemap, Open Graph URLs and the www redirect.
    | Override with SEO_CANONICAL_BASE in .env for staging.
    |
    */
    'canonical_base' => rtrim(env('SEO_CANONICAL_BASE', 'https://olunanagardens.com'), '/'),

    'site_name' => 'Olunana Gardens',

    // Social preview image, relative to /public.
    'default_image' => 'img/slider/1.jpg',

    'title_default' => 'Olunana Gardens | Wedding & Event Venue, Koma Rock',
    'description_default' => 'Olunana Gardens is a garden venue at Koma Rock for weddings, corporate events and celebrations, with a restaurant on site. Check availability and book online.',

    /*
    |--------------------------------------------------------------------------
    | Per-page title and meta description, keyed by route name
    |--------------------------------------------------------------------------
    |
    | Keep titles under about 60 characters and descriptions between 70 and 160.
    | Every page must stay unique (tests/Feature/SeoTest.php enforces this).
    |
    */
    'pages' => [

        'home' => [
            'title' => 'Olunana Gardens | Wedding & Event Venue, Koma Rock',
            'description' => 'Olunana Gardens is a garden venue at Koma Rock for weddings, corporate events and celebrations, with a restaurant on site. Check availability and book online.',
        ],

        'about' => [
            'title' => 'About Olunana Gardens | Garden Venue & Restaurant',
            'description' => 'Get to know Olunana Gardens: landscaped gardens and event spaces at Koma Rock, made for weddings, retreats and special occasions, with a restaurant on site.',
        ],

        'gallery' => [
            'title' => 'Photo Gallery | Olunana Gardens Events & Gardens',
            'description' => 'Browse photos of Olunana Gardens, from the gardens to event setups for each type of celebration, and picture your own event at our Koma Rock venue.',
        ],

        'restaurant' => [
            'title' => 'Restaurant & Menu | Olunana Gardens',
            'description' => 'Dine at the Olunana Gardens restaurant, where the menu is built around fresh, locally sourced ingredients. View the menu and prices before you visit.',
        ],

        'blog' => [
            'title' => 'Blog & News | Olunana Gardens',
            'description' => 'News, stories and updates from Olunana Gardens, the garden events venue and restaurant at Koma Rock.',
        ],

        'faq' => [
            'title' => 'FAQs: Booking & Events | Olunana Gardens',
            'description' => 'Answers to common questions about booking and hosting an event at Olunana Gardens, so you can plan with confidence.',
        ],

        'contact-us' => [
            'title' => 'Contact & Reservations | Olunana Gardens',
            'description' => 'Contact Olunana Gardens to reserve your date or ask about events and dining. Call, email or send an enquiry through the form, and find us on the map.',
        ],

    ],
];
