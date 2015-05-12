<?php
include_once "config.php";

$record = $db->get_row("SELECT * FROM " . $tables['pushes'] . " WHERE COMMIT LIKE '" . $_POST['sha'] . "%' AND github_user = '" . $_POST['github_user'] . "' LIMIT 1");
if ($record) {
  echo json_encode($record);
} else {
  echo '{"error": "no commit found"}';
}

?>
