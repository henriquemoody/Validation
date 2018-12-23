declare -A REFERENCES
declare MARKER=${1:-'-'}

string_pad()
{
  local string="${1}"
  local limit=${2}
  local length=${#string}
  local pad="${3:- }"

  if [[ ${#string} -gt ${limit} ]]; then
    echo "${string}"
    return
  fi

  echo -n "${string}"
  seq --separator="${pad}" $[limit-length] | tr --delete '[:digit:]'
}

create_documentation()
{
  # Usage: create_documentation RULE REFERENCES [MARKER]
  local rule=${1}
  local related_rules=${2}
  local marker=${3}
  local filename="rules/${rule}.md"
  local links=$(egrep '^\[.+\]: .+' "${filename}")
  local related_links=$(
    tr ':' '\n' <<< ${related_rules} |
      sort -u |
      grep -v '^$' |
      grep -v "^${rule}$" |
      sed -E "s,(.+),${marker} [\1](\1.md),g"
  )
  local template_placeholders=$(
    egrep '\{\{.+\}\}' "../library/Exceptions/${rule}Exception.php" |
      cut -d '>' -f 2- |
      tr '{' '\n' |
      grep '}' |
      cut -d '}' -f 1 |
      sort -u |
      sed -E 's,^(.+)$,`{{\1}}`,g'
  );
  local max_length=$(wc --max-line-length <<< "${template_placeholders}")
  if [[ ${max_length} -lt 11 ]]; then
    max_length=11
  fi

  # "Description" section
  sed -nE '/^# /,/^## Changelog/p' "${filename}" | egrep -v '^## Changelog'

  # "Template placeholders" section
  echo '## Template placeholders'
  echo
  echo " $(string_pad 'Key' $[max_length+1]) | Description"
  echo "-$(string_pad '' $[max_length+1] '-')-|-------------"
  echo " $(string_pad '`{{name}}`' $[max_length+1]) | Input or user-defined name of the rule."
  echo " $(string_pad '`{{input}}`' $[max_length+1]) | Input validated by the rule."

  for template_placeholder in $(fgrep -v '`{{name}}`' <<< ${template_placeholders}); do
    echo " $(string_pad ${template_placeholder} ${max_length} ' ') |"
  done

  # "Changelog" section
  echo
  sed -nE '/^## Changelog/,/^\*\*\*/p' "${filename}" | fgrep -v '***'

  # "See also" section
  if [[ ! -z "${related_links}" ]]; then
    echo "***"
    echo "See also:"
    echo
    echo "${related_links}"
  fi

  # Index of links
  if [[ ! -z "${links}" ]]; then
    echo
    echo "${links}"
  fi
}

while read filename; do
  declare rule=$(cut -d '/' -f 2  <<< "${filename}" | cut -d '.' -f 1)
  declare related_rules=$(
    egrep '\[.+\]\(.+\.md\)' "${filename}" |
      sed -E 's,.*\[.+\]\((.+)\.md\).*,\1,' |
      egrep -v '(BaseAccount|Vxdigit|comparable-values)'
  )

  for related_rule in ${related_rules}; do
    REFERENCES[${related_rule}]=${REFERENCES[${related_rule}]}:${rule}
  done

  REFERENCES[${rule}]="${REFERENCES[${rule}]}:$(tr '\n' ':' <<< ${related_rules})"
done < <(find rules -type f)

for rule in ${!REFERENCES[@]}; do
  echo "Recreating documentation for ${rule}"
  create_documentation "${rule}" "${REFERENCES[${rule}]}" "${MARKER}" > /tmp/rule.md
  cat /tmp/rule.md > rules/${rule}.md
done
