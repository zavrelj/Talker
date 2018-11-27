<div class="row">
  <div class="col-lg-6">
    <h5><?php echo phpGetGroupName($_GET["gid"]); ?></h5>
  </div>
  <div class="col-lg-6">
    <?php if (phpGetGroupOwnerID($_GET["gid"]) == $_SESSION["uid"]) { ?>
    <a href="gate.php?module=group&gid=<?php echo $_GET["gid"]; ?>" class="btn btn-primary btn-sm float-right mt-3" role="button">Settings</a>
    <?php } ?>
  </div>
</div>
<hr>


<div class="row">
	<div class="col-lg-12">
		<form name="formPosts" action="posts.ctrl.php" method="post" novalidate>

			<div class="form-group">
				<label for="formPostsContent">Create new post</label>
				<textarea class="form-control <?php if ($_SESSION['msgid']!='501' && $_SESSION['msgid']!='') { echo 'is-valid'; }else{ echo (phpShowInputFeedback($_SESSION['msgid'])[0]); } ?>" id="formPostsContent" name="formPostsContent" placeholder="Write the post here. Tags are not allowed." onkeyup="jsPostsValidateTextArea('formPostsContent')"><?php echo $_SESSION["posts_content"]; ?></textarea>

                <?php if ($_SESSION["msgid"]=="501") { ?>
                <div class="invalid-feedback">
                <?php echo (phpShowInputFeedback($_SESSION["msgid"])[1]); ?>
                </div>
                <?php } ?>
            </div>

            <input type="hidden" id="formPostsGroupID" name="formPostsGroupID" value="<?php echo $_GET['gid']; ?>">

			<button type="submit" id="formPostsSubmit" name="formPostsSubmit" class="btn btn-primary btn-success mb-5">Send</button>
		</form>
	</div>
</div>

<?php

$db_data = array($_GET["gid"]);
$dbPostsList = phpFetchAllDB('SELECT * FROM posts WHERE post_group_id = ? ORDER BY post_date DESC', $db_data);
$db_data = "";

?>

<p><strong>Latest posts</strong></p>

<div class="row">
<div class="col-lg-12">
  <table class="table">

  <?php foreach ($dbPostsList as $dbPostRow) { ?>


    <tr>
      <td class="message_header">
        FROM: <?php echo phpGetUserEmail($dbPostRow["post_author_id"]); ?>
        | DATE: <?php echo $dbPostRow["post_date"]; ?>
      </td>
    </tr>

    <tr><td class="message_content"><?php echo $dbPostRow["post_content"]; ?></td></tr>
  <?php } ?>

  </table>
</div>
</div>


<script src="posts.js"></script>

<?php $_SESSION["posts_content"] = ""; ?>
