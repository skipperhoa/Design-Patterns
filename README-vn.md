Factory Method là một trong những Creational Design Patterns (mẫu thiết kế khởi tạo), giúp bạn tạo đối tượng mà không cần chỉ định lớp cụ thể. Thay vì khởi tạo đối tượng trực tiếp bằng từ khóa new, Factory Method sử dụng một phương thức được định nghĩa trong một lớp hoặc interface để quyết định lớp nào sẽ được khởi tạo.

## Mục đích
+ Cung cấp sự linh hoạt khi thêm các lớp mới mà không cần thay đổi mã nguồn hiện tại.
+ Tăng khả năng mở rộng (Open/Closed Principle).
+ Tách biệt logic khởi tạo đối tượng ra khỏi logic nghiệp vụ chính.

## Cấu trúc Factory Method
+ Product (Sản phẩm): Interface hoặc lớp trừu tượng định nghĩa các đối tượng được tạo.
+ Concrete Product (Sản phẩm cụ thể): Các lớp cụ thể triển khai hoặc mở rộng từ Product.
+ Creator (Người tạo): Lớp hoặc interface định nghĩa phương thức factoryMethod trả về Product.
+ Concrete Creator (Người tạo cụ thể): Lớp cụ thể triển khai phương thức factoryMethod để tạo ra Concrete Product.