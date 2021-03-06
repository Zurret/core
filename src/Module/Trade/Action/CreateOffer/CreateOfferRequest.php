<?php

declare(strict_types=1);

namespace Stu\Module\Trade\Action\CreateOffer;

use Stu\Lib\Request\CustomControllerHelperTrait;

final class CreateOfferRequest implements CreateOfferRequestInterface
{
    use CustomControllerHelperTrait;

    public function getStorageId(): int
    {
        return $this->bodyParameter('storid')->int()->required();
    }

    public function getWantedGoodId(): int
    {
        return $this->bodyParameter('wgid')->int()->required();
    }

    public function getWantedAmount(): int
    {
        return $this->bodyParameter('wcount')->int()->required();
    }

    public function getGiveGoodId(): int
    {
        return $this->bodyParameter('ggid')->int()->required();
    }

    public function getGiveAmount(): int
    {
        return $this->bodyParameter('gcount')->int()->required();
    }

    public function getOfferAmount(): int
    {
        return $this->bodyParameter('amount')->int()->required();
    }

}