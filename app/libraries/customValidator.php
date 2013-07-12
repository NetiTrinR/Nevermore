<?php

class CustomValidator extends Illuminate\Validation\Validator {

    public function validateMinecraft($attribute, $value, $parameters)
    {
    	$check_mcUser = file_get_contents('http://www.minecraft.net/haspaid.jsp?user='.$attribute.'');
		if ($check_mcUser == 'true') {
			return true;
		}
		return false;
    }
}
