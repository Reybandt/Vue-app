<?php

namespace GraphQL\Application\Type;

use GraphQL\Application\AppContext;

use GraphQL\Application\Data\User;
use GraphQL\Application\Database\DataSource;
use GraphQL\Application\Types;
use GraphQL\Type\Definition\ObjectType;

use GraphQL\Type\Definition\ResolveInfo;

/**
 * Class QueryType
 * Корневой тип, содержащий общие методы по нахождению других типов.
 *
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
                    // Здесь можно написать методы которые доступны в Query запросе

                    'hello' => [
                        'type' => Types::string(),
                        'description' => 'Возвращает приветствие',
                        'resolve' => function () {
                            return 'Привет, GraphQL!';
                        }
                    ],

                    'association' => [
                        'type' => Types::association(),
                        'description' => 'Returns association by id (in range of 1-5)',
                        'args' => [
                            'id' => Types::nonNull(Types::id())
                        ]
                    ],

                    'group' => [
                        'type' => Types::group(),
                        'description' => 'Returns group by id (in range of 1-5)',
                        'args' => [
                            'id' => Types::nonNull(Types::id())
                        ]
                    ],

                    'user' => [
                        'type' => Types::user(),
                        'description' => 'Возвращает пользователя по id (in range of 1-5)',
                        'args' => [
                            'id' => Types::nonNull(Types::id())
                        ]
                    ],

                    'viewer' => [
                        'type' => Types::user(), // Тип данных, которые возвращает метод
                        'description' => 'Represents currently logged-in user (for the sake of example - simply returns user with id == 1)' // Описание поля
                    ],
                ];
            },
            'resolveField' => function ($val, $args, $context, ResolveInfo $info) {
                return $this->{$info->fieldName}($val, $args, $context, $info);
            }
        ];
        parent::__construct($config);
    }


    /**
     * Поиск единичного объединения из базы данных
     *
     * @param $rootValue
     * @param $args
     * @param $context
     * @return mixed
     */
    public function association($rootValue, $args, AppContext $context)
    {
        return DataSource::select('Association', $args['id']);
    }

    public function group($rootValue, $args, AppContext $context)
    {
        return DataSource::select('Group', $args['id']);
    }

    /**
     * Поиск единичного пользователя из базы данных
     *
     * @param $rootValue
     * @param $args
     * @param AppContext $context
     * @return mixed
     */
    public function user($rootValue, $args, AppContext $context)
    {
        return DataSource::select('User', $args['id']);
    }

    /**
     * Текущий пользователь
     *
     * @param $rootValue
     * @param $args
     * @param AppContext $context
     * @return \GraphQL\Application\Entity\User
     */
    public function viewer($rootValue, $args, AppContext $context)
    {
        return $context->viewer;
    }


    /**
     * "Ping" о том, что сервер работает корректно
     *
     * @return string
     */
    public function hello()
    {
        return 'GraphQL сервер успешно работает.';
    }
}
