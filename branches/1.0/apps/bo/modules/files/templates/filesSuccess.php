<?php
/**
 * Simple page to handle file transfer in and out of the file uploads/newsletter/images
 * 
 * @package mcms
 * @subpackage newsletter
 * @author Ryan Weaver
 */
?>

<h2>Custom Files</h2>

<p>
	If you upload a file 'myfile.jpg', it will be available via:<br/>
	http://www.braunmedia.com/uploads/custom/myfile.jpg
</p>


<h4>Files Currently Uploaded</h4>
<div>
	<ul>
		<?php foreach($files as $file): ?>
			<li>
				<?php echo $file; ?>
				<?php echo link_to('del', '/files/files_delete?filename='.$file, array('post'=>true, 'confirm'=>'Delete this file?')); ?>
				<a href="/uploads/custom/<?php echo $file; ?>" target="_blank">view</a>
			</li>
		<?php endforeach; ?>
		<?php if (count($files)==0) echo '<i>No Files currently uploaded</i>'; ?>
	</ul>
</div>

<h4>Upload a new file</h4>
<?php echo form_tag('/files/files_add', array('multipart'=>true)); ?>
	<?php echo input_file_tag('file'); ?>
	<?php echo submit_tag('Upload File'); ?>
</form>