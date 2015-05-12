<?php
include_once "config.php";

$headers = getallheaders();
$hubSignature = $headers['X-Hub-Signature'];
list($algo, $hash) = explode('=', $hubSignature, 2);

$payload = $HTTP_RAW_POST_DATA;
$data = json_decode($payload);
$payloadHash = hash_hmac($algo, $payload, $secret);

// record the event anyway
$db->query("INSERT INTO " . $tables['events'] . " (event, payload) VALUES ('" . $headers['X-GitHub-Event'] . "', '" . $db->escape($payload) ."')");

// if it's not sent from github, kill it.
if ($hash !== $payloadHash) {
  die('Unauthorized');
}

for($i = 0; $i < count($data->commits); $i++) {
  $sha = $data->commits[$i]->id;
  $repo = $data->repository->name;
  $github_username = $data->sender->login;

  $db->query("INSERT INTO " . $tables['pushes'] . " (repository, github_user, commit) VALUES ('" . $repo . "', '" . $github_username . "', '" . $sha ."')");
}

?>

success
