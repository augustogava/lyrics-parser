<?php 

class lyrics {
	public function search_result($search, $filename){

		$getdata_source = getdata("http://www.chartlyrics.com/search.aspx?q=".replace_space($search), $curl);
		$getdata = explode('<th style="width: auto">', $getdata_source);
		$getdata = explode('[END] Page', $getdata[1]);
		$getdata = explode('<a href="', $getdata[0]);
		if(count($getdata) <= 1){
			echo "<center>Não foi encontrada</center>";
		} else {
			foreach($getdata as $pecah){
				$data = explode('</a>', $pecah);
				$data = explode('<td>', $data[0]);
				$data = array_unique(explode('</th>', $data[0]));
				foreach($data as $gay){
					$gay = explode('">', $gay);
					if(!strpos($gay[0], "add.aspx")){
						if(isset($gay[1])){
							$string = $gay[0].":".$gay[1].":".str_replace(".php", "", str_replace("_", ".", $filename));
							echo "<center><a href='?lyrics=".encode_url($string, 'encode')."'>$gay[1]</a><br /></center>";
						}
					}
				}
			}
		}
	}
	public function get_result($request){
		$request = encode_url($request, "decode");
		$getname = explode(':', $request);
		$url = replace_space("http://www.chartlyrics.com".$getname[0]);
		$getlyrics = getdata("$url", $curl);
		$getlyrics = explode('alt="" title="', $getlyrics);
		$getlyrics = explode('" />', $getlyrics[1]);
		$getlyrics = explode('<div id="adlyric">', $getlyrics[1]);
		echo "<center><br><h3><b>$getname[1]</b></h3><br>$getlyrics[0]</center>";
	}
	public function getFirstResult($search, $filename){
		//print "http://www.chartlyrics.com/search.aspx?q=".replace_space($search);
		$getdata_source = getdata("http://www.chartlyrics.com/search.aspx?q=".replace_space($search), $curl);
		$getdata = explode('<th style="width: auto">', $getdata_source);
		$getdata = explode('[END] Page', $getdata[1]);
		$getdata = explode('<a href="', $getdata[0]);
		$achou = false;
		if(count($getdata) > 1){
			

			$pecah =  $getdata[1];
			//foreach($getdata as $pecah){
				$data = explode('</a>', $pecah);
				$data = explode('<td>', $data[0]);
				$data = array_unique(explode('</th>', $data[0]));
				
				//$gay = $data[0];
				foreach($data as $gay){
					$gay = explode('">', $gay);
					if(!strpos($gay[0], "add.aspx")){
						if(isset($gay[1])){
							$string = $gay[0].":".$gay[1].":".str_replace(".php", "", str_replace("_", ".", $filename));
							//echo "<center><a href='?lyrics=".encode_url($string, 'encode')."'>$gay[1]</a><br /></center>";
							//print encode_url($string, 'encode');		
							$achou = true;	
							$this->get_result(encode_url($string, 'encode'));
						}
					}
				}
			//}
		}
	
		if( !$achou ) 
			echo "0";  
	}

}


?>
