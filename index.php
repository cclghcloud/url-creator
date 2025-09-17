<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Tracking my Customers / CCL</title>
    <meta name="description" content="Contracts CCL">
    <meta name="author" content="GramThanos">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <style>
    	#email{
    		text-align: center;
    		margin-bottom: 1%;
    	}
    	#person, #deals, #results1{
    		margin-top: 2%;
    	}
    	.py-5{
    		padding-top: 0rem!important;
    		padding-bottom: 0rem!important;
    	}
    	#propsbutton{
    		margin-top: 1%;
		    background-color: cyan;
		    padding-left: 2%;
		    padding-right: 2%;
		    border-radius: 10px;
		    float: left;
		    font-size: 0.9em;
		    font-weight: bold;
		    margin-right: 2%;
    	}
      .butpropt{
        margin-top: 2%;
      }
      .butsrch{
        margin-top: 10%;
      }
    </style>
  </head>
<body>
<div class="container">
	<div class="py-5 text-center">
		<h2>Tracking my customers / CCL</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<form class="needs-validation" novalidate>
        <label for="email">Entity <span class="text-muted"></span></label>
        <select id="entity" name="entity" class="form-control">
          <option value="ccl" selected>Classic Country Land</option>
          <option value="ll">Legacy Land</option>
        </select><br><br>
				<label for="email">Sales Person <span class="text-muted"></span></label>
        <?php
        $agents = array(          
          1 => 'jasmine-dudley',
          3 => 'bailey-springer',
          4 => 'kim-foust',
          5 => 'bryce-muckle',
          6 => 'emma-wigginton',
          10 => 'taylor-roland',
          11 => 'alek-freeland',
          13 => 'alex-roland',
          16 => 'marvin-attan',
          17 => 'mitchell-ray',
          20 => 'scott-leonard',
          22 => 'luke-shamburger',
          24 => 'rachelle-wigginton',
          27 => 'mackenzie-kastl',
          28 => 'megan-leija',
          29 => 'whitney-woodrome',
          30 => 'tammy-sharp',
          32 => 'sydney-wigginton',
          33 => 'alan-pulido',
          44 => 'chad-williams',
        );
        asort($agents);
        echo "<select class='form-control' name='sp' id='sp'>";
        echo "<option value='0'>- SELECT YOUR PROFILE -</option>";
        foreach ($agents as $key => $value) {
          echo "<option value='$value'>$value</option>";
        }
        echo "</select>";
        ?>

        <!--<input type="sp" class="form-control" id="sp" value="<?php echo $_GET['sp']; ?>" readonly>-->
        <label for="email" class="butpropt">Properties <span class="text-muted"></span></label>
      	<input type="properties" class="form-control" id="properties" onkeyup="proplist(this.value)">
      	<input type="hidden" id="pId" name="pId" value="">
      	<div class="invalid-feedback">
        	Please enter a valid email address for shipping updates.
      	</div>
        <hr>
        <div id="propertiesccl"></div>
      	<button class="btn btn-primary btn-lg btn-block butpropt butsrch" type="button" onclick="sCreateUrl()">Create Custom URL</button>
			</form>
			<div id="url"></div>
		</div>
	</div>
</div>
</body>
<script>
function proplist(val){
  var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("propertiesccl").innerHTML = this.responseText;
        }
  };

  var properties = val;
  var variables = "p="+properties;  
  //console.log(variables);

  xhttp.open("GET", '../intranet/contracts/propertieslist.php?' + variables, true);
  xhttp.send();
}

function tractlist(p){
  var parts = p.split(",");
  var title = parts[1];
  title = title.replaceAll("%20"," ");
  var entry_id = parts[0];
  //console.log(title);
  document.getElementById("properties").value = title;
  document.getElementById("pId").value = entry_id;

  var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("propertiesccl").innerHTML = this.responseText;
      }
    };

  var variables = "id="+entry_id; 
  xhttp.open("GET", '../intranet/contracts/tractdropdown.php?' + variables, true);
  xhttp.send();
}

function sCreateUrl(){
  var sp = document.getElementById("sp").value;
  var idprop = document.getElementById("pId").value;
  var idtract = document.getElementById("tracts").value;
  var entity = document.getElementById("entity").value;
  
  var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("url").innerHTML = this.responseText;
    }
  };

  var variables = "sp="+sp+"&idprop="+idprop+"&idtract="+idtract+"&entity="+entity; 
  xhttp.open("GET", '../intranet/geturltracking.php?' + variables, true);
  xhttp.send();
}
</script>
</html>