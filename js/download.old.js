/*
 * This file is soon to be deprecated.  (bug 393634)
 */
var gPlatform = PLATFORM_WINDOWS;
var gCssClass = '';

var PLATFORM_OTHER    = 0;
var PLATFORM_WINDOWS  = 1;
var PLATFORM_LINUX    = 2;
var PLATFORM_MACOSX   = 3;
var PLATFORM_MAC      = 4;
var PLATFORM_SOLARIS  = 5;

if (navigator.platform.indexOf("Win32") != -1 || navigator.platform.indexOf("Win64") != -1) {
  gPlatform = PLATFORM_WINDOWS;
  gCssClass = 'os_windows';
} else if (navigator.platform.indexOf("Linux") != -1) {
  gPlatform = PLATFORM_LINUX;
  gCssClass = 'os_linux';
} else if (navigator.userAgent.indexOf("Mac OS X") != -1) {
  gPlatform = PLATFORM_MACOSX;
  gCssClass = 'os_osx';
} else if (navigator.userAgent.indexOf("MSIE 5.2") != -1) {
  gPlatform = PLATFORM_MACOSX;
  gCssClass = 'os_osx';
} else if (navigator.platform.indexOf("Mac") != -1) {
  gPlatform = PLATFORM_MAC; // This will show up as unsupported (ie. < OS X)
  gCssClass = 'os_osx';

  // Special case for Opera on OS X emulating IE (bug 402113)
  if ((navigator.userAgent.indexOf("Opera") != -1) && (navigator.userAgent.indexOf("Opera 6") == -1)) {
    gPlatform = PLATFORM_MACOSX;
  }
} else if (navigator.platform.indexOf("SunOS") != -1) {
  gPlatform = PLATFORM_SOLARIS;
  gCssClass = '';
} else {
  gPlatform = PLATFORM_OTHER;
  gCssClass = '';
}

/**
 * Gets whether or not the client is an officially unsupported platform
 *
 * Officially unsupported platforms are Windows 95, 98, ME and NT 4.x
 *
 * The regular expression matches:
 *
 *  - Win16
 *  - Win9x
 *  - Win95
 *  - Win98
 *  - WinNT (not followed by version or followed bu version < 5)
 *  - Windows ME
 *  - Windows CE
 *  - Windows 9x
 *  - Windows 95
 *  - Windows 98
 *  - Windows 3.1
 *  - Windows 4.10
 *  - Windows NT (not followed by version or followed by version < 5)
 *  - Windows_95
 */
var gPlatformUnsupported = /(Win(16|9[x58]|NT( [1234]| [^0-9]|[^ -]|$))|Windows ([MC]E|9[x58]|3\.1|4\.10|NT( [1234]| [^0-9]|[^ ]|$))|Windows_95)/.test(navigator.userAgent);

function getPlatformName(aPlatform)
{
  if (aPlatform == PLATFORM_WINDOWS)
    return "Windows";
  if (aPlatform == PLATFORM_LINUX)
    return "Linux i686";
  if (aPlatform == PLATFORM_MACOSX)
    return "Mac OS X";
  if (aPlatform == PLATFORM_SOLARIS)
    return "SunOS";
  return "Unknown";
}

