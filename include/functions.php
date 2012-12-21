<?php

/**判断标题长度函数
*$title标题字符串
*$titlelen标题不能超过的最大长度*/
function titlen($title,$titlelen)
{
	$len = strlen($title);
    if ($len <= $titlelen)
		{
        $title1 = $title;
	} else {
			$title1 = substr($title,0,$titlelen); 
			$parity= 0;

			for($i=0;$i<$titlelen;$i++)
			{ 
				$temp_str=substr($title,$i,1); 
				if(Ord($temp_str)>127) $parity+=1; 
			} 
			if($parity%2==1) $title1=substr($title,0,($titlelen-1))."..."; 
			else $title1=substr($title,0,$titlelen)."..."; 
	}
return $title1;
}


/**
* 截取中文部分字符串
*
* 截取指定字符串指定长度的函数,该函数可自动判定中英文,不会出现乱码
* @access public
* @param string $str 要处理的字符串
* @param int $strlen 要截取的长度默认为10
* @param string $other 是否要加上省略号,默认会加上
* @return string
*/
function cutstr($str,$strlen=10,$other=true)
{
	$j=0;
	for($i=0;$i<$strlen;$i++)
	{
		if(ord(substr($str,$i,1))>0xa0) 
		{
			$j++;
		}
	}
	if(($j%2) != 0) 
	{
	$strlen++;
	}

	$rstr=substr($str,0,$strlen);
	if(strlen($str)>$strlen && $other)
	{
		$rstr.='……';
	}
	return $rstr;
}

?>