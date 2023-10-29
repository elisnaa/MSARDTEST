<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: bindec ==> Filters:[letters, specials]
- Filters complete: Filters:[letters, specials]
- Dataflow: assignment
- Context: xss_quotes
- Sink: user_error_prm_

State:
- State: Good
- Exploitable: Not found


# Exploit description

-->
<?php
# Init

# Sample
$tainted = $_REQUEST;
$tainted = $tainted["t"];
$sanitized = bindec($tainted);
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
user_error($context);

?>