<?php


namespace GraphQL\Application\Type;

use GraphQL\Application\Database\DB;
use GraphQL\Application\Types;
use GraphQL\Type\Definition\ObjectType;

class GroupType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'description' => 'Группа',
            'fields' => function () {
                return [
                    'id' => [
                        'type' => Types::id(),
                        'description' => 'Идентификатор группы'
                    ],

                    'association' => [
                        'type' => Types::association(),
                        'description' => 'объединение',
                        'resolve' => function ($root) {
                            return DB::selectOne(
                                "SELECT a.* FROM groups g INNER JOIN association a ON a.id = g.idassociation");
                        }
                    ],

                    'teacher' => [
                        'type' => Types::string(),
                        'description' => 'Преподователь'
                    ],

                    'study_days' => [
                        'type' => Types::string()
                    ],

                    'study_times' => [
                        'type' => Types::string()
                    ]
                ];
            }
        ];
        parent::__construct($config);
    }
}