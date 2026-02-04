<?php

declare (strict_types = 1);

require_once __DIR__ . '/Machine.php';
require_once __DIR__ . '/data.php';

$machines  = [];
$employees = [];

// Create Employee instances
foreach ($employeesData as $employeeData) {
    $employees[] = new Employee(
        $employeeData['name'],
        $employeeData['role']
    );
}

// Initialize machines and assign random employee and state
foreach ($machinesData as $machineName) {
    $machine = new Machine($machineName);

    // Attach a random employee
    $randomEmployee = $employees[array_rand($employees)];
    $machine->attach($randomEmployee);

    // Set a random state
    $machine->setState($states[array_rand($states)]);

    $machines[] = $machine;
}
