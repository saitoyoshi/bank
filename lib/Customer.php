<?php

require_once __DIR__ . '/Account.php';

class Customer {
    private string $name;
    private string $address;
    private array $accounts = [];

    public function __construct(string $name, string $address)
    {
        $this->name = $name;
        $this->address = $address;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getAddress(): string {
        return $this->address;
    }
    public function getAccounts(): array {
        return $this->accounts;
    }
    public function addAccount(Account $account): void {
        $this->accounts[] = $account;
    }
    public function getAccountByNumber(string $number): Account {
        foreach ($this->accounts as $account) {
            if ($account->getNumber() === $number) {
                return $account;
            }
        }
        throw new Exception('口座番号が見つかりませんでした');
    }
}
