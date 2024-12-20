<?php
// 1. Interface cho vai trò (Role)
interface Role {
    public function getPermissions(): array;
}

/* 
2. Các lớp cụ thể cho vai trò
Tạo các lớp cho vai trò User và Admin:
 */
class UserRole implements Role {
    public function getPermissions(): array {
        return ['view_posts', 'comment'];
    }
}

class AdminRole implements Role {
    public function getPermissions(): array {
        return ['view_posts', 'comment', 'create_posts', 'delete_posts', 'manage_users'];
    }
}

/* 
3. Interface cho người dùng (User)
Tạo một interface chung cho người dùng:
*/

interface User {
    public function getRole(): Role;
    public function getName(): string;
}

/* 
4. Các lớp cụ thể cho User và Admin
Triển khai các lớp User và Admin:
*/

class RegularUser implements User {
    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getRole(): Role {
        return new UserRole();
    }

    public function getName(): string {
        return $this->name;
    }
}

class AdminUser implements User {
    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function getRole(): Role {
        return new AdminRole();
    }

    public function getName(): string {
        return $this->name;
    }
}
/* 
5. Factory Method
Sử dụng Factory Method để tạo người dùng:
*/

abstract class UserFactory {
    abstract public function createUser(string $name): User;

    public function getUserInfo(string $name): string {
        $user = $this->createUser($name);
        $role = $user->getRole();

        return sprintf(
            "User: %s\nRole: %s\nPermissions: %s\n",
            $user->getName(),
            get_class($role),
            implode(', ', $role->getPermissions())
        );
    }
}

class RegularUserFactory extends UserFactory {
    public function createUser(string $name): User {
        return new RegularUser($name);
    }
}

class AdminUserFactory extends UserFactory {
    public function createUser(string $name): User {
        return new AdminUser($name);
    }
}

/* 
6. Sử dụng Factory Method
Dùng các factory để tạo User và Admin:
*/

function clientCode(UserFactory $factory, string $name) {
    echo $factory->getUserInfo($name) . PHP_EOL;
}

// Tạo User
$userFactory = new RegularUserFactory();
clientCode($userFactory, 'John Doe');

// Tạo Admin
$adminFactory = new AdminUserFactory();
clientCode($adminFactory, 'Jane Smith');
