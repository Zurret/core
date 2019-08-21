<?php

declare(strict_types=1);

namespace Stu\Module\Alliance\Action\CancelOffer;

use AllianceRelation;
use PM;
use Stu\Control\ActionControllerInterface;
use Stu\Control\GameControllerInterface;

final class CancelOffer implements ActionControllerInterface
{
    public const ACTION_IDENTIFIER = 'B_CANCEL_OFFER';

    private $cancelOfferRequest;

    public function __construct(
        CancelOfferRequestInterface $cancelOfferRequest
    ) {
        $this->cancelOfferRequest = $cancelOfferRequest;
    }

    public function handle(GameControllerInterface $game): void
    {
        $alliance = $game->getUser()->getAlliance();
        $allianceId = $alliance->getId();

        $relation = AllianceRelation::getById($this->cancelOfferRequest->getRelationId());

        if (!$relation || $relation->getAllianceId() != $allianceId) {
            return;
        }
        if (!$relation->isPending()) {
            return;
        }

        $relation->deleteFromDatabase();

        $text = sprintf(_('Die Allianz %s hat das Angebot zurückgezogen'), $alliance->getNameWithoutMarkup());

        PM::sendPM(USER_NOONE, $relation->getRecipient()->getFounder()->getUserId(), $text);
        if ($relation->getRecipient()->getDiplomatic()) {
            PM::sendPM(USER_NOONE, $relation->getRecipient()->getDiplomatic()->getUserId(), $text);
        }
        $game->addInformation(_('Das Angebot wurde zurückgezogen'));
    }

    public function performSessionCheck(): bool
    {
        return true;
    }
}