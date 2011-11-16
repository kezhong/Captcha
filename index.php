<?php
session_start();
require("config.php");

    if(isset($_POST['submit'])){           
        if(sha1(strtoupper($_POST['captcha']))==$_SESSION['string']){
            require("header.php");
            $email = $_POST['email'];
            $comment = $_POST['comment'];
            echo "<h1>You are a human! Comment Submitted.</h1>";
            echo "<p>Email: $email</p>";
            echo "<p>Comment: $comment</p>";
            echo "<p><a href='index.php'>Try Another?</a></p>";
            require("footer.php");
        }else{

            if(!isset($_COOKIE['count'])) { 
                $count = 0; }
            else{
                $count=$_COOKIE['count'];
                    if($count>$count_num){
                        $count=0; 
                     }
                     else{
                        $count++; 
                        }   
                 }
            setcookie("count", $count, time(  )+$amount_time);
            
            
            if(!isset($_COOKIE['start'])){
                $start = time(  );
                setcookie("start", $start, time(  )+$amount_time);                  
              }else{
                 $start = $_COOKIE['start'];
              }           
            
            
            
            $try_times=$count_num;
            $try_times_left = $try_times - $count;
            $duration = time(  ) - $start;
            $seconds=$amount_time;
            $seconds_left = $seconds - $duration;
            

            if($try_times_left<=0&&$duration>0){
                require("logout_index.php");
                $logout = time();
                setcookie("logout",$logout,time()+$locked_out_time);
            }
            else{
                require("header.php");
                echo "<p>Captcha was wrong, Please try again.</p>";
                echo "<h3>You have $try_times_left attempts left in the next $seconds_left seconds</h3>";
                require('form.php');
                require('footer.php');
            }            
        }
    }
    else{
            if(isset($_COOKIE['count'])){
                setcookie('count','',time()-3600);
            }//delete cookies
            if(isset($_COOKIE['start'])){
                setcookie('start','',time()-3600);
            }
             require("header.php");
             require('form.php');
             require("footer.php");             

        }   
?>
    
