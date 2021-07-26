<?php
error_reporting(0);
?>

<?php
include('config/db_connect.php');

$meal = $email = $ingredients = '';
$errors = array('email' => '', 'mealName' => '', 'ingredients' => '', 'mealImage' => '', 'submitError' => '');

if (count($_POST) > 0) {
    include('insert-fields.php');

    mysqli_query($connection, "UPDATE meal_ideas set id='" . $_POST['id'] . "', email='" . $_POST['email'] . "', mealName='" . $_POST['mealName'] . "', ingredients='" . $_POST['ingredients'] . "' ,mealImage='" . $_POST['mealImage'] . "' ,imageName='" . $_POST['imageName'] . "' WHERE id='" . $_POST['id'] . "'");
    header('Location: index.php');
}
$result = mysqli_query($connection, "SELECT * FROM meal_ideas WHERE id='" . $_GET['id'] . "'");
$row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<section class="container update-form d-flex flex-column align-items-center my-auto">
    <h4 class="text-center h2">Update recipe:</h4>
    <form method="post" action="" enctype="multipart/form-data" id="update_form">
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
        <div class="alert-danger p-2"><?php echo $errors['mealImage']; ?></div>

        <div class="text-center mt-4">
            <input type="submit" id="msg_submit" name="submit" value="Submit" class="btn btn-secondary">
        </div>
        <div class="alert-danger p-2"><?php echo $errors['submitError']; ?></div>
    </form>

    <div class="mt-4">
        <button class="btn btn-primary back">Back</button>
    </div>

</section>

<?php include('templates/footer.php'); ?>

</html>