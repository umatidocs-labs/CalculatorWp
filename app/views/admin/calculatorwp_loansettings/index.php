<div class="calculatorwp_loansettings_index">
<center><h3 class="calculatorwp_main_title">Mortgage Product Manager</h3></center>
<div class = "calculatorwp_input">    
    <center>
    <table class="calculatorwp_list_table ">
		<thead>
			<tr style="width:100%;">
				<th class="calculatorwp_sub_title" >
					Product Name(id)
				</th>
				<th class="calculatorwp_sub_title">
					Interest Rate
				</th>
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
	<tfoot>
			<tr style="width:100%;">
				<th class="calculatorwp_sub_title" >
					Mortgage Product Name( ID )
				</th>
				<th class="calculatorwp_sub_title">
					Interest Rate
				</th>
				</th>
				<th class="calculatorwp_sub_title">                
				</th>
			</tr>
		</tfoot>	
	</table>
    <center><?php  echo paginate_links($pagination); ?></center>
    </center>

</div>
</div>