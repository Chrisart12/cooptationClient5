<?php
    /**
     * @param mixed $date
     * 
     * @return [type]
     */
    function formateDateTime($date)
    {
        return date('d/m/Y à H:i:s', strtotime( $date ));
    }

    /**
     * @param mixed $date
     * 
     * @return [type]
     */
    function formatShortDateTime($date)
    {
        return date('d/m/Y', strtotime( $date ));
    }

    /**
     * @param mixed $date
     * 
     * @return [type]
     */
    function add_active_route_class($route)
    {
        return Route::is($route) ? 'active' : '';
    }

?>