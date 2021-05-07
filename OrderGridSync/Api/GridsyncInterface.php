<?php
namespace Orange\OrderGridSync\Api;
 
interface GridsyncInterface
{
   /**
     * @param mixed $orderids
     * @return mixed 
     */
    public function syncOrders($orderids);
}