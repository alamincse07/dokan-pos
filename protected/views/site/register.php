<?php
$baseUrl = Yii::app()->request->baseUrl;
/**
 * @var $L Language
 */
$L = $this::$L;
?>

<div class="cont_info">

<div class="top_area1">

    <div class="fl-lt">

        <h1>
            <?=$L->g('Register')?>
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
                <?=$L->g('Welcome to My Kees, fill in your details below.')?>
                <div class="clear">
                </div>

            </div>

            <div class="popup_form_row">

                <label>
                    <?=$L->g('Title')?>
                </label>

                <select class="txt_box " name="register_title">

                    <option value="Dhr.">
                        <?=$L->g('Mr.')?>
                    </option>

                    <option value="Dr.">
                        <?=$L->g('Dr.')?>
                    </option>

                    <option value="Drs.">
                        <?=$L->g('Drs.')?>
                    </option>

                    <option value="Ir.">
                        <?=$L->g('Ir.')?>
                    </option>

                    <option value="Mej.">
                        <?=$L->g('Ms.')?>
                    </option>

                    <option value="Mevr.">
                        <?=$L->g('Mrs.')?>
                    </option>

                    <option value="Mr.">
                        <?=$L->g('Mr.')?>
                    </option>

                </select>

                <div class="clear">
                </div>

            </div>

            <div class="popup_form_row">

                <label>
                    <?=$L->g('Name')?>
                </label>

                <input type="text" class="txt_box " name="register_firstname" value="">

                <div class="clear">
                </div>

            </div>

            <div class="popup_form_row">

                <label>
                    <?=$L->g('Insert')?>
                </label>

                <input type="text" class="txt_box " name="register_infix" value="">

                <div class="clear">
                </div>

            </div>

            <div class="popup_form_row">

                <label>
                    <?=$L->g('Surname')?>
                </label>

                <input type="text" class="txt_box " name="register_lastname" value="">

                <div class="clear">
                </div>

            </div>

            <div class="popup_form_row">

                <br />

                <div class="clear">
                </div>

            </div>

            <div class="popup_form_row">

                <label>
                    <?=$L->g('E-mail')?>
                </label>

                <input type="text" class="txt_box " name="register_email" value="">

                <div class="clear">
                </div>

            </div>

            <div class="popup_form_row">

                <label>
                    <?=$L->g('Password')?>
                </label>

                <input type="password" class="txt_box " name="register_password" value="">

                <div class="clear">
                </div>

            </div>

            <div class="popup_form_row">

                <label>
                    <?=$L->g('Password Repeat')?>
                </label>

                <input type="password" class="txt_box " name="register_passwordagain" value="">

                <div class="clear">
                </div>

            </div>

            <div class="popup_form_row">

                <input type="submit" value=<?=$L->g("Register")?> class="opslaan_btn" />

                <div class="clear">
                </div>

            </div>

            <div class="popup_form_row">

                <br />

                <a href="/" class="forgotpassword_btn">
                    <?=$L->g('Back')?>
                </a>

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