<?php

function deleteTeamById($id) {
  runSafeQuery(
    "DELETE FROM teams WHERE id = ?",
    ["i", $id]
  );

  runSafeQuery(
    "DELETE FROM Players WHERE team_id = ?",
    ['i', $id]
  );
}

function updatePlayerById($playerId, $name, $age, $number, $teamId) {
  runSafeQuery(
    "
    UPDATE players
    SET name=?, age=?, number=?, team_id=?
    WHERE id=?
    ",
    [
      "siiii",
      $name, $age, $number, $teamId, $playerId
    ]
  );
}

function getAllPlayersFromTeam($id) {
  $rawResult = runSafeQuery(
    "
    SELECT * FROM players WHERE team_id=?
    ",
    ["i", $id]
  );

  $result = getAllResults($rawResult);

  return $result;
}

function updateTeam($name, $location, $logo, $teamId) {
  runSafeQuery(
    "UPDATE teams
     SET name=?, location=?, picture=?
     WHERE id=?
    ",
    [
      "sssi",
      $name, $location, $logo, $teamId
    ]
  );
}

function updateProfile($email, $password, $id) {
  $hashedPassword = md5($password);
  runSafeQuery(
    "UPDATE users
     SET email=?, password=?
     WHERE id=?
    ",
    [
      "ssi",
      $email, $hashedPassword, $id
    ]
  );
}

function deleteUserById($id) {
  runSafeQuery(
    "DELETE FROM users WHERE id = ?",
    ["i", $id]
  );

  runSafeQuery(
    "DELETE FROM teams WHERE user_id = ?",
    ["i", $id]
  );
}

function getUserById($id) {
  $rawResult = runSafeQuery(
    "SELECT * FROM users WHERE id = ?",
    ["i", $id]
  );

  $result = getAllResults($rawResult);

  $profile = reset($result); // Get the first result

  return $profile;
}

function getTeamById($id) {
  $rawResult = runSafeQuery(
    "SELECT * FROM teams WHERE id = ?",
    ["i", $id]
  );

  $result = getAllResults($rawResult);

  $team = reset($result); // Get the first result

  return $team;
}

function checkUserLogin($email, $password) {
  $hashedPassword = md5($password);
  $rawResult = runSafeQuery(
    "SELECT * FROM users WHERE email = ?",
    ["s", $email]
  );

  $result = getAllResults($rawResult);
  $user = reset($result);

  if (!$user) {
    die('User could not be found');
  } else if ($user['password'] != $hashedPassword) {
    die("Passwords don't match");
  } else {
    return $user;
  }
}


function saveUser($email, $password) {
  $hashedPassword = md5($password);
  runSafeQuery(
    "INSERT INTO users (email, password) VALUES (?,?)",
    ["ss", $email, $hashedPassword]
  );
}

function getPlayerById($id) {
  // $connection = getConnection();
  // $rawResult = $connection->query("SELECT * FROM dogs WHERE id = $id");
  $rawResult = runSafeQuery(
    "SELECT * FROM Players WHERE id = ?",
    ["i", $id]
  );

  $results = getAllResults($rawResult);
  // $connection->close();

  // reset pulls out the first item
  return reset($results);
}

function getTeamId($id) {
  // $connection = getConnection();
  // $rawResult = $connection->query("SELECT * FROM dogs WHERE id = $id");
  $rawResult = runSafeQuery(
    "SELECT * FROM teams WHERE id = ?",
    ["i", $id]
  );

  $results = getAllResults($rawResult);
  // $connection->close();

  // reset pulls out the first item
  return reset($results);
}

function getTeamsByUserId($id) {
  // $connection = getConnection();
  // $rawResult = $connection->query("SELECT * FROM dogs WHERE id = $id");
  $rawResult = runSafeQuery(
    "SELECT * FROM teams WHERE user_id = ?",
    ["i", $id]
  );

  $results = getAllResults($rawResult);
  // $connection->close();

  // reset pulls out the first item
  return $results;
}

function deletePlayerById($playerId) {
  runSafeQuery(
    "DELETE FROM Players WHERE id = ?",
    ["i", $playerId]
  );
}

function deletePlayerByTeamId($teamId) {
  runSafeQuery(
    "DELETE FROM Players WHERE team_id = ?",
    ["i", $teamId]
  );
}


function createTeam($team,$userId) {
  runSafeQuery(
    "
    INSERT INTO teams (name, location, picture, user_id)
    VALUES (?, ?, ?, ?)
    ",
    [
      "sssi",
      $team['name'],
      $team['location'],
      $team['picture'],
      $userId
    ]
  );
}

function createPlayer($player,$id) {
  runSafeQuery(
    "
    INSERT INTO players (name, number, age, team_id)
    VALUES (?, ?, ?, ?)
    ",
    [
      "siii",
      $player['name'],
      $player['number'],
      $player['age'],
      $id
    ]
  );
}

function getAllTeamsFromDB() {
  // fill the array from the DB
  $teams = [];
  // make a connection
  $connection = getConnection();
  // run a query
  $rawResult = $connection->query("SELECT * FROM teams");
  // get the results
  $teams = getAllResults($rawResult);
  // close the connection
  $connection->close();
  // return the results
  return $teams;
}

function getAllPlayersFromDB() {
  // fill the array from the DB
  $players = [];
  // make a connection
  $connection = getConnection();
  // run a query
  $rawResult = $connection->query("SELECT * FROM Players");
  // get the results
  $players = getAllResults($rawResult);
  // close the connection
  $connection->close();
  // return the results
  return $players;
}

function getAllResults($rawResult) {
  $rows = [];

  // the result->fetch_assoc() call, returns either a row associative array
  // or FALSE when there are no more rows to fetch
  while($row = $rawResult->fetch_assoc()) {
    $rows[] = $row;
  }

  return $rows;
}


function getConnection() {
  $connection = new mysqli(
    'localhost',
    'root',
    'root',
    'nhl'
  );

  if ($connection->connect_error) {
    die('Connection error: ' . $connection->connect_error);
  }

  // if no error, return the connection
  return $connection;
}



function runSafeQuery($query, $params) {

  $connection = getConnection();

  // PREPARE
  $statement = $connection->prepare($query);
  // check if prepare failed

  if ($statement == false) {
    die('Prepare failed: ' . $connection->error);
  }

  // BIND PARAMETERS
  // ex SELECT * FROM dogs WHERE id = ? AND name = ?
  // $statement->bind_param('is', 1, 'spot');
  // s = string, i = int, b = blob/binary

  $statement->bind_param(...$params);
  if ($statement->error) {
    die('Bind failed: ' . $statement->error);
  }

  $success = $statement->execute();

  if($success == false) {
    die('Execute failed: ' . $statement->error);
  }

  $result = $statement->get_result();
  $connection->close();
  return $result;
}
?>
