<?php
session_start();

require_once 'db.php';

$username = "";
$email    = "";
$errors   = array();

if (isset($_POST['register_submit'])) {
	register();
}

if (isset($_POST['login_submit'])) {
	login();
}

if (isset($_POST['add_rdv'])) {
    addRdv();
}

function addRdv(){
    global $db, $errors;
    $id_patient     =   e($_POST['id_patient']);
    $date_patient   =   e($_POST['date']);
    if (empty($id_patient)) {
        array_push($errors, "veuillez sélectionner un patient");
    }
    if (empty($date_patient)) {
        array_push($errors, "veuillez sélectionner l'heure de réservation");
    }
    if (!empty($id_patient)) {
        $sql = "SELECT * FROM patient WHERE id_patient=?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id_patient);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) == 0) {
            array_push($errors, "veuillez sélectionner un patient");
        }
    }
    if (count($errors) == 0){
        $medecin = mysqli_query($db, "SELECT id,username FROM `users` WHERE profil_type='medecin' ORDER BY id DESC LIMIT 1");
        if (mysqli_num_rows($medecin) == 1){
            $medecin = mysqli_fetch_assoc($medecin);
            $id_medecin = $medecin["id"];
        }else{
            $id_medecin = 1;
        }

        $query = "INSERT INTO rdv (date_rdv, id_patient, id_medecin) VALUES ('$date_patient', $id_patient, $id_medecin)";
        mysqli_query($db, $query);

        $_SESSION['success']  = "Rendez-vous ajouter";
        header('Location: rdv.php');
    }

}
include('func.php');
function register()
{
	global $db, $errors;

	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_one =  e($_POST['password_one']);
	$password_two  =  e($_POST['password_two']);

	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (!empty($email)) {
		$sql = "SELECT * FROM users WHERE email=?"; // SQL with parameters
		$stmt = $db->prepare($sql);
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$result = $stmt->get_result();
		if (mysqli_num_rows($result) > 0) {
			array_push($errors, "Email already exist");
		}
	}
	if (empty($password_one)) {
		array_push($errors, "Password is required");
	}
	if ($password_one != $password_two) {
		array_push($errors, "The two passwords do not match");
	}


	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = password_hash($password_one, PASSWORD_DEFAULT); //encrypt the password before saving in the database

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, email, user_type, password) 
						  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: home.php');
		} else {
			$query = "INSERT INTO users (username, email, user_type, password) 
						  VALUES('$username', '$email', 'User', '$password')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');
		}
	}
}

function getUserById($id)
{
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

function getDrsSql($sort = "all"){
    $sql = "SELECT * FROM users WHERE profil_type='medecin'";
    return ($sql);
}

function getPatsSql($sort = "all"){
    $sql = "SELECT * FROM patient";
    return ($sql);
}

function login()
{
	global $db, $username, $errors;

	// grap form values
    $loginType_input = e($_POST['loginType']);
	$username_input = e($_POST['username']);
	$password_input = e($_POST['password']);

    if (!(isset($loginType_input) && ($loginType_input == "medecin" OR $loginType_input == "administrateur" OR $loginType_input == "assistante"))) {
        $loginType_input = "assistante";
    }
	if (empty($username_input)) {
		array_push($errors, "le nom d'utilisateur est requis");
	}
	if (empty($password_input)) {
		array_push($errors, "le mot de passe est requis");
	}

	if (count($errors) == 0) {
		$query = "SELECT * FROM users WHERE username='$username_input' AND profil_type='$loginType_input' AND active=true LIMIT 1";
		$results = mysqli_query($db, $query);
		if (mysqli_num_rows($results) == 1) {
			$logged_in_user = mysqli_fetch_assoc($results);
			$hashed = $logged_in_user["password"];
			$verify = password_verify($password_input, $hashed);
			if ($verify) {
				if (true) {
					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "Tu es maintenant connecté";
					header('location: dashboard.php');
				}
			} else {
				array_push($errors, "Identifiants non valides");
			}
		} else {
			array_push($errors, "Identifiants non valides");
		}
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	} else {
		return false;
	}
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['profil_type'] == 'administrateur') {
		return true;
	} else {
		return false;
	}
}

function isDr()
{
    if (isset($_SESSION['user']) && $_SESSION['user']['profil_type'] == 'medecin') {
        return true;
    } else {
        return false;
    }
}

function isAs()
{
    if (isset($_SESSION['user']) && $_SESSION['user']['profil_type'] == 'assistante') {
        return true;
    } else {
        return false;
    }
}

function e($val)
{
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error()
{
	global $errors;

	if (count($errors) > 0) {
		foreach ($errors as $error) {
			echo '<div class="alert alert-warning">';
			echo $error . '<br>';
			echo '</div>';
		}
	}
}
