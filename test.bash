#!/usr/bin/env bash

phpt_create()
{
  local phpt_filename="${1}"
  local php_test="${2}"
  local expectation="${3}"

  {
    echo '--FILE--'
    echo '<?php'
    echo
    echo 'require "vendor/autoload.php";'
    echo
    {
      echo 'use Respect\Validation\Validator as v;'
      echo 'use Respect\Validation\Exceptions\ValidationException;'
      echo 'use Respect\Validation\Exceptions\NestedValidationException;'
      egrep '^(use|namespace) ' <<< "${php_test}"
    } | sort | uniq
    echo
    egrep -v '^(use|namespace) ' <<< "${php_test}"
    echo '?>'
    echo '--EXPECT--'
    echo "${expectation}"
  } > "${phpt_filename}"
}

for filename in $(find docs -name '*.md' | grep -v vendor | egrep 'docs/[A-Z][a-z]+.md'); do
  declare phpt_filename="tests/integration/$(sed -E 's,/([A-Z]),/\l\1,' <<< "${filename/md/phpt}")"
  declare php_code=$(
    sed -n '/```php/,/```/p' "${filename}" |
      sed '/^```/d' |
      sed -E "s,'([^']+\.(jpg|png|txt|gif|sh))','tests/fixtures/\1',g"
  )
  declare php_test=$(
    sed -E 's,^((v::|\$).+validate\(.+\));\s?//\s*(true|false).*,var_dump(\1)\;,g' <<< "${php_code}"
  )
  declare expectation=$(
    sed -E 's,^((v::|\$).+validate\(.+\));\s?//\s*(true|false).*,bool(\3),g' <<< "${php_code}" |
      egrep 'bool\('
  )

  if [[ -z "${php_code}" ]]; then
      continue
  fi

  phpt_create "${phpt_filename}" "${php_test}" "${expectation}"
done
