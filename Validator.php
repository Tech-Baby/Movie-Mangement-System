<?php
include_once "Session.php";
class Validator{
private $data;

private $errors;

private $validation_rules;

private $messages = [

    'required' => "This field is required",
    "number" => "This field must be a number",
    "email" => "This field must be an email",
    "date" => "This field must be a valid date"

];


public function __construct($data,$validation_rules){

    $this->data = $data;
    $this->validation_rules = $validation_rules;                
}

public function validate(){

    foreach($this->validation_rules as $field => $rule){

        $field_value = $this->getFieldValue($field);

        $rule = ucfirst($rule);

        $method_to_call = "validate$rule";
        
         // if method returns false (validation fails)
        if(!$this->$method_to_call($field_value)){

            //add errors to our errors 
           $this->addError($rule,$field);

        }

    }

}

public function getFieldValue($field){

    return $this->data[$field];

}
private function validateRequired($value){

    return !empty($value);

}
public function validateNumber($value){
    return is_numeric($value);
}
public function validateEmail($value){

    return filter_var($value, FILTER_VALIDATE_EMAIL);

}

public function validateDate($value){

    $format = 'Y-m-d';
    $d = DateTime::createFromFormat($format, $value);
    return $d && $d->format($format) === $value;
    
}
public function addError($rule,$field){

    $rule = strtolower($rule);
    $message = $this->messages[$rule];

    $this->errors[$field] = $message;

    Session::set('errors', $this->errors);

}
public static function getErrorForField($field){

    if(Session::exists('errors')){

        $errors = Session::get('errors');

        if(key_exists($field,$errors)){

            $error =  $errors[$field];
            unset($_SESSION['errors'][$field]);
            return $error;

        }
        
    }
     
     

}
public function passes(){

    return empty($this->errors);

}


}










?>