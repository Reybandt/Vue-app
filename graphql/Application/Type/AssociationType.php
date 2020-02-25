<?php
namespace GraphQL\Application\Type;

use GraphQL\Application\AppContext;
use GraphQL\Application\Database\DataSource;
use GraphQL\Application\Data\Association;
use GraphQL\Application\Types;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

class AssociationType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Association',
            'description' => 'Ассоциации',
            'fields' => function() {

                // Не забывайте писать документацию методов и полей GraphQL, иначе они не будут зарегистрированы.

                return [
                    'id' => Types::id(),
                    'name' => ['type' => Types::string()],
                    'min_age' => ['type' => Types::string()],
                    'max_age' => ['type' => Types::string()],
                    'col' => ['type' => Types::string()]
                ];
            },
            'interfaces' => [
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