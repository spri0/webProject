<?php
include_once 'dbconfig.php';
if(!$user->is_loggedin())
{
 $user->redirect('login.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>whvorwhbr</title>
        <!-- CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        
        <!--Spotify
        var templateSource = document.getElementById('results-template').innerHTML,
        template = Handlebars.compile(templateSource),
        resultsPlaceholder = document.getElementById('results'),
        playingCssClass = 'playing',
        audioObject = null;

        var fetchTracks = function (albumId, callback) {
        $.ajax({
        url: 'https://api.spotify.com/v1/albums/' + albumId,
        success: function (response) {
            callback(response);
            }
        });
        };

        var searchAlbums = function (query) {
        $.ajax({
        url: 'https://api.spotify.com/v1/search',
        data: {
            q: query,
            type: 'album'
            },
            success: function (response) {
            resultsPlaceholder.innerHTML = template(response);
            }
        });
    };

        results.addEventListener('click', function (e) {
        var target = e.target;
        if (target !== null && target.classList.contains('cover')) {
            if (target.classList.contains(playingCssClass)) {
            audioObject.pause();
        } else {
            if (audioObject) {
                audioObject.pause();
            }
            fetchTracks(target.getAttribute('data-album-id'), function (data) {
                audioObject = new Audio(data.tracks.items[0].preview_url);
                audioObject.play();
                target.classList.add(playingCssClass);
                audioObject.addEventListener('ended', function () {
                    target.classList.remove(playingCssClass);
                });
                audioObject.addEventListener('pause', function () {
                    target.classList.remove(playingCssClass);
                    });
                });
            }
        }
    });

    document.getElementById('search-form').addEventListener('submit', function (e) {
        e.preventDefault();
        searchAlbums(document.getElementById('query').value);
    }, false); </script> -->
        
        
    </head>
  <body>
        <div class="container" style="width:60%;">
        <h2 align="center">Online Music Store</h2>
        
        <!--Login
        <a href="login.php">
        <button>Admin</button>
        </a> -->
        
              
    <?php
    $query = "SELECT * FROM products ORDER BY id ASC";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result))
        {
            ?>
            <div class="col-md-3">
    <form method="post" action="shopping.php?action=add&id=<?php echo $row["id"]; ?>">
    <div style="border: 1px solid #eaeaec; margin: -1px 19px 3px -1px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding:10px;" align="center">
    <img src="<?php echo $row["image"]; ?>" class="img-responsive">
    <h5 class="text-info"><?php echo $row["p_name"]; ?></h5>
    <h5 class="text-danger">$ <?php echo $row["price"]; ?></h5>
    <input type="text" name="quantity" class="form-control" value="1">
    <input type="hidden" name="hidden_name" value="<?php echo $row["p_name"]; ?>">
    <input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
    <input type="submit" name="add" style="margin-top:5px;" class="btn btn-default" value="Add to Bag">
    </div>
    </form>
    </div>
    <?php
}
}
?>
    <div style="clear:both"></div>
    <h2>My Shopping Bag</h2>
    <div class="table-responsive">
    <table class="table table-bordered">
    <tr>
    <th width="40%">Product Name</th>
    <th width="10%">Quantity</th>
    <th width="20%">Price Details</th>
    <th width="15%">Order Total</th>
    <th width="5%">Action</th>
    </tr>
    <?php
if(!empty($_SESSION["cart"]))
{
$total = 0;
foreach($_SESSION["cart"] as $keys => $values)
{
?>
    <tr>
    <td><?php echo $values["item_name"]; ?></td>
    <td><?php echo $values["item_quantity"] ?></td>
    <td>$ <?php echo $values["product_price"]; ?></td>
    <td>$ <?php echo number_format($values["item_quantity"] * $values["product_price"], 2); ?></td>
    <td><a href="shopping.php?action=delete&id=<?php echo $values["product_id"]; ?>"><span class="text-danger">X</span></a></td>
    </tr>
    <?php 
$total = $total + ($values["item_quantity"] * $values["product_price"]);
}
?>
    <tr>
    <td colspan="3" align="right">Total</td>
    <td align="right">$ <?php echo number_format($total, 2); ?></td>
    <td></td>
    </tr>
    <?php
}
?>
        </table>
        </div>
        </div>
<iframe src="https://embed.spotify.com/?uri=spotify%3Auser%3A1248680873%3Aplaylist%3A4OKJEahlNYntx5b6ayOO8z&view=coverart&theme=white" width="280" height="380" frameborder="0" 
        allowtransparency="true"></iframe>

   </body>
</html>
