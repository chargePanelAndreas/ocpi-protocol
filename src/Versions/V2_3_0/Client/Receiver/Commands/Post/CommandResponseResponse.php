<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Client\Receiver\Commands\Post;

use Chargemap\OCPI\Common\Client\Modules\AbstractResponse;
use Chargemap\OCPI\Versions\V2_3_0\Common\Factories\CommandResponseFactory;
use Chargemap\OCPI\Versions\V2_3_0\Common\Models\CommandResponse;
use Psr\Http\Message\ResponseInterface;

class CommandResponseResponse extends AbstractResponse
{
    private CommandResponse $commandResponse;

    public function __construct(CommandResponse $commandResponse)
    {
        $this->commandResponse = $commandResponse;
    }

    public static function fromResponseInterface(ResponseInterface $response): self
    {
        $json = self::toJson($response, 'V2_3_0/Receiver/Commands/commandResponsePostRequest.schema.json');

        return new self(CommandResponseFactory::fromJson($json->data));
    }

    public function getCommandResponse(): CommandResponse
    {
        return $this->commandResponse;
    }
}
