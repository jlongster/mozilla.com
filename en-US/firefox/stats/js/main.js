var M = {}

$(function() {
  M.get_total();
  window.setInterval(M.get_total, 60000);
});

M.get_total = function() {
  $.getJSON("/firefox/stats/total.php?callback=?",
  function(json) {
    $('.updating_total').each(function(span) {
      this.innerHTML = M.add_commas(json);
    })
  })  
};

M.add_commas = function(nStr)
{
  nStr += '';

  x       = nStr.split('.');
  x1      = x[0];
  x2      = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;

  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
  return x1 + x2;
}


$(document).ready(function(){
  $('p#vduwrap').show();
  $('#download-tracker').show();
  $('#download-summary').show();
  $('#legend').show();
  $('#thank-yous').show();

  var debug = function(key) {
    var categories = {
      parse: true,
      grid_population: false,
      sort_comparisons: false,
      query_data: false,
      extracted_rows: false,
      get_raw_data: false,
      push_heartbeat: false,
      pagination: false,
      push_row_order: false,
    }

    // Set constant to true or false for debugging
    return window.console && categories[key];
  }
  var jsonURL = "getJSON.php?q=data/country_report.json";

  var previousJSONTime = "";
  var newDataAvailable = false;

  /* parseRawJSON -- called once per minute to process the JSON from the feed and render it into a format
   * suitable for processing by jqGrid
   */
  var parseRawJSON = function(json){
    newDataAvailable = json.seconds[0] > previousJSONTime;
    if (debug("parse")) console.log("Parsing raw JSON version filter %s, time from %s to %s previous time was %s, newdataavailable? %s", json.versionFilter, json.seconds[0], json.seconds[json.seconds.length - 1], previousJSONTime, newDataAvailable);

    if (newDataAvailable) {
      previousJSONTime = json.seconds[0];
    }
    var jsonCountries = json.countries;
    var gridRows = transformedJSON.rows;
    var userdata = transformedJSON.userdata;

    userdata.seconds = json.seconds;

    $.each(jsonCountries, function(i, country) {
      userdata[country.code] = country.rps;
      if (country.code == '**') {
        country.name = 'All countries';
      }
      var r = country.rps[0];
      gridRows.push({code:country.code, name: country.name, trend: r, cur: r, min:r, max:r, total: country.total+r});
    });

    /* If this isn't the first load, call the jqGrid method that I think resets the grid from scratch.
    * Otherwise, initialize the grid
    */
    if (parseRawJSON.isInitialized) {
    if (debug("grid_population")) console.log("Reloading grid");
    $('#data').trigger('reloadGrid');
    } else {
    if (debug("grid_population")) console.log("Initializing grid");
    var mygrid = $('#data').jqGrid({
        datatype: queryData,
        colNames: ['Code','Country','Trend','Cur','Min','Max','Total'],
        colModel: [
        {name:'code',index:'code',width:'30',key:true,hidden:true,searchoptions:{attr:{title:'Type a semicolon separated list of country codes and press enter'},dataInit:function(elm){$(elm).tooltip()}}},
        {name:'name',index:'name',width:'200',searchoptions:{attr:{title:'Type a semicolon separated list of country names and press enter'},dataInit:function(elm){$(elm).tooltip()}}},
        {name:'trend',index:'trend',width:'200',sortable:false,search:false},
        {name:'cur',index:'cur',width:'40',align:'right',formatter:'integer',formatoptions:{thousandsSeparator:","},search:false},
        {name:'min',index:'min',width:'40',align:'right',formatter:'integer',formatoptions:{thousandsSeparator:","},search:false},
        {name:'max',index:'max',width:'40',align:'right',formatter:'integer',formatoptions:{thousandsSeparator:","},search:false},
        {name:'total',index:'total',width:'90',align:'right',formatter:'integer',formatoptions:{thousandsSeparator:","},search:false}
        ],
        pager: $('#pager'),
        rowNum:5,
        rowList:[3,5,10,20],
        sortname:'total',
        sortorder:'desc',
        viewrecords:true,
        height:"auto",
        width:640,
        jsonReader : {repeatitems:false,id:"0"},
        // initialize sparkline maybe not needed
        afterInsertRow : function (rowid, data, rawdata) {
        // initialize the sparkline
        // jQuery do not like id = "**"
        if(rowid != "**") {
            $("td:eq(2)", "#data #"+rowid).sparkline('html', { height: "30px", minSpotColor: "#f00", maxSpotColor: "#0f0", spotRadius:"2", spotColor: "#000"});
        } else {
            $("tr:first td:eq(2)","#data").sparkline('html', { height: "30px", minSpotColor: "#f00", maxSpotColor: "#0f0", spotRadius:"2", spotColor: "#000"});
        }
        },
        // caption:'Firefox 3.6 downloads per second -- '+getCurrentTime(),
    }).navGrid('#pager',{edit:false,add:false,del:false,search:false,refresh:false})
        .navButtonAdd("#pager",{caption:"Reset search",title:"Reset Search",buttonicon :'ui-icon-refresh', onClickButton:function(){ mygrid[0].clearToolbar() } });

    mygrid.filterToolbar({autosearch:true});

    parseRawJSON.isInitialized = true;
    }

    // Update the grid every second with the next second of data from the playback
    pushDataTimer = window.setInterval(pushData, 1000);
  };

  var currentTimeIndex = 0;
  var getCurrentTime = function() {
    var dateString = transformedJSON.userdata.seconds[currentTimeIndex];
    if (true) { // FIX TIMESTAMP HACK
      var localDate = new Date();
      var dateEpoch = Date.parse(dateString.replace(/(\d{4})-(\d{2})-(\d{2}) (\d{2}:\d{2}:\d{2}).0/, "$1/$2/$3 $4 GMT+0100"));
      localDate = new Date(dateEpoch - 180000);
      dateString = localDate.toLocaleString();
    }
    return dateString;
  };

  var pushDataTimer;
  var pushData = function() {
    currentTimeIndex++;
    var userdata = transformedJSON.userdata;
    var rows = transformedJSON.rows;

    // If we don't have data yet, just no-op.
    if (userdata.seconds[currentTimeIndex]) {
      var grid = $('#data');
      // grid.setCaption('Firefox 3.6 downloads per second -- '+getCurrentTime());
      if (debug("push_heartbeat")) console.log("Pushing updated data for second %d (%s)", currentTimeIndex, userdata.seconds[currentTimeIndex]);
      $.each(rows, function(i, row) {

        // This is the number of requests for this country row for the current second.
        var datum = userdata[this.code][currentTimeIndex];

        // Increment the total count
        this.total += datum;

        // Set the current count
        this.cur = datum;
  
        // Test and update min/max if the current second replaces either of them
        if (this.min > datum) this.min = datum;
        if (this.max < datum) this.max = datum;
      });

      // Update the grid with the new records.  We don't resort or repaginate unless the user changes something
      grid.updateGridRows(currentPageRows, 'code');

      if (debug("push_row_order")) console.log("Country codes: %s; grid ids: %s", $.map(currentPageRows, function(n) { return n.code; }).join(),$("#data").getDataIDs().join());
      $.each(currentPageRows, function(i, row) {
        var values = userdata[this.code].slice(0, currentTimeIndex);
        if (this.code != "**") {
          //just in case if there are other grids with country codes
          $("td:eq(2)","#data  #"+this.code).sparkline(values, { height: "30px", minSpotColor: "#f00", maxSpotColor: "#0f0", spotRadius:"2", spotColor: "#000"});
        } else {
          $("tr:first td:eq(2)","#data").sparkline(values, { height: "30px", minSpotColor: "#f00", maxSpotColor: "#0f0", spotRadius:"2", spotColor: "#000"});
        }
        delete this.trend;
      });
    } else {
      window.clearInterval(pushDataTimer);
    }
  };

  var sortRows = function(rows, sord, sidx) {
    rows.sort(function(a,b) {
      // If the user specifies descending, flip the sign on the comparison.
      var ord = (sord == 'desc' ? -1 : 1);
      var retval = 0;

      // Special hack, I always want the summary row to be visible and I always want it at the top of every page.
      if (a.code == '**') retval = -1;
      else if (a[sidx] < b[sidx]) retval = ord * -1;
      else if (a[sidx] > b[sidx]) retval = ord * 1;
      if (debug("sort_comparisons")) console.log('Sorting: sidx %s; sord %s; ord %d; a[sidx] %s; b[sidx] %s; %d', sidx, sord, ord, a[sidx], b[sidx], retval);
      return retval;
    });
  };

  var extractRows = function(postData) {
    var filteredRows;

    if (postData._search) {
      filteredRows = [];
      var key;
      var values = [];
      if (postData.name) {
        key = 'name';
        values = postData.name.split(';');
      } else if (postData.code) {
        key = 'code';
        values = postData.code.split(';');
      }

      $.each(transformedJSON.rows, function(i, row) {
          var keep = false;
          if (row.code == '**') {
            keep = true;
          } else {
            $.each(values, function (j, value) {
              if (row[key].toLowerCase().indexOf($.trim(value.toLowerCase())) >= 0) keep = true;
            });
          }
          if (keep) filteredRows.push(row);
      });
    } else {
      filteredRows = transformedJSON.rows;
    }

    // Perform the sort of the rows.
    sortRows(filteredRows, postData.sord, postData.sidx);

    // Concatenate row 0 (the summary row) with the pagenated slice
    var startIdx = ((parseInt(postData.page) - 1) * parseInt(postData.rows)) + 1;
    var endIdx = startIdx + parseInt(postData.rows);
    if (endIdx - startIdx == 0) endIdx++;
    if (debug("pagination")) {
      var country_codes = "";
      for (var i = startIdx - 8; i < endIdx + 8; i++) {
        if (filteredRows[i] == null) continue;
        country_codes += filteredRows[i].code;
        country_codes += (i == endIdx - 1) ? '] ' : ' ';
        if (i == startIdx - 1) country_codes += '[';
      }
      console.log("Paginating on input page %d; rows %d; returning row 0 + %d rows, %d to %d -- %s", postData.page, postData.rows, (endIdx - startIdx), startIdx, endIdx, country_codes);
    }
    var extractedRows = [filteredRows[0]].concat(filteredRows.slice(startIdx, endIdx));
    extractedRows.total = filteredRows.length;
    return extractedRows;
  };

  /* queryData(postData) -- This method is called by jqGrid to populate the grid based on user input.
   * It supports client side sorting and pagination of the transformed JSON data.
   */
  var queryData = function(postData) {
    if (debug("query_data")) console.dir(postData);

    currentPageRows = extractRows(postData);
    // This is the paginated slice of data that will be consumed by the grid.
    var extract = {
      total: Math.ceil(currentPageRows.total / postData.rows),
      page: postData.page,
      records: currentPageRows.total,
      // Concatenate row 0 (the summary row) with the pagenated slice
      rows: currentPageRows,
      userdata: transformedJSON.userdata,
    };

    if (debug("extracted_rows")) {
      console.log("Returning rows:");
      console.log(extract);
    }

    $('#data')[0].addJSONData(extract);
  };

  var currentPageRows;
  var transformedJSON;
  /* getRawData() -- Clears the old parsed data and loads new data every minute.
   */
  var getRawData = function() {
    window.clearInterval(pushDataTimer);
    currentTimeIndex = 0;
    transformedJSON = {
      rows: [],
      userdata: {}
    };

    if (debug("get_raw_data")) console.group("Updating raw data");
    $.getJSON(jsonURL, parseRawJSON);
    if (debug("get_raw_data")) console.groupEnd();
  }

  // Initially load the data when the page is loaded.
  getRawData();

  // Refresh the source JSON data file very minute (it contains 60 seconds of data)
  window.setInterval(getRawData, 60000);
});
// vim: set tabstop=2 shiftwidth=2 expandtab smartindent:
