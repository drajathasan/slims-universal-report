<?php
use SLiMS\DB;

class SchemaOutput {
    private string $defaultColumnAsString = '';
    private array $data = [];

    public function __construct(string $defaultColumnAsString = '')
    {
        if (!empty($defaultColumnAsString)) {
            $this->defaultColumnAsString = $defaultColumnAsString;
        }
    }

    public function __set($key, $value) {
        $this->data[$key] = $value;
    }

    public function __get($key) {
        return $this->data[$key]??null;
    }

    public function __toString()
    {
        return $this->data[$this->defaultColumnAsString]??'';
    }
}

class Schema
{
    public static function getTables()
    {
        $tables = DB::getInstance()->prepare('select TABLE_NAME from information_schema.TABLES where TABLE_NAME != \'loan_history\' and TABLE_SCHEMA = ? order by TABLE_NAME asc');
        $tables->setFetchMode(PDO::FETCH_CLASS, SchemaOutput::class, ['defaultColumnAsString' => 'TABLE_NAME']);
        $tables->execute([
            config('database.nodes.' . config('database.default_profile', 'SLiMS') . '.database')
        ]);

        return $tables;
    }
}