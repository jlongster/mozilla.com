<?php
/* ***** BEGIN LICENSE BLOCK *****
 * Version: MPL 1.1/GPL 2.0/LGPL 2.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 * The Original Code is nutch-interface
 *
 * The Initial Developer of the Original Code is
 * Mozilla Corporation.
 * Portions created by the Initial Developer are Copyright (C) 2008
 * the Initial Developer. All Rights Reserved.
 *
 * Contributor(s):
 *   Wil Clouser <clouserw@mozilla.com> (Original Author)
 *
 * Alternatively, the contents of this file may be used under the terms of
 * either the GNU General Public License Version 2 or later (the "GPL"), or
 * the GNU Lesser General Public License Version 2.1 or later (the "LGPL"),
 * in which case the provisions of the GPL or the LGPL are applicable instead
 * of those above. If you wish to allow use of your version of this file only
 * under the terms of either the GPL or the LGPL, and not to allow others to
 * use your version of this file under the terms of the MPL, indicate your
 * decision by deleting the provisions above and replace them with the notice
 * and other provisions required by the GPL or the LGPL. If you do not delete
 * the provisions above, a recipient may use your version of this file under
 * the terms of any one of the MPL, the GPL or the LGPL.
 *
 * ***** END LICENSE BLOCK ***** */

class mozNutch {

    /**
     * What is the URL to get the nutch results from?  No trailing slash.  Example:
     *      http://nutch.mozilla.com
     */
    public $xml_source;

    /**
     * Where is the xsl file to process the nutch results with?
     */
    public $xsl_file;

    /**
     * Default number of results to return?
     */
    public $default_total = 10;

    /**
     * Default offset of results?
     */
    public $default_offset = 0;

    /**
     * What site do you want to search?  If you only want results from mozilla.com, 
     * this should be 'mozilla.com'.  If you want results from anywhere, leave
     * this blank.
     */
    public $server_name = '';

    /**
     * HTML template for the page navigation links.  Substitutions:
     *  NAV_CONTENT is replaced with the actual links and/or images
     */
    public $nav_area = '<div class="pages"><table><tr><td class="searchlabel">Results</td>NAV_CONTENT</tr></table></div>';

    /**
     * HTML template for the previous page link.  Substitutions:
     *  SEARCH_URL is replaced with a link to the previous page
     *  PAGE_NUMBER is replaced with the # of this page
     * The default is a simple link.  For a link with an image, try:
     *   <td class="searchprev">
     *      <a href="SEARCH_URL"><img src="include/prev.gif" alt="Extend Search" /></a>
     *      <br /><a href="SEARCH_URL">Prev</a>
     *   </td>
     */
    public $prev_link = '<td class="searchprev"><a href="SEARCH_URL">Prev</a></td>';

    /**
     * HTML template for the current page.  Substitutions:
     *  SEARCH_URL is replaced with a link to the current page, if you want it
     *  PAGE_NUMBER is replaced with the # of this page
     */
    public $current_link = '<td class="searchcurrent">PAGE_NUMBER</td>';

    /**
     * HTML template for the next page link.  Substitutions:
     *  SEARCH_URL is replaced with a link to the next page
     *  PAGE_NUMBER is replaced with the # of the next page
     */
    public $next_link = '<td class="searchnext"><a href="SEARCH_URL">Next</a></td>';

    /**
     * HTML template for numbered pages that aren't the current one.  Substitutions:
     * SEARCH_URL is replaced with the address of the previous page
     *  PAGE_NUMBER is replaced with the # of this page
     */
    public $page_link = '<td class="searchpage"><a href="SEARCH_URL">PAGE_NUMBER</a></td>';

    /**
     *
     * @param string URL for nutch server
     */
    public function __construct($xml_source) {

        $this->xml_source = $xml_source;

        // Default to use the built in .xsl file
        $this->xsl_file = dirname(__FILE__).'/moz_nutch.xsl';

    }
    
