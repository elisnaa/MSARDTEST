<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_SANITIZE_FULL_SPECIAL_CHARS) ==> Filters:[Filtered(", &, ', <, >)]
- Sanitization: filter_var_prm__<c>(FILTER_UNSAFE_RAW) ==> Filters:[]
- Filters complete: Filters:[Filtered(", &, ', <, >)]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: mysqli_real_query_method_prm__<$>(db)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$servername = "mysql";
$username = "username";
$password = "password";
$dbName = "myDB";
$db = new mysqli($servername, $username, $password, $dbName);


# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$sanitized = filter_var($tainted, FILTER_UNSAFE_RAW);
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
$db->real_query($context);
$results = $db->use_result();
while(($row = $results->fetch_row()))
{
  echo(htmlentities(print_r($row, true)));
}

?>