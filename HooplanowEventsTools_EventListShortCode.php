<?php

include_once('HooplanowEventsTools_ShortCodeLoader.php');

class HooplanowEventsTools_EventListShortCode extends HooplanowEventsTools_ShortCodeLoader {

    private $api_params = array();

    /**
     * @param  $atts shortcode inputs
     * @return string shortcode content
     */
    public function handleShortcode($atts) {

	/* Available API search parameters */
	$this->api_params = array(
	    'keywords' => '',
	    'start_date' => date('Y-m-d\TH:i:s-05:00'), // start_date: "2013-04-13T18:30:00-05:00"
	    'end_date' =>  date('Y-m-d\TH:i:s-05:00'),   // end_date:   "2013-04-13T18:30:00-05:00"
	    'place_id' => '',
	    'event_categories' => array()
	);
	
	extract( shortcode_atts( $this->api_params, $atts ) );

	foreach( $this->api_params as $param_key => $param_value ) {
	    if(isset($$param_key) && ! empty($$param_key) ) {
		if($param_key == 'event_categories') {
		    $this->api_params[$param_key] = explode(',', $$param_key);
		} else {
		    $this->api_params[$param_key] = $$param_key;
		}
	    }
	}

	return $this->events();
    }

    public function events() {
	$api_str = $this->createAPICall();
	$json = $this->getEventsJSON( $api_str );

	return $api_str;
    }
    
    public function getEventsJSON( $api_str ) {
	ob_start();
	echo $this->cats;
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
    }

    public function createAPICall() {
	$call_str = '';

	$i = 0;
	$ii = count( $this->api_params );
	foreach( $this->api_params as $param_key => $param_value ) {
	    if(is_array($param_value)) {
		$j = 0;
		$jj = count( $param_value );
		foreach( $param_value as $l ) {
		    $call_str .= $param_key . '[]=' . urlencode( $l );
		    $call_str .= ($j < $jj) ? '&' : '';
		    $j++;
		}
	    } else {
		$call_str .= $param_key . '=' . urlencode( $param_value );
		$call_str .= ($i < $ii) ? '&' : '';
	    }
	    $i++;
	}

	return $call_str;
    }
}