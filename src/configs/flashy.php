<?php

/**
 * Flashy Feedback Manager Configurations
 */

use Codersamer\Flashy\Renderers\BootstrapRenderer;
use Codersamer\Flashy\Renderers\TailwindRenderer;

return [
    /**
     * Define Flashy Render Engines and the one to use
     *
     * You can add your custom engines by implemented the IFlashyRenderer interface
     * \Codersamer\Flashy\Contracts\IFlashyRenderer
     */
    'render' => [

        'engines' => [
            //Bootstrap Renderer
            'bootstrap' => BootstrapRenderer::class,
            //Tailwind Renderer
            'tailwind' => TailwindRenderer::class
        ],

        'use' => 'tailwind'
    ],

];

