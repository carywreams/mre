<?php

/**
 * 20211006
 * Reported: https://github.com/phan/phan/issues/4569
 * 
 * 20211007
 * Resolved: https://github.com/phan/phan/commit/67775dc17877ec9bbcf7005ad3a51c5621f17381
 *
 * concerned with reporting of PhanPossiblyFalseTypeArgumentInternal
 * PDOStatement::fetchAll()
 *  >= 8.0.0 always returns an array
 *  <  8.0.0 could return a falsy value or an array of results
 */
class mre0000 {

    private array|false $items;
    private PDO $dbh;
    private PDOStatement|false $sth;

    public function __construct() {
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=mre_database', 'mre_user', 'mre_password');
            $this->sth = $this->dbh->prepare("SELECT * from month");
        } catch (PDOException | Exception $e) {
            print_r($e);
        }
    }

    public function driver() {

        try {

            $this->sth->execute();
            // NO ISSUES FLAGGED BY PHAN
            /* ? phan accepts this construct because still believes false is possible */
            if ($this->items = $this->sth->fetchAll()) {
                printf("[%04d] Fetched %d rows in the result set.\n",__LINE__,count($this->items));
            }

            $this->sth->execute();
            $this->items = $this->sth->fetchAll();
            // PhanPossiblyFalseTypeArgumentInternal FLAGGED
            if (count($this->items) > 1) {
                printf("[%04d] Fetched %d rows in the result set.\n",__LINE__,count($this->items));
            }

        } catch (PDOException | Exception $e) {
            print_r($e);
        }
    }
}

$mre = new mre0000();
$mre->driver();

?>
