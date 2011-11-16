    <form method="post">
        <fieldset>
            <label for="email">Email</label>
            <br/>
            <input name="email" id="email" value="<? if(!empty($_POST['email'])) echo $_POST['email']; ?>" />
            <br/>
            <label for"comment">Comment</label>
            <br/>
            <textarea name="comment" id="comment" rows="5" cols="20"><? if(!empty($_POST['comment'])) echo $_POST['comment']; ?></textarea>
            <br/>           
            <label for="captcha">Please input CAPTCHA:</label>
            <input name="captcha" id="captcha" /><img src="captchaChallenge.php" alt="captcha image" />
            <br/>
            <input type="submit" name="submit" value="Submit" />
        </fieldset>
    </form>