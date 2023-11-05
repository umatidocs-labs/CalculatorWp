<div class = "wrap calculatorwp_input">
    <hr>
    <center><h2 class="calculatorwp_main_title">LOAN FLOW</h2></center>
    <center>
    <table class="calculatorwp_list_table">
            <tr style="width:100%;">
                    <td class="calculatorwp_sub_title">
                            <b>CLIENT NAME</b>
                    </td>
                    <td class="calculatorwp_sub_title">
                            <b>LOAN STAGE</b>
                    </td>
                    <td class="calculatorwp_sub_title">
                            <b>LOAN PRODUCT</b>
                    </td>
                    </td>
                    <td class="calculatorwp_sub_title">
                           <b>HOUSE KEEPING</b>
                    </td>
            </tr>
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   foreach ($objects as $object): ?>

        <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item', array('locals' => array('object' => $object))); ?>

    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
    </table>
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->pagination(); ?>
<hr>
</div>
<?php sl_hide_mitem(); ?>
