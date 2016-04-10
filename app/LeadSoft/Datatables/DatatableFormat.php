<?php namespace App\LeadSoft\Datatables;

/*-----------------------------------------------------
* SKILLS MASTERY INSTITUTE - MIS
* -----------------------------------------------------
* Controller Author : Ralph Degoma
* Class             : datatableFormat
* Purpose           : For data table format
*-----------------------------------------------------
*/

class DatatableFormat{
	public static function format($data){
      $output = array();
      foreach ($data as $item) {
          $output[] = $item;
      }

      $i = 0;
      foreach($output as $key => $vendor){   
        $row_id = $i;
        $output[$key]->row_id = $row_id;
        $i++;
      }
      return json_encode($output);
  }
}

?>