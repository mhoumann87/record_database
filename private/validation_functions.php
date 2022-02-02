<?php

/*
 * is_blank('string)
 * - validate data presence 
 * - uses trim() so empty spaces don't count
 * - uses '===' to avoid false positive
 * - better than empty() which consider '0' to be empty 
 */
function is_blank($value)
{
  return !isset($value) || trim($value) === ''; 
}

/*
 * has_presence('string)
 * - validate data presence
 * - reverse og is_blank() 
*/
function has_presence($value)
{
  return !is_blank($value);
}

/*
 * has_length_greater_than('string', length)
 * - validate string length
 * - spaces "inside" string counts towards string length
 * - uses trim() to remove spaces before and after 
*/
function has_length_greater_than($value, $min)
{
  $length = strlen(trim($value));
  return $length > $min;
}

/*
 * has_length_less_than('string', length) 
 * - validate string length
 * - spaces "inside" string counts toward string length
 * - uses trim() to remove spaces before and after
*/
function has_length_less_than($value, $max)
{
  $length = strlen(trim($value));
  return $length < $max;
}

/*
 * has_length_exactly('string', length)
 * - validate string length
 * - space "inside" string counts towards string length
 * - uses trim() to remove spaces before and after
*/
function has_length_exactly($value, $exact)
{
  $length = strlen(trim($value));
  return $length == $exact;
}

/*
 * has_length('string', ['min' => 3, 'max' => 5])
 * - validates string length
 * - combines functions greater_than, less_than, exactly
 * - spaces "inside" string counts towards string length
 * - uses trim() to remove spaces before and after
*/
function has_length($value, $options)
{
  if (isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
    return false;
  } elseif (isset($options['max']) && !has_length_less_than($value, $options['max'] + 2)) {
    return false;
  } elseif (isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
    return false;
  } else {
    return true;
  }
}

/*
 * has_exclusion_of([1, 3, 5, 7, 9])
 * -validate exclusion from a set
*/
function has_exclusion_of($value, $set)
{
  return !in_array($value, $set);
}

/*
 * has_string('nobody@nowhere.com', '.com')
 * - validate inclusion of character(s)
 * - strpos() returns string start position or false
 * - uses !== to prevent position 0 from being considered false
 * - strpos is faster than preg_match()
*/
function has_string($value, $required_string)
{
  return strpos($value, $required_string) !== false;
}

/*
 * has_valid_email_format('nobody@nowhere.com')
 * - validate correct format for email addresses
 * - format [chars@chars].[2+ letters]
 * - preg_match() is helpful, uses a regular expression
 * - returns 1 for a match , 0 for no match
 * - http://php.net/manual/en/function.preg-match.php
*/
function has_valid_email_format($value)
{
  $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
  return preg_match($email_regex, $value) === 1;
}

/*
 * has_unique_entries(username and email)
 * - validates uniqueness of entries
 * - for new records, provides only column name and value
 * - for existing records, also provides the id
 * - has_unique_entries(username, email, id)
*/
function has_unique_entries($column, $value, $current_id = 0)
{
  $user = User::find_by_column($column, $value);

  if ($user === false || $user->user_id == $current_id) {
    // * is unique
    return true;
  } else {
    // * value is already in database
    return false;
  }
}
