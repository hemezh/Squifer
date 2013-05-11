<?php
function metadata($file)
{
	
	echo '
    <form name="" action="" method="post">
    <table  border="1">
    <tr>
    <td>Title</td>
    <td><input name="title" value="'.$file.'" size="50" />
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
    </table>
    ';
	
}
?>