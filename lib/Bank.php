<?php

require_once __DIR__ . '/Account.php';

class Bank {
    private array $accounts = [];

    public function createAccount(string $name, string $number, int $balance = 0) {
        if (!$this->isOnlyNumber($number)) {
            throw new Exception('口座番号はユニークでなければなりません');
        }
        $this->accounts[] = new Account($name, $number, $balance);
    }
    public function getAccounts(): array {
        return $this->accounts;
    }
    private function isOnlyNumber(string $number): bool {
        foreach ($this->accounts as $account) {
            if ($account->getNumber() === $number) {
                return false;
            }
        }
        return true;
    }
    public function findAccount(string $number):Account {
        foreach ($this->accounts as $account) {
            if ($account->getNumber() === $number) {
                return $account;
            }
        }
        throw new Exception('口座が見つかりませんでした');
    }
    public function transfer(string $srcAccountNumber, string $dstAccountNumber, $money): void {
        $srcAccount = $this->findAccount($srcAccountNumber);
        $dstAccount = $this->findAccount($dstAccountNumber);
        $srcAccount->withdraw($money);
        $dstAccount->deposit($money);
    }
}
