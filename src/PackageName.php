<?php

namespace Jeybin\Packagename;

use Illuminate\Http\Request;
use Jeybin\Packagename\App\Http\Middleware\AcceptJsonHeader;

class PackageName {

    private $variable;

    private $second_variable;

    public static function firstVariable($variable){
        $object = new self;
        $object->variable = $variable;
        return $object;
    }

    public function secondVariable($secondVariable){
        $this->second_variable = $secondVariable;
        return $this;
    }

    public function execute(){
        return [
            'first'=>$this->variable,
            'second'=>$this->second_variable
        ];
    }


}