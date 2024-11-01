<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main>
        <section>
            <?php
            
            session_start();
                require_once "clean.php";
                require_once "classes/books.class.php";


                $bookErr = $authorErr = $genreErr = $publisherErr = $pubDateErr = $editionErr = $numCopiesErr = $formatErr = $ageErr = $ratingErr = "";
                $allFieldsInputed = true;

   
                if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
                    if(empty($_POST['title'])){
                        $bookErr = "*Book Title is required.";
                        $allFieldsInputed = false;
                    } else {
                        $title = clean($_POST['title']);
                    }

                    if(empty($_POST['author'])) {
                        $authorErr = "*Lead author is required";
                        $allFieldsInputed = false;
                    } else {
                        $author = clean($_POST['author']);
                    }

                    if(empty($_POST['genre'])) {
                        $genreErr = "*Genre is required";
                        $allFieldsInputed = false;
                    } else {
                        $genre = clean($_POST['genre']);
                    }

                    if(empty($_POST['publisher'])){
                        $publisherErr = "*Publisher is required";
                        $allFieldsInputed = false;
                    } else {
                        $publisher = clean($_POST['publisher']);
                    }
                    
                    if(empty($_POST['publication'])){
                        $pubDateErr = "*Publication Date is required";
                        $allFieldsInputed = false;
                    } else {
                        $pubdate = clean($_POST['publication']);
                    }

                    if(empty($_POST['edition'])){
                        $editionErr = "*Edition is required";
                        $allFieldsInputed = false;
                    } else {
                        $edition = clean($_POST['edition']);
                    } 

                    if(empty($_POST['number'])){
                        $numCopiesErr = "*Number of copies is required";
                        $allFieldsInputed = false;
                    } else {
                        $numCopies = clean($_POST['number']);
                    }

                    if(empty($_POST['radio'])) {
                        $formatErr = "*Format is required";
                        $allFieldsInputed = false;
                    } else {
                        $format = clean($_POST['radio']);
                    }

                    if(empty($_POST['group'])){
                        $ageErr = "*Group age is required";
                        $allFieldsInputed = false;
                    } else {
                        $age = clean($_POST['group']);
                    }

                    if(empty($_POST['rating1'])){
                        $ratingErr = "* Rating is required";
                        $allFieldsInputed = false;
                    } else {
                        $rating  = clean($_POST['rating1']);
                    }

                    $tableDatas = [];
                    if($allFieldsInputed){
                        $objBook = new Books;
                        $objBook->setData($title, $author, $genre, $publisher, $pubdate, $edition, $numCopies, $format, $age, $rating);
                        $tableDatas = $objBook->getData();
                    }


                    
                }
            ?>
            <div class="forms">
                <form action="" method="post">
                    <div class="container">
                        <div>
                            <label for="title">Book Title <span style="color: red;"><?php echo $bookErr?></span></label>
                        </div>
                        <input type="text" name="title" id="title" placeholder="Enter Book Title" >
                    </div>
                    <div class="container">
                        <div>
                            <label for="author">Author <span style="color: red;"><?php echo $authorErr?></span></label>
                        </div>
                        <input type="text" name="author" id="author" placeholder="Enter Lead's Author Name">
                    </div>
                    <div class="container">
                        <div>
                            <label for="genre">Genre <span style="color: red;"><?php echo $genreErr?></span></label>
                        </div>
                        <select name="genre" id="genre">
                            <option value="" selected disabled>Select Genre</option>
                            <option value="fantasy">Fantasy</option>
                            <option value="horror">Horror</option>
                            <option value="literacy">Literacy Fiction</option>
                            <option value="romance">Romance</option>
                            <option value="educational">Education</option>
                        </select><br>
                    </div>
                    <div class="container">
                        <div>
                            <label for="publisher">Publisher  <span style="color: red;"><?php echo $publisherErr ?></span></label>
                        </div>
                        <input type="text" name="publisher" id="publisher" placeholder="Enter Publisher's Company"><br>
                    </div>
                    <div class="container">
                        <div>
                            <label for="pubDate">Publication Date <span style="color: red;"><?php echo $pubDateErr ?></span></label>
                        </div>
                        <input type="date" name="publication" id="publication" placeholder="Publication Date"><br>
                    </div>
                    <div class="container">
                        <div>
                            <label for="edition">Edition <span style="color: red;"><?php echo $editionErr?></span></label>
                        </div>
                        <input type="number" name="edition" id="edition" placeholder="Enter Edition Number"><br>
                    </div>
                    <div class="container">
                        <div>
                            <label for="copies">Number of Copies  <span style="color: red;"><?php echo $numCopiesErr?></span></label>
                        </div>
                        <input type="number" name="number" id="number" placeholder="Enter Number of Copies"><br>
                    </div>
                    <div class="container">
                        <div>
                            <label for="format">Format <span style="color: red;"><?php echo $formatErr?></span></label>
                        </div>
                        <div class="select">
                            <input type="radio" name="radio" value="hardbound" id="hardbound" value="hardbound">Hardbound
                            <input type="radio" name="radio" value="softbound" id="softbound" value="softbound">Softbound <br>
                        </div>
                    </div>
                    <div class="container">
                        <div>
                            <label for="group">Age Group <span style="color: red;"><?php echo $ageErr ?></span></label>
                        </div>
                        <div class="select">
                            <input type="checkbox" name="group" id="kids" value="kids">Kids
                            <input type="checkbox" name="group" id="teens" value="teens">Teens
                            <input type="checkbox" name="group" id="adults" value="adults">Adults <br>
                        </div>
                    </div>
                    <div class="container">
                        <div>
                            <label for="rating">Book Rating <span style="color: red;"><?php echo $ratingErr ?></span></label>
                        </div>
                        <div class="star">
                            <input type="radio" name="rating1" id="rating1" value="poor">
                            <label for="rating1" class="fa fa-star"></label>
                            <input type="radio" name="rating1" id="rating2" value-="fair">
                            <label for="rating2" class="fa fa-star"></label>
                            <input type="radio" name="rating1" id="rating3" value="good">
                            <label for="rating3" class="fa fa-star"></label>
                            <input type="radio" name="rating1" id="rating4" value="very good">
                            <label for="rating4" class="fa fa-star"></label>
                            <input type="radio" name="rating1" id="rating5" value="excellent">
                            <label for="rating5" class="fa fa-star"></label>
                        </div>
                    </div>
                    <div class="container">
                        <label for="description">Description </label>
                        <textarea name="description" id="description" cols="40" rows="10" placeholder="Describe this book"></textarea><br>
                    </div>
                    <button type="submit" name="submit">
                        <span>Submit</span>
                    </button>
                </form>
            </div>
            <div class="tables">
                <table>
                    <tr class="header">
                        <th>Book Title</th>
                        <th>Author's Name</th>
                        <th>Genre</th>
                        <th>Publisher</th>
                        <th>Publication Date</th>
                        <th>Edition</th>
                        <th>Number of Copies</th>
                        <th>Format</th>
                        <th>Age Group</th>
                        <th>Book Rating</th>
                    </tr>
                    <?php if(!empty($tableDatas)): ?>
                        <?php foreach($tableDatas as $datas): extract($datas);?>

                    <tr class="data">
                        <td><?php echo $bookTitle ?></td>
                        <td><?php echo $author ?></td>
                        <td><?php echo $genre ?></td>
                        <td><?php echo $publisher ?></td>
                        <td><?php echo $pubDate ?></td>
                        <td><?php echo $edition ?></td>
                        <td><?php echo $numCopies ?></td>
                        <td><?php echo $format ?></td>
                        <td><?php echo $ageGroup ?></td>
                        <td><?php echo $rating ?></td>
                    </tr>

                    <?php endforeach;?>

                    <?php endif; ?>
                </table>
                
            </div>
        </section>
    </main>
    <script src="https://kit.fontawesome.com/28caaa96a1.js" crossorigin="anonymous"></script>
</body>
</html>





