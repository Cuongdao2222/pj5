@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('css/colorbox') }}">
<style type="text/css">

    .div-box {
        border: 1px solid #a0a0a0;
    }

    #tabMenuDmPro {
        border-bottom: 0 solid #999;
        width: 100%;
    }

    .text_arrow {
        color: #000039;
        font-weight: 700;
        margin-bottom: 6px;
        margin-top: 6px;
    }

    #tabMenuDmPro a:hover span, #tabMenuDmPro .curent a span {
        background-position: 100% -29px;
        color: #000;
        text-decoration: none;
    }

    #tabMenuDmPro a:hover, #tabMenuDmPro .curent a {
        background-position: 0 -29px;
    }

    .div-box {
        border: 1px solid #a0a0a0;
    }

    #tabMenuDmPro .bgg {
        background: url(../images/bgg_tk.gif);
        height: 29px;
        width: 100%;
        border-left: 0 solid #b1b1b1;
        border-right: 0 solid #b1b1b1;
    }

    #tabMenuDmPro a span {
        background: url({{ asset('images/template/bgg_tk_right.jpg')  }}) right top no-repeat;
        display: block;
        color: #000;
        text-decoration: none;
        float: none;
        padding: 10px 7px 4px 6px;
    }

    #tabMenuDmPro a {
        float: left;
        background: url({{ asset('images/template/bgg_tk_left.jpg')  }}) left top no-repeat;
        text-decoration: none;
        padding: 0 0 0 8px;
    }

    td{
        font-size: 12px;
    }

    span{
        font-size: 12px;
    }

    ul, ol {
        list-style: none;
    }


</style>

