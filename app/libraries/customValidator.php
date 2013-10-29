<?php
Validator::extend('minecraft', function($attribute, $value, $parameters)
{
	$check_mcUser = file_get_contents('http://www.minecraft.net/haspaid.jsp?user='.$value.'');
	if ($check_mcUser == 'true') {
		return true;
	}
	return false;
});