<?php

include('config/db_connect.php');

if (isset($_POST['delete'])) {
    $delete_id = mysqli_real_escape_string($connection, $_POST['delete_id']);

    $sql = "DELETE FROM meal_ideas WHERE id = $delete_id";
    echo $delete_id;

    if (mysqli_query($connection, $sql)) {
        //on success
        header('Location: index.php');
    } else {
        //on error
        echo 'Query error: ' . mysqli_error($connection);
    }
}

//check GET req id parameter
if (isset($_GET['id'])) {
    //get the id from the url
    $id = mysqli_real_escape_string($connection, $_GET['id']);

    //get the current meal id from the db
    $sql = "SELECT * FROM meal_ideas WHERE id = $id";

    //get the query result
    $result = mysqli_query($connection, $sql);

    //fetch the result in array format
    $meal = mysqli_fetch_assoc($result);

    //free the result and close the connection
    mysqli_free_result($result);
    mysqli_close($connection);
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<div class="container m-auto">
    <div class="recipe-details card align-items-center mx-auto">
        <?php if ($meal) : ?>
            <div class="card-body w-100 d-flex">
                <div class="recipe-img d-flex justify-content-center">
                    <?php echo '<img  src="data:image/jpeg;base64,' . base64_encode($meal['mealImage']) . '" class="rounded-circle"/>'; ?>
                </div>
                <div class="recipe-text w-100 d-flex flex-column">
                    <h4><?php echo htmlspecialchars($meal['mealName']); ?></h4>
                    <p>Submitted by: <?php echo htmlspecialchars($meal['email']) ?></p>
                    <p>Date: <?php echo date($meal['created_at']) ?></p>
                    <h4>Ingredients:</h4>
                    <p><?php echo htmlspecialchars($meal['ingredients']) ?></p>

                    <div class="details-options d-flex justify-content-end mt-auto">
                        <button class="btn btn-warning mx-3 btn-lg">
                            <a class="text-decoration-none text-dark" href="update-recipe.php?id=<?php echo $meal['id']; ?>">Update</a>
                        </button>

                        <form action="details.php" method="POST" class="text-end">
                            <input type="hidden" name="delete_id" value="<?php echo $meal['id'] ?>">
                            <input type="submit" value="Delete" name="delete" class="btn btn-danger btn-lg">
                        </form>

                    </div>
                </div>
            </div>

        <?php else : ?>
            <?php header('Location: index.php'); ?>
        <?php endif; ?>
    </div>
</div>

<?php include('templates/footer.php'); ?>

</html>