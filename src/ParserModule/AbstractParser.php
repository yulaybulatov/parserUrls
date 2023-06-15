<?php

namespace App\ParserModule;

use App\Curl\Curl;

abstract class AbstractParser implements ParserInterface
{
    protected string $findTags = '/<([a-z]+\d*)(\s+[^>]*)*>/';
    public function __construct(
        protected Curl $curl
    )
    {
    }

}