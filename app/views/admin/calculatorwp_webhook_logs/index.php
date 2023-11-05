<div class="cwp_wrap">
<div class = "wrap calculatorwp_input">
    <hr>
    <center><h2 class="calculatorwp_main_title">Notification Logs</h2><br>
	
	<br>
    <table class="calculatorwp_list_table">
            <tr style="width:100%;">
                    <td class="calculatorwp_sub_title">
                        <center><b>Notification</b></center>
                    </td>
                    <td class="calculatorwp_sub_title">
                        <center><b>Executed successful</b></center>
                    </td>
                    <td class="calculatorwp_sub_title">
                        <center><b>Retry</b></center>
                    </td>
                    </td>
                    <td class="calculatorwp_sub_title">
                        <center><b>Log Type</b></center>
                    </td>
					<td class="calculatorwp_sub_title">
                        <center><b>Time</b></center>
                    </td>
            </tr>
    <?php  foreach ($objects as $object): ?>

        <?php  $this->render_view('_item', array('locals' => array('object' => $object))); ?>

    <?php endforeach; ?>
    </table>
<hr>
</div>

</div>