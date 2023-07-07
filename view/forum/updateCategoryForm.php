<?php
    $category = $result["data"]['category'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Category</title>
</head>
<body>
    <main>
        <section class="section_updateCategory">

            <h1>Modify this Category</h1>
            
                <div class="updateCategory_wrapper">
                    <form class='formular_base' action="index.php?ctrl=forum&action=updateCategory&id=<?=$category->getId()?>" method="post">
                        
                        <div class="categoryName">
                            <label class="categoryName" for="categoryName">Category Name :</label>
                            <input type="text" name="categoryName" id="categoryName" required>
                        </div>

                        <input id="submit" type="submit" name="updateCategory" value="update">
                    </form>
                </div>
            
            </section>
    </main>
</body>

</html>