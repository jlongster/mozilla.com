var M = {};
var d = YAHOO.util.Dom;
var e = YAHOO.util.Event;
var get = YAHOO.util.Get;
var el = null;

M.update = function() {
  return {
    init: function() {
      el = d.get('updating-total')
      if (el) {
        e.onDOMReady(this.start);
      }
    },

    update: function(num) {
      el.innerHTML = M.add_commas(num);
      d.setStyle('download-stats', 'display', 'inline');
    },

    start: function() {
      M.update.updater = false;
      M.update.get();
      M.update.updater = window.setInterval(M.update.get, 60000);
    },

    get: function() {
      get.script("/firefox/stats/total.php?callback=M.update.update");
      if (M.update.updater) {
        window.clearInterval(M.update.updater);
      }
    }
  }

}();


M.update.init();

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