function getPlatformFileSize(aPlatform, aProduct)
{
  if (aProduct == "fx") {
    if (aPlatform == PLATFORM_WINDOWS)
      return "7.7<abbr title=\"megabytes\">MB</abbr>";
    if (aPlatform == PLATFORM_LINUX)
      return "9.4<abbr title=\"megabytes\">MB</abbr>";
    if (aPlatform == PLATFORM_MACOSX)
      return "17.6<abbr title=\"megabytes\">MB</abbr>";
  } else if (aProduct == "fxold") {
    if (aPlatform == PLATFORM_WINDOWS)
      return "7.2<abbr title=\"megabytes\">MB</abbr>";
    if (aPlatform == PLATFORM_LINUX)
      return "8.7<abbr title=\"megabytes\">MB</abbr>";
    if (aPlatform == PLATFORM_MACOSX)
      return "17.3<abbr title=\"megabytes\">MB</abbr>";
  } else if (aProduct == "fxbeta") {
    if (aPlatform == PLATFORM_WINDOWS)
      return "7.7<abbr title=\"megabytes\">MB</abbr>";
    if (aPlatform == PLATFORM_LINUX)
      return "9.4<abbr title=\"megabytes\">MB</abbr>";
    if (aPlatform == PLATFORM_MACOSX)
      return "17.6<abbr title=\"megabytes\">MB</abbr>";
  } else if (aProduct == "tb") {
    if (aPlatform == PLATFORM_WINDOWS)
      return "6.4<abbr title=\"megabytes\">MB</abbr>";
    if (aPlatform == PLATFORM_LINUX)
      return "10.9<abbr title=\"megabytes\">MB</abbr>";
    if (aPlatform == PLATFORM_MACOSX)
      return "18.7<abbr title=\"megabytes\">MB</abbr>";
  } else if (aProduct == "tbold") {
    if (aPlatform == PLATFORM_WINDOWS)
      return "6.1<abbr title=\"megabytes\">MB</abbr>";
    if (aPlatform == PLATFORM_LINUX)
      return "10.2<abbr title=\"megabytes\">MB</abbr>";
    if (aPlatform == PLATFORM_MACOSX)
      return "17.8<abbr title=\"megabytes\">MB</abbr>";
  } else if (aProduct == "tbbeta") {
    if (aPlatform == PLATFORM_WINDOWS)
      return "6.4<abbr title=\"megabytes\">MB</abbr>";
    if (aPlatform == PLATFORM_LINUX)
      return "10.9<abbr title=\"megabytes\">MB</abbr>";
    if (aPlatform == PLATFORM_MACOSX)
      return "18.7<abbr title=\"megabytes\">MB</abbr>";
  }
  return "";
}

function getProductName(aProduct)
{
  if (aProduct == "fx") {
    return "firefox";
  } else if (aProduct == "fxold") {
    return "firefox";
  } else if (aProduct == "fxbeta") {
    return "firefox";
  } else if (aProduct == "fxaurora") {
    return "firefox";
  } else if (aProduct == "tb") {
    return "thunderbird";
  } else if (aProduct == "tbold") {
    return "thunderbird";
  } else if (aProduct == "tbbeta") {
    return "thunderbird";
  }
  return "Unknown";
}

function getDownloadURLForProduct(product, version)
{
  return "http://download.mozilla.org/?product=";
}

// Get a downloadURL given a locale and platform.
// The optional boolean is used when we want to get the download.mozilla.org
// link that points directly to Bouncer.
function getDownloadURLForLanguage(aLangID, aPlatform, directLink)
{
  var abCD = aLangID.abCD;
  var product = getProductName(aLangID.product);
  var version = aLangID[aLangID.product];

  if (aLangID.product == "fxaurora") {
    return getDownloadURLForAuroraForLanguage(product, version, abCD, aPlatform);
  }

  // If we are testing the site locally, or if we explicitly asked for it,
  // give the direct download URL.
  if (window.location.protocol == "file:" ||
      directLink == true) {
    var url = getDownloadURLForProduct(product, version);
  // Otherwise give the download page URL.
  } else {
    var url = "/products/download.html?product=";
  }


  url += product + "-" + version;

  if (typeof gDownloadFunnelCake != 'undefined') {
      url += gDownloadFunnelCake;
  }

  url +="&amp;os=";


  if (aPlatform == PLATFORM_WINDOWS) {
    url += "win";
  } else if (aPlatform == PLATFORM_LINUX) {
    url += "linux";
  } else if (aPlatform == PLATFORM_MACOSX) {
    url += "osx";
    if (abCD == "ja-JP")
      abCD = "ja-JPM";
    if (abCD == "ja")
      abCD = "ja-JP-mac";
  } else if (aPlatform == PLATFORM_SOLARIS) {
    return "http://opensolaris.org/os/community/desktop/communities/mozilla/development/";
  } else {
    return "http://www.mozilla.com/" + abCD + "/" + product + "/all.html";
  }

  return url + "&amp;lang=" + abCD;
}

