<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\GraphQL;

class IndexController
{
  public function index(Request $request): Response
  {
    $queryType = new ObjectType([
      'name' => 'Query',
      'fields' => [
        'echo' => [
          'type' => Type::string(),
          'args' => [
            'message' => Type::nonNull(Type::string()),
          ],
          'resolve' => function($root, $args) {
            return $root['prefix'] . $args['message'];
          }
        ]
      ],
    ]);

    $schema = new Schema([
      'query' => $queryType,
    ]);

    $input = json_decode($request->getContent(), true);
    $query = $input['query'] ?? null;
    $variableValues = $input['variables'] ?? null;

    try {
      $rootValue = ['prefix' => 'You said: '];
      $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
      $output = $result->toArray();
      return new JsonResponse($output);
    } catch (\Exception $e) {
      $output = [
        'errors' => [
          ['message' => $e->getMessage()]
        ]
      ];
    }
  }
}
