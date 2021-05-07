<?php
namespace Orange\OrderGridSync\Model;
use Orange\OrderGridSync\Api\GridsyncInterface;
 
class Gridsync implements GridsyncInterface
{   
    /**
     * @var \Magento\Sales\Model\ResourceModel\Grid[]
     */
    protected $_grids;
    
    protected $_syncFactory;  
    
    
    /**
     * @param array $grids
     */
    public function __construct(
        \Magento\Sales\Model\ResourceModel\GridPool $grids,
        \Orange\OrderGridSync\Model\SyncFactory $syncFactory
    ) {
       $this->_grids = $grids;
       $this->_syncFactory = $syncFactory;
    }
    
    /**
     * get the order ids from api response and sync.
     * @param mixed $orderids
     * @return mixed 
     */
    public function syncOrders($orderids) {
        foreach ($orderids as $v){
            $id = $v['id']; $info = $v['affiliate_information'];
            $model = $this->_syncFactory->create();			
            $model->setId($id);
            $model->setAffiliateInformation($info);
            $model->save();
            /**
             * @var \Magento\Sales\Model\ResourceModel\Grid[]
             */
            $this->_grids->refreshByOrderId($id);
        }
        $message = "Successfully Synced.";
        return $message;     
    }
}