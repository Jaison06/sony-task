<?php

require_once __DIR__ . '/includes/MachineManagement.php';

require_once __DIR__ . '/Employee.php';

class Machine extends MachineManagement
{
    public function __construct(private string $name)
    {}

    public function getName(): string
    {
        return $this->name;
    }
}

