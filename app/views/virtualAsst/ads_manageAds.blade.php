<div class="tab-pane" id="manageAds">
	<div style="margin:20px">
		<h3>Published ads:</h3>
		<div style="margin: 10px">
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<td>Title</td>
					<td>Description</td>
					<td>URL</td>
					<td>Remaining budget</td>
				</tr>
			</thead>
			<tbody>
			<?php $ads = array( 	array("title"=>"title1", "description"=>"description1", "url"=>"http://www.url1.com", "budget"=>"100"),
										array("title"=>"title2", "description"=>"description2", "url"=>"https://www.url2.com", "budget"=>"200"),
										);
			?>
			@foreach($ads as $key => $value)
				<tr>
					<td>{{{ $value["title"] }}} </td>
					<td>{{{ $value["description"] }}} </td>
					<td>{{{ $value["url"] }}} </td>
					<td>{{{ $value["budget"] }}} </td>
				</tr>
			@endforeach
			</tbody>
		</table>
		</div><!-- margin 10px -->
		
		<a href="#" class="btn btn-primary" id="asst_ads_publish">Publish new ads</a>

	</div><!-- margin 20px -->
</div> <!--tab pange -->

