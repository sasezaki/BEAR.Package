<?php
namespace FakeVendor\HelloWorld\Resource\App;

use BEAR\Resource\ResourceObject;

class Link extends ResourceObject
{
    public $body = [
        'message' => 'Welcome',
        '_links' => [
            'self' => [
                'href' => '/',
            ],
            'curies' => [
                'href' => 'http://localhost:8080/docs/{?rel}',
                'name' => 'pt',
                'templated' => true
            ],
            'pt:todo' => ['href' => '/todo']
        ]
    ];

    public function onGet()
    {
        return $this;
    }
}
