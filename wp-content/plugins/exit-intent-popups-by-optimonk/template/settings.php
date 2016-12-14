<div class="wrapper">
    <h2><a href="<?php echo $domain ?>" title="OptiMonk"><img src="<?php echo $pluginDirUrl; ?>/assets/logo.png"></a></h2>
    <div class="register-trial"><?php echo $registerText; ?></div>
    <?php
        include($pluginDirPath . 'template/error.php');
        include($pluginDirPath . 'template/success.php');
    ?>
    <div class="container">
        <div class="form-wrapper">
            <form method="post" action="admin-post.php?action=optimonk_settings" id="settings-form">
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><label for="optiMonk-accountId"><?php echo __('Account Id', 'optimonk'); ?></label></th>
                        <td><input type="text" name="optiMonk_accountId" id="optiMonk-accountId" value="<?php echo get_option('optiMonk_accountId'); ?>" /><span id="insert-code-tooltip" class="dashicons dashicons-editor-help"></span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php @submit_button(); ?></td>
                    </tr><tr>
                        <td colspan="2"><?php echo $reviewLink; ?></td>
                    </tr>
                </table>
            </form>
            <div class="clearfix"></div>
        </div>
        <div class="descriptions">
            <div class="panel">
                <div class="panel-heading"><h4>v1.1</h4></div>
                <div class="panel-body">
                    <?php echo $customVariablesDescription; ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="tooltip" id="tooltip-1" style="display: none; position: absolute;">
        <img src="<?php echo $pluginDirUrl; ?>assets/insert_code_wordpress.jpg" />
    </div>
</div>
<script>
    jQuery(function ($) {
        $('#insert-code-tooltip').hover(function (event) {
            var position = $(event.currentTarget).position();
            var top = position.top + 30;
            var left = position.left - 300;

            $('#tooltip-1').css({'top': top, 'left': left}).show();

        }, function () {
            $('#tooltip-1').hide();
        });
    });
</script>
