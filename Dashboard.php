<?php

require_once __DIR__ . '/includes/Observer.php';

class Dashboard extends Observer
{
    private array $data = [];

    public function __construct()
    {
        parent::__construct("Dashboard");
    }

    public function update(string $state, string $from): void
    {
        $this->data = [
            'machine' => $from,
            'state'   => $state,
        ];
    }

    public function getData(): array
    {
        return $this->data;
    }
}
