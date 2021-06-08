<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="filterStyleD3.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<style>
#clickMe {
  border: none;
  background-color: #003DA5;
  color: white;
  padding: 14px 28px;
  font-size: 16px;
  cursor: pointer;
  display: inline-block;
}

<style>
* {
  box-sizing: border-box;
}

body {
  font: 16px Arial;
}

/*the container must be positioned relative:*/
.autocomplete {
  position: relative;
  display: inline-block;
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff;
  border-bottom: 1px solid #d4d4d4;
}

#privateAuto {
  max-height 50px;
  overflow-y: auto;
  overflow-x: hidden;
}

</style>

<?php
  $hostname = "db1.mcs.slu.edu";
  $username = "edstat";
  $password = "LAqes3FbK3";
  $db = "edstat";

$dbconnect=mysqli_connect($hostname,$username,$password,$db);

if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbonnect->connect_error);
}

?>

<?php
$private = array();
$privateSQL = mysqli_query($dbconnect, "Select school from privateSchools")
  or die (mysqli_error($dbconnect));

while ($row = mysqli_fetch_array($privateSQL)) {
  $private[] = $row[0];
}
$private_array = json_encode($private);
?>

<script>


$( function() {
    var availableTags = <?php echo $private_array;?>;

function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#privateTags" )
      // don't navigate away from the field on tab when selecting an item
      .on( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          // delegate back to autocomplete, but extract the last term
          response( $.ui.autocomplete.filter(
            availableTags, extractLast( request.term ) ) );
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
  } );



  </script>
</head>
<body>

<div class="top">
  <ul>
    <li><a class="link" href="HomePageD4.php">Home Page</a></li>
    <li><a class="link" href="map.php">Map</a></li>
    <li><a class="link" href="filterPageD4.php">Public Data</a></li>
    <li><a class="link" href="about.html">About Us</a></li>
  </ul>
</div>

<div id="banner">
    <img src="slu.jpg">
  </div>

<div id="privateAuto">
<form>
<div class="ui-widget" style="width:300px;">
  <input id="privateTags" size="50" id="private" type="text" name="myPrivate" placeholder="Private School Name(s)">
</div>
</form>
</div>

<div>
  <button id="clickMe" type="button">Download</button>
</div>

<div class="directions">
  <h4>Need Help?</h4>
  <a class="directionsLink" href="privateDirections.pdf" target="_blank">Directions</a>
</div>

<script>

$('#clickMe').on('click', function() {
  var input1 = document.getElementById("privateTags").value;
  var yuh = input1.split(",");
  var where = yuh.join(", ");
  where = where.replace(/,\s*$/, "");
  location.href = "privateFilterScript.php?h1=" + where;
});

</script>

<div class="footerWrap">
    <div class="footer">
      <div class="footerContent">
    <h3><a href = "https://www.slu.edu" target="_blank">Saint Louis University</a></h3>
 </div>
</div>
</div> 

</body>
</html> 
