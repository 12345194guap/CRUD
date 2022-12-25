<?php
session_start();
require_once 'php/funcs_db.php';
require_once 'php/notices.php';
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>CRUD</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="send_message">
                <p class="title_send_message">Напишите свое сообщение</p>
                <form class="form_send_message" method="POST" action="php/send_message.php" id="msg">
                    <textarea class="text_send_message" rows="8" cols="60" type="text" name="text" form="msg" resize='none' autofocus='True' placeholder="Ваш текст..."><?php if(isset($_SESSION['message'])) echo $_SESSION['message']; unset($_SESSION['message']); ?></textarea>
                    <button class="btn_send_message" type="submit" form="msg">Отправить</button>
                    <?php notice() ?>
                </form>
            </div>
            <div class="block_messages">
                <?php  
                        
                    $size = get_size();
                    while($size > 100) {
                        $size--;
                    }
                    $i = 0;
                    while($size > $i) {
                ?>
                <div class="main_message">
                    <p class="title_block_messages">Anon</p>
                    <textarea class="main_message_text" rows="7" cols="75" disabled="disabled"><?php
                        $row = get_message($size);
                        $size--;
                        echo $row[0]['text'];?>
                    </textarea>

                    <form class="change_likes">
                        <button id="btn_like" type="submit">Like</button>
                        <p class="output_likes"><?php echo $row[0]['likes'];?></p>
                        <p class="output"><?php echo $row[0]['time'];?></p>
                        <input name="likes" type="hidden" value="<?php echo $row[0]['likes'];?>"></input>
                        <input name="id" type="hidden" value="<?php echo $row[0]['id'];?>"></input>
                    </form>
                    
                    <form class="add_comment" method = "POST" action="php/add_comment.php">
                        <textarea name="text" class="text_add_comment" rows="7" cols="30" type="text" placeholder="Ваш комментарий..."><?php if(isset($_SESSION['comment'])) echo $_SESSION['comment']; unset($_SESSION['comment']); ?></textarea>
                        <button class="btn_add_comment" type="submit">Написать</button>
                        <input name = "id" type="hidden" value="<?php echo $row[0]['id'];?>"></input>
                    </form> 
                    
                    <form method="POST" action="index.php">
                        <button class="btn_show_comments" type="submit" name="show_comments">Посмотреть комментарии</button>
                        <input type="hidden" value="<?php echo $row[0]['id'];?>" name = "msg_id"></input>
                    </form>
                    <?php
                    if(isset($_POST['show_comments']) && $_POST['msg_id'] == $row[0]['id']){
                        $id = $_POST['msg_id'];
                        $comments = get_comments($id);
                        foreach($comments as $comment){?>
                            <div class='comment'>
                                <p class="comment_title">©Anon</p>
                                <textarea class="comment_text" cols="73" rows="5" disabled="disabled"><?php echo $comment['text'];?></textarea>
                                <div><?php echo $comment['time'];?></div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php  }?>
            </div>
        </div> 
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </body>
</html>
