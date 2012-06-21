<?php

class Ticker {
    public $ticker = null;
    public $evaluation = null;
    public $volume = null;
    public $mkt_cap = null;
    public $beta = null;

    function __construct() {
        $this->ticker = "INVALID";
        $this->evaluation = 0;
        $this->volume = 0;
        $this->mkt_cap = 0;
        $this->beta= 0;
    }
    public function setBeta($beta) { 
        $this->beta = $beta;
    }
    public function getBeta() { 
        return $this->beta;
    }

    /* Inser the user into the database. */                           
    public function insertTicker() {
        $fin_db = "bt_finance";
        $mysql_conn = connect_mysql();
        select_database($mysql_conn, $fin_db);                        
        
        $sql ="INSERT INTO Google_data (ticker, evaluation, volume, mkt_cap, beta) 
            VALUES('$this->ticker', $this->evaluation, $this->volume, $this->mkt_cap, $this->beta)";

        print $sql."\n";
        if(!mysql_query($sql, $mysql_conn))                            
        {
           print "Error inserting Ticker". mysql_error();
        }
        mysql_close($mysql_conn);
    }

}

?>
