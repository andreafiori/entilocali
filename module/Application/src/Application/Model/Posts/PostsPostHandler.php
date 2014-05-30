<?php

namespace Application\Model\Posts;

use Admin\Model\InputSetupAbstract;

/**
 * Receive data from posts or get and handle operation\s
 * TODO:
 *      set input
 *      set posts \ get \ request data (array)
 *      handle operation and return a result (with or without message?)
 */
class PostsPostHandler extends InputSetupAbstract
{
    private $operation;
    
    private $inputRequest;
    
    public function handleOperation($inputRequest, $operation)
    {
        switch($operation) {
            case("insert"):
               
            break;

            case("update"):
                
            break;
        }
    }
}