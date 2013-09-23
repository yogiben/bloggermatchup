$(document).ready(function(){
	// PrettyPhoto
	$("a[rel^='prettyPhoto']").prettyPhoto({
		deeplinking: false,
		social_tools: '',
		overlay_gallery: false
	});
});

// Convert Twitter API Timestamp to "Time Ago"
function relative_time(time_value) {
  var values = time_value.split(" ");
  time_value = values[1] + " " + values[2] + ", " + values[5] + " " + values[3];
  var parsed_date = Date.parse(time_value);
  var relative_to = (arguments.length > 1) ? arguments[1] : new Date();
  var delta = parseInt((relative_to.getTime() - parsed_date) / 1000);
  delta = delta + (relative_to.getTimezoneOffset() * 60);

  var r = '';
  if (delta < 60) { //60 sec
        r = 'less than minute ago';
  } else if(delta < 120) { //2 min
        r = 'about a minute ago';
  } else if(delta < (60*60)) { //60 min
        r = 'about ' + (parseInt(delta / 60)).toString() + ' minutes ago';
  } else if(delta < (120*60)) { //2 hours
        r = 'about an hour ago';
  } else if(delta < (24*60*60)) { //1 day
        r = 'about ' + (parseInt(delta / 3600)).toString() + ' hours ago';
  } else if(delta < (48*60*60)) { //2 days
        r = '1 day ago';
  } else { // > 2 days
        r = (parseInt(delta / 86400)).toString() + ' days ago';
  }
  
  return r;
}

// Create Usable Links
String.prototype.linkify = function() {
	return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&\?\/.=]+/, function(m) {
		return m.link(m);
	});
};

// Modernizr.load loading the right scripts only if you need them
Modernizr.load(); /* end Modernizr load script */
