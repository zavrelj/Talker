<?php
$db_data = array($_SESSION["uid"]);
$dbUserRow = phpFetchDB('SELECT * FROM users WHERE user_id = ?', $db_data);
$db_data = "";

if ($dbUserRow["user_verified"] == 0) {
    
?>

    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-3">Access denied!</h1>
        <p class="lead">You need to verify your email address before you can use this feature.</p>
      </div>
    </div>
  
<?php
  

} else {
    $db_data = array();
    $dbRecipientsList = phpFetchAllDB('SELECT * FROM users', $db_data);
    $db_data = "";

?>
    <h5>Messaging</h5>
    <hr>

    <div class="row">
        <div class="col-lg-12">
            <form name="formMessaging" action="messaging.ctrl.php" method="post" novalidate>
                <div class="form-group">
                    <label for="formMessagingRecipient">Recipient</label>
                    <select class="form-control" id="formMessagingRecipient" name="formMessagingRecipient" onchange="jsMessagingValidateSelect('formMessagingRecipient')">
                        <option value="default" default>Select email</option>
                        <?php foreach ($dbRecipientsList as $dbRecipientRow) { ?>
                            <option value="<?php echo $dbRecipientRow["user_id"]; ?>"><?php echo $dbRecipientRow["user_email"]; ?></option>
                        <? } ?>

                    </select>
                </div>

                <div class="form-group">
                    <label for="formMessagingContent">Message</label>
                    <textarea class="form-control" id="formMessagingContent" name="formMessagingContent" placeholder="Write the message here. Tags are not allowed." onkeyup="jsMessagingValidateTextArea('formMessagingContent')"></textarea>
                </div>

                <button type="submit" id="formMessagingSubmit" name="formMessagingSubmit" class="btn btn-primary btn-success">Send</button>
            </form>
        </div>
    </div>

    <script src="messaging.js"></script>

<?php
}

?>