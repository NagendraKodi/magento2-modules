<?php

namespace Orange\HelloWorld\Plugin;

class SamplePlugin{
    
    public function beforeSetTitle(\Orange\HelloWorld\Controller\Sample\Plugin $subject, $title){
        $title = $title . " to ";
        echo __METHOD__ . "</br>";
        return [$title];
    }
    
    public function afterGetTitle(\Orange\HelloWorld\Controller\Sample\Plugin $subject, $result){
        echo __METHOD__ . "</br>";
        return '<h1>'. $result . ' Orange.com ' .'</h1>';
    }
    
    public function aroundGetTitle(\Orange\HelloWorld\Controller\Sample\Plugin $subject, callable $proceed){
        echo __METHOD__ . "</br> - Before proceed() </br>";
         $result = $proceed();
        echo __METHOD__ . "</br> - After proceed() </br>";
        return $result;
    }
        
        
}