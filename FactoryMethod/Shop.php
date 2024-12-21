<?php

/*  Exception */
class UnknownShopTypeException extends Exception {
    public function __construct(string $type) {
        $message = "The shop type '{$type}' is not recognized. Please provide a valid shop type.";
        parent::__construct($message);
    }
}

/* 
FACTORY METHOD IN DESIGN PATTERN
1 : Tạo interface Shop
*/

interface Shop {
    public function getName() : string;
    public function getAddress() : string;
}


abstract class BaseShop implements Shop {
    protected string $name;
    protected string $address;

    public function __construct(string $name, string $address) {
        $this->name = $name;
        $this->address = $address;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAddress(): string {
        return $this->address;
    }
}
/* 
2: Concrete Classes: Các lớp cụ thể
 */

class PhoneShop extends BaseShop {}

class BodyShop extends BaseShop {}

/* 
3 : Abstract Factory Class: Bạn tạo lớp trừu tượn
*/
abstract class ShopFactory {
    abstract public function create(string $name, string $address): Shop;
    public static function getFactory(string $type): ShopFactory {
        return match ($type) {
            'phone' => new PhoneShopFactory(),
            'body' => new BodyShopFactory(),
            default => throw new UnknownShopTypeException("Unknown shop type: $type"),
        };
    }
}

/*  
4: Concrete Factories
*/
class PhoneShopFactory extends ShopFactory {
    public function create(string $name, string $address): Shop {
        return new PhoneShop($name, $address);
    }
}

class BodyShopFactory extends ShopFactory {
    public function create(string $name, string $address): Shop {
        return new BodyShop($name, $address);
    }
}

/* 
5: Sử dụng Factory Method
*/

function clientCode(ShopFactory $factory) {
    $shop = $factory->create();
    echo $shop->getName() . PHP_EOL;
    echo $shop->getAddress() . PHP_EOL;
}

$phoneShopFactory = new PhoneShopFactory();
$clientCode($phoneShopFactory); 

$bodyShopFactory = new BodyShopFactory();
$clientCode($bodyShopFactory);