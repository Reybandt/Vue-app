<?php
namespace GraphQL\Application\Entity;

use GraphQL\Utils\Utils;
/**
 * Class Association
 * Сущность объединения
 *
 * @package GraphQL\Application\Data
*/
class Association extends EntityBase
{
    public string $name;
    public string $min_age;
    public string $max_age;
    public string $col;

    public function __construct(array $data = null)
    {
        parent::__construct($data);
    }

    /**
     * Ассоциированная таблица
     * (таблица должна быть создана в базе данных)
     *
     * @return string
     */
    public function __getTable()
    {
        return "association";
    }
}