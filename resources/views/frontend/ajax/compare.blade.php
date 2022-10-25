
@if(!empty($data))

@foreach($data as $datas)
<a href="javascript:void(0)" class="js-compare-item position-relative" data-id="39839">
    <span class="remove-compare js-remove-compare" onclick="removeCompare(this)"></span>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               
                    <input type="text" class="input-search ui-autocomplete-input" id="searchs" placeholder="nhập tên hoặc mã model" name="key" autocomplete="off" maxlength="100" required=""> 
                    <button type="button"> <i class="icon-search" onclick="add_Pd_search('')"></i> </button> 
                    <div id="search-result"></div> 
                
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
    
    

    function add_Pd_search() {

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
                search:$('#searchs').val()
            },
           
            success: function (data) {

               let classname =  id_name[0]??'';
               $('#'+classname).html('');
               html = '<img src="https://dienmaynguoiviet.vn/'+data.Image+'"> <span>'+data.Name+'</span>';
               $('#'+classname).append(html);
               $('#modal-search-pd').modal().hide();
               id_name = [];

               ar_product.push(data.id);
              
            }
        });
    }
</script>
