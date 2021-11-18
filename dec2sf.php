<?php

	$cmd = (int)$argv[1];

	printf("input: %d\n", $cmd);
	
	$sf = dec2sf($cmd);
	printf("output64: %s\n", $sf);

	$dec = sf2dec($sf);
	printf("output10: %s\n", $dec);

exit;

// 10進数→64進数 変換
function dec2sf(int $input){
	$table64e = array(	'A','B','C','D','E','F','G','H','I','J','K','L','M',
						'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
						'a','b','c','d','e','f','g','h','i','j','k','l','m',
						'n','o','p','q','r','s','t','u','v','w','x','y','z',
						'0','1','2','3','4','5','6','7','8','9','+','/');	
	$tmp = $input;
	$output = "";
	while(1){
		$output = $table64e[$tmp % 64].$output;
		$tmp = floor($tmp / 64);
		if($tmp == 0) break;
	}
	return $output;
}

// 64進数→10進数 変換
function sf2dec($input){
	$char_arr = str_split($input);
	$char_arr = array_reverse($char_arr);
	$table64d = array(	 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
						 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,62, 0, 0, 0,63,52,53,54,55,56,57,58,59,60,61, 0, 0, 0, 0, 0, 0,
						 0, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25, 0, 0, 0, 0, 0,
						 0,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51, 0, 0, 0, 0, 0);
	$i = 0;
	$output = 0;
	foreach($char_arr as $tmp){
		$output = $output + $table64d[ord($tmp)] * pow(64, $i);
		$i++;
	}
	return $output;
}

?>
