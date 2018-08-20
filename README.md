# Todo(s)

- `strings` default value for argument-N

# Strings

https://secure.php.net/ref.strings

caveats

- `ctype_*()` is not available
- `str_replace()` cannot passing-by-reference for `$count` (4th arguments)
- `similar_text()` cannot passing-by-reference for `$percent` (3th arguments)
- `sscanf()` ?

be carefull with function which could return `false` (e.g `strpos()`, `stripos()`, etc)

input only string,
output only string,
if output not string,
string will not be updated and the result will be directly returned from `__call()` (e.g `explode`) or `return ((string) false);`

# numbers (todo)

https://secure.php.net/manual/en/ref.math.php

# arrays

https://secure.php.net/manual/en/ref.array.php

caveats

- `compact()` ?
- `extract()` not working / ignored because inside function
- `isset()` aka `array_key_exists()`
- `list()` is not avaiable
- `range()` is not avaiable
