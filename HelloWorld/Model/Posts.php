<?php
namespace Orange\HelloWorld\Model;
use Orange\HelloWorld\Api\PostsInterface;
 
class Posts implements PostsInterface
{   
    protected $_postFactory;
    
    public function __construct(
            \Orange\HelloWorld\Model\PostFactory $postFactory
            )
        {
            $this->_postFactory = $postFactory;
        }
    /**
     * Returns greeting message to user
     *
     * @api
     * @param int $id Users name.
     * @return mix Greeting message with users name.
     */
    public function getName($id) {
        // echo "getName called--"; exit;
        $model = $this->_postFactory->create()->load($id);
        $data = $model->getData(); $result = array();
        foreach($data as $v){
            $result[0]['id'] = $data['id'];
            $result[0]['name'] = $data['name'];
        } 
        return $result;
    }
}