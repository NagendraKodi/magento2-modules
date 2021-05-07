<?php
namespace Orange\HelloWorld\Api;
 
interface PostsInterface
{
    /**
     * Returns greeting message to user
     *
     * @api
     * @param int $id Users name.
     * @return mix Greeting message with users name.
     */
    public function getName($id);
}