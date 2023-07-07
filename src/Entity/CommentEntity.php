<?php

namespace App\Entity;

use Core\Entity\Hydrate;

abstract class CommentEntity extends Hydrate
{

    protected int $id;

    protected string $content;

    protected string $date;

    protected string $validation;

    protected int $userId;

    protected int $articleId;


    public function getId(): int
    {
        return $this->id;

    }


    public function setId(int $id): self
    {
        $this->id = $id;
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


    public function getValidation(): string
    {
        return $this->validation;

    }


    public function setValidation(string $validation): self
    {
        $this->validation = $validation;
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


    public function getArticleId(): int
    {
        return $this->articleId;

    }


    public function setArticleId(int $articleId): self
    {
        $this->articleId = $articleId;
        return $this;

    }


}
