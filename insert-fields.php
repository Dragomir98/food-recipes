<?php

//check email
if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email must be a valid email address.';
    }
}

//check name
if (!empty($_POST['mealName'])) {
    $meal = $_POST['mealName'];
    if (!preg_match('/^[a-zA-z\s]+$/', $meal)) {
        $errors['mealName'] = 'Meal can contain only letters and spaces.';
    }
}

//check ingredients
if (!empty($_POST['ingredients'])) {
    $ingredients = $_POST['ingredients'];
    if (preg_match('/^[a-zA-z\s]+$/', $ingredients)) {
        $errors['ingredients'] = 'Ingredients must be a comma separated list.';
    }
}

//check image
$imagename = $_FILES["myimage"]["name"];

//Get the content of the image and then add slashes to it 
$imagetmp = addslashes(file_get_contents($_FILES['myimage']['tmp_name']));
