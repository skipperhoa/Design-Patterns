<?php
interface Shipper
{
    public function getName(): string;
    public function getPhone(): string;
    public function getEmail(): string;
    public static function create(): Shipper;
}
class GrapShipper implements Shipper
{
    public function getName(): string
    {
        return "GrapShipper";
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
        return "zV1Mx@example.com";
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
        'GrapShipper' => GrapShipper::class,
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
$shipper1 = ShipperFactory::getInstance("GrapShipper");
$shipper2 = ShipperFactory::getInstance("GrapShipper");
var_dump($shipper1 === $shipper2); // true
