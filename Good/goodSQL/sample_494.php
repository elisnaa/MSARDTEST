<!--
# Sample information

Patterns:
- Source: filter_input_prm__<c>(INPUT_GET)_<s>(t)_<c>(FILTER_UNSAFE_RAW) ==> Filters:[]
- Sanitization: gettype_check_prm__<s>(integer) ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: sql_apostrophe
- Sink: db2_exec_prm__<$>(db)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init
$dsn = "DATABASE=myDB;HOSTNAME=ibm_db2;PORT=50000;PROTOCOL=TCPIP;UID=db2inst1;PWD=ibm_db2_pw;";
$db = db2_connect($dsn, "", "");


# Sample
$tainted = filter_input(INPUT_GET, "t", FILTER_UNSAFE_RAW);
if(gettype($tainted) == "integer")
{
  $sanitized = $tainted;
  $dataflow = $sanitized;
  $context = (("SELECT * FROM users WHERE password ='" . $dataflow) . "';");
  $stmt = db2_exec($db, $context);
  if($stmt == false)
  {
    die(db2_stmt_errormsg());
  }
  while(($row = db2_fetch_array($stmt)))
  {
    echo(htmlentities(print_r($row, true)));
  }
}

?>