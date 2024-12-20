<?php
/**
 * Khi nào dùng Factory Method?
Khi bạn cần tạo ra các đối tượng mà không biết trước lớp cụ thể.
Khi việc khởi tạo các đối tượng có thể thay đổi hoặc phức tạp.
Khi bạn muốn tuân theo nguyên tắc Open/Closed Principle (mở rộng dễ dàng, nhưng hạn chế sửa đổi).
 * Cách hoạt động của Factory Method
Lớp cha cung cấp một phương thức trừu tượng hoặc phương thức mặc định để tạo đối tượng.
Lớp con cụ thể sẽ triển khai phương thức này để trả về các loại đối tượng khác nhau.    
     */
// 1. Interface cho sản phẩm
interface Ticket {
    public function getType(): string;
}
// 2. Các lớp cụ thể
class MovieTicket implements Ticket {
    public function getType(): string {
        return "Vé xem phim";
    }
}

class TheaterTicket implements Ticket {
    public function getType(): string {
        return "Vé xem kịch";
    }
}

// 3. Lớp Factory cơ bản
abstract class TicketFactory {
    // Factory Method
    abstract public function createTicket(): Ticket;

    public function getTicketType(): string {
        $ticket = $this->createTicket();
        return $ticket->getType();
    }
}

// 4. Các lớp Factory cụ thể
class MovieTicketFactory extends TicketFactory {
    public function createTicket(): Ticket {
        return new MovieTicket();
    }
}

class TheaterTicketFactory extends TicketFactory {
    public function createTicket(): Ticket {
        return new TheaterTicket();
    }
}

// 5. Sử dụng Factory Method
function clientCode(TicketFactory $factory) {
    echo "Loại vé: " . $factory->getTicketType() . PHP_EOL;
}

// Tạo vé xem phim
$movieFactory = new MovieTicketFactory();
clientCode($movieFactory);

// Tạo vé xem kịch
$theaterFactory = new TheaterTicketFactory();
clientCode($theaterFactory);

