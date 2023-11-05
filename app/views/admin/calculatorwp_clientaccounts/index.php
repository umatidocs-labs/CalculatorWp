<div class="cwp_borrower_wrapper">
<center><h3 class="calculatorwp_main_title">Borrowers</h3></center>

<div class = "">
<center><table class="calculatorwp_list_table">
		<thead>
			<tr style="width:100%;">
				<th class="calculatorwp_sub_title" >
					Name
				</th>
				<th class="calculatorwp_sub_title">
					ACC Number
				</th>
				<th class="calculatorwp_sub_title"> 
				</th>
			</tr>
		</thead>
		<tbody>  
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   foreach ($objects as $object): ?>

	<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item', array('locals' => array('object' => $object))); ?>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
</tbody>
 <thead>
	<tr style="width:100%;">
		<th class="calculatorwp_sub_title" >
			Name
		</th>
		<th class="calculatorwp_sub_title">
			ACC Number
		</th>
		<th class="calculatorwp_sub_title"> 
		</th>
	</tr>
</thead>
</table>

<center><?php  echo paginate_links($pagination); ?></center>

</div>


<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */  ?>

</div>