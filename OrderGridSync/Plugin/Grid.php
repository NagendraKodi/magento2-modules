<?php

namespace Orange\OrderGridSync\Plugin;

class Grid{
    
    public function afterRefresh(\Orange\OrderGridSync\Controller\Index\Sync $val, $title=Null){
        $title = $title . " to ";
        echo __METHOD__ . "</br>";
        return [$title];
    }   
}