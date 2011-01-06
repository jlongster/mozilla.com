# Used to create stats.js, just for reference
cat js/jquery-1.3.2.min.js js/jquery-ui-1.7.2.custom.min.js js/jquery.sparkline.min.js js/jquery.tooltip.pack.js jqGrid/jquery.jqGrid.js js/main.js js/moz.stat.map.js | java -jar yuicompressor-2.3.4/build/yuicompressor-2.3.4.jar --type js > js/stats.js

# Used to create stats.css, just for reference
cat ../../../style/tignish/download-stats.css css/smoothness/jquery-ui-1.7.2.custom.css css/jquery.tooltip.css jqGrid/css/ui.jqgrid.css | java -jar yuicompressor-2.3.4/build/yuicompressor-2.3.4.jar --type css > css/stats.css
