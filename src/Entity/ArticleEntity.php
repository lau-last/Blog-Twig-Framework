<?php

namespace App\Entity;

use Core\Entity\Hydrate;

abstract class ArticleEntity extends Hydrate
{

    protected int $id;

    protected string $title;

    protected string $head;

    protected string $content;

    protected string $date;

    protected int $userId;


    public function getId(): int
    {
        return $this->id;

    }


    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;

    }


    public function getTitle(): string
    {
        return $this->title;

    }


    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;

    }


    public function getHead(): string
    {
        return $this->head;

    }


    public function setHead(string $head): self
    {
        $this->head = $head;
        return $this;

    }


    public function getContent(): string
    {
        return $this->content;

    }


    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;

    }


    public function getDate(): string
    {
        return $this->date;

    }


    public function setDate(string $date): self
    {
        $this->date = $date;
        return $this;

    }


    public function getUserId(): int
    {
        return $this->userId;

    }


    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;

    }


}
