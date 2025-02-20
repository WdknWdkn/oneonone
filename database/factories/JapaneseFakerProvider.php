<?php

namespace Database\Factories;

class JapaneseFakerProvider
{
    protected static $departments = ['営業部', '開発部', '人事部', '総務部', 'マーケティング部'];
    protected static $positions = ['部長', '課長', '主任', '担当'];
    
    public function japaneseDepartment()
    {
        return static::$departments[array_rand(static::$departments)];
    }
    
    public function japanesePosition()
    {
        return static::$positions[array_rand(static::$positions)];
    }
}
