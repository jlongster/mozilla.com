window.onunload = GUnload;

/**
 * Initializes map widget on this page after the document has been loaded
 */
$(document).ready(function()
{
	if (!GBrowserIsCompatible())
		return;

	new Mozilla.Map();
});

// create namespace
if (typeof Mozilla == 'undefined') {
	function Mozilla() {}
}

/**
 * Map widget
 */
Mozilla.Map = function()
{
	this.map = new GMap2(document.getElementById("map"));
	this.map.setCenter(new GLatLng(37.421017, -122.090693), 15);
	this.map.addControl(new GSmallMapControl());
	this.map.addControl(new GMapTypeControl());

	this.locations = new Object();

	var map_locations = document.getElementById('map_locations');
	this.addLocations(map_locations);

	for (var i in this.locations)
		this.map.addOverlay(this.createMarkerEvent(i, this.locations[i]));

	this.updateLocationHash();
}


// Creates a marker at the given point with the given number label
Mozilla.Map.prototype.createMarkerEvent = function(name, loc)
{
	GEvent.addListener(loc.marker, "click", function() {
		loc.marker.openInfoWindowHtml(loc.content);
	});

	return loc.marker;
}

Mozilla.Map.prototype.addLocations = function(startNode)
{
	for (var i = 0; i < startNode.childNodes.length; i++) {
		var loc = startNode.childNodes[i];

		if (loc.nodeType == 1) {
			if (loc.className == 'map-address')
				this.addLocation(loc);
			else if (loc.childNodes.length > 0)
				this.addLocations(loc);
		}
	}
}
//This will check for a hash tag if there is a hash tag it will send the map to that location
Mozilla.Map.prototype.updateLocationHash = function()
{
	var hash = window.location.hash;
	var hashName;
	if (hash !== '') {
		for (var location in this.locations) {
			hashName = '#map-' + location;
			if(hashName === hash){
				this.goToLocation(location);
				return;
			}
		}
	}
	// If no good hash was found, go to default.
	this.goToLocation('mountain_view');
}

Mozilla.Map.prototype.addLocation = function(loc)
{
	var map_links = document.getElementById('map_links');

	var id = loc.id;
	var title_tag = loc.getElementsByTagName('h5')[0];
	var title = title_tag.innerHTML;
	var lat_tag = loc.getElementsByTagName('span')[0];
	var long_tag = loc.getElementsByTagName('span')[1];

	if (lat_tag && long_tag) {
		var address = loc.getElementsByTagName('address')[0].innerHTML;

		this.locations[id] = new GLatLng(
			lat_tag.innerHTML, long_tag.innerHTML);
		this.locations[id].content = '<h5>' + title  + '</h5>'
			+ '<address>' + address + '</address>';
		this.locations[id].marker = new GMarker(this.locations[id]);

		var title_anchor = document.createElement('a');
		title_anchor.innerHTML = title;
		title_anchor.href = '#';
		title_anchor.id = 'link_' + id;
		var that = this;
		$(title_anchor).click(function (e) {
			e.preventDefault(); that.goToLocation(id);
		});
		map_links.appendChild(title_anchor);

		var update_map = document.createElement('a');
		update_map.innerHTML = 'Update Map';
		update_map.href = '#';
		update_map.className = 'update-map';
		$(update_map).click(function (e) {
			e.preventDefault(); that.goToLocation(id);
		});
		document.getElementById(id).appendChild(update_map);
	} else {
		map_links.innerHTML+= '<div id="link_' + id + '">' + title + '</div>';
	}
}

Mozilla.Map.prototype.goToLocation = function(name)
{
	for (var i in this.locations) {
		if (i == name) {
			this.locations[i].marker.openInfoWindowHtml(this.locations[i].content);
			this.map.setCenter(this.locations[i], 15);
			window.location.hash = '#map-' + name;

			if (name == 'china')
				this.map.setMapType(G_SATELLITE_MAP);
			else
				this.map.setMapType(G_NORMAL_MAP);

			break;
		}
	}
}
