<?php

abstract class Observer
{
    public function __construct(protected string $name)
    {}

    abstract public function update(string $state, string $from): void;
}
