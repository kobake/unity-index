<?php
global $DLL;
global $VER;
$DLL = "UnityEngine";
$VER = "5.2.3p1";
?>

<?php
$body = '';
//$body = @file_get_contents('cache.html');
//if(!$body){
//}
$body = generateHtml();

$html = file_get_contents("template.html");
$html = str_replace("{\$BODY}", $body, $html);
$html = str_replace("{\$DLL}", $DLL, $html);
$html = str_replace("{\$VER}", $VER, $html);

file_put_contents("{$DLL}.html", $html);
echo $html;
?>


<?php
// ---------------------------------------------------------------------------
function generateHtml(){
	global $DLL;
	global $VER;
	$ret = "";

	$text = file_get_contents("Unity{$VER}_{$DLL}.txt");
	// echo $text;
	$lines = explode("\n", $text);

	$class = "";
	$parentName = "";
	$table = 0;
	foreach($lines as $line){
		$line = rtrim($line);
		if(!preg_match('/^  /', $line)){
			$class = "parent";
			$parentName = $line;
		}
		else{
			$class = "child";
		}
		// 除外
		// if(preg_match('/ (ToString|CompareTo|GetType|GetTypeCode|HasFlag|Equals)\(/', $line)){
		// }
		// 出力
		if($class === "parent"){
			if($table === 1){
				$table = 0;
				$ret .= "</table>\n";
			}
			$ret .= "<div class=\"$class\">\n";
			if(preg_match('/^(UnityEngine|UnityEditor)\./', $line)){
				$name = preg_replace('/^(UnityEngine|UnityEditor)\./', '', $line);
				$ret .= "<a href=\"http://docs.unity3d.com/ScriptReference/{$name}.html\" target=\"_blank\">\n";
				$ret .= $line . "\n";
				$ret .= "</a>\n";
			}
			else{
				$ret .= $line;
			}
			$ret .= "</div>\n";
		}
		else{
			if(preg_match('/ (get_|set_)/', $line)){
			}
			else{
				if($table === 0){
					$table = 1;
					$ret .= "<table cellspacing=\"0\" border=\"0\">\n";
				}
				$cols = explode(' ', trim($line));

				$type = array_shift($cols);
				$other = implode(' ', $cols);
				$line = "<tr><td class=\"type\">$type</td><td class=\"right\">$other</td>\n";

				$ret .= $line;
			}
		}
	}
	if($table == 1){
		$table = 0;
		$ret .= "</table>\n";
	}

	return $ret;
}
?>

