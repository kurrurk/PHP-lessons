<?php

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$finder = Finder::create()
    ->in(__DIR__)
;

return (new Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        '@PhpCsFixer' => true,

        'array_indentation' => true,

        'trailing_comma_in_multiline' => [
            'elements' => ['arrays'],
        ],

        'multiline_whitespace_before_semicolons' => true,

        'method_argument_space' => [
            'on_multiline' => 'ensure_fully_multiline',
        ],

        'binary_operator_spaces' => [
            'default' => 'single_space',
        ],
    ])
    ->setFinder($finder);
