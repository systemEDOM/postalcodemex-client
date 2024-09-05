<?php

namespace OmSoft\PostalCodeMexClient\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \OmSoft\PostalCodeMexClient\PostalCodeMexClient
 */
class PostalCodeMexClient extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \OmSoft\PostalCodeMexClient\PostalCodeMexClient::class;
    }
}
