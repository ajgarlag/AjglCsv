<?php

$header = <<<EOF
AJGL CSV Library

Copyright (C) Antonio J. García Lagar <aj@garcialagar.es>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

Symfony\CS\Fixer\Contrib\HeaderCommentFixer::setHeader($header);

return Symfony\CS\Config\Config::create()
    // use default SYMFONY_LEVEL and extra fixers:
    ->fixers(array(
        '-psr0',
        'ordered_use',
        'strict',
        'strict_param',
        'header_comment',
    ))
    ->finder(
        Symfony\CS\Finder\DefaultFinder::create()
            ->in(__DIR__.'/src')
            ->in(__DIR__.'/tests')
    )
;
