<!--
# Sample information

Patterns:
- Source: _REQUEST ==> Filters:[]
- Sanitization: crypt ==> Filters:[nums, letters, specials]
- Filters complete: Filters:[nums, letters, specials]
- Dataflow: assignment
- Context: xss_apostrophe
- Sink: printf_func_prm__<s>(Print this: %d)

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
$sanitized = crypt($tainted);
$dataflow = $sanitized;
$context = (("Hello to '" . $dataflow) . "'");
printf("Print this: %d", $context);

?>