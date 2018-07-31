# Genesis Layouts

Register and unregister Genesis layouts through configuration.

## Installation

This component should be installed using Composer, with the command `composer require d2/core-genesis-layouts`.

## Usage

Within your config file (typically found at `config/defaults.php`) define an array of Genesis layouts you would like to register, and an array of Genesis layouts you would like to unregister. 

There are already class constants defined for all of the standard Genesis layouts.

For example:

```php
use D2\Core\GenesisLayout;

$d2_layouts = [
    GenesisLayout::REGISTER   => [
        'slim-content', [
            'label' => __( 'Slim Content Area', 'example-textdomain' ),
            'image' => get_stylesheet_directory_uri() . '/images/slim-content-icon.png',
        ],
    ],
    GenesisLayout::UNREGISTER => [
        GenesisLayout::SIDEBAR_CONTENT,
        GenesisLayout::CONTENT_SIDEBAR_SIDEBAR,
        GenesisLayout::SIDEBAR_CONTENT_SIDEBAR,
        GenesisLayout::SIDEBAR_SIDEBAR_CONTENT,
    ],
];

return [
    GenesisLayout::class => $d2_layouts,
];
 ```

## Load the component

Components should be loaded in your theme `functions.php` file, using the `Theme::setup` static method. Code should run on the `after_setup_theme` hook (or `genesis_setup` if you use Genesis Framework).

```php
add_action( 'after_setup_theme', function() {
    $config = include_once __DIR__ . '/config/defaults.php';
    D2\Core\Theme::setup( $config );
} );
```