    /**
     * Get the navigation buttons.  HTML is controlled via class variables.  Logic adapted from
     * code on http://search.oregonstate.edu/.
     *
     * @param array options (ironically, most of these are not optional for a usable result):
     *      query: string, unescaped.  Default: 
     *      start: int, start index of results. Default: 0
     *      total: int, total number of results. Default: 0
     *      hitsPerPage: int, number of results per page. Default: 10
     *      hitsPerSite: int, number of hits per site. Default: 0
     *      searchAddress: string, full path to search page. Default: The current script
     *
     * @return string HTML navigation output
     */
    public function getNavigation(array $options) {
        $query         = array_key_exists('query', $options) ? $options['query'] : '';
        $start         = ctype_digit($options['start']) ? $options['start'] : 0;
        $hitCount      = ctype_digit($options['total']) ? $options['total'] : 0;
        $hitsPerPage   = ctype_digit($options['hitsPerPage']) ? $options['hitsPerPage'] : 10;
        $hitsPerSite   = ctype_digit($options['hitsPerSite']) ? $options['hitsPerSite'] : 0;
        $searchAddress = array_key_exists('searchAddress', $options) ? $options['searchAddress'] : $_SERVER['SCRIPT_URL'];

        // Padding numbers define how many pages to show in the numbered page links
        $allPad = 10;
        // show a maximum of 3 pages prior to the current page
        $begPad = 3;

        $endPad = $allPad - $begPad;
        $numPages = ceil($hitCount / $hitsPerPage);
        $thisPage = floor($start / $hitsPerPage) + 1;

        $nav_string = '';

        /* Skip the whole thing, if there isnt more than one page */
        if($numPages > 1) {

            $page_nav_buttons = '';

            $lastPage = $thisPage + $endPad;
            if($thisPage <= $begPad){ $lastPage += $begPad - $thisPage + 1; }
            $lastPage = ($lastPage < $numPages) ? $lastPage : $numPages;

            $firstPage = ($thisPage - $begPad > 1) ? ($thisPage - $begPad):1;
            $firstPage = ($firstPage > $lastPage - $allPad) ? $firstPage : $lastPage - $allPad;
            if($numPages < ($allPad + 1)){ $firstPage = 1; }

            if($firstPage < $thisPage)
            { /* PREVIOUS */
                $prev_link_url = htmlspecialchars($searchAddress).
                                    htmlentities('?query='.urlencode($query).'&hitsPerPage='.$hitsPerPage.'&hitsPerSite='.$hitsPerSite.
                                    '&start='.(($thisPage-2)*$hitsPerPage));

                $prev_link_info = str_replace('SEARCH_URL',$prev_link_url,$this->prev_link);
                $prev_link_info = str_replace('PAGE_NUMBER',$thisPage-1,$prev_link_info);
                $page_nav_buttons .= $prev_link_info;
            }

            for($i=$firstPage; $i <= $lastPage; $i++)
            {
                if($i == $thisPage)
                {
                    $current_link_url = htmlspecialchars($searchAddress).
                                        htmlentities('?query='.urlencode($query).'&hitsPerPage='.$hitsPerPage.'&hitsPerSite='.$hitsPerSite.
                                        '&start='.(($i-1)*$hitsPerPage));
                    $current_link_info = str_replace('SEARCH_URL',$current_link_url,$this->current_link);
                    $current_link_info = str_replace('PAGE_NUMBER',$thisPage,$current_link_info);
                    $page_nav_buttons .= $current_link_info;
                }
                else
                {
                    $page_link_url = htmlspecialchars($searchAddress).
                                        htmlentities('?query='.urlencode($query).'&hitsPerPage='.$hitsPerPage.'&hitsPerSite='.$hitsPerSite.
                                        '&start='.(($i-1)*$hitsPerPage));
                    $page_link_info = str_replace('SEARCH_URL',$page_link_url,$this->page_link);
                    $page_link_info = str_replace('PAGE_NUMBER',$i,$page_link_info);
                    $page_nav_buttons .= $page_link_info;

                }
            }

            if($lastPage > $thisPage)
            {
                $next_link_url = htmlspecialchars($searchAddress).
                                    htmlentities('?query='.urlencode($query).'&hitsPerPage='.$hitsPerPage.'&hitsPerSite='.$hitsPerSite.
                                    '&start='.$thisPage*$hitsPerPage);
                $next_link_info = str_replace('SEARCH_URL',$next_link_url, $this->next_link);
                $next_link_info = str_replace('PAGE_NUMBER',$thisPage+1, $next_link_info);
                $page_nav_buttons .= $next_link_info;
            }

            $nav_string = str_replace('NAV_CONTENT',$page_nav_buttons,$this->nav_area);

        }//if numpages

        return $nav_string;
    }

