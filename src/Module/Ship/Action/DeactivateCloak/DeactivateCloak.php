<?php

declare(strict_types=1);

namespace Stu\Module\Ship\Action\DeactivateCloak;

use request;
use Stu\Control\ActionControllerInterface;
use Stu\Control\GameControllerInterface;
use Stu\Module\Ship\Lib\ShipLoaderInterface;
use Stu\Module\Ship\View\ShowShip\ShowShip;

final class DeactivateCloak implements ActionControllerInterface
{
    public const ACTION_IDENTIFIER = 'B_DEACTIVATE_CLOAK';

    private $shipLoader;

    public function __construct(
        ShipLoaderInterface $shipLoader
    ) {
        $this->shipLoader = $shipLoader;
    }

    public function handle(GameControllerInterface $game): void
    {
        $game->setView(ShowShip::VIEW_IDENTIFIER);

        $userId = $game->getUser()->getId();

        $ship = $this->shipLoader->getByIdAndUser(
            request::indInt('id'),
            $userId
        );

        $ship->setCloak(0);
        $ship->save();
        $game->addInformation("Tarnung deaktiviert");

        //  @todo $this->redalert();
    }

    public function performSessionCheck(): bool
    {
        return true;
    }
}
