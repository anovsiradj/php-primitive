<?php
namespace anovsiradj\primitive;

abstract class primitives
{
	public $__prefix__ = '';
	public $__primitive__;
	public $__breakpoint__;

	// public static $FN_WITH_UNDERLINE = [];
	// public static $FN_CUSTOM_INDEX = [];
	// public static $FN_DIRECT_RETURN = [];
	// public static $FN_WITHOUT_PREFIX = [];
	// public static $FN_ALIAS = [];
	// public static $FN_PASSIVE = [];

	public function __construct($primitive) {
		$this->__primitive__ = $primitive;
		$this->__breakpoint__ = array_fill(0, 10, false);
	}

	public function __call($fn,$args) {}

	public function __invoke()
	{
		return $this->__primitive__;
	}
}