    /**
     * Run a basic query against nutch
     *
     * @throws Exception - if there is a cURL error
     * @param string query to run
     * @param int total items to return
     * @param int offset to count before returning items
     * @param string locale code to restrict search to. Note, this is specific for 
     *      Mozilla.  Mozilla's sites use the locale as the first parameter in the URL, 
     *      for example, mozilla.com/en-US/index.html.  This option just restricts the URL
     *      to having the locale in it.  It's your responsibilty to make sure this locale
     *      is valid and that your URL scheme is the same. NOT CURRENTLY IMPLEMENTED!
     * @return string XML result
     */
    public function query($query, $total=10, $offset=0, $locale=null) {

        $_query  = urlencode($query);
        $_total  = ctype_digit($total)  ? $total  : $this->default_total;
        $_offset = ctype_digit($offset) ? $offset : $this->default_offset;

        $_query_prefix = '';

        if (!empty($this->server_name)) {
            $_query_prefix .= 'site:'.$this->server_name.'+';
        }

        // Build our query
        $_search_string = "?query={$_query_prefix}{$_query}&hitsPerPage={$_total}&hitsPerSite=0&start={$_offset}";

        $_ch = curl_init();
        curl_setopt($_ch, CURLOPT_URL, "{$this->xml_source}{$_search_string}");
        curl_setopt($_ch, CURLOPT_HEADER, false);
        curl_setopt($_ch, CURLOPT_RETURNTRANSFER, true);
    
        // grab XML via curl
        $_xml = curl_exec($_ch);

        if (curl_errno($_ch)) {
            throw new Exception('cURL error: '.curl_error($_ch));
        } else {
            curl_close($_ch);
        }
        
        return $_xml;
    }

    /**
     * Convenience function to convert XML to HTML
     *
     * @throws Exception - Error loading XML parameter
     * @throws Exception - Error loading XSL file
     * @throws Exception - Error transforming result
     * @param string XML data to transform
     * @return string HTML document
     */
    public function transformXmlToHtml($xml) {

        $_out = new DOMDocument();
        if (!$_out->loadXML($xml)) {
            throw new Exception("Error loading XML string.");
        }
        
        $_xsl = new DOMDocument();
        if (!$_xsl->load($this->xsl_file)) {
            throw new Exception("Error loading XSL file ({$this->xsl_file}).");
        }
        
        $_proc = new XSLTProcessor();
        $_proc->importStyleSheet($_xsl);

        if (($_result = $_proc->transformToDoc($_out)) == false) {
            throw new Exception("Error transforming result.");
        }
        
        return $_result->saveHTML();
    }
    
    /**
     * Convenience function to extract total results from search results XML
     * 
     * @param string search results XML
     * @return mixed int if successful, false on failure
     */
    public function getTotalResultsFromXml($xml) {
        if (preg_match('/\<opensearch:totalResults\>(\d+)\<\/opensearch:totalResults\>/', $xml, $hit)) {
            if (ctype_digit($hit[1])) {
                return $hit[1];
            }
        }
        return false;
    }

    /**
     * Convenience function to extract start index from search results XML
     * 
     * @param string search results XML
     * @return mixed int if successful, false on failure
     */
    public function getStartIndexFromXml($xml) {
        if (preg_match('/\<opensearch:startIndex\>(\d+)\<\/opensearch:startIndex\>/', $xml, $hit)) {
            if (ctype_digit($hit[1])) {
                return $hit[1];
            }
        }
        return false;
    }
}

?>
