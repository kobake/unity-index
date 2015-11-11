<html>
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Unity 5.2.2p1 UnityEngine.dll symbol list</title>
	<style>
	*{
		font-family: 'ＭＳ ゴシック';
		font-size: 10pt;
	}
	body{
		padding: 10px 5px;
	}
	h1{
		font-size: 20pt;
		color: #333;
	}
	h1 a{
		font-size: 20pt;
		text-decoration: none;
	}
	.parent{
		margin-top: 10px;
		color: red;
	}
	table{
		margin-left: 20px;
		color: #222;
		border-collapse: collapse;
		margin-top: 6px;
	}
	table td{
		padding: 2px 4px;
	}
	tr{
		border: 1px solid #999;
	}
	td.type{
		padding-right: 10px;
		max-width: 300px;
	}
	td.right{
		padding-right: 10px;
		max-width: 500px;
	}
	td.type, td.right{
		word-break : break-all;
	}
	.foot{
		margin-top: 18px;
		border-top: 1px solid #999;
		padding-top: 4px;
		padding-left: 1px;
	}
	.foot div{
		margin-top: 4px;
	}
	.foot div:nth-child(2){
		margin-top: 12px;
		margin-bottom: 8px;
	}
	</style>
</head>
<body>
<h1>
Unity 5.2.2p1 UnityEngine.dll symbol list
</h1>

<?php
$text = '';
$text = @file_get_contents('cache.html');
if(!$text){
	$text = generateHtml();
	file_put_contents('cache.html', $text);
}
echo $text;
?>

<script type="text/javascript" src="http://clock-up.jp/acc/acctag.js"></script>

<div class="foot">
	<div>
	<a href="http://japan.unity3d.com/" target="_blank">Unity</a> is provided by <a href="http://japan.unity3d.com/company/public-relations/" target="_blank">Unity Technologies</a>.
	</div>

	<div>
	This index is provided by <a href="http://qiita.com/kobake@github" target="_blank">kobake@github</a>.
	</div>
</div>

</body>
</html>


<?php
// ---------------------------------------------------------------------------
function generateHtml(){
	$ret = "";

	$text = file_get_contents("unity5.2.2p1_UnityEngine.txt");
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

