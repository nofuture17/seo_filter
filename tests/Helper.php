<?php

namespace nofuture17\seo_filter_tests;

/**
 * Created by PhpStorm.
 * User: nofuture17
 * Date: 01.06.2017
 * Time: 22:54
 */
class Helper
{
    /**
     * Получить объект ошибки
     * @param callable $callable Функция, выбрасывающая исключение
     * @return \Exception|null
     */
    public static function getException(callable $callable)
    {
        $result = null;
        try {
            call_user_func($callable);
        } catch (\Exception $exception) {
            $result = $exception;
        }
        return $result;
    }
}