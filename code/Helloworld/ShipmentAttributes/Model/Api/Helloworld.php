<?php
namespace Helloworld\ShipmentAttributes\Model\Api;


class Helloworld {

     public function getData(){
         $response=['success'=>false];
         try{
             $response=['success'=>true, 'message'=>'Hello World'];
         }catch (\Exception $e){
             $response=['success'=>false, 'message'=>$e->getMessage()];
         }
         $returnArray=json_encode($response);

         return $returnArray;
     }
}