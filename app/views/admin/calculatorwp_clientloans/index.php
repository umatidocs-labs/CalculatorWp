<div class="calculatorwp_clientloans_index">

<center><h3 class="calculatorwp_main_title">All Mortgages</h3></center>
<div class = "calculatorwp_input">    
	<table class="calculatorwp_list_table">
		<thead>
			<tr style="width:100%;">
				<th class="calculatorwp_sub_title" >
					Client Name
				</th>
				<th class="calculatorwp_sub_title">
					Mortgage Stage
				</th>
				</th>
				<th class="calculatorwp_sub_title"> 
					Mortgage Product
				</th>
				<th class="calculatorwp_sub_title">
				</th>
			</tr>
		</thead>
		<tbody>   
	   <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   foreach ($objects as $object): ?>

		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
		//var_dump($object);
		$this->render_view('_item', array('locals' => array('object' => $object))); ?>

		<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
		</tbody>
		<tfoot>
			<tr style="width:100%;">
				<th class="calculatorwp_sub_title" >
					Client Name
				</th>
				<th class="calculatorwp_sub_title">
					Mortgage Stage
				</th>
				</th>
				<th class="calculatorwp_sub_title"> 
					Mortgage Product
				</th>
				<th class="calculatorwp_sub_title">
				</th>
			</tr>
		</tfoot>
    </table>
    <center><?php  echo paginate_links($pagination); ?></center>
</div>

</div>