<?php

class Parental {
    public function __construct() {
    }

    public function parentFunction() :string {
        return __METHOD__ . "\n";
    }
}

class Child 
    extends Parental {

    public function __construct() {
        parent::__construct();
    }

    public function childFunction() :string {
        return __METHOD__ . "\n";
    }
}

class Creator {
    static public function getChild() :mixed {
        return new Child();
    }
}


class User {
    private Child $Child;
    public function __construct() {
        $this->Child = Creator::getChild();
    }

    public function __toString() :string {
        return 
            $this->Child->parentFunction().
        $this->Child->childFunction();
    }
}

$User = new User();
echo $User;

