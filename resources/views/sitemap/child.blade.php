<url>
	<url>
		<loc>https://dienmaynguoiviet.vn</loc>
	</url>


	@if(isset($product))
    @foreach($product as $products)
    <url>
		<loc>{{ route('details',$products->Link) }}</loc>
	</url>	
	@endforeach    
    @endif
</url>