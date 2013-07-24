<?php

class CWS_Fragment_Cache {
	const GROUP = 'cws-fragments';
	var $key;
	var $ttl = 3600;

	public function __construct( $key, $ttl ) {
		$this->key = $key;
		$this->ttl = $ttl;
	}

	public function output() {
		$output = wp_cache_get( $this->key, self::GROUP );
		if ( !empty( $output ) ) {
			// It was in the cache
			echo $output;
			return true;
		} else {
			ob_start();
			return false;
		}
	}

	public function flush() {
		wp_cache_delete( $this->key, self::GROUP );
	}

	public function store() {
		$output = ob_get_flush(); // Flushes the buffers
		wp_cache_add( $this->key, $output, self::GROUP, $this->ttl );
	}
}