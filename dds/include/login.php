<!DOCTYPE html>
<html>
<head>
<title>DDS LOGIN</title>
  <script type="text/javascript">
    function login_valid(){
      var a=document.login_form.login_user.value;
      var b=document.login_form.login_pass.value;
      if(a.trim()==""){
        document.getElementById('login_eid').innerHTML="Please Enter your user id";
        return false;
      }
      else if(b.trim()=="") {
        document.getElementById('login_epass').innerHTML="Please Enter Your Password ";
        return false;
      }
      else{
        return true;
      }
    }
	
    function clr_user(){
      document.getElementById('login_eid').innerHTML="";
    }
	
    function clr_pass(){
      document.getElementById('login_epass').innerHTML="";
    }
  </script>
</head>
<body>
    <div class="log_table">
        <h1 >ETIM Login</h1>
        <table >
            <form id="log_form" name="login_form" action="#" method="post" onsubmit="return login_valid()">
                <tr>
                    <td> <input type="text" placeholder="User ID" name = "login_user" class="log_text" autocomplete="on" onKeyDown="clr_user()"/></td>
                </tr>
                <tr>
                	<td id ="login_eid" <span style='color: red;'></span></td>
                </tr>
                <tr>
                    <td><input type="password" placeholder="Password" name = "login_pass" class="log_text" autocomplete="off" onKeyDown="clr_pass()"/></td>
                </tr>
                <tr>
                	<td id ="login_epass" <span style='color: red;'></span></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Login" name="login_check" class="log_but"/></td>
                </tr>  
            </form>
        </table>
    </div>
</body>
</html>