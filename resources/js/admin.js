var $doc = jQuery(document);
var $win = jQuery(window);

$doc.ready(function () {
  $win.on("YoastSEO:ready", function () {
    new CarbonFieldsYoast();
  });
});
