<?php

namespace GraphQL\Application;

use GraphQL\Application\Type\AssociationType;
use GraphQL\Application\Type\UserType;
use GraphQL\Application\Type\GroupType;
use GraphQL\Application\Type\NodeType;
use GraphQL\Application\Type\Scalar\EmailType;
use GraphQL\Application\Type\Scalar\UrlType;
use GraphQL\Application\Type\QueryType;
use GraphQL\Type\Definition\BooleanType;
use GraphQL\Type\Definition\CustomScalarType;
use GraphQL\Type\Definition\FloatType;
use GraphQL\Type\Definition\IDType;
use GraphQL\Type\Definition\IntType;
use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\NonNull;
use GraphQL\Type\Definition\StringType;
use GraphQL\Type\Definition\Type;

/**
 * Class Types
 * Регистратор GraphQL типов данных.
 *
 * @package GraphQL\Application
 */
class Types
{
    /* Типы данных сущностей */
    private static $user;
    private static $association;
    private static $group;

    /**
     * Пользователь
     *
     * @return UserType
     */
    public static function user()
    {
        return self::$user ?: (self::$user = new UserType());
    }

    /**
     * Объединение
     *
     * @return AssociationType
     */
    public static function association()
    {
        return self::$association ?: (self::$association = new AssociationType());
    }

    /**
     * Группа
     *
     * @return GroupType
     */
    public static function group()
    {
        return self::$group ?: (self::$group = new GroupType());
    }


    /* Корневые типы */
    private static $node;
    private static $query;
    private static $mutation;

    /**
     * Тип объекта, имеющего ID
     *
     * @return NodeType
     */
    public static function node()
    {
        return self::$node ?: (self::$node = new NodeType());
    }

    /**
     * Тип объекта с общими методами
     *
     * @return QueryType
     */
    public static function query()
    {
        return self::$query ?: (self::$query = new QueryType());
    }


    /* Объектные типы данных */
    private static $emailType;
    private static $urlType;

    /**
     * Тип e-mail
     *
     * @return CustomScalarType
     */
    public static function email()
    {
        return self::$emailType ?: (self::$emailType = EmailType::create());
    }

    /**
     * Тип ссылкок
     *
     * @return UrlType
     */
    public static function url()
    {
        return self::$urlType ?: (self::$urlType = new UrlType());
    }


    /* Базовые типы данных */
    /**
     *  Тип Boolean
     *
     * @return BooleanType
     */
    public static function boolean()
    {
        return Type::boolean();
    }

    /**
     * Тип Float
     * @return FloatType
     */
    public static function float()
    {
        return Type::float();
    }

    /**
     * Тип ID
     *
     * @return IDType
     */
    public static function id()
    {
        return Type::id();
    }

    /**
     * Тип Integer
     *
     * @return IntType
     */
    public static function int()
    {
        return Type::int();
    }

    /**
     * Тип String
     *
     * @return StringType
     */
    public static function string()
    {
        return Type::string();
    }

    /**
     * Массив данных
     *
     * @param Type $type передающийся тип данных
     * @return ListOfType
     */
    public static function listOf($type)
    {
        return new ListOfType($type);
    }

    /**
     * Для обязательных аргументов
     *
     * @param Type $type
     * @return NonNull
     */
    public static function nonNull($type)
    {
        return Type::NonNull($type);
    }

}
