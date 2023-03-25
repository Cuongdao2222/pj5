<div class="row">

    <?php 

        $get_find_searchPost = $_GET['searchPost']??'';

    ?>
    @if(!empty($get_find_searchPost))

        {!! str_replace('find-post?', 'find-post?searchPost='.$get_find_searchPost.'&', $records->links()) !!}
       
    @else

    {!! $records->links() !!}
    @endif


    
</div>
