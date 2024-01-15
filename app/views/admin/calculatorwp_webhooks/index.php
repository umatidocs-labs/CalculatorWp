<div class = "calculatorwp_input cwp_coms_wrap_outer">
  
    <center>
        <h3 class="calculatorwp_main_title">All Notifications</h3>
        <table class="loan_stages">
        <tbody><tr>
            <td class="calculatorwp_application_top">
                <a class="calculatorwp_application_top_a" href="<?php echo mvc_admin_url(array("controller" => "calculatorwp_webhooks", "action" => "index", "id" =>"" )); ?>">All Custom Email(s)</a>
            </td>
            <td class="calculatorwp_minfore_top">
                <a class="calculatorwp_application_top_a" href="<?php echo mvc_admin_url(array("controller" => "calculatorwp_webhooks", "action" => "add", "id" =>"")); ?>">New Custom Email</a>
            </td>
        </tr>
    </tbody></table>
    <br>
    </center>
    <center>
    <table class="calculatorwp_list_table_index">
            <tr style="width:100%;">
					<td class="calculatorwp_sub_title">
                        <center>Active</center>
                    </td>
                    <td class="calculatorwp_sub_title">
                        <center>Title</center>
                    </td>
                    <td class="calculatorwp_sub_title">
                        <center>Trigger</center>
                    </td>  
                    <td class="calculatorwp_sub_title">
                        <center>Last Event Trigger</center>
                    </td>
					<td class="calculatorwp_sub_title">
                        <center>Number of Triggers</center>
                    </td>
					<td class="calculatorwp_sub_title">
                        <center>Unsuccessful Attempts</center>
                    </td>
                    </td>
                    <td class="calculatorwp_sub_title">
                        <center>Active Retries</center>
                    </td>
            </tr>
    <?php  foreach ($objects as $object): ?>

        <?php  $this->render_view('_item', array('locals' => array('object' => $object))); ?>

    <?php endforeach; ?>
    </table>
<hr>
</div>
<?php  
    $notification_arr=[];
    foreach ($objects as $object){
        $notification_arr["calculatorwpWebhookNotificationIsActive".$object->id] = $object->id;
    }
?>

<script type="text/javascript">
    calculatorwp_number_of_notifications=<?php echo json_encode( $notification_arr ); ?>;
</script>