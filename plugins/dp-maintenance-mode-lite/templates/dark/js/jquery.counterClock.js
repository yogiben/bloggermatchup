(function($){
	
	var gVars = {};

	$.fn.counterClock = function(opts){
	
		var container = this.eq(0);
		
		if(!opts) opts = {}; 
		
		var defaults = {

			launchDate: { year: 2012, month: 12, day: 31, hour: 00, minute: 00}
		}, launchDateFix;
		

		$.each(defaults,function(k,v){
			opts[k] = opts[k] || defaults[k];
		})
		
		launchDateFix = new Date(opts.launchDate.year, (opts.launchDate.month - 1), opts.launchDate.day, opts.launchDate.hour, opts.launchDate.minute);
		
		gVars["launchDate"] = launchDateFix;

		setUp.call(container);
		
		return this;
	}
	
	function setUp()
	{
		
		setInterval(function(){
		
			var currentTime = new Date(), differenceTime;
			
			differenceTime = new Date(gVars.launchDate.getTime() - currentTime.getTime());

			var d = Math.floor(Math.abs((gVars.launchDate.getTime() - currentTime.getTime()) / (24*60*60*1000)));
			var h = differenceTime.getUTCHours();
			var m = differenceTime.getUTCMinutes();
			var s = differenceTime.getUTCSeconds();
			if( differenceTime.getTime() < 0 ) {
				d = 0;
				h = 0;
				m = 0;
				s = 0;
			}
			//console.log(differenceTime.getTime());
			$('.container_clock .days span').html(_str_pad(d, 2, "0", "STR_PAD_LEFT"));
			$('.container_clock .hours span').html(_str_pad(h, 2, "0", "STR_PAD_LEFT"));
			$('.container_clock .minutes span').html(_str_pad(m, 2, "0", "STR_PAD_LEFT"));
			$('.container_clock .seconds span').html(_str_pad(s, 2, "0", "STR_PAD_LEFT"));
			

		},1000);
	}
	
	function _str_pad(input, pad_length, pad_string, pad_type) {

	  var half = '',
		pad_to_go;
	
	  var str_pad_repeater = function (s, len) {
		var collect = '',
		  i;
	
		while (collect.length < len) {
		  collect += s;
		}
		collect = collect.substr(0, len);
	
		return collect;
	  };
	
	  input += '';
	  pad_string = pad_string !== undefined ? pad_string : ' ';
	
	  if (pad_type != 'STR_PAD_LEFT' && pad_type != 'STR_PAD_RIGHT' && pad_type != 'STR_PAD_BOTH') {
		pad_type = 'STR_PAD_RIGHT';
	  }
	  if ((pad_to_go = pad_length - input.length) > 0) {
		if (pad_type == 'STR_PAD_LEFT') {
		  input = str_pad_repeater(pad_string, pad_to_go) + input;
		} else if (pad_type == 'STR_PAD_RIGHT') {
		  input = input + str_pad_repeater(pad_string, pad_to_go);
		} else if (pad_type == 'STR_PAD_BOTH') {
		  half = str_pad_repeater(pad_string, Math.ceil(pad_to_go / 2));
		  input = half + input + half;
		  input = input.substr(0, pad_length);
		}
	  }
	
	  return input;
	}
	
	
})(jQuery)