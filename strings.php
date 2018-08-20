<?php
namespace anovsiradj\primitive;

class strings extends primitives
{
	protected $__prefix__ = 'str';

	public static $FN_PREFIX_UNDERLINE = [
		'pad',
		'repeat',
		'replace',
		'ireplace',
		'rot13',
		'shuffle',
		'split',
		'word_count',
	];
	public static $FN_CUSTOM_INDEX = [
		'replace' => 2,
		'explode' => 1,
	];
	public static $FN_DIRECT_RETURN = [
		'crc32','coll','count_chars', // ?
		'spn','cspn', // ?
		'ncmp','natcmp','cmp','casecmp','ncasecmp','natcasecmp', // ?
		'len',
		'pos','ipos','ripos','rpos',
		'split',
		'explode',
		'parse_str',
		'word_count',
		'levenshtein',
		'substr_count',
		'substr_compare',
	];
	public static $FN_WITHOUT_PREFIX = [
		'crc32','count_chars', // ?
		'trim','ltrim','rtrim',
		'addcslashes','addslashes','stripcslashes','stripslashes',
		'chunk_split',
		'substr','substr_count','substr_replace','substr_compare',
		'convert_uudecode','convert_uuencode', // ?
		'htmlentities','html_entity_decode','htmlspecialchars','htmlspecialchars_decode',
		'lcfirst','ucfirst','ucwords',
		'vprintf',
		'bin2hex','hex2bin',
		'md5','sha1',
		'parse_str',
		'quotemeta',
		'quoted_printable_decode','quoted_printable_encode',
		'strip_tags',
		'explode',
		'levenshtein',
		'similar_text',
		'sprintf',
		'soundex',
		'metaphone',
		'nl2br',
		'wordwrap',
	];
	/* todo */
	public static $FN_ALIAS = [
		// 'position' => 'ipos','position_sensitive' => 'pos',
		// 'replace' => 'ireplace','replace_sensitive' => 'replace',
		'length' => 'len',
		'htmlunentities' => 'html_entity_decode',
		'replace_multiple' => 'tr',
		'reverse' => 'rev',
		'lowercase' => 'tolower',
		'uppercase' => 'toupper',
	];

	public function __construct($primitive = '')
	{
		parent::__construct($primitive);
	}

	public function __toString()
	{
		return ((string) $this->__primitive__);
	}

	public function __call($fn_suffix, $args)
	{
		// aliasing
		if (isset(static::$FN_ALIAS[$fn_suffix])) $fn_suffix = static::$FN_ALIAS[$fn_suffix];

		/* DEBUG-1 */ if ($this->__breakpoint__[1]) { var_dump($fn_suffix,$args); die(); }

		if (in_array($fn_suffix, static::$FN_WITHOUT_PREFIX)) $fn = $fn_suffix;
		else {
			$fn = $this->__prefix__;
			if (in_array($fn_suffix, static::$FN_PREFIX_UNDERLINE)) $fn .= '_';
			$fn .= $fn_suffix;
		}

		/* DEBUG-2 */ if ($this->__breakpoint__[2]) { var_dump($fn,$fn_suffix,$args); die(); }

		// inconsistent argument index
		if (isset(static::$FN_CUSTOM_INDEX[$fn_suffix])) {
			$idx = static::$FN_CUSTOM_INDEX[$fn_suffix];
			$new_args = [];
			$not_ok = true;
			for ($i=0; $i < count($args); $i++) {
				if ($idx === $i) {
					$not_ok = false;
					$new_args[] = $this->__primitive__;
				}
				$new_args[] = $args[$i];
			}
			if ($not_ok) $new_args[$idx] = $this->__primitive__; // forced
			$args = $new_args;

		// default argument 0
		} else array_unshift($args, $this->__primitive__);

		/* DEBUG-3 */ if ($this->__breakpoint__[3]) { var_dump($fn,$fn_suffix,$args); die(); }

		// direct return
		if (in_array($fn_suffix, static::$FN_DIRECT_RETURN)) return call_user_func_array($fn,$args);

		/* DEBUG-4 */ if ($this->__breakpoint__[4]) { var_dump($fn,$fn_suffix,$args); die(); }

		$this->__primitive__ = call_user_func_array($fn, $args);

		return $this;
	}
}
