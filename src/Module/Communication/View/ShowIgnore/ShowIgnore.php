<?php

declare(strict_types=1);

namespace Stu\Module\Communication\View\ShowIgnore;

use Stu\Control\GameControllerInterface;
use Stu\Control\ViewControllerInterface;

final class ShowIgnore implements ViewControllerInterface
{
    public const VIEW_IDENTIFIER = 'SHOW_IGNORE';

    public function handle(GameControllerInterface $game): void
    {
        $game->showMacro('html/macros.xhtml/ignoretext');
    }
}