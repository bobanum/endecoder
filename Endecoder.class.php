<?php
class Endecoder {
	public $original = "";
	public $modes = "";
	public function __construct($original, $modes=null) {
		$this->original = $original;
		$this->modes = $modes;
	}
	public function __set($name, $val) {
		$set_name = 'set_'.$name;
		if (method_exists($this, $set_name)) {
			return $this->$set_name($val);
		} else {
			throw new Exception("Propriété '$name' inconnue.");
		}
	}
	public function __get($name) {
		$get_name = 'get_'.$name;
		if (method_exists($this, $get_name)) {
			return $this->$get_name();
		} else {
			throw new Exception("Propriété '$name' inconnue.");
		}
	}
	public function __toString() {
		return $this->traiter();
	}
	public function get_final() {
		return $this->traiter();
	}
	static public function traiterChaine($string, $modes) {
		$modes = str_split($modes);
		foreach ($modes as $mode) {
			$string = self::applyMode($string, $mode);
		}
		return $string;
	}
	static public function applyMode($string, $mode) {
		switch($mode) {
			case 'B': return base64_encode($string);
			case 'b': return base64_decode($string);
			case 'G': return gzdeflate($string, 9);
			case 'g': return gzinflate($string);
			case 'U': return urlencode($string);
			case 'u': return urldecode($string);
			case 'W': return convert_uuencode($string);
			case 'w': return convert_uudecode($string);
			case 'X': return bin2hex($string);
			case 'x': return pack('H*', $string);
			case 'M': case 'C': return strtoupper($string);
			case 'm': case 'c': return strtolower($string);
			case '5': return md5($string);
			case 'F': return utf8_encode($string);
			case 'f': return utf8_decode($string);
			default: return $string;
		}
	}
	public function traiter($modes=null) {
		$r = $this->original;
		if (is_null($modes)) {
			$modes = $this->modes;
		} else {
			$this->modes = $modes;
		}
		return static::traiterChaine($r, $modes);
	}
}
