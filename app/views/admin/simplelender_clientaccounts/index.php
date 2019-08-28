<div class = "wrap simplelender_input">
<center><h2 class="simplelender_main_title">CLIENTS</h2></center>

<center>
<table class="simplelender_list_table">
    <tr style="width:100%;">
	<td class="simplelender_sub_title" >
        <center>NAME</center>
	</td>
	<td class="simplelender_sub_title" >
        <center>ACC NUMBER</center>
	</td>
	<td class="simplelender_sub_title" >
            
	</td>
    </tr>
<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   foreach ($objects as $object): ?>

    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item', array('locals' => array('object' => $object))); ?>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
</table>
<hr>
<center><?php  echo paginate_links($pagination); ?></center>
</center>
</div>


<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   //echo $this->pagination(); ?>