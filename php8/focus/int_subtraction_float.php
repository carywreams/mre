<?php

class mre0001 {

    private int $a;
    private int $b;
    private int $adiff;
    private int $bdiff;

    public function __construct() {
        $this->a = 5;
        $this->b = 17;
        $this->adiff = $this->a - 1;
        $this->bdiff = $this->b-1;
    }

    public function __toString() :string {
        $buf = <<<EOBUFFER
a: $this->a
b: $this->b
adiff: $this->adiff
bdiff: $this->bdiff
EOBUFFER;

        return $buf;
    }
}

$mre = new mre0001();
echo $mre;
