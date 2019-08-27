<?php

declare(strict_types=1);

namespace Stu\Module\Ship\View\ShowBeamFromColony;

use Colony;
use request;
use Stu\Control\GameControllerInterface;
use Stu\Control\ViewControllerInterface;
use Stu\Module\Ship\Lib\ShipLoaderInterface;

final class ShowBeamFromColony implements ViewControllerInterface
{
    public const VIEW_IDENTIFIER = 'SHOW_COLONY_BEAMFROM';

    private $shipLoader;

    public function __construct(
        ShipLoaderInterface $shipLoader
    ) {
        $this->shipLoader = $shipLoader;
    }

    public function handle(GameControllerInterface $game): void
    {
        $userId = $game->getUser()->getId();

        $ship = $this->shipLoader->getByIdAndUser(
            request::indInt('id'),
            $userId
        );

        $target = new Colony(request::getIntFatal('target'));
        if ($ship->canInteractWith($target, true) === false) {
            // @todo ships cant interact
        }

        $game->setPageTitle(_('Von Kolonie beamen'));
        $game->setTemplateFile('html/ajaxwindow.xhtml');
        $game->setAjaxMacro('html/shipmacros.xhtml/show_ship_beamfrom');

        $game->setTemplateVar('targetShip', $target);
        $game->setTemplateVar('SHIP', $ship);
    }
}
