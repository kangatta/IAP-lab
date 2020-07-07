$(document).ready(function()
{
	//returns the number of minutes ahead or behind gmt
	var offset = new Date().getTimeZoneOffset();
	//return no of millisecs since 1970/01/01
	var timestamp = new Date().getTime();
	//convert our time to :universal time coordinated/ universal coordinated time
	var utc_timestamp=timestamp+(60000*offset);

	$('#time_zone_offset').val(offset);  
	$('#utc_timestamp').val(utc_timestamp);
});