<?php


/**
 *
 */
class Flight extends model
{

    function __construct()
    {
        parent::__construct();
    }

    public function bothGood( $to, $from)
    {
        if((bool) $to && (bool) $from) {
            return "Your flight is most likely to go on time";
        } else {
            //use Bayesian theorem yo predict outcome and possible magnitude of delay
            return "It is likely your flight will be delayed. Sorry, we can not estimate the number of minutes because of in-adequate data";
        }
    }


}
