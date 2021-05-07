<?php
namespace Orange\OrderGridSync\Controller\Index;
class Sync extends \Magento\Framework\App\Action\Action
{
protected $_pageFactory;
protected $_postFactory;

/**
* @var \Magento\Sales\Model\ResourceModel\Grid[]
*/

protected $grids;
/**
 * @param array $grids
 */
public function __construct(
        \Magento\Sales\Model\ResourceModel\GridPool $grids,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory            
        )
{       
        $this->grids = $grids;
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);            
}

public function execute()
{
   
    /**
     * @var \Magento\Sales\Model\ResourceModel\Grid[]
     */
     $this->grids->refreshByOrderId(81);
   
}              
}
