<?php
error_reporting(0);
?>

<?php
include('config/db_connect.php');

$meal = $email = $ingredients = '';
$errors = array('email' => '', 'mealName' => '', 'ingredients' => '', 'mealImage' => '', 'submitError' => '');

if (isset($_POST['submit'])) {
    include('insert-fields.php');

    if (array_filter($errors)) {
        //cycle through arr and perform callback function on it
        $errors['submitError'] = 'There are errors in the form.';
    } else {
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $mealName = mysqli_real_escape_string($connection, $_POST['mealName']);
        $ingredients = mysqli_real_escape_string($connection, $_POST['ingredients']);

        //create sql
        $sql = "INSERT INTO meal_ideas(email,mealName,ingredients,mealImage,imageName) VALUES('$email','$mealName','$ingredients','$imagetmp','$imagename')";

        //save to db and perform check
        if (mysqli_query($connection, $sql)) {
            //on success redirect user if there are no errors:
            header('Location: index.php');
        } else {
            //error
            echo 'Query error: ' . mysqli_error($connection);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<section class="container add-form d-flex flex-column align-items-center my-auto">
    <h4 class="text-center h2">Add new recipe:</h4>
    <form action="add.php" id="add_form" class="mt-2" method="POST" enctype="multipart/form-data">
        <label for="email">Your Email*</label>
        <input class="form-control" type="text" name="email" value="<?php echo htmlspecialchars($email) ?>" required>
        <div class="alert-danger p-2"><?php echo $errors['email']; ?></div>

        <label for="mealName">Meal name*</label>
        <input class="form-control" type="text" name="mealName" value="<?php echo htmlspecialchars($meal) ?>" required>
        <div class="alert-danger p-2"><?php echo $errors['mealName']; ?></div>

        <label for="ingredients">Required ingredients*</label>
        <input class="form-control" type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>" required>
        <div class="alert-danger p-2"><?php echo $errors['ingredients']; ?></div>

        <label for="myimage">Image*</label>
        <input class="form-control" type="file" name="myimage" required>
        <div class="alert-danger p-2"><?php echo $errors['mealImage'] ?></div>

        <div class="text-center mt-4">
            <input type="submit" name="submit" value="Submit" class="btn btn-secondary">
        </div>
        <div class="alert-danger p-2"><?php echo $errors['submitError'] ?></div>
    </form>
</section>

<?php include('templates/footer.php'); ?>

</html>