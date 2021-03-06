<?php
/**
 * This file is part of the BEAR.Package package
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace BEAR\Package\Provide\ResourceView;

use BEAR\Resource\ResourceObject;
use BEAR\Resource\RenderInterface;
use BEAR\Resource\RequestInterface;

/**
 * Request renderer
 */
class JsonRenderer implements RenderInterface
{
    /**
     * {@inheritdoc}
     */
    public function render(ResourceObject $ro)
    {
        // evaluate all request in body.
        /** @noinspection PhpUndefinedFieldInspection */
        if (is_array($ro->body) || $ro->body instanceof \Traversable) {
            array_walk_recursive(
                $ro->body,
                function (&$element) {
                    if ($element instanceof RequestInterface) {
                        /** @var $element callable */
                        $element = $element();
                    }
                }
            );
        }
        $ro->view = @json_encode($ro->body, JSON_PRETTY_PRINT);
        if ($ro->view === false) {
            error_log('json_encode error in ' . __METHOD__  . ':' . json_last_error());
            return '';
        }
        return $ro->view;
    }
}
