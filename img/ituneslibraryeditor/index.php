<? include '../../header.php'; 
   include '../../projects-data.php';
?>


<div class="container">

<div class="jumbo2">
</div>

	<h1>
		iTunes Library Editor</h1>
	<div class="row">
		<div class="col-sm-8">
			A .Net dll with no external dependencies which can edit iTunes library files (*.itl)
			without using the Apple iTunes SDK.
			<br><br>
			Whats wrong with the iTunes SDK?
	<ul>
		<li>Its slow</li>
		<li>iTunes starts and shows its main window. </li>
		<li>iTunes may begin to synchronize connected iPods, download podcasts and artwork,
			display modal dialogs and take the focus from your application.</li>
		<li>iTunes continues to run after you've finished.</li>
	</ul>
	<br />
	By contrast, iTunes LibraryEditor is:
	<ul>
		<li>Very quick to load library files (under a second instead of 5-6 seconds for iTunes
			SDK for a large library)</li>
		<li>Simple to use - add and remove both tracks and playlists with a couple of lines
			of code</li>
		<li>Doesn't require iTunes to be running</li>
		<li>Supports iTunes 6 - 10</li>
	</ul>
	<br />
	<br />

	Usage example:
	<pre>// Load the default iTunes library
iTunesLibrary library = new iTunesLibrary();

// Add a track to the iTunes library:
Track newTrack = library.Tracks.Add(&quot;c:\\music\\mytrack.mp3&quot;);

// Add a playlist to the iTunes library:
Playlist newPlaylist = library.Playlists.Add(&quot;My new list&quot;);
newPlaylist.AddTrack(newTrack);
library.SaveChanges();
	</pre>
		</div>
		<div class="col-sm-4">
			<a href="/download/iTunesLibraryEditor.zip" class="btn btn-primary" style="margin-bottom:10px">
				Download v1.2.4 (2 Jun 09)</a>
			<a href="http://shareit.com/product.html?productid=300304813" target="_blank" class="btn btn-default">Source (USD $99)</a>
		</div>
	</div>
	
	
			

</div>

<? include '../../footer.php'; ?>
