<!DOCTYPE html>
<html>
<head>
</head>
<body>

Enter your name: <input type="text" id="fname" onchange="myFunction()">
<input type="text" id="tname" onchange="myFunction()">
<input type="text" id="name" readonly>
<input type="text" id="quantity" name="quantity"  >



<script>
function myFunction() {
  var x = document.getElementById("fname");
  var y = document.getElementById("tname");
  var z = document.getElementById("name");
  z.value = x.value * y.value;
}
</script>
</body>
</html>