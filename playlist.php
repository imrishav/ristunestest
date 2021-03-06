<?php  
include("includes/includedFiles.php");

if(isset($_GET['id'])) {
	$playlistId = $_GET['id'];
}
else {
	header("Location: index.php");
}

$playlist = new Playlist($con, $playlistId);
$owner = new User($con, $playlist->getOwner());
?>

<div class="entityInfo">

	<div class="leftSection">
		<div class="playlistImgBig">
		<img src="playlist.png">
		</div>
	</div>

	<div class="rightSection">
		<h2><?php echo $playlist->getName();  ?></h2>
		<p> By <?php echo $playlist->getOwner(); ?></p>
		<p><?php echo $playlist->getNumbersofSongs(); ?> Songs</p>
		<button class='deleteBtn' onclick="deletePlaylist('<?php echo $playlistId; ?>')">DELETE PLAYLIST</button>
	</div>

</div>





<div class="trackListContainer">
	
	<ul class="trackList">
		
		<?php
			$songIdArray = $playlist->getSongIds();

			$i =1;

			foreach ($songIdArray as $songsId) {
				$playlistSong = new Songs($con, $songsId);
				$songArtist = $playlistSong->getArtist();
				//echo $albumSong->getTitle() . "<br>";

				echo "<li class='trackListRow'>
							<div class='trackCount'>
							<img class='play' src='assests/images/icons/play-white.png' onclick='setTrack(" . $playlistSong->getId() .", tempPlaylist, true)'>
							<span class='trackNumber'>$i</span>
							</div>

							<div class='trackInfo'>
								<span class ='trackName'>" . $playlistSong->getTitle() ."</span>
								<span class='artistName'>" . $songArtist->getName() ."</span>

							</div>

							<div class='trackOptions'>
								<img class='optionsButton' src='assests/images/icons/more.png'>
								
							</div>

							<div class='trackDuration'>
								<span class='duration'>" . $playlistSong->getDuration() ."</span>
								
							</div>

						</li>";

				$i = $i +1;

			}

		?>



		<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';

			tempPlaylist = JSON.parse(tempSongIds);


		</script>


	</ul>

</div>






