<?php
namespace App\src\MaSPack\Domain\Employee;

class EmployeeEntity
{
    private $id;
    private $name;
    private $email;
    private $password;

    public function __construct(string $name, string $email, int $id = null, string $password = null)
    {
        $this->id = $id;
        $this->changeName($name);
        $this->changeEmail($email);
        $this->password = $password;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): ?string
    {
        return $this->name;
    }

    public function email(): ?string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }

    public function changeName(string $name)
    {
        if (!isset($name)) {
            throw new EmployeeEntityVoidNameException();
        }

        $this->name = $name;
    }

    public function changeEmail(string $email)
    {
        if (!isset($email)) {
            throw new EmployeeEntityVoidEmailException();
        }

        $this->email = $email;
    }
}
