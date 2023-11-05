<div class = "cwp_coms_wrap_outer">
    <center><h3 class="calculatorwp_main_title">All Tickets</h3>
    <table class="loan_stages">
        <tbody><tr>
            <td class="calculatorwp_application_top">
                <a class="calculatorwp_application_top_a" href="<?php echo mvc_admin_url(array('controller' => 'admin_calculatorwp_messages', 'action' => '',)); ?>">All Tickets</a>
            </td>
            <td class="calculatorwp_minfore_top">
                <a class="calculatorwp_application_top_a" href="<?php echo mvc_admin_url(array('controller' => 'admin_calculatorwp_messages', 'action' => 'unresolved_index',)); ?>">Unresolved Tickets</a>
            </td>
        </tr>
    </tbody></table>
    <br>
    </center>

    <center>
        <table class="calculatorwp_list_table">
        <tr style="width:100%;">
            <td class="calculatorwp_sub_title" >
                <center>Ticket Id</center>
            </td>
            <td class="calculatorwp_sub_title">
                <center>Ticket Status</center>
            </td>
            <td class="calculatorwp_sub_title">
                <center>Loan Product</center>
            </td>
            <td class="calculatorwp_sub_title">
                
            </td>
        </tr>
    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   foreach ($objects as $object): ?>

        <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   $this->render_view('_item', array('locals' => array('object' => $object))); ?>

    <?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   endforeach; ?>
    </table>
    <hr>
    <center><?php // echo paginate_links($pagination); ?></center>
    
    </center>

</div>