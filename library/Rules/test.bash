need-refactoring()
{
  local filename="${1}"
  local classname="${2}"

  egrep --quiet "^final class" "${filename}" && return 1

  egrep --quiet "class (Ip|Zend|Sf)" "${filename}" && return 0

  rg --quiet "extends ${classname}" && return 0

  egrep --quiet "Abstract(Rule|FilterRule)" "${filename}" && return 1

  return 0
}

analyze()
{
  declare filename="${1}"
  declare classname="${2}"

  grep -q "final class" "${filename}" && echo -n "- [x] " || echo -n "- [ ] "

  need-refactoring "${filename}" "${classname}"
  if [[ ${?} -eq 0 ]]; then
    echo "~${classname}~ (needs refactoring)"
    return
  fi

  echo "${classname}"
}

for filename in $(ls -1 *.php); do
  declare classname=${filename/.php/}

  egrep -q '^abstract class' "${filename}" && continue

  analyze "${filename}" "${classname}"
done
