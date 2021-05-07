<?php
namespace Orange\Helloworld\Controller\Adminhtml\Post;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Helper\Js;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Orange\Helloworld\Controller\Adminhtml\Post;
use Orange\Helloworld\Model\PostFactory;

/**
 * Class Save
 * @package Orange\Helloworld\Controller\Adminhtml\Post
 */
class Save extends Post
{
    /**
     * JS helper
     *
     * @var \Magento\Backend\Helper\Js
     */
    public $jsHelper;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Orange\Helloworld\Model\PostFactory $postFactory
     * @param \Magento\Backend\Helper\Js $jsHelper
     */
    public function __construct(
        Context $context,
        Registry $registry,
        PostFactory $postFactory,
        Js $jsHelper
    )
    {
        parent::__construct($postFactory, $registry, $context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        
        if ($data = $this->getRequest()->getPost('post')) { 
            /** @var \Orange\Helloworld\Model\Post $post */
            $post = $this->initPost();
            $this->prepareData($post, $data);

            $this->_eventManager->dispatch('orange_helloworld_post_prepare_save', ['post' => $post, 'request' => $this->getRequest()]);

            try {
                $post->save();

                $this->messageManager->addSuccess(__('The post has been saved.'));
                $this->_getSession()->setData('orange_helloworld_post_data', false);

                if ($this->getRequest()->getParam('back')) {
                    $resultRedirect->setPath('orange_helloworld/*/edit', ['id' => $post->getId(), '_current' => true]);
                } else {
                    $resultRedirect->setPath('orange_helloworld/*/');
                }

                return $resultRedirect;
            } catch (LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Post.'));
            }

            $this->_getSession()->setData('orange_helloworld_post_data', $data);

            $resultRedirect->setPath('orange_helloworld/*/edit', ['id' => $post->getId(), '_current' => true]);

            return $resultRedirect;
        }

        $resultRedirect->setPath('orange_helloworld/*/');

        return $resultRedirect;
    }

    /**
     * @param $post
     * @param array $data
     * @return $this
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    protected function prepareData($post, $data = [])
    {
        //set specify field data
        $post->addData($data);
        return $this;
    }
}
