<?php require_once './commentShow.php' ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Comments PHP</title>
        <link href="./styles.css" rel="stylesheet" type="text/css"/>
        <script type="text/javascript" src="./jquery-3.1.0.min.js"></script>
        <script type="text/javascript" src="./comment.js"></script>
    </head>
    <body>
        <div id="comments">
            <ul id="commentRoot">
                <?php 
                    echo $comments; 
                ?>   
                <li id="newComment">
                    <div class="commentContent">
                        <p id="errorSymbols" class="error"></p>
                        <div id="cancelComment">X</div>
                        <h6 class="comment">Name:*
                            <input name="userName" type="text" placeholder="John"> 
                            <span id="errorName"></span>
                        </h6>
                        <h6 class="comment">Email:* 
                            <input name="userEmail" type="text" placeholder="exampl@example.com" > 
                            <span id="errorEmail"></span>
                        </h6>
                        <h6 class="comment">Website:
                            <input name="userHost" type="text" placeholder="http://facebook.com">
                            <span></span>
                        </h6>
                        <div class="comment">
                            Comment:*  
                            <textarea name="text" rows="6" cols="10" placeholder="Very important comment"></textarea>
                        </div>
                        <p id="errorComment" class= "error"></p>
                        <div>  
                            <button>Submit</button><img class="loader" >
                        </div>  
                    </div>
                </li>  
            </ul>
            <button id="addNewComment">Add comment</button>
    </div>
    </body>
</html>