<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class crawlController extends Controller
{

    public function crawl()
    {
        
    
        $url = 'https://dienmaynguoiviet.vn/smart-tivi-lg-50up8100ptb-50-inch-4k/';
        $html = file_get_html($url);
        $page = $html->getElementById("page-view")->getAttribute("value");

        // $specialDetail = $html->find('.special-detail active');
        // $content  = $html->find('.emty-content');
        // $info  = $html->find('.emty-info table', 0);
        // $arElements = $html->find( "meta[name=keywords]" );
        // $price = $html->find(".p-price", 0);

        echo $page;
    }

   
}
