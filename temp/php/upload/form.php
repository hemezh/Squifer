<?php
//print_r($_POST);
$title=$_POST['title'];
$id=$_POST['id'];
$bookId=$_POST['bookId'];
require_once('../include/class.book.php');
$obj=new book();
$title=$obj->titleCleaner($title);
function metadata($title,$id,$bookId)
{
	
	echo '
    <form name="saveMetadata:'.$id.'" class="formMetadata" action="#" method="post">
    <table  border="1">
	<tr>
	<td colspan="2">
	<div class="uploadBokTitle">'.$_POST['title'].'</div>
	</td>
	</tr>
    <tr>
	<td colspan="2">&nbsp;
	</td>
	</tr>
	<tr>
	<td colspan="2" id="errorMetadata-'.$id.'" class="errorMetadata"  style="display:none;" >&nbsp;
	</td>
	</tr>
    <tr>
    <td>Title</td>
    <td><input name="title" value="'.$title.'" size="50" />
    </td>
    </tr>
    <tr>
    <td>Author</td>
    <td><input name="author" value="Unknown" size="50"/>
    </td>
    </tr>
    <tr>
    <td>Tags</td>
    <td><textarea name="tags"></textarea> Separated by comma (,)
    </td>
    </tr>
	<tr>
	<td>
	<input type="submit" name="save" value="Save" class="saveMetadata"/>
	</td>
	</tr>
	</table>
	<input type="hidden" name="bookId" value="'.$bookId.'"/>
	<input type="hidden" name="filename" value="'.$_POST['title'].'"/>
	<input type="hidden" name="id" value="'.$id.'"/>
	</form>
	';
}
echo '<div id="editMetadata-'.$id.'" class="formEditMetadata"  style="display:none;" >';
metadata($title,$id,$bookId);
echo '</div>';
echo '<div id="ackMetadata-'.$id.'" class="formAckMetadata"  style="display:none;" >';
echo 'Your Book <b>"'.$_POST['title'].'"</b> has been Successfully Uploaded.';
echo '</div>';



?>