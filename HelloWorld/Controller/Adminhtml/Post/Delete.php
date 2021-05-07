<?php
namespace Orange\Helloworld\Controller\Adminhtml\Post;

use Orange\Helloworld\Controller\Adminhtml\Post;

/**
 * Class Delete
 * @package Orange\Helloworld\Controller\Adminhtml\Post
 */
class Delete extends Post
{
    /**
     * @return \Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $this->postFactory->create()
                    ->load($id)
                    ->delete();

                $this->messageManager->addSuccess(__('The Post has been deleted.'));
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                $resultRedirect->setPath('orange_helloworld/*/edit', ['id' => $id]);

                return $resultRedirect;
            }
        } else {
            // display error message
            $this->messageManager->addError(__('Post to delete was not found.'));
        }

        // go to grid
        $resultRedirect->setPath('orange_helloworld/*/');

        return $resultRedirect;
    }
}
