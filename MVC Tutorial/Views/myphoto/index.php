<div id="Photos"></div>

<form id="upload" method="POST" action="http://localhost/MVC%20Tutorial/myphoto/receivePhoto" enctype="multipart/form-data">
  <input type="file" name="file">
  <input type="submit" name="submit">
</form>
<div id="booth">
	<button id="capture">Take a photo</button>
	<video id="vidDisplay" autoplay="true">
		No video support in your browser!
	</video>
	<div class='menu-photoshoot' id='menu-phtoshoot'>
        <div class='list-gif' id='listGif'>
        	<img id='gif1' class='gif' src="https://media.giphy.com/media/l1KVaVCC1jrRoVlGE/source.gif"'>
        </div>
    </div>
	<canvas id="myCanvas" width="400" height="300"></canvas>
	<input type="submit" id="back-button" value="Upload">
</div>
<script type="text/javascript" src="<?php echo URL;?>Views/myphoto/js/default.js">
</script>