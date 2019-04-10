<?php
/**
 * Created by PhpStorm.
 * User: Sanchoss
 * Date: 2019-04-09
 * Time: 12:55
 */


/**
 * @author DemonIa sanchoclo@gmail.com
 * @function run_mightyforms_application
 * @description Render main plugin page, that contain
 * forms list and Mightyforms application (in tabs)
 * @param
 * @returns void
 */
function run_mightyforms_application()
{
   ?>
    <div class="mf-main-block">
        <div class="application-box">
            <iframe id="mf" src="https://dev.mightyforms.com" frameborder="0"
                    style="width: 100%;"></iframe>
        </div>
    </div>
    <?php
}
