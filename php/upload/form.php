<?php
//print_r($_POST);
$title=$_POST['title'];
$id=$_POST['id'];
$bookId=$_POST['bookId'];
require_once('../include/class.book.php');
$obj=new book();
$title=$obj->titleCleaner($title);

echo '<div id="editMetadata-'.$id.'" class="formEditMetadata well"  style="display:none;" >';
	
	echo '
    

	<form class="form-horizontal formMetadata" name="saveMetadata:'.$id.'" action="#" method="post">
				        <fieldset>
				        <legend>
				        	'.$_POST['title'].'
				        	<h6>
    							Make it easier to find your new document!
    						</h6>
    						</legend>
				        <center><div class="loader">
			  		 	</div>
			  		 	</center>
				            <div class="alert alert-error errorMetadata" id="errorMetadata-'.$id.'" style="display:none;">
				            
    						</div>
    						<div class="control-group">
					            <label class="control-label">Title</label>
					            <div class="controls">
					              <input class="input-xlarge span4 "  name="title" value="'.$title.'"  type="text" >
				            </div>
				          </div>
				          <div class="control-group">
				            <label class="control-label">Author</label>
				            <div class="controls">
				              <input class="input-xlarge span4" name="author" value="Unknown" type="text" >
				            </div>
				          </div>
				          <div class="control-group">
				            <label class="control-label">Tags</label>
				            <div class="controls">
				              <input class="input-xlarge span4" name="tags" type="text" >Separated by comma (,)
				          	  
				            </div>
				          </div>
				          <div class="control-group ">
				            <label class="control-label">Category</label>
				            <div class="controls">
				              <select id="" name="category">
				              <option selected="true" disabled="true" value="0">Choose a Category</option>
							        ';
							        $obj->getCategoryList();

			echo '	          </select>
				            </div>
				          </div>
					      <div class="control-group">
						      <label class="control-label">Description</label>
				              <div class="controls">
				              	<textarea class="span4" name="description"></textarea>
						       </div>
						     
				        </div>
				        <input type="submit" name="save" value="Save" class="saveMetadata btn"/>
					</fieldset>

	<input type="hidden" name="filename" value="'.$_POST['title'].'"/>	<input type="hidden" name="bookId" value="'.$bookId.'"/>
	<input type="hidden" name="id" value="'.$id.'"/>
				      </form>
	';
echo '</div>';


?>