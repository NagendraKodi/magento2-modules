<?php
namespace Orange\OrderGridSync\Api;
 
interface SyncInterface
{
   /**
     * @param mixed $orderids
     * @return mixed 
     */
    public function syncOrders($orderids);
}