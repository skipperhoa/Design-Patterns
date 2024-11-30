<?php
interface Shipper
{
    public function getName(): string;
    public function getPhone(): string;
    public function getEmail(): string;
    public static function create(): Shipper;
}
class GrabShipper implements Shipper
{
    public function getName(): string
    {
        return "GrabShipper";
    }
    public function getPhone(): string
    {
        return "0123456789";
    }
    public function getEmail(): string
    {
        return "zV1Mx@example.com";
    }

    public static function create(): Shipper
    {
        return new self();
    }
}
class XanhSMShipper implements Shipper
{
    public function getName(): string
    {
        return "XanhSMShipper";
    }
    public function getPhone(): string
    {
        return "0123456789";
    }
    public function getEmail(): string
    {
        return "zV2Mx@example.com";
    }
    public static function create(): Shipper
    {
        return new self();
    }
}

class ShipperFactory
{
    private static $instances = [];
    private static $shipperClasses = [
        'GrabShipper' => GrabShipper::class,
        'XanhSMShipper' => XanhSMShipper::class,
    ];
    public static function getInstance(string $name): Shipper
    {
        if (!isset(self::$shipperClasses[$name])) {
            throw new InvalidArgumentException("Tên lớp không hợp lệ");
        }
        if (!isset(self::$instances[$name])) {
            self::$instances[$name] = self::$shipperClasses[$name]::create();
        }

        return self::$instances[$name];
    }
}
// Sử dụng
$shipper1 = ShipperFactory::getInstance("GrabShipper");
$shipper2 = ShipperFactory::getInstance("GrabShipper");
var_dump($shipper1 === $shipper2); // true
$sh = $shipper1::create();
$name = $sh->getName();
$email = $sh->getEmail();
$phone = $sh->getPhone();
echo $name . " " . $email . " " . $phone;
