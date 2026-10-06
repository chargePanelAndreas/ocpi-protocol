<?php

declare(strict_types=1);

namespace Chargemap\OCPI\Versions\V2_3_0\Common\Factories;

use Chargemap\OCPI\Versions\V2_3_0\Common\Models\Credentials;
use stdClass;

class CredentialsFactory
{
    public static function fromJson(?stdClass $json): ?Credentials
    {
        if ($json === null) {
            return null;
        }

        $credentials = new Credentials(
            $json->token,
            $json->url,
            $json->hub_party_id ?? null
        );

        if (property_exists($json, 'roles') && $json->roles !== null) {
            foreach ($json->roles as $role) {
                $credentials->addRole(CredentialsRoleFactory::fromJson($role));
            }
        }

        return $credentials;
    }
}
