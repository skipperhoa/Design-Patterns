<?php
interface CrudInterface {
    public function create(array $data): void;
    public function read(int $id): ?array;
    public function update(int $id, array $data): void;
    public function delete(int $id): void;
}

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

// Factory cho User
$userFactory = new UserFactory();
$userCrud = $userFactory->createCrud();

// Thực hiện các thao tác CRUD cho User
$userCrud->create(['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com']);
$userCrud->update(1, ['email' => 'john.doe@example.com']);
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

