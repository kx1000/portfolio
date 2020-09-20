<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class FileExtension extends AbstractExtension
{
    const DISPLAYABLE_EXTENSIONS = ['png', 'svg', 'jpg', 'gif', 'bmp'];

    public function getFilters(): array
    {
        return [
            new TwigFilter('isDisplayable', [$this, 'isDisplayable']),
        ];
    }

    public function isDisplayable(string $path): bool
    {
        $ext = pathinfo($path, PATHINFO_EXTENSION);

        if (in_array($ext, self::DISPLAYABLE_EXTENSIONS)) {
            return true;
        }

        return false;
    }
}
