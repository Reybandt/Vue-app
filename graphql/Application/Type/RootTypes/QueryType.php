<?php

namespace GraphQL\Application\Type;

use GraphQL\Application\Database\DB;
use GraphQL\Application\Types;
use GraphQL\Type\Definition\ObjectType;

/**
 * Class QueryType
 * Корневой тип, содержащий общие методы по нахождению других типов.
 *
 * @package GraphQL\Application\Type
 */
class QueryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'fields' => function () {
                return [
                    'hello' => [
                        'type' => Types::string(),
                        'description' => 'Возвращает приветствие',
                        'resolve' => function () {
                            return 'GraphQL works';
                        }
                    ],

                    'allGroups' => [
                        'type' => Types::listOf(Types::group()),
                        'description' => 'Список всех групп',
                        'resolve' => function () {
                            return DB::select("SELECT * from groups");
                        }
                    ],

                    'allUsers' => [
                        'type' => Types::listOf(Types::user()),
                        'description' => 'Список всех пользователей',
                        'resolve' => function () {
                            return DB::select("SELECT * from user");
                        }
                    ],

                    'selectGroupById' => [
                        'type' => Types::group(),
                        'description' => 'Поиск группы по id',
                        'args' => [
                            'id' => Types::nonNull(Types::id())
                        ],
                        'resolve' => function ($root, $args) {
                            return DB::selectOne("SELECT * from groups WHERE id = {$args['id']}");
                        }
                    ],

                    'selectUserById' => [
                        'type' => Types::user(),
                        'description' => 'Возвращает пользователя по id (in range of 1-5)',
                        'args' => [
                            'id' => Types::nonNull(Types::id())
                        ],
                        'resolve' => function ($root, $args) {
                            return DB::selectOne("SELECT * from user WHERE id = {$args['id']}");
                        }
                    ],

                    // Здесь можно написать методы которые доступны в Query запросе
                ];
            }
        ];
        parent::__construct($config);
    }
}
