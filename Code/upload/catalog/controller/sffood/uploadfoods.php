<?php
class ControllerSffoodUploadfoods extends Controller{
    public function index(){   
		$lines = file("C:\\Users\\v-yhe\\git\\SmartYourFood\\Code\\upload\\catalog\\controller\\sffood\\restaurants-dishes.txt", FILE_IGNORE_NEW_LINES);
		$myfile = fopen("foodfiles.sql", "w");
        $this->load->model('sffood/food');
        $count = 1;
        foreach ($lines as $line) {
        	$data = array();
        	$lineArray = explode(";",$line);
        	$data['name'] = $lineArray[0];
			$data['restaurant_id'] = $lineArray[1];
			$data['desc'] = $lineArray[2];
			$data['review_score'] = $lineArray[3];
			$data['tags'] = $lineArray[4];
			$data['img_url'] = $lineArray[5];
			if(isset($lineArray[6])) {
				if($lineArray[6] != null || $lineArray[6] != ""){
					$data['price'] = $lineArray[6];
				}
				else{
					$data['price'] = -1;
				}
				
			}
			
			$data['available'] = $lineArray[7];
			echo "Error row: " . $count . "Price: " . $lineArray[6] . "Available: ". $lineArray[7] ."\r\n";
			$count++;
			fwrite($myfile, $this->model_sffood_food->getAddSql($data));
        }
        fclose($myfile);
        $this->response->setOutput("Done");
    }
}