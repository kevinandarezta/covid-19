<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('url_seo'))
{
	function url_seo($string, $wordLimit = 0){
		$separator = '-';
		
		if($wordLimit != 0){
			$wordArr = explode(' ', $string);
			$string = implode(' ', array_slice($wordArr, 0, $wordLimit));
		}
	
		$quoteSeparator = preg_quote($separator, '#');
	
		$trans = array(
			'&.+?;' => '',
			'[^\w\d _-]' => '',
			'\s+' => $separator,
			'('.$quoteSeparator.')+' => $separator
		);
	
		$string = strip_tags($string);
		foreach ($trans as $key => $val){
			$string = preg_replace('#'.$key.'#i'.(UTF8_ENABLED ? 'u' : ''), $val, $string);
		}
	
		$string = strtolower($string);
	
		return trim(trim($string, $separator));
	}
}
