<?php

namespace App\Curl;

use RuntimeException;

abstract class AbstractCurl
{

    /**
     * проверяем страницу на ошибки по возвращаемому коду ответа
     * @param int $http_code
     * @param ?string $redirectUrl
     * @return string|false
     */
    protected function isError(int $http_code, ?string $redirectUrl): string|false {

        if($http_code == 200) {
            return false;
        }

        try {

            $error = "Ошибка $http_code.";

            if($http_code == 0) {
                $error = 'Не удалось установить HTTP-соединение. Сайт не существует или заблокирован Роскомнадзором. 
                Проверьте правильно ли вы указали адрес';;
            }

            elseif($http_code == 404) {
                $error .= ' Данная страница на сайте не найдена';
            }

            elseif($http_code == 301 || $http_code == 302) {
                $error = "Страница перемещена на <a href=\"$redirectUrl\">новый адрес</a>";
            }

            elseif($http_code == 500) {
                $error .= ' Внутренняя ошибка сервера';
            }

            throw new RuntimeException($error);
        }

        catch (RuntimeException $exception) {

            return $exception->getMessage();
        }

    }

}