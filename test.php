<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>


.square {
    margin: 5px;
  width: 250px;
  height: 250px;
  background-color: #ccc;
}

.container {
  display: grid;
  grid-template-columns: repeat(3, 0fr);
}
@media (max-width: 767px) {
  .container {
    grid-template-columns: repeat(2, 1fr);
  }
}

</style>
<body>
<div class="container">
  <div class="square"></div>
  <div class="square"></div>
  <div class="square"></div>
  <div class="square"></div>
  <div class="square"></div>
  <div class="square"></div>
</div>
</body>
</html>