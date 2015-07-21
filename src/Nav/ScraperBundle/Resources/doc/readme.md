Feedsburner:
====
$feedburner = $this->get('scraper.feedburner');
$feedburner->loadFeed("http://feeds.feedburner.com/theverge/nav");
$feedburner->getEntries();

Available options:
loadFeed
getClient
setClient
getEntries
getOneEntry
count

Chuck Norris Joke:
===
Gets a Chuck Norris joke from http://www.icndb.com/ 

Available options:
getOneRandomChuckNorrisJoke // Get random joke
makeOneChuckNorrisJokeByName( $firstname, $lastname[optional] ) // Returns joke with ur name