<?php

namespace GraphQL\Application\Type;

use GraphQL\Application\Data\User;

use GraphQL\Application\Types;
use GraphQL\Type\Definition\ObjectType;

use GraphQL\Type\Definition\ResolveInfo;

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
                    'childids' => [
                        'type' => Types::listOf(Types::id()),
                        'description' => 'Идентификаторы детей'
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
                    'status_email' => [
                        # TODO Узнать что за поле
                        'type' => Types::string(),
                        'description' => 'Status email?'
                    ],
                    'verification_key_email' => [
                        # TODO Узнать что за поле
                        'type' => Types::string(),
                        'description' => 'Verification key email?'
                    ],
                ];
            },
            'interfaces' => [
                Types::node() //объект, имеющий ID
            ],
            'resolveField' => function ($value, $args, $context, ResolveInfo $info) {
                $method = 'resolve' . ucfirst($info->fieldName);
                if (method_exists($this, $method)) {
                    return $this->{$method}($value, $args, $context, $info);
                } else {
                    return $value->{$info->fieldName};
                }
            }
        ];
        parent::__construct($config);
    }

    /*
     * <b>Как добавить свое GraphQL полё</b>
     * Любой видимый для GraphQL в данном классе метод должен:
     *  1) быть публичной функцией,
     *  2) начинаться со слова 'resolve' (см. код на строчках 34-39), последующее слово должно быть написано с большой буквы (например, resolveMyName или resolveMyname и т.п.)
     * Не стоит забывать, что метод должен вернуть какое-нибудь значение для клиента.
     *
     * Пример объявления:
    public function resolvePhoto(User $user, $args)
    {
        return DataSource::getUserPhoto($user->id, $args['size']);
    }
    */

}