<div class="paddings">
    <style type="text/css">
        .div-box table { width:100%;}
    </style>
    <table width="100%">
        <tbody>
            <tr>
                <!--start cot trai-->
                <td valign="top" width="55%">
                    <!--Start don hang-->
                    <div class="pic icon_arrow left"></div>
                    <div class="text_arrow left">Đơn hàng mới nhất:  (<a href="?opt=order">Xem toàn bộ danh sách</a>)</div>
                    <div class="clear"></div>
                    <div style="border:1px solid #6a8ab9 ">
                        <table width="100%" class="table_public" border="1" bordercolor="#e0e0e0">
                            <tbody>
                                <tr class="table_public_tr">
                                    <td width="40">STT</td>
                                    <td width="190">Khách hàng</td>
                                    <td width="130">Thời gian đặt hàng</td>
                                    <td>Giá trị đơn hàng</td>
                                    <td width="120">Xem chi tiết</td>
                                </tr>
                                <?php 
                                    $key =0;
                                ?>
                                @if(isset($order))
                                    @foreach($order as $orders)
                                    <?php $key++; ?>
                                <tr>
                                   
                                    <td width="40">{{ $key }}</td>
                                    <td width="190">{{ @$orders->name }}</td>
                                    <td width="130">{{ @$orders->created_at }}</td>
                                    <td>{{str_replace(',' ,'.', number_format($orders->total_price)) }}</td>
                                    <td width="120"><a href="{{ route('order_list_view', $orders->id) }}">Xem</a></td>
                                    
                                </tr>

                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5">Hiện tại chưa có đơn hàng mới nào !</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!--End don hang-->
                    <!--Start don hang tra gop-->
                    <!--<div>&nbsp;</div>
                        <div class="pic icon_arrow left"></div>
                        <div class="text_arrow left">Đơn hàng trả góp:  (<a href="?opt=payinstall&view=order">Xem toàn bộ danh sách</a>)</div>
                        <div class="clear"></div>
                        <div style="border:1px solid #6a8ab9 ">
                        
                            <table width="100%" class="table_public" border="1" bordercolor="#e0e0e0">
                                <tr bgcolor=#EEEEEE>
                                    <td width=20px>STT</td>
                                    <td width=160px>Thời gian</td>
                                    <td width=160px>Loại hình</td>
                                    <td>Sản phẩm</td>
                                    <td width=100px>xem chi tiết</td>
                                </tr>
                        
                                
                            </table>
                        
                        </div>-->
                    <!--End don hang tra gop-->
                    <!--Start khach hang-->
                    <div>&nbsp;</div>
                    <div class="pic icon_arrow left"></div>
                    <div class="text_arrow left">Khách hàng liên hệ qua website (<a href="?opt=customer&amp;view=customer-contact">Xem toàn bộ danh sách</a>)</div>
                    <div class="clear"></div>
                    <div style="border:1px solid #6a8ab9 ">
                        <table width="100%" class="table_public" border="1" bordercolor="#e0e0e0">
                            <tbody>
                                <tr class="table_public_tr">
                                    <td width="40">STT</td>
                                    <td width="190">Khách hàng</td>
                                    <td width="130">Thời gian</td>
                                    <td>Nội dung</td>
                                    <td width="120">Xem chi tiết</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Hiện tại chưa có liên hệ mới nào !</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--End khach hang-->
                    <!--Start khach hang đánh giá-->
                    <div>&nbsp;</div>
                    <div class="pic icon_arrow left"></div>
                    <div class="text_arrow left">Trao đổi chưa duyệt</div>
                    <div class="clear"></div>
                    <div style="border:1px solid #6a8ab9 ">
                        <table width="100%" class="table_public" border="1" bordercolor="#e0e0e0">
                            <tbody>
                                <tr class="table_public_tr">
                                    <td width="40">STT</td>
                                    <td width="120">Khách hàng</td>
                                    <td>Nội dung</td>
                                    <td width="80">Xem</td>
                                </tr>
                                <tr onmouseover="this.className='row-hover'" onmouseout="this.className=''" class="">
                                    <td class="stt">1</td>
                                    <td class="email">
                                        Thảo Nguyên<br>
                                        <br>
                                        08-02-2022, 7:13 pm                            
                                    </td>
                                    <td class="content">
                                        <div><a href="?opt=product&amp;view=user-comment#review_8643">[product] Tủ lạnh Samsung RT22FARBDSA/SV 243 ...</a></div>
                                        Tủ này khay đựng đá ...                            
                                    </td>
                                    <td>
                                        <a href="?opt=product&amp;view=user-comment#review_8643">
                                            <div class="pic icon_xem"></div>
                                        </a>
                                    </td>
                                </tr>
                                <tr onmouseover="this.className='row-hover'" onmouseout="this.className=''" class="">
                                    <td class="stt">2</td>
                                    <td class="email">
                                        user_name<br>
                                        <br>
                                        05-01-2022, 1:18 am                            
                                    </td>
                                    <td class="content">
                                        <div><a href="?opt=product&amp;view=user-comment#review_8638">[item_type] item_title</a></div>
                                        content                            
                                    </td>
                                    <td>
                                        <a href="?opt=product&amp;view=user-comment#review_8638">
                                            <div class="pic icon_xem"></div>
                                        </a>
                                    </td>
                                </tr>
                                <tr onmouseover="this.className='row-hover'" onmouseout="this.className=''" class="">
                                    <td class="stt">3</td>
                                    <td class="email">
                                        user_name<br>
                                        <br>
                                        05-01-2022, 12:25 am                            
                                    </td>
                                    <td class="content">
                                        <div><a href="?opt=product&amp;view=user-comment#review_8632">[item_type] item_title</a></div>
                                        content                            
                                    </td>
                                    <td>
                                        <a href="?opt=product&amp;view=user-comment#review_8632">
                                            <div class="pic icon_xem"></div>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--End khach hang đánh giá-->
                </td>
                <!--end cot trai-->
                <!--start cot phai-->
                <td width="20">&nbsp;</td>
                <td valign="top">
                    <!--Start thống kê-->
                    <div class="div-box">
                        <div id="tabMenuDmPro">
                            <div class="bgg">
                                <ul>
                                    <li id="select_1" class="curent"><a onclick="ajax_cate(1);" style="cursor:pointer"><span>Sản phẩm xem nhiều</span></a></li>
                                    <li id="select_2"><a onclick="ajax_cate(2); home_report('visitor');" style="cursor:pointer"><span>Truy cập web</span></a></li>
                                    <li id="select_4"><a onclick="ajax_cate(4); home_report('referer')" style="cursor:pointer"><span>Web giới thiệu</span></a></li>
                                    <li id="select_5"><a onclick="ajax_cate(5); home_report('search')" style="cursor:pointer"><span>Từ khóa</span></a></li>
                                    <li id="select_6"><a onclick="ajax_cate(6); home_report('article')" style="cursor:pointer"><span>Bài viết</span></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="space"></div>
                        <div style="display:block; padding: 0 45px; width: 68% ;" id="content_1">
                            <div>Xem nhiều nhất trong 30 ngày qua - <a href="?opt=report&amp;view=product-visit">Xem danh sách</a></div>
                            <div id="top_pro_visit"></div>
                          
                        </div>
                       <!--  <div class="" style="display:none;" id="content_2">
                            <div>Số lượt truy cập website theo ngày - <a href="?opt=report&amp;view=visitor">Xem danh sách</a></div>
                            <div id="home_report_visitor"></div>
                        </div>
                        <div class="" style="display:none;" id="content_3">
                            <div>Sản phẩm mua nhiều nhất trong 30 ngày qua</div>
                            <div id="home_report_product_buy"></div>
                        </div>
                        <div class="" style="display:none;" id="content_4">
                            <div>Website mang người dùng đến</div>
                            <div id="home_report_referer"></div>
                        </div>
                        <div class="" style="display:none;" id="content_5">
                            <div>Tìm kiếm tại website nhiều nhất trong 30 ngày qua - <a href="?opt=report&amp;view=search">Xem danh sách</a></div>
                            <div id="home_report_search"></div>
                        </div>
                        <div class="" style="display:none;" id="content_6">
                            <div>Bài viết xem nhiều nhất trong 30 ngày qua - <a href="?opt=report&amp;view=article-visit">Xem danh sách</a></div>
                            <div id="top_article_visit"></div>
                        </div> -->
                    </div>
                    
                    <!--End thống kê-->
                    
                    <!--Start thong bao tu hurasoft-->
                    <div>&nbsp;</div>
                    <div class="pic icon_arrow left"></div>
                    
                    <!--End thong bao tu hurasoft-->
                </td>
                <!--End cot phai-->
            </tr>
        </tbody>
    </table>
    <script type="text/javascript">
        function home_report(w){
        	$.get("/admin/ajax/report_home.php", {
        	    action : w
        	}, function(data) {
        	    $("#home_report_"+w).html(data);
        	} );
        }
        
           function report_top_article(type, period, holder, limit, from_date, to_date){
               $('#'+holder).html('<img src=/includes/images/awaiting.gif> vui lòng chờ ...');
               $.get("/admin/ajax/report.php",{
                   action : "report-top-article",
                   type : type ,
                   period : period,
                   limit : limit,
                   from_date : from_date,
                   to_date : to_date
               },function(data){
                   $('#'+holder).html(data);
               });
           }
        
        $(function(){
        	$('.thickbox').colorbox({
        	    iframe: true,
                   fixed : true,
                   width:'70%',
                   height:'80%'
        	});
        });
    </script>   
    <input type="hidden" id="current_use1" value="1">
    <script>
        function ajax_cate(idmau) {
          var current_use = document.getElementById('current_use1').value;
          document.getElementById('select_'+current_use).className = '';
          document.getElementById('current_use1').value = idmau;
          document.getElementById('select_'+idmau).className = 'curent';
          document.getElementById('content_'+current_use).style.display = 'none';
          //document.getElementById('content_'+idmau).style.display = 'block';
          $("#content_"+idmau).fadeIn("slow");
        
          if(idmau == 6) {
             report_top_article('visit','mo', 'top_article_visit', 10);
          }
        }
    </script>
</div>
@endsection