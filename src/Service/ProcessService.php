<?php
/**
 * Created by PhpStorm.
 * User: ycy
 * Date: 2/26/18
 * Time: 8:27 PM
 */

namespace Service;


class ProcessService
{
    static $codeList = [];

    static $processIds = [];

    public function run(){
        while(true){
            if(count(self::$codeList) > 0){
                foreach (self::$codeList as $code){
                    $process = $this->createProcess($code);
                    self::$processIds[$code] = $process->pid;
                }
            }else{
                sleep(10);
            }
        }
    }

    /**
     * @param $code
     * @return \swoole_process
     */
    protected function createProcess($code){

        return null;
    }

    protected function rebootProcess($code){

    }

    protected function waitProcess(){
        
    }

}