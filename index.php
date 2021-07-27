<?php
//include file with db connection
include('config/db_connect.php');

//query for all meals
$sql = 'SELECT mealImage, imageName, mealName, ingredients, id FROM meal_ideas ORDER BY created_at';
$collapseId = 1;

//make query to the db and get result
$result = mysqli_query($connection, $sql);

//fetch the resulting rows as an array
$meals = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);

//close connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<h2 class="text-dark fw-bold text-center py-3">Recipes</h2>

<div class="search-container mb-5 px-3 mx-auto w-100 position-relative">
    <input type="text" class="form-control live-search" name="live_search" id="live_search" autocomplete="off" placeholder="Search ...">
    <span class="reset position-absolute"><i class="far fa-lg fa-times-circle"></i></span>
    <div id="search_result" class="search-result"></div>
</div>

<div class="container grid-items">
    <?php foreach ($meals as $meal) : ?>
        <div class="card align-items-center">

            <?php echo '<img  src="data:image/jpeg;base64,' . base64_encode($meal['mealImage']) . '" class="card-img-top index-img m-3 rounded-circle" alt="' . $meal['imageName'] . '"'; ?> <div class="card-body w-100">
                <div class="card-bottom w-100 mt-auto position-relative">
                    <a class="h6 collapse-toggler w-100 d-flex justify-content-between text-decoration-none p-3" data-toggle="collapse" href="#toggleCollapse<?php echo $collapseId ?>" role="button" aria-expanded="false" aria-controls="toggleCollapse">
                        <span class="collapse-title"><?php echo htmlspecialchars($meal['mealName']) ?></span><span class="fas fa-stack-1x fa-inverse fa-plus-square position-relative"></span>
                    </a>
                    <div class="collapse multi-collapse text-center position-absolute w-100" id="toggleCollapse<?php echo $collapseId ?>">
                        <ul class="px-0 py-2">
                            <?php foreach (explode(',', $meal['ingredients']) as $ingredient) : ?>
                                <li><?php echo htmlspecialchars($ingredient) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="recipe-options d-flex justify-content-center align-items-center pb-2">
                        <a href="details.php?id=<?php echo $meal['id'] ?>" class="btn btn-primary text-decoration-none mx-1">Learn more</a>

                        <form action="details.php" method="POST" class="mx-1">
                            <input type="hidden" name="delete_id" value="<?php echo $meal['id'] ?>">
                            <input type="submit" value="Delete" name="delete" class="btn btn-danger">
                        </form>
                    </div>
                </div>
            </div>

            <?php $collapseId++; ?>
        <?php endforeach; ?>
        </div>

        <?php if (count($meals) < 1) : ?>
            <div class="mx-auto w-50 text-center h2 alert alert-danger">there are no recipes</div>
        <?php endif; ?>

        <?php include('templates/footer.php'); ?>

</html>