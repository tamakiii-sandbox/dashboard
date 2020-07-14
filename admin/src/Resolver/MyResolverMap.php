<?php

namespace App\Resolver;

use Overblog\GraphQLBundle\Resolver\ResolverMap;

class MyResolverMap extends ResolverMap
{
  protected function map()
  {
    return ["hello" => "world"];
  }
}
