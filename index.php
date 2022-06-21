<html>
	
	<head>
		
		<style>
			
			.wrapper {
			  display: grid;
			  grid-template-columns: repeat(8, 1fr);
			  gap: 10px;
			  grid-auto-rows: 100px;
			  grid-template-areas:
				"a a a a b b b b"
				"a a a a b b b b"
				"c c c c d d d d"
				"c c c c d d d d";
			  align-items: start;
			}
			.item1 {
			  grid-area: a;
			}
			.item2 {
			  grid-area: b;
			}
			.item3 {
			  grid-area: c;
			}
			.item4 {
			  grid-area: d;
			}

			
		</style>
		
	</head>

</html>


<?php

	
	$url = 'https://api.sightmap.com/v1/assets/1273/multifamily/units';

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$headers = array(
	   'API-Key: 7d64ca3869544c469c3e7a586921ba37',
	);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	//for debug only!
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	$resp = curl_exec($curl);
	curl_close($curl);
	

	echo  '<div class="wrapper">';
	 getLessThanEqualsAreaOne($resp);
	getGreaterThanAreaOne($resp);
	echo  '</div>';
	

	function getLessThanEqualsAreaOne($resp) {
		
		$arr = json_decode($resp);
	
		echo '<div class="item1">';
		
		echo '<h1>Those areas whose value are <= 1 </h1>';
		
		echo '<table border="1" width="100%">';
			
			echo '<tr>';
				
				echo '<th> # </th>';
				echo '<th> Unit Number </th>';
				echo '<th> Area (SqFt) </th>';
				echo '<th> Updated_at </th>';
				
			echo '</tr>';
		
		$count=1;
		
		foreach($arr->data as $item) { //foreach element in $arr
		
			if($item->area <= 1) {
				echo '<tr>';
						echo '<td>' . $count . '</td>';
						echo '<td>' . $item->unit_number . '</td>';
						echo '<td>' . ($item->area / 10.764) . " SqFt" . '</td>';
						echo '<td>' . $item->updated_at . '</td>';
				echo '</tr>';
				
				$count++;
			}
			
		}
		
		echo '</table>';
		echo '</div>';
		
	}
	
	function getGreaterThanAreaOne($resp) {
		
		$arr = json_decode($resp);
	
		echo '<div class="item2">';
		
		echo '<h1>Those areas whose value are > 1</h1>';
		
		echo '<table border="1" width="100%">';
			
			echo '<tr>';
				
				echo '<th> # </th>';
				echo '<th> Unit Number </th>';
				echo '<th> Area (SqFt) </th>';
				echo '<th> Updated_at </th>';
				
			echo '</tr>';
		
		$count=1;
		
		foreach($arr->data as $item) { //foreach element in $arr
		
			if($item->area > 1) {
				echo '<tr>';
						echo '<td>' . $count . '</td>';
						echo '<td>' . $item->unit_number . '</td>';
						echo '<td>' . ($item->area / 10.764) . " SqFt" . '</td>';
						echo '<td>' . $item->updated_at . '</td>';
				echo '</tr>';
				
				$count++;
			}
			
		}
		
		echo '</table>';
		echo '</div>';
		
		
	}

?>