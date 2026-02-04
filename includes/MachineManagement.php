<?php

require_once __DIR__ . '/Observer.php';

abstract class MachineManagement
{
    protected string $state;
    protected array $observers = [];

    public function setState(string $state): void
    {
        $this->state = $state;
        $this->notifyAllObservers();
    }

    public function attach(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    protected function notifyAllObservers(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this->state, $this->getName());
        }
    }

    abstract public function getName(): string;
}
