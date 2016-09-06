 <li id="comment<?php echo $comment[id]?>">
    <div class="commentContent">
        <h6 class="userName">Name: <?php echo $comment[userName]?> <span><?php echo $comment[date_add]?></span> </h6>
        <h6 class="userEmail">Email: <?php echo $comment[userEmail]?> </h6>
        <div class="comment">
            <?php echo $comment[text]?>
        </div>
        <a class="reply" href="#comment<?php echo $comment[id]?>">Answer</a>
    </div>
    <?php if($comment[childs]) { ?>
        <ul id="commentsRoot<?php echo $comment[id]?>">
        <?php echo commentsString($comment[childs]) ?>
        </ul>
    <?php } ?>
</li>  
