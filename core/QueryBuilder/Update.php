<?php

namespace Core\QueryBuilder;

final class Update
{

    private string $table;

    private string $set;

    private array $where;


    public function __construct(string $table)
    {
        $this->table = $table;

    }


    public function __toString(): string
    {
        return 'UPDATE '.$this->table.' SET '.$this->set.($this->where !== [] ? ' WHERE '.\implode(' AND ', $this->where) : '');

    }


    public function set(string $set): self
    {
        $this->set = $set;
        return $this;

    }


    public function where(string ...$where): self
    {
        foreach ($where as $arg) {
            $this->where[] = $arg;
        }

        return $this;

    }


}
