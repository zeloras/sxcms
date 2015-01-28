<?if (!isset($finish_install)) {?>
<form method="post" action="/install/step2">
    <input type="hidden" name="submit_step2" value="1">
    <div class="title">MySql connection data</div>
    <ul class="list">
        <li class="<?if ($check['mysql_host']) {?>itsok<?}else{?>error<?}?>">
            <label for="mysql_sever_p">Server:</label>
            <input type="text" id="mysql_sever_p" name="mysql[server]" value="<?=$_POST['mysql']['server']?>">
        </li>
        
        <li class="<?if ($check['mysql_login']) {?>itsok<?}else{?>error<?}?>">
            <label for="mysql_login_p">Login:</label>
            <input type="text" id="mysql_login_p" name="mysql[login]" value="<?=$_POST['mysql']['login']?>">
        </li>
        
        <li class="<?if ($check['mysql_password']) {?>itsok<?}else{?>error<?}?>">
            <label for="mysql_password_p">Password:</label>
            <input type="text" id="mysql_password_p" name="mysql[password]" value="<?=$_POST['mysql']['password']?>">
        </li>
        
        <li class="<?if ($check['mysql_db']) {?>itsok<?}else{?>error<?}?>">
            <label for="mysql_db_p">Database:</label>
            <input type="text" id="mysql_db_p" name="mysql[database]" value="<?=$_POST['mysql']['database']?>">
        </li>
    </ul>
    
    
    <div class="title">Create Administrative account</div>
    <ul class="list">
        <li class="<?if ($check['user_email']) {?>itsok<?}else{?>error<?}?>">
            <label for="user_email_p">Email:</label>
            <input type="text" id="user_email_p" name="user[email]" value="<?=$_POST['user']['email']?>">
        </li>
        
        <li class="<?if ($check['user_password']) {?>itsok<?}else{?>error<?}?>">
            <label for="user_password_p">Password:</label>
            <input type="password" id="user_password_p" name="user[password]" autocomplete="off" value="<?=$_POST['user']['password']?>">
        </li>
        
        <li class="<?if ($check['user_repassword']) {?>itsok<?}else{?>error<?}?>">
            <label for="user_repassword_p">Re-Password:</label>
            <input type="password" id="user_repassword_p" name="user[repassword]" autocomplete="off" value="<?=$_POST['user']['repassword']?>">
        </li>
    </ul>
    <?if (!$all_ok) {?>
        <button type="submit" class="button">Check</button>
    <?}else{?>
        <button type="submit" class="button">Check again</button>
        <button type="submit" name="finish_install" class="button">Finish</button>
    <?}?>
</form>
<?} else {?>
    <div class="title">Congratulations Install SxCms Complete!</div>
    <p>Please remove directory <strong>_install</strong> on <strong>/application/classes/controller/</strong></p>
    <p>After that, you may go in <a href="/admin">administrative panel</a> and change cms settings</p>
    <p>Administrative panel: <a href="http://<?=$_SERVER['HTTP_HOST']?>/admin">http://<?=$_SERVER['HTTP_HOST']?>/admin</a></p>
    <p>Your site: <a href="http://<?=$_SERVER['HTTP_HOST']?>">http://<?=$_SERVER['HTTP_HOST']?></a></p>
    <p>Username/Email to Login: <b><?=$user_login?></b> OR <b><?=$user_email?></b></p>
    <p>Password: <b><?=$user_password?></b></p>
<?}?>