<?php
namespace anovsiradj\primitive;

class arrays extends primitives
{
	protected $__prefix__ = 'array_';

	public static $FN_WITHOUT_PREFIX = [
		'count',
		'sort','arsort','asort','krsort','ksort','natcasesort','natsort','rsort','uasort','uksort','usort',
		'in_array',
		'current','key','prev','next','end','reset',
		'shuffle',
	];
	public static $FN_DIRECT_RETURN = [
		'count',
		'in_array',
		'key_exists',
		'current','key','prev','next','end','reset',
	];
	public static $FN_CUSTOM_INDEX = [
		'in_array' => 1,
		'key_exists' => 1,
	];
	public static $FN_BY_REFERENCE = [
		'unshift',
		'sort','arsort','asort','krsort','ksort','natcasesort','natsort','rsort','uasort','uksort','usort',
		'prev','next','end','reset',
		'shuffle',
	];
	public static $FN_PASSIVE = [
		'unshift',
		'sort','arsort','asort','krsort','ksort','natcasesort','natsort','rsort','uasort','uksort','usort',
		'shuffle',
	];
	public static $FN_ALIAS = [
		'length' => 'count',
		'sizeof' => 'count',
		'has' => 'in_array', 'ina' => 'in_array',
		/* real isset() return false even though key is exists but with null value */
		'exists' => 'key_exists', 'isset' => 'key_exists',
		'pos' => 'current',
		'sort_reverse' => 'rsort',
		'random' => 'shuffle',
	];

	public function __construct($primitive = [])
	{
		parent::__construct($primitive);
	}

	public function __call($fn_suffix,$args)
	{
		$byref = in_array($fn_suffix,static::$FN_BY_REFERENCE);

		if (isset(static::$FN_ALIAS[$fn_suffix])) $fn_suffix = static::$FN_ALIAS[$fn_suffix];

		$fn = in_array($fn_suffix,static::$FN_WITHOUT_PREFIX) ? $fn_suffix : ($this->__prefix__ . $fn_suffix);

		if (isset(static::$FN_CUSTOM_INDEX[$fn_suffix])) {
			$idx = static::$FN_CUSTOM_INDEX[$fn_suffix];
			$new_args = [];
			$not_ok = true;
			for ($i=0; $i < count($args); $i++) {
				if ($idx === $i) {
					$not_ok = false;
					if ($byref) $new_args[] = &$this->__primitive__;
					else $new_args[] = $this->__primitive__;
					$new_args[] = $args[$i];
				} else $new_args[] = $args[$i];
			}
			if ($not_ok) {
				if ($byref) $new_args[$idx] = &$this->__primitive__;
				else $new_args[$idx] = $this->__primitive__;
			}
			$args = $new_args;

		} else {
			if ($byref) {
				array_unshift($args,null);
				$args[0] = &$this->__primitive__;
			} else array_unshift($args,$this->__primitive__);
		}

		if (in_array($fn_suffix,static::$FN_DIRECT_RETURN)) return call_user_func_array($fn,$args);

		if (in_array($fn_suffix, static::$FN_PASSIVE)) call_user_func_array($fn,$args);
		else $this->__primitive__ = call_user_func_array($fn,$args);

		return $this;
	}
}
