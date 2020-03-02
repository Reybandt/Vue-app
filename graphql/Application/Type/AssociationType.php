<?php

namespace GraphQL\Application\Type;

use GraphQL\Application\Types;
use GraphQL\Type\Definition\ObjectType;

class AssociationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'description' => 'Объединение',
            'fields' => function () {
                return [
                    'id' => Types::id(),
                    'name' => [
                        'type' => Types::string()
                    ],
                    'min_age' => [
                        'type' => Types::string()
                    ],
                    'max_age' => [
                        'type' => Types::string()
                    ],
                    'col' => [
                        'type' => Types::string()
                    ]
                ];
            }
        ];
        parent::__construct($config);
    }
}