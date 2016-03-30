<?php namespace App\Http\Controllers;

/*-----------------------------------------------------
* SKILLS MASTERY INSTITUTE - MIS
* -----------------------------------------------------
* Controller Author : Ralph Degoma
* Class             : rhitsReturn
* Purpose           : Returns Random Message
*-----------------------------------------------------
*/

class rrdReturn{

        protected  $status; 
        protected  $message;

	public static function returnMessage($bol, $mes){
        	$this->status = $bol;
                $this->message = $mes;
                $return_value = array();
                $return_value[0] = $this->status;
                $return_value[1] = $this->message;
                return $return_value;
        }

        public function status($stat){
                $this->status = $stat;
                return $this;
        }

        public function message($mes){
                $this->message = $mes;
                return $this;
        }

        public function show(){
                $return_value = array();
                $return_value[0] = $this->status;
                $return_value[1] = $this->message;

                return $return_value;
        }


	




}


?>