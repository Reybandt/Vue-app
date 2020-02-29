<?php


namespace GraphQL\Application\Entity;

use GraphQL\Utils\Utils;
/**
 * Class Group
 * Сущность группы.
 * (публичные GraphQL-методы см. в /src/graphql/Application/Type/UserType.php)
 * (поля объекта соответствуют полям таблицы, за которой прикреплена сущность - см. метод __getTable())
 *
 * @package GraphQL\Application\Data
 */
class Group extends EntityBase
{
    public string $teacher;
    public string $study_days;
    public string $study_times;

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
        return "groups";
    }
}