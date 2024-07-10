const gTTS = require('gtts');
var gtts = new gTTS('เชิญคุณสุรชาติ อุดม', 'th');
gtts.save('audio/000006216.mp3', function (err, result) {
  if(err) { throw new Error(err) }
  console.log('Success! Open file /audio/000006216.mp3 to hear result.');
});