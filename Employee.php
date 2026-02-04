<?php

class Employee extends Observer
{
    public function __construct(
        string $name,
        private string $role
    ) {
        parent::__construct($name);
    }

    public function update(string $state, string $from): void
    {
        echo "Machine: {$from}, New State: {$state}, Employee & Role : ({$this->name} , {$this->role})" . "\n\n";
    }
}
