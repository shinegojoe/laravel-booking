<?php
namespace App\Utils;

class TableNameString {
    public const schema = "test123";
    public const booking = self::schema.".booking";
    public  const calendar = self::schema.'.calendar';
    public  const course = self::schema.'.course';
    public  const courseRegistraction = self::schema.'.courseRegistartion';
    public  const defaultConfig = self::schema.'.defaultConfig';
    public  const login = self::schema.'.login';
    public  const paymentHistory = self::schema.'.paymentHistory';
    public  const syncCanendar = self::schema.'.syncCanendar';
    public  const userConfig = self::schema.'.userConfig';
    public const user = self::schema.".user";

}
