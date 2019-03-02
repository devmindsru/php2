<?php
//  Данный класс - наше приложение
namespace app\base;
// Т.к. автолоадер подключаем после Singleton, поэтому Singleton подключаем руками
include "../traits/TSingleton.php";
use app\controllers\Controller;
use app\services\Db;
use app\services\Request;
use app\traits\TSingleton;
class ComponentNotFoundException extends \Exception{}
class ComponentNotFoundException extends \Exception
{
}
class App
{
@@ -47,21 +49,22 @@ private function autoloadRegister()
    // Используем магический метод __get, который будет вызываться при обращении к свойству, которого нет в нашем массиве components конфига
    function __get($name)
    {
       return $this->components->get($name);
        return $this->components->get($name);
    }
    // Создание компонента (имя компонента)
    function createComponent($name){
        if(isset($this->config['components'][$name])){
    function createComponent($name)
    {
        if (isset($this->config['components'][$name])) {
            //
            $params = $this->config['components'][$name];
            // Получаем имя класса компонента из $params
            $className = $params['class'];
            // Существует ли такой класс?
            if(class_exists($className)){
            if (class_exists($className)) {
                // Убираем из параметров Class, т.к. в конструкторе в параметрах никакого класса быть не может!
                unset($params['class']);
                $reflection =  new \ReflectionClass($className);
                $reflection = new \ReflectionClass($className);
                // ReflectionClass::newInstanceArgs - Создаёт экземпляр класса с переданными параметрами
                return $reflection->newInstanceArgs($params);
            }
        // Исключение - Компонент не найден
        throw new ComponentNotFoundException($name);
    }
} 