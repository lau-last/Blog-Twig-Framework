<?php

namespace Core\Http;

final class Request
{

    private array $server;

    private ?array $post;


    public function __construct()
    {
        $this->server = $_SERVER;
        $this->post = $_POST;

    }


    public function getUri(): string
    {
        return $this->server['REQUEST_URI'];

    }


    public function getPost(): ?array
    {
        return $this->post;

    }


}
