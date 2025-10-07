<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";
    $email    = isset($_POST["email"]) ? trim($_POST["email"]) : "";
    $age      = isset($_POST["age"]) ? trim($_POST["age"]) : "";

    $errors = [];

    if ($username === "") {
        $errors[] = "Username is required.";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters long.";
    }

    if ($password === "") {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    if ($email === "") {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if ($age === "") {
        $errors[] = "Age is required.";
    } elseif (!is_numeric($age) || $age < 1) {
        $errors[] = "Age must be a valid positive number.";
    }

    if (empty($errors)) {
        $query = http_build_query([
            "username" => $username,
            "email"    => $email,
            "age"      => $age
        ]);
        header("Location: profile.html?$query");
        exit;
    } else {
        echo "<h3 style='color:red;'>Validation Errors:</h3>";
        echo "<ul style='color:red;'>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        echo "<a href='index.html'>🔙 Go Back</a>";
    }
} else {
    header("Location: index.html");
    exit;
}
?>
