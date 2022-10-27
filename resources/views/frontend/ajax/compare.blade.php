
@if(!empty($data))

@foreach($data as $datas)

<a href="javascript:void(0)" class="js-compare-item position-relative" data-id="39839">
    <!-- <span class="remove-compare js-remove-compare" onclick="removeCompare({{ $datas->id }})">X</span> -->
    <img src="{{ asset($datas->Image) }}">
    <span>{{ $datas->Name }}</span>
</a>
@endforeach

<?php 
    $count = 3-count($data);
?>

@for($i=1; $i<=$count; $i++)

<a href="javascript:void(0)" class="add-search-popup"  id="search-pro-{{ $i }}">

    <i class="fa-solid fa-plus"></i>

    <span>Thêm sản phẩm</span>
</a>

@endfor

@endif


<div class="modal" tabindex="-1" role="dialog" id="modal-search-pd">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tìm kiếm model</h5>
                <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                    <input type="text" class="input-search ui-autocomplete-input" id="searchs" placeholder="nhập tên hoặc mã model" name="key" autocomplete="off" maxlength="100" required="" id="search-model"> 
                     
                    <button type="button"> <i class="icon-search" onclick="add_Pd_search('')"></i> </button> 
                    <div id="suggesstion-box"></div>
                   <!--  <div id="search-result"></div>  -->
                
            </div>

            <div class="modal-footer">
                
                <button type="button" class="btn btn-secondary close-modal" >Close</button>
            </div>
           
        </div>
    </div>
</div>

<script type="text/javascript">
    var id_name = [];

    $('.add-search-popup').click(function () {

         id_names = $(this).attr('id');

         id_name.push(id_names);

       $('#modal-search-pd').show();

    })

    $('.close-modal').click(function () {
       
      $('#modal-search-pd').hide();
    })
    
   

    function add_Pd_search(search) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
      
        $.ajax({

            url: "{{  route('search-pd-compare')}}",
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                search: search??$('#searchs').val()
            },
           
            success: function (data) {

               let classname =  id_name[0]??'';
               $('#'+classname).html('');
               html = '<img src="https://dienmaynguoiviet.vn/'+data.Image+'"> <span>'+data.Name+'</span>';
               $('#'+classname).append(html);
               $('#modal-search-pd').modal().hide();
               $('#modal-search-pd').modal('hide');
               id_name = [];
               ar_product.push(data.id);
               console.log(group_id);
              
            }
        });
    }

    $(function() {
        $("#searchs").autocomplete({

            minLength: 2,
            
            source: function(request, response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({

                    url: "{{  route('search-input-pd-compare')}}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        search:$('#searchs').val()
                    },
                    dataType: "json",
                    success: function (data) {
                        var items = data;                      
                        
                        // response(items);

                        $("#suggesstion-box").show();
                        $("#suggesstion-box").html(data);

                        
                    
                    }
                });
            },
            html:true,
        });
    });
</script>
