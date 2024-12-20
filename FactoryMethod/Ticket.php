<?php 

abstract class Ticket {
    abstract public function getPrice(): float;
}

class StandardTicket extends Ticket {
    public function getPrice(): float {
        return 10.0;
    }
}

class VIPTicket extends Ticket {
    public function getPrice(): float {
        return 50.0;
    }
}

abstract class TicketFactory {
    abstract public function createTicket(): Ticket;
}

class StandardTicketFactory extends TicketFactory {
    public function createTicket(): Ticket {
        return new StandardTicket();
    }
}

class VIPTicketFactory extends TicketFactory {
    public function createTicket(): Ticket {
        return new VIPTicket();
    }
}

//them một class mới
class PremiumTicket extends Ticket {
    public function getPrice(): float {
        return 100.0;
    }
}
class PremiumTicketFactory extends TicketFactory {
    public function createTicket(): Ticket {
        return new PremiumTicket();
    }
}


//xuat
function printTicketPrice(TicketFactory $factory) {
    $ticket = $factory->createTicket();
    echo "Ticket Price: $" . $ticket->getPrice() . "\n";
}

// Sử dụng các loại vé:
$standardFactory = new StandardTicketFactory();
$vipFactory = new VIPTicketFactory();
$premiumFactory = new PremiumTicketFactory();

printTicketPrice($standardFactory); // Ticket Price: $10
printTicketPrice($vipFactory);      // Ticket Price: $50
printTicketPrice($premiumFactory);  // Ticket Price: $100
