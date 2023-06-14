<?php

require_once __DIR__ . '/Account.php';

class Bank {
    private array $accounts = [];

    public function createAccount($name, $number, $balance = 0) {
        if (!$this->isOnlyNumber($number)) {
            throw new Exception('口座番号はユニークでなければなりません');
        }
        $this->accounts[] = new Account($name, $number, $balance);
    }
    public function getAccounts() {
        return $this->accounts;
    }
    private function isOnlyNumber($number): bool {
        foreach ($this->accounts as $account) {
            if ($account->getNumber() === $number) {
                return false;
            }
        }
        return true;
    }
    public function findAccount($number):Account {
        foreach ($this->accounts as $account) {
            if ($account->getNumber() === $number) {
                return $account;
            }
        }
    }
    public function transfer($srcAccount, $dstAccount, $money): void {
        $srcAccount->withdraw($money);
        $dstAccount->deposit($money);
    }
}