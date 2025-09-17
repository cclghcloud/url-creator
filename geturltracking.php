<?php
//include 'dbcclconn.php';
include 'dbcclconn_dev_coord.php';

//print_r($list);
$sp = $_GET['sp'];
$idtract = $_GET['idtract'];
$idprop = $_GET['idprop'];
$entity = $_GET['entity'];
echo $entity;

$datat = array(
	"sp"		=>	$sp, 
	"idtract"	=>	$idtract, 
	"idprop"	=> 	$idprop, 
);

//print_r($datat);
if (strcasecmp($entity, "ccl") == 0) {
	$target = "https://www.classiccountryland.com";
}else{
	$target = "https://legacyland.classiccountryland.com";
}

if ($idtract > 0) {
	$x = $pdod->query("SELECT * FROM exp_zproperties WHERE entry_id = '$idtract'")->fetchAll();

	$url = $target."/my-land?sp=".$sp."&q=".$idprop."&t=".$idtract;
}else{
	$x = $pdod->query("SELECT * FROM exp_zproperties WHERE entry_id = '$idprop'")->fetchAll();
	$url = $target."/my-land?sp=".$sp."&q=".$idprop."&t=0";
}
?>

<!-- The text field -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<br><br><br>
<input type="text" class="form-control" id="lnktoshare" style="width: 100%;" value="<?php echo $url; ?>"><br>

<!-- The button used to copy the text -->
<br>
<script>
function copyInputValue() {
	// Get the text from the input field
    var textToCopy = document.getElementById("lnktoshare").value;

    // Create a temporary textarea element to hold the text
    var tempTextArea = document.createElement("textarea");
    tempTextArea.value = textToCopy;

    // Append the textarea to the document, select the text, and copy it
    document.body.appendChild(tempTextArea);
    tempTextArea.select();
    tempTextArea.setSelectionRange(0, 99999); // For mobile devices

    try {
        // Execute the copy command
        var successful = document.execCommand("copy");
        if (successful) {
            alert("Copied the text: " + textToCopy);
        } else {
            alert("Copy command failed.");
        }
    } catch (err) {
        console.error("Failed to copy: ", err);
    }

    // Remove the temporary textarea from the document
    document.body.removeChild(tempTextArea);
}
</script>
<!--<button class="btn btn-primary btn-lg btn-block" onclick="copyInputValue()">Copy link</button>-->
<button class="btn btn-primary btn-lg btn-block" onclick="location.href = '<?php echo $url?>';">Test Link</button>