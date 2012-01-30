<h1>Brief explanation</h2>

<p>This isn't a massively fancy XML sitemap generator - it literally builds an XML of all the links that are on the provided page. So if you have a nice big 'SEO Footer' then you will get a full site-map...</p>

<hr>

<h2>To use!</h2>
<p>Put into a working directory of some kind, perhaps on a server - it's completely up to you.</p>
<p>Now follow these simple easy to use steps: </p>
<ol>
  <li>Put create.php and download.php in a directory where you want to create the XML file</li>
  <li>Open a browser</li>
  <li>Direct yourself to the directory and use create.php?url=website.com   - With the query string, it's not neccessary to include www.</li>
  <li>Press enter in the URL bar ( of course )</li>
  <li>If you have kept the 'force download' in the create.php file you will get a download prompt</li>
  <li>Open the download, and there it is!</li>
</ul>

<hr>
<p>I'm happy with this as it's the first time I have used the DOM class provided by PHP. It's pretty nifty not having to use Javascript to search the DOM</p>