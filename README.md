# Design-Patterns

### Factory Method Design Pattern Explained with PHP Examples

[🚀 The acticle 🧑‍💻](https://hoanguyenit.com/factory-method-design-pattern-explained-with-php-examples.html)

[🧑‍💻 Github](https://github.com/skipperhoa/Design-Patterns/tree/main/FactoryMethod)

Facetory is a but in Creational Design Patterns, help create object , don't need specify class

Instead of create object using `new` , Facetory Method using a method special in class or interface ,after then return object

### Purpose

+ Provides flexibility to add new classes without changing existing source code

+ Increase Scalability (open/closed Principle)

+ Separate object initialzation logic from main business logic


### Factory Method Structure
+ Product : Interface or abstract class defines the objects that are created

+ Concrete Product :  Concrete classes that implement or extends from `Product`

+ Creator : The class or Interface definde a `facetoryMethod` method that returns Product

+ Concrete creator : Concrete class implmenting the method `facetoryMethod` to create the `Concrete Product`

##### Example

+ Product class initialztation 
```php

interface Logger {
    public function log(string $message): void;
}

class FileLogger implements Logger {
    public function log(string $message): void {
        echo "Logging to a file: $message";
    }
}

class DatabaseLogger implements Logger {
    public function log(string $message): void {
        echo "Logging to a database: $message";
    }
}
```

+  Creator and Concrete Creator

```php

abstract class LoggerFactory {
    // Phương thức factory method
    abstract public function createLogger(): Logger;

    public function log(string $message): void {
        $logger = $this->createLogger();
        $logger->log($message);
    }
}

class FileLoggerFactory extends LoggerFactory {
    public function createLogger(): Logger {
        return new FileLogger();
    }
}

class DatabaseLoggerFactory extends LoggerFactory {
    public function createLogger(): Logger {
        return new DatabaseLogger();
    }
}
```

+ Ussing Facetory Method

```php
// Tạo logger dạng File
$fileLoggerFactory = new FileLoggerFactory();
$fileLoggerFactory->log("This is a file log message.");

// Tạo logger dạng Database
$databaseLoggerFactory = new DatabaseLoggerFactory();
$databaseLoggerFactory->log("This is a database log message.");

```

### Advantages of Factory Method

+ Scalable : create a new product, only need add product class and creator class respectively

+ Reuse : same business logic, but different objects can be created without modifying the main source code.

+ Separation of responsibilities : creator is responsible for object initialization , initialization logic is not part of business logic

### Disadvantages
+ the code more complicated, because it requires additional creator class and Concrete Product classes

+ Ability extends ,requires the initial design to be accurate

##### Example 2: CRUD (User and Role) in PHP 

+ Setup interface 
```php 

interface CrudInterface {
    public function create(array $data): void;
    public function read(int $id): ?array;
    public function update(int $id, array $data): void;
    public function delete(int $id): void;
}
```
+ Product (User  Role)

```php 
class User implements CrudInterface {
    private $users = []; // Mô phỏng cơ sở dữ liệu

    public function create(array $data): void {
        $this->users[$data['id']] = $data;
        echo "User created: " . json_encode($data) . PHP_EOL;
    }

    public function read(int $id): ?array {
        return $this->users[$id] ?? null;
    }

    public function update(int $id, array $data): void {
        if (isset($this->users[$id])) {
            $this->users[$id] = array_merge($this->users[$id], $data);
            echo "User updated: " . json_encode($this->users[$id]) . PHP_EOL;
        } else {
            echo "User not found." . PHP_EOL;
        }
    }

    public function delete(int $id): void {
        unset($this->users[$id]);
        echo "User deleted: $id" . PHP_EOL;
    }
}

class Role implements CrudInterface {
    private $roles = []; // Mô phỏng cơ sở dữ liệu

    public function create(array $data): void {
        $this->roles[$data['id']] = $data;
        echo "Role created: " . json_encode($data) . PHP_EOL;
    }

    public function read(int $id): ?array {
        return $this->roles[$id] ?? null;
    }

    public function update(int $id, array $data): void {
        if (isset($this->roles[$id])) {
            $this->roles[$id] = array_merge($this->roles[$id], $data);
            echo "Role updated: " . json_encode($this->roles[$id]) . PHP_EOL;
        } else {
            echo "Role not found." . PHP_EOL;
        }
    }

    public function delete(int $id): void {
        unset($this->roles[$id]);
        echo "Role deleted: $id" . PHP_EOL;
    }
}
```
+ Create Factory class

```php 

abstract class CrudFactory {
    abstract public function createCrud(): CrudInterface;
}

class UserFactory extends CrudFactory {
    public function createCrud(): CrudInterface {
        return new User();
    }
}

class RoleFactory extends CrudFactory {
    public function createCrud(): CrudInterface {
        return new Role();
    }
}
```

+ Factory Method use CRUD
```php
// Factory cho User
$userFactory = new UserFactory();
$userCrud = $userFactory->createCrud();

// Thực hiện các thao tác CRUD cho User
$userCrud->create(['id' => 1, 'name' => 'Hoa Dev', 'email' => 'hoadev@example.com']);
$userCrud->update(1, ['email' => 'hoadev.code@example.com']);
$userData = $userCrud->read(1);
echo "Read User: " . json_encode($userData) . PHP_EOL;
$userCrud->delete(1);

// Factory cho Role
$roleFactory = new RoleFactory();
$roleCrud = $roleFactory->createCrud();

// Thực hiện các thao tác CRUD cho Role
$roleCrud->create(['id' => 101, 'name' => 'Admin']);
$roleCrud->update(101, ['name' => 'Super Admin']);
$roleData = $roleCrud->read(101);
echo "Read Role: " . json_encode($roleData) . PHP_EOL;
$roleCrud->delete(101);
```

+ Results 👍
```
User created: {"id":1,"name":"Hoa Dev","email":"hoadev@example.com"}
User updated: {"id":1,"name":"Hoa Dev","email":"hoadev.code@example.com"}
Read User: {"id":1,"name":"Hoa Dev","email":"hoadev.code@example.com"}
User deleted: 1
Role created: {"id":101,"name":"Admin"}
Role updated: {"id":101,"name":"Super Admin"}
Read Role: {"id":101,"name":"Super Admin"}
Role deleted: 101

```






