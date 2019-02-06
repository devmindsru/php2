<?php

// УРОК 1
//Задание 1,2,3
class Goods //Товар
{

    public $cost; //цена
    public $number; //кол-во
    public $order_number; //Количество заказов

    protected function __construct($cost = 100, $number = 1, $order_number = 0)
    {
        $this->cost = $cost;
        $this->number = $number;
        $this->order_number = $order_number;
    }

    public function for_payment() //Сумма оплаты
    {
        return $this->cost * $this->number;
    }

    public function view_num_orders()
    {
        echo 'Заказано: ' . $this->order_number;
    }

}

//Задание 4 Придумать наследников класса из п.1. Чем они будут отличаться?
//В дочернем классе присутствуют дополнительные (свои) свойства и методы.
class Item extends Goods
{

    public $name;
    public $color;

    public function __construct($name, $color)
    {
        parent::__construct();
        $this->name = $name;
        $this->color = $color;
    }

    public function view_goods()
    {
        echo "Нименование товара - " . $this->name . '<br>';
        echo "Цена товара - " . $this->cost . '<br>';
        echo "Цвет товара - " . $this->color . '<br>';
        echo "Количество товара - " . $this->number . '<br>';
    }

}

$obj = new Item('Футболка', 'Белый');
$obj->view_goods();

//Задание 5
//class A
//{
//
//    public function foo()
//    {
//        static $x = 0;
//        echo ++$x;
//    }
//
//}
//
//$a1 = new A();
//$a2 = new A();
//$a1->foo();
//$a2->foo();
//$a1->foo();
//$a2->foo();
//Вывод 12345
//$x объявлена как static и не уничтожается после работы функции. 
//Значение переменной $x присваивается 1 раз, 
//при последующих вызовах переменная $x получает сохраненное значение. 
//Метод (foo) для всех экземпляров класса только один, 
//поэтому при каждом вызове из разных экземпляров мы получаем инкремент одной и той же переменной.


//Задание 6
class A
{

    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }

}

class B extends A
{
    
}

$a1 = new A;
$b1 = new B;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();

//Вывод 1122. 
//Статическая $x для каждого экземпляра класса своя, 
//т.к. при наследовании класса создается новый метод "foo", и как следствие создается новая $x