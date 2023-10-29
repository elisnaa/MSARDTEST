<!--
# Sample information

Patterns:
- Source: filter_input_array_prm__<c>(INPUT_GET)_<array>(<ae_k>(<s>(t),<c>(FILTER_SANITIZE_FULL_SPECIAL_CHARS))) ==> Filters:[Filtered(", &, ', <, >)]
- Sanitization: strstr_prm__<s>(1) ==> Filters:[]
- Filters complete: Filters:[Filtered(", &, ', <, >)]
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
$tainted = filter_input_array(INPUT_GET, ["t" => FILTER_SANITIZE_FULL_SPECIAL_CHARS]);
$tainted = $tainted["t"];
$sanitized = strstr($tainted, "1");
$dataflow = $sanitized;
$context = (("Hello to \"" . $dataflow) . "\"");
user_error($context);

?>