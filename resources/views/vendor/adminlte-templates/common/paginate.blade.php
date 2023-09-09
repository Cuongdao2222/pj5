<div class="row">

    <?php 

        $get_find_searchPost = $_GET['searchPost']??'';

        $get_find_promotion = $_GET['promotion']??'';

    ?>
    @if(!empty($get_find_searchPost))

        {!! str_replace('find-post?', 'find-post?searchPost='.$get_find_searchPost.'&', $records->links()) !!}

    @elseif(!empty($get_find_promotion))
    
        {!! str_replace('products?', 'products?promotion='.$get_find_promotion.'&', $records->links()) !!}
       
    @else

    {!! $records->links() !!}
    @endif

</div>
