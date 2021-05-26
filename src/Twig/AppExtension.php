<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('articleImagePath', [$this, 'articleImagePath']),
            new TwigFunction('articleVideoPath', [$this, 'articleVideoPath']),
        ];
    }

    public function articleImagePath(int $articleId, string $imageName): string
    {
        return sprintf('uploads/articles/%s/%s', $articleId, $imageName);
    }

    public function articleVideoPath(string $videoName): string
    {
        return sprintf('https://www.youtube.com/embed/%s', $videoName);
    }
}
