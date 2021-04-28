<h2>
					<?= $lang_newpassset_doctitle ?>
                </h2>
                <script>resettoken = "<?= $_GET['token'] ?>";</script>
                <div class="nd_Login_error" style="display: none;" id="login_error_1"><?= $lang_polymer_reset22 ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_2"><?= $lang_polymer_reset23 ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_3"><?= $lang_polymer_reset25 ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_4"><?= $lang_polymer_autherr ?></div>
                <div class="nd_Login_success" style="display: none;" id="login_success"><?= $lang_polymer_reset24 ?></div>
				<div>
					<h3>
                    <?= $lang_newpassset_tagline ?>
					</h3>
					<form name="login_form" action="javascript:submitForm();">
                        <div class="nd_Field nd_Field_input">
							<input id="nd_Field_3" name="password" id="lgpass" type="password"  placeholder="<?= $lang_newpassset_password ?>" />
							<label for="nd_Field_3">
                                <?= $lang_newpassset_password ?>
							</label>
						</div>
						<div class="nd_Field nd_Field_input">
							<input id="nd_Field_4" name="passwordrepeat" id="lgprep" type="password"  placeholder="<?= $lang_newpassset_passwordr ?>" />
							<label for="nd_Field_4">
                                <?= $lang_newpassset_passwordr ?>
							</label>
                        </div>
						<input class="nd_Login_submit" name="submit" type="submit" id="lgsend" value="<?= $lang_newpassset_submit ?>" />
					</form>
				</div>