function getDownloadURLForAuroraForLanguage(aProduct, aVersion, aLocale, aPlatform) {
  var os_file_ext;
  if (aPlatform == PLATFORM_WINDOWS) {
    os_file_ext = "win32.installer.exe";
  } else if (aPlatform == PLATFORM_LINUX) {
    os_file_ext = "linux-i686.tar.bz2";
  } else if (aPlatform == PLATFORM_MACOSX) {
    os_file_ext = "mac.dmg";
  }
  
  var url = "http://ftp.mozilla.org/pub/mozilla.org/firefox/nightly/latest-mozilla-aurora/";
  url += aProduct + "-" + aVersion + "." + aLocale + "." + os_file_ext;

  return url;
}

// "" for a version means it should be "Not Yet Available" on all.html,
// null means it should not be listed
// A region code of "-" means that no region code should be used.
<?php

    require_once dirname(__FILE__).'/../includes/product-details/productDetails.class.php';
    require_once dirname(__FILE__).'/../includes/product-details/firefoxDetails.class.php';
    require_once dirname(__FILE__).'/../includes/product-details/thunderbirdDetails.class.php';

    $productDetails = new ProductDetails();

    echo $productDetails->getJavaScriptDownloadArray();
?>

function LanguageID(aAB, aCD, aProduct, aBuild)
{
  if (aCD == "-")
    this.abCD = aAB;
  else
    this.abCD = aAB + "-" + aCD.toUpperCase();
  this.product = aProduct;
  for (var prop in aBuild)
    this[prop] = aBuild[prop];
}

function buildValidForPlatform(aLangID, aPlatform)
{
  var product = getProductName(aLangID.product);
  var version = aLangID[aLangID.product];
  if ((aLangID.abCD == "gu-IN" ||
       (aLangID.abCD == "pa-IN" &&
        ((product == "firefox" && version < "2.0.0.1") ||
         (product == "thunderbird" && version < "2.0.0.0")))) &&
      (aPlatform == PLATFORM_MACOSX))
    return false;

  return true;
}

function getLanguageIDs(aProduct)
{
  var language = "";
  if (navigator.language)
    language = navigator.language;
  else if (navigator.userLanguage)
    language = navigator.userLanguage;
  else if (navigator.systemLanguage)
    language = navigator.systemLanguage;

  // Convert "en" to "en-US" as well since en-US build is the canonical
  // translation, and thus better tested.
  if (language == "" || language == "en")
    language = "en-US";

  // Konqueror uses '_' where other browsers use '-'.
  if (language.indexOf("_") != -1)
    language = language.split("_").join("-");

  language = language.toLowerCase();
  var languageCode = language.split("-")[0];
  var regionCode = language.split("-")[1];

  // String comparison actually works for version numbers.
  var currentVersion = gLanguages["en"]["us"][aProduct];
  var bestVersion = "";
  var ids = [];

  if (gLanguages[languageCode]) {
    var region;
    var build;
    var langid;

    for (region in gLanguages[languageCode]) {
      build = gLanguages[languageCode][region];
      if (build[aProduct] && regionCode == region) {
        langid = new LanguageID(languageCode, regionCode, aProduct, build);
        if (buildValidForPlatform(langid, gPlatform)) {
          ids[ids.length] = langid;
          bestVersion = build[aProduct];
        }
      }
    }

    // We have a localized build for this language, but not this region.
    // Show all available regions and let the user pick.

    if (bestVersion != currentVersion) {
      var bestRegionVersion = "";
      for (region in gLanguages[languageCode]) {
        build = gLanguages[languageCode][region];
        if (build[aProduct] > bestVersion) {
          langid = new LanguageID(languageCode, region, aProduct, build);
          if (buildValidForPlatform(langid, gPlatform)) {
            ids[ids.length] = langid;
            if (build[aProduct] > bestRegionVersion)
              bestRegionVersion = build[aProduct];
          }
        }
      }
      if (bestRegionVersion > bestVersion)
        bestVersion = bestRegionVersion;
    }
  }

  // Bug 373796 -- Norwegian users need to be offered both nb-NO and nn-NO
  if (regionCode == "no") {
    if (languageCode == "nb") {
      ids[ids.length] = new LanguageID("nn", regionCode, aProduct, gLanguages["nn"][regionCode]);
    }
    if (languageCode == "nn") {
      ids[ids.length] = new LanguageID("nb", regionCode, aProduct, gLanguages["nb"][regionCode]);
    }
  }

  // Offer the en-US version if it has a higher version than the locale
  if (bestVersion != currentVersion) {
    ids[ids.length] = new LanguageID("en", "us", aProduct, gLanguages["en"]["us"]);
  }

  return ids;
}

