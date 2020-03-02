<?php

namespace GraphQL\Application\Type;

use GraphQL\Application\Types;
use GraphQL\Type\Definition\ObjectType;

class UserType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'description' => 'Пользователи личного кабинета.',
            'fields' => function () {
                return [
                    'id' => [
                        'type' => Types::id(),
                        'description' => 'Идентификатор'
                    ],
                    'surname' => [
                        'type' => Types::string(),
                        'description' => 'Фамилия'
                    ],
                    'name' => [
                        'type' => Types::string(),
                        'description' => 'Имя'
                    ],
                    'midname' => [
                        'type' => Types::string(),
                        'description' => 'Отчество'
                    ],
                    'sex' => [
                        'type' => Types::int(),
                        'description' => 'Пол. 0 - муж, 1 - жен'
                    ],
                    'phone_number' => [
                        'type' => Types::string(),
                        'description' => 'Телефон'
                    ],
                    'email' => [
                        'type' => Types::email(),
                        'description' => 'E-mail'
                    ],
                    'registration_address' => [
                        'type' => Types::string(),
                        'description' => 'Адрес регистрации'
                    ],
                    'residence_address' => [
                        'type' => Types::string(),
                        'description' => 'Адрес проживания'
                    ],
                    'job_place' => [
                        'type' => Types::string(),
                        'description' => 'Место работы'
                    ],
                    'job_position' => [
                        'type' => Types::string(),
                        'description' => 'Должность'
                    ],
                    'relationship' => [
                        'type' => Types::string(),
                        'description' => 'Степень родства'
                    ],
                    'children' => [
                        'type' => Types::listOf(Types::user()),
                        'description' => 'Идентификаторы детей',
                    ],
                    'study_place' => [
                        'type' => Types::string(),
                        'description' => 'Адрес и номер школы (если есть)'
                    ],
                    'study_class' => [
                        'type' => Types::string(),
                        'description' => 'Класс (если есть)'
                    ],
                    'date_registered' => [
                        'type' => Types::string(),
                        'description' => 'Дата регистрации'
                    ],
                    'birthday' => [
                        'type' => Types::string(),
                        'description' => 'Дата рождения'
                    ],
                    'role' => [
                        'type' => Types::listOf(Types::string()),
                        'description' => 'Роль пользователя'
                    ]
                ];
            },
            'interfaces' => [
                Types::node() //объект, имеющий ID
            ],
        ];
        parent::__construct($config);
    }
}
