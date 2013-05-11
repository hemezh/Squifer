<script type="text/javascript" src="../scripts/settings.js" ></script>
<?php
require_once('./include/class.user.php');
$obj=new user_info ();
?>
<div id="userThumb">

</div>
<div id="userDetails">
<div class="alert" id="saveSettingsAlert">
</div>                                                                
<form name="userSettings" id="userSettings">
        <table width="100%" cellpadding="10px" border="0" align="center">
                <tbody>
                <tr><td>Email Id</td>
                <td><input name="email" value="<?php echo $obj->getEmail($_SESSION['username']); ?>" /> </td></tr>

                <tr><td>Name</td>
                <td><input name="name" value="<?php echo $obj->getLoginUserName(); ?>" /></td><td><i class="icon-pencil" ></i></td></tr>
                
                <tr><td>Password</td>
                <td><input name="password" type="password"></td><td><i class="icon-pencil"></i></td></tr>

                <tr><td>Retype Password</td>
                <td><input name="repassword" type="password"></td><td><i class="icon-pencil"></i></td></tr>

                
                <tr><td>&nbsp;</td>
                <td><input type="button" class="btn" value="Save Changes" id="saveSettings" /></td></tr>
                
                </tbody>
        </table>
</form>
</div>