function writeDownloadItem(aLanguageID)
{
  var item = gDownloadItemTemplate;
  item = item.replace(/%DOWNLOAD_URL%/g,  getDownloadURLForLanguage(aLanguageID, gPlatform));
  item = item.replace(/%BOUNCER_URL%/g,   getDownloadURLForLanguage(aLanguageID, gPlatform, true));
  item = item.replace(/%VERSION%/g,       aLanguageID[aLanguageID.product]);
  item = item.replace(/%PLATFORM_NAME%/g, getPlatformName(gPlatform));
  item = item.replace(/%LANGUAGE_NAME%/g, aLanguageID.name);
  item = item.replace(/%FILE_SIZE%/g,     getPlatformFileSize(gPlatform, aLanguageID.product));
  item = item.replace(/%CSS_CLASS%/g,     gCssClass);
  document.writeln(item);
}

function writeDownloadItems(aProduct)
{
  // Show the dynamic links
  if (gPlatform == PLATFORM_MAC) {
    document.writeln(gDownloadItemMacOS9);
  } else if (gPlatform == PLATFORM_OTHER) {
    document.writeln(gDownloadItemOtherPlatform);
  } else {
    var languageIDs = getLanguageIDs(aProduct);
    for (var i = 0; i < languageIDs.length; ++i)
      writeDownloadItem(languageIDs[i]);
  }
}

function do_download(link)
{

  // get product
  var matches = link.match(/product=([^&]+)/);
  if (matches.length > 1) {
    if (matches[1] == 'fx') {
      var product = 'firefox';
    } else if (matches[1] == 'fxold') {
      var product = 'firefox';
    } else if (matches[1] == 'fxbeta') {
      var product = 'firefox';
    } else if (matches[1] == 'fxaurora') {
      var product = 'firefox';
    } else if (matches[1] == 'tb') {
      var product = 'thunderbird';
    } else if (matches[1] == 'tbold') {
      var product = 'thunderbird';
    } else if (matches[1] == 'tbbeta') {
      var product = 'thunderbird';
    } else {
      var product = 'firefox';
    }
  } else {
    var product = 'firefox';
  }

  // If we have IE, use a new window to push the download.
  // We have to do this because other methods did not work in IE.
  if (navigator.appVersion.indexOf('MSIE') != -1) {
    if (gPlatformUnsupported && product == 'firefox') {
      var unsupportedLink = link.replace(/\/products\/download\.html/, '/firefox/unsupported-systems.html');
      // redirect to unsupported platform page
      window.location = unsupportedLink;
    } else {
      // start the download
      window.open(link, 'download_window', 'toolbar=0,location=no,directories=0,status=0,scrollbars=0,resizeable=0,width=1,height=1,top=0,left=0');
      window.focus();
    }
  }
}
