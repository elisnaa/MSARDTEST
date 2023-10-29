<!--
# Sample information

Patterns:
- Source: _GET ==> Filters:[]
- Sanitization: strripos_prm__<s>(needle) ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_quotes
- Sink: trigger_error_prm__<c>(E_USER_ERROR)

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_GET;
$tainted = $tainted["t"];
$sanitized = strripos($tainted, "needle");
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
trigger_error($context, E_USER_ERROR);

?>