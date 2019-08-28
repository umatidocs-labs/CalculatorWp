<div class = "wrap simplelender_input">
    <center><h2 class="simplelender_main_title">ALL LOANS</h2></center>
    <center>
    <table class="simplelender_list_table">
            <tr style="width:100%;">
                    <td class="simplelender_sub_title">
                        <center><b>CLIENT NAME</b></center>
                    </td>
                    <td class="simplelender_sub_title">
                            <center><b>LOAN STAGE</b></center>
                    </td>
                    <td class="simplelender_sub_title">
                            <center><b>LOAN PRODUCT</b></center>
                    </td>
                    </td>
                    <td class="simplelender_sub_title">
                           
                    </td>
            </tr>
   <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   foreach ($objects as $object): ?>

    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
    //var_dump($object);
    $this->render_view('_item', array('locals' => array('object' => $object))); ?>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
    </table>
    <center><?php  echo paginate_links($pagination); ?></center>
<hr>
</div>

