<?php
$baseUrl = Yii::app()->request->baseUrl;
$L = $this::$L;
?>
<div class="cont_info">

    <div class="top_area1">

        <div class="fl-lt">

            <h1>
                <?=$L->g('Forgot Password')?>
            </h1>

        </div>

        <div class="fl-rt">

            <div class="clear">
            </div>

        </div>

        <div class="clear">
        </div>

    </div>

    <div class="icon_area2 lessmrgin2 loginbox">

        <form method="post">

            <div class="popup_left">

                <div class="popup_form_row register_text">
                    <?=$L->g('Enter your email address to request a new password')?>
                    <div class="clear">
                    </div>

                </div>

                <?=$L->g(@$message)?>
                <div class="popup_form_row">

                    <label>
                        <?=$L->g('E-mail')?>
                    </label>

                    <input type="text" class="txt_box" name="email" value="">

                    <div class="clear">
                    </div>

                </div>

                <div class="popup_form_row">

                    <input type="submit" name="submit-btn" value="Opvragen" class="opslaan_btn" />

                    <div class="clear">
                    </div>

                </div>

                <div class="popup_form_row">

                    <br />



                    <div class="clear">
                    </div>

                </div>

            </div>

            <div class="clear">
            </div>

        </form>

    </div>

    <div class="contactno">
        <?=$L->g('Please call us directly at 0186-6277777 or mail your')?>
        <a href="javascript:void(0);">
            <?=$L->g('advisor')?>
        </a>

        <div class="txt3">
            <?=$L->g('Need Help')?>
        </div>

    </div>

</div>