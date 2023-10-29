<!--
# Sample information

Patterns:
- Source: _POST ==> Filters:[]
- Sanitization: str_word_count_prm__<i>(1) ==> Filters:[]
- Filters complete: Filters:[]
- Dataflow: assignment
- Context: sql_plain
- Sink: pdo_query_prm__<$>(pdo)

State:
- State: Bad
- Exploitable: Yes


# Exploit description

1. No enclosure and special chars are allowed -> SQL injection
-->
<?php
# Init
$pdo = new PDO("mysql:host=mysql;port=3306;dbname=myDB", "username", "password");


# Sample
$tainted = $_POST;
$tainted = $tainted["t"];
$sanitized = str_word_count($tainted, 1);
$sanitized = implode($sanitized, "_");
$dataflow = $sanitized;
$context = (("SELECT * FROM users WHERE pin =" . $dataflow) . ";");
$results = $pdo->query($context);
foreach ($results as $row){
  echo(htmlentities(print_r($row, true)));
}

?>