<?php
abstract class AbstractModel {

	private $db;
	private $changed;
		
	public function __construct(IDatabase $db){
		$this->db=$db;
		$this->changed=false;
	}
	public function getDB() {
		return $this->db;
	}
	public function hasChanges() {
		return $this->changed;
	}
	protected function didChange($changed=true) {
		$this->changed=$changed;
	}
	
	// helper functions
	protected function safeSqlString($value) {
		if ($value===null) {
			return 'null';
		} else {
			$escapedValue=$this->getDB()->escape($value);
			return "'$escapedValue'";
		}
	}
	protected function safeSqlDate($value) {	// value can be string or time-stamp ( time-stamp is preferred)
		if ($value===null) {
			return 'null';
		} else {
			if (is_int($value) ) {
				$escapedValue = date('Y-m-d H:i:s',$value);
			} else {
				$escapedValue=$this->getDB()->escape($value);
			}
			return "'$escapedValue'";
		}
	}
	protected function safeSqlNumber($value) {
		if ($value===null) {
			return 'null';
		} else if (is_numeric($value)) {
			return "$value";
		} else {
			$escapedValue=$this->getDB()->escape($value);	// this is overkill for most cases
			return "'$escapedValue'";
		}
	}
	protected function safeSqlBoolean($value) {
		if ($value===null) {
			return 'null';
		} else if ($value){
			return 'true';
		} else {
			return 'false';
		}
	}	
	/* 
		Static shared validation functions
		(These are 'helper' functions)
	*/
	protected static function checkExistingId($db,$id,$sql) {
		if ($id==null){
			return false;
		}
		if (!is_int($id) && !(ctype_digit($id))) {
			return false;
		}
		$rows=$db->query($sql);
		return count($rows)==1;
	}	
	public static function errorInRequiredField($field, $value, $maxSize) {
		if ($value==null || strlen($value)==0) {
			return $field.' must be specified';
		}
		return self::errorInOptionalField($field, $value, $maxSize);
	}
	public static function errorInOptionalField($field, $value, $maxSize) {
		if ($value==null || strlen($value)==0) {
			return null;
		}
		if (strlen($value)>$maxSize) {
			return $field.' must have no more than '.$maxSize.' characters';
		}
		return null;
	}

	// required date cannot be null, must have valid date
	public static function errorInRequiredDateField($field, $value, $format='dd-mm-yy') {
		if ($value==null || strlen($value)==0) {
			return $field.' must be specified';
		}
		return self::errorInDateField($field,$value.$format);
	}		
	// can be null, otherwise must match format 
	public static function errorInDateField($field, $value, $format='d-m-y') {
		if ($value==null || strlen($value)==0) {
			return null;
		}
		$seps='/[-\.\/ ]/';  // allow hyphen (-), full stop (.), forward slash (/), space as separators 
		$parts = preg_split( $seps, $value );
		if (count($parts) === 3) {				
			switch( $format ) {
				case 'd-m-y':	// standard
					list( $d, $m, $y ) = $parts;
					break;
				case 'm-d-y':	// US
					list( $m, $d, $y ) = $parts;
					break;						
				case 'y-m-d':	// ISO, Japanese
					list( $y, $m, $d ) = $parts;
					break;
				case 'y-d-m':	// strange US format
					list( $y, $d, $m ) = $parts;
					break;
				default:
					throw new LogicException( "Invalid Date Format Specified" );
			}
			if (checkdate( $m, $d, $y )) {
				return null;
			}
		}
		return $field.' must have a valid date in '.$format.' format';
	}
	
	// required date cannot be null, must have valid date
	public static function errorInRequiredNumericField($field, $value, $decimalPlaces=0, $minValue=null, $maxValue=null) {

	if ($value==null || strlen($value)==0) {
			return $field.' must be specified';
		}
		return self::errorInNumericField($field,$value,$decimalPlaces, $minValue, $maxValue);
	}		
	// can be null, otherwise must match format 
	public static function errorInNumericField($field, $value, $decimalPlaces=0, $minValue=null, $maxValue=null) {
		if ($value==null || strlen($value)==0) {
			return null;
		}
		if (!is_int($decimalPlaces) || $decimalPlaces < 0) {
			throw new LogicException('Invalid decimal places specified');
		}
		$decimalPlaces = (int) $decimalPlaces;	
		$pattern="/^-?[0-9]+(?:\.[0-9]{0,$decimalPlaces})?$/";
		if ( preg_match($pattern, $value)) {
			$number = (float) $value;
			if ( ($minValue===null || $number >= $minValue) && 
			     ($maxValue===null || $number <= $maxValue) ) {
				return null;
			}
		}
		$error=' must be a number';
		if ( ($minValue !==null) && ($maxValue !==null) ) {
			$error.=" in the range $minValue to $maxValue";
		} elseif ($minValue!==null) {
			$error.=" of at least $minValue";
		} elseif ($maxValue !==null) {
			$error.=" of at most $maxValue";
		}
		
		if ($decimalPlaces > 0) {
			$error.=", with no more than $decimalPlaces decimal places.";
		}
		return $field.$error;
	}

	public static function assertNoError ($error) {
		if ($error!==null ){
			throw new InvalidDataException($error);
		}
	}	
	public static function assertPositiveInteger ($value) {
		if (! self::isPositiveInteger($value)) {
			throw new InvalidDataException('value must be a positive integer');
		}
		return (int) $value;
	}
	public static function isPositiveInteger ($value) {
		if (is_int($value) && $value >= 0) {
			return true;
		} elseif (ctype_digit($value)) {
			return true;
		}
		return false;
	}	
}
?>