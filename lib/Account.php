<?php

class Account {
    private string $name;
    private string $number;
    private int $balance;

    public function __construct(string $name, string $number, int $balance = 0)
    {
        $this->name = $name;
        $this->number = $number;
        if ($balance < 0) {
            throw new Exception('残高は０以上設定です');
        }
        $this->balance = $balance;
    }

    public function getBalance(): int {
        return $this->balance;
    }
    public function getNumber(): string {
        return $this->number;
    }
    public function getName(): string {
        return $this->name;
    }
    public function deposit(int $money): void {
        if ($money < 0) {
            throw new Exception('預金額は0以上でなければなりません');
        }
        $this->balance += $money;
    }
    public function withdraw(int $money): void {
        if ($money < 0) {
            throw new Exception('引き出し額は0以上でなければなりません');
        }
        if (!$this->isWithDrawable($money)) {
            throw new Exception('残高よりも多くのお金を下ろそうとしています');
        }
        $this->balance -= $money;
    }
    private function isWithDrawable($money): bool {
        return $this->balance >= $money;
    }
}
