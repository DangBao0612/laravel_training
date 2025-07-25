<?php
namespace App\Core;

class Validator
{
    private array $errors = [];

    public function required(string $field, $value): static
    {
        if (trim($value) === '') {
            $this->errors[$field][] = 'Không được để trống';
        }
        return $this;
    }
    public function email(string $field, $value): static
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = 'Email không hợp lệ';
        }
        return $this;
    }
    public function min(string $field, $value, int $min): static
    {
        if (strlen($value) < $min) {
            $this->errors[$field][] = "Phải tối thiểu $min ký tự";
        }
        return $this;
    }
    public function fails(): bool
    {
        return $this->errors !== [];
    }
    public function errors(): array
    {
        return $this->errors;
    }
    public function addError($field, $msg) { // Hàm lấy biến error ra ngoài private
    $this->errors[$field][] = $msg;
    }

}
