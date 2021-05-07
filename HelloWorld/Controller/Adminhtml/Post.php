<?php
namespace Orange\Helloworld\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Orange\Helloworld\Model\PostFactory;

/**
 * Class Post
 * @package Orange\Helloworld\Controller\Adminhtml
 */
abstract class Post extends Action
{
    /** Authorization level of a basic admin session */
    const ADMIN_RESOURCE = 'Orange_Helloworld::post';

    /**
     * Post Factory
     *
     * @var \Orange\Helloworld\Model\PostFactory
     */
    public $postFactory;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    public $coreRegistry;

    /**
     * Post constructor.
     * @param \Orange\Helloworld\Model\PostFactory $postFactory
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        PostFactory $postFactory,
        Registry $coreRegistry,
        Context $context
    )
    {
        $this->postFactory = $postFactory;
        $this->coreRegistry = $coreRegistry;

        parent::__construct($context);
    }

    /**
     * @param bool $register
     * @return bool|\Orange\Helloworld\Model\Post
     */
    protected function initPost($register = false)
    {
        $postId = (int)$this->getRequest()->getParam('id');

        /** @var \Orange\Helloworld\Model\Post $post */
        $post = $this->postFactory->create();
        if ($postId) {
            $post->load($postId);
            if (!$post->getId()) {
                $this->messageManager->addErrorMessage(__('This post no longer exists.'));

                return false;
            }
        }

        if (!$post->getAuthorId()) {
            $post->setAuthorId($this->_auth->getUser()->getId());
        }

        if ($register) {
            $this->coreRegistry->register('orange_helloworld_post', $post);
        }

        return $post;
    }
}
