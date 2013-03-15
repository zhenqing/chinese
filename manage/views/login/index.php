            
            <div id="main">
               <form method="post" action="<?=$_SERVER['REQUEST_URI'] ?>" >
                <div id="login"> 
                    <h3>Login</h3> 
                    <p>User Name</p> 
                    <input class="input300" name="User[user_id]" id="AdminForm_username" value="" type="text">
                    <p>Password</p> 
                    <input class="input300" name="User[user_pw]" id="AdminForm_password" value="" type="password">
                    <input class="login" src="images/bt_login.gif" name="yt0" value="submit" type="submit">                    
                    <div class="error">
                        <? if(is_array($form_error)){
                                echo "<ul>";
                                foreach($form_error as $v){
                                    echo "<li>{$v}</li>";
                                }
                                echo "</ul>";
                            
                        }   ?>
                    </div>
                </div>
               </form> 
                
            </div>                