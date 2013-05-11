<?php
//print_r($_POST);
$title=$_POST['title'];
$id=$_POST['id'];

function metadata($title,$id)
{
	
	echo '
    <form name="saveMetadata'.$id.'" action="" method="post">
    <table  border="1">
	<tr>
	<td colspan="2">
	'.$title.'
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
	<input type="button" name="save" value="Save" />
	</td>
	<td>
	<input type="button" name="clear" value="Clear data" onclick="clear()"/>
	</td>
	</tr>
	
    </table>
	
    ';
	
}

echo '<div id="editMetadata:'.$id.'">';
metadata($title,$id);
echo '</div>';


?>