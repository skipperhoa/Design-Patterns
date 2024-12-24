<?php

/* Factory Method */
interface Payment {
    public function nameBank();
    public function addressBank();
    public function numberBank();
}

abstract class BankFactory implements Payment {
    public string $nameBank;
    public string $addressBank;
    public string $numberBank;

    public function __construct(string $nameBank, string $addressBank, string $numberBank) {
        $this->nameBank = $nameBank;    
        $this->addressBank = $addressBank;
        $this->numberBank = $numberBank;
    }
    public function nameBank() : string {
        return $this->nameBank;
    }
    public function addressBank() : string {
        return $this->addressBank;
    }
    public function numberBank() : string {
        return $this->numberBank;
    }
}

/* Bank A */

class BankA extends BankFactory {
    public function __construct(string $nameBank, string $addressBank, string $numberBank) {
        parent::__construct($nameBank, $addressBank, $numberBank);
    }
}

/* Bank B  */
class BankB extends BankFactory {
    public function __construct(string $nameBank, string $addressBank, string $numberBank) {
        parent::__construct($nameBank, $addressBank, $numberBank);
    }
}

/* Create Factory */
abstract class PaymentFactory  {
    abstract public function createBank(string $nameBank, string $addressBank, string $numberBank);
}

/* create bank */
class BankAFactory extends PaymentFactory {
    public function createBank(string $nameBank, string $addressBank, string $numberBank) : Payment
    {
        return new BankA($nameBank, $addressBank, $numberBank);
    }
}

class BankBFactory extends PaymentFactory {
    public function createBank(string $nameBank, string $addressBank, string $numberBank) {
        return new BankB($nameBank, $addressBank, $numberBank);
    }
}

/* client using bank */
class Client {
    public $paymentFactory;
    public function __construct(PaymentFactory $paymentFactory) {
        $this->paymentFactory = $paymentFactory;
    }
    public function createBank(string $nameBank, string $addressBank, string $numberBank) {
        $bank = $this->paymentFactory->createBank($nameBank, $addressBank, $numberBank);
        return $bank;
    }
}

$bankA = new BankAFactory();
$client = new Client($bankA);
$bank = $client->createBank('Bank A', 'address A', 'number A');
echo $bank->nameBank() . '<br>';
echo $bank->addressBank() . '<br>';
echo $bank->numberBank() . '<br>';