<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Models;

use JsonSerializable;

class Credentials implements JsonSerializable
{
    private string $token;

    private string $url;

    private ?string $hubPartyId;

    /** @var CredentialsRole[] */
    private array $roles = [];

    public function __construct(string $token, string $url, ?string $hubPartyId = null)
    {
        $this->token = $token;
        $this->url = $url;
        $this->hubPartyId = $hubPartyId;
    }

    public function addRole(CredentialsRole $role): self
    {
        $this->roles[] = $role;

        return $this;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getHubPartyId(): ?string
    {
        return $this->hubPartyId;
    }

    /**
     * @return CredentialsRole[]
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    public function jsonSerialize(): array
    {
        $return = [
            'token' => $this->token,
            'url' => $this->url,
        ];

        if ($this->hubPartyId !== null) {
            $return['hub_party_id'] = $this->hubPartyId;
        }

        $return['roles'] = array_map(function ($role) {
            return (object)$role->jsonSerialize();
        }, $this->roles);

        return $return;
    }
}
