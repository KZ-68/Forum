<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
</head>
<body>
    <main>
        <section class="section_createCategory">

            <h1>Create new Category</h1>
            
                <div class="createCategory_wrapper">
                    <form class='formular_base' action="index.php?ctrl=forum&action=createCategory" method="post">
                        
                        <div class="categoryName">
                            <label class="categoryName" for="categoryName">Category Name :</label>
                            <input type="text" name="categoryName" id="categoryName" required>
                        </div>

                        <input id="submit" type="submit" name="createCategory" value="Create">
                    </form>
                </div>
            
        </section>
        <button class="backTo-btn"><a href="index.php?ctrl=forum&action=categoriesList">Back to the Categories</a></button>
    </main>
</body>

</html>