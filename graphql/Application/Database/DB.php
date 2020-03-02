<?php

namespace GraphQL\Application\Database;

use Error;
use GraphQL\Application\ConfigManager;
use PDO;
use PDOException;

/**
 * Class DB
 * Менеджер по работе с базой данных (используется PDO).
 *
 * @package GraphQL\Application
 */
class DB
{
    /**
     * Активное PDO соединение
     *
     * @var PDO
     */
    private static PDO $pdo;

    /**
     * Инициализация PDO соединения
     *
     * @param array $config
     */
    private static function init()
    {

        if (!isset(self::$pdo)) {
            $db_type = ConfigManager::getField("db_type");
            $db_host = ConfigManager::getField("db_host");
            $db_name = ConfigManager::getField("db_name");
            $db_user = ConfigManager::getField("db_user");
            $db_pass = ConfigManager::getField("db_pass");
            try {
                self::$pdo = new PDO("{$db_type}:dbname={$db_name};host={$db_host};charset=utf8", $db_user, $db_pass, [
                    PDO::ATTR_PERSISTENT => true
                ]);
            } catch (PDOException $e) {
                throw new Error("Не могу соединиться с базой данных.");
            }
//			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    /**
     * Выполнение запроса select и возвращение одной строки
     *
     * @param string $query
     * @return mixed
     */
    public static function selectOne($query)
    {
        $records = self::select($query);
        return array_shift($records);
    }

    /**
     * Выполнение запроса select и возвращение строк
     *
     * @param string $query Запрос
     * @return array
     */
    public static function select($query)
    {
        $statement = self::$pdo->query($query);
        return $statement->fetchAll();
    }

    /**
     * Выполнение запроса и возвращение количества затронутых строк
     *
     * @param string $query
     * @return int
     */
    public static function affectingStatement($query)
    {
        $statement = self::$pdo->query($query);
        return $statement->rowCount();
    }





    /**
     * Получение адаптера
     * @return PDO
     */
    public static function getPDO()
    {
        return self::$pdo;
    }

    /**
     * Нахождение сущности по ID
     * Пример использования:
     *      DB::find('User', 1);
     *
     * @param string $class
     * @param int $id
     * @return mixed|null
     */
    public static function find(string $class, int $id)
    {
        $bindings = ["id" => (string)$id];
        return self::findOne($class, "id = :id", $bindings);
    }

    /**
     * Нахождение сущности по первому вхождению
     * [ Выдаётся первый попавшийся элемент, для нахождения по ID см. метод выше ]
     *
     * @param string $class
     * @param string $query
     * @param array $bindings
     * @return mixed|null
     */
    public static function findOne(string $class, string $query, array $bindings = [])
    {
        $result = self::selectAll($class, $query . " LIMIT 1", $bindings);
        return (count($result) > 0) ? $result[0] : null;
    }

    /**
     * Нахождение всех сущностей по запросу
     *
     * @param string $class
     * @param string $query
     * @param array $bindings
     * @return array
     */
    public static function selectAll(string $class, string $query, array $bindings = []): array
    {

        self::init();

        $class = "\\GraphQL\\Application\\Entity\\{$class}";
        $assoc_table = (new $class(null))->__getTable();


        $query = self::getPDO()->prepare("SELECT * FROM `{$assoc_table}` WHERE {$query}");
        foreach ($bindings as $key => $value) {
            $query->bindValue($key, $value);
        }


        $isSuccessful = $query->execute();

        if (!$isSuccessful) {
            $arr = print_r($query->errorInfo(), true);
            throw new Error("Не удалось совершить запрос: " . $arr);
        }

        $res = $query->fetchAll();
        $result = [];
        foreach ($res as $object_key => $object_value) {
            $__ = new $class();

            foreach ($object_value as $key => $value) {
                $__->$key = $value;
            }
            $result[] = $__;
        }
        return $result;
    }
}
