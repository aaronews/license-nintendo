<?php

namespace App\Twig;

use App\Entity\Game;
use Twig\Environment;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class GetGameStyleExtension extends AbstractExtension
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('getGameStyle', [$this, 'getGameStyle']),
        ];
    }

    public function getGameStyle(Game $game)
    {
        return $this->twig->render('stylesheet/game.css.twig', ['game' => $game]);
    }
}
