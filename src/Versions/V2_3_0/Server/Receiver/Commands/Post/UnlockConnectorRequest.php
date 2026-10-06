<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Server\Receiver\Commands\Post;

use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\UnlockConnectorFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\UnlockConnector;
use stdClass;


class UnlockConnectorRequest extends ReceiverCommandPostRequest
{
    protected function buildCommand(stdClass $jsonBody): UnlockConnector
    {
        return UnlockConnectorFactory::fromJson($jsonBody);
    }

    public function getCommand(): UnlockConnector
    {
        return $this->command;
    }
}