<?php


namespace GraphQL\Application;

use GraphQL\Application\AppContext;
use GraphQL\Application\Database\DataSource;
use GraphQL\Application\Data\Group;
use GraphQL\Application\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class GroupType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Group',
            'description' => 'Группы',
            'fields' => function() {
                // Не забывайте писать документацию методов и полей GraphQL, иначе они не будут зарегистрированы.
                return [
                    'id' => Types::id(),
                    'idassociation' => Types::id(),
                    'teacher' => ['type' => Types::string()],
                    'study_days' => ['type' => Types::string()],
                    'study_times' => ['type' => Types::string()]
                ];
            },
            'intefaces' => [
                Types::node()
            ],
            'resolveField' => function($value, $args, $context, ResolveInfo $info) {
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
}