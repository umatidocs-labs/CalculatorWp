<div class = "wrap calculatorwp_input">
    <hr>
    <center><h2 class="calculatorwp_main_title">Notification Logs</h2><br>
	
	<br>
    <table class="calculatorwp_list_table">
            <tr style="width:100%;">
                    <td class="calculatorwp_sub_title">
                            <b>Notification</b>
                    </td>
                    <td class="calculatorwp_sub_title">
                            <b>Executed successful</b>
                    </td>
                    <td class="calculatorwp_sub_title">
                            <b>Retry</b>
                    </td>
                    </td>
                    <td class="calculatorwp_sub_title">
                           <b>Log Type</b>
                    </td>
					<td class="calculatorwp_sub_title">
                           <b>Time</b>
                    </td>
            </tr>
    <?php  foreach ($objects as $object): ?>

        <?php  $this->render_view('logs_item', array('locals' => array('object' => $object))); ?>

    <?php endforeach; ?>
    </table>
<hr>
</div>

