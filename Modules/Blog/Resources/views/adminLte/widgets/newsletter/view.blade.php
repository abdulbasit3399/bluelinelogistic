<section class="newsletter-widget">
    <div class="wpb_widgetised_column">        
        <div id="mc4wp_form_widget-2" class="content-only widget bdaia-widget widget_mc4wp_form_widget">
            <div class="widget-box-title widget-box-title-s4"><h3>@lang('blog::view.widget_newsletter.newsletter')</h3></div>
            <div class="widget-inner">
                <!-- Mailchimp for WordPress v4.7.4 - https://wordpress.org/plugins/mailchimp-for-wp/ -->
                <form id="mc4wp-form-1" class="mc4wp-form mc4wp-form-66" method="post" data-id="66" data-name="">
                    <div class="bdaia-mc4wp-form-icon"><span class="bdaia-io bdaia-io-ion-paper-airplane"></span></div>
                    <p class="bdaia-mc4wp-bform-p bd1-font">@lang('blog::view.widget_newsletter.get_even_more')</p>
                    <p class="bdaia-mc4wp-bform-p2 bd2-font">@lang('blog::view.widget_newsletter.form_description')</p>
                    <br>
                    <div class="mc4wp-form-fields">
                        <p>
                            <input type="email" name="email" placeholder="@lang('blog::view.widget_newsletter.your_email_address')" required />
                        </p>
                        <p>
                            <input type="submit" value="@lang('blog::view.widget_newsletter.signup')" />
                        </p>
                    </div>
                    {{-- <label style="display: none !important;">
                        Leave this field empty if you're human: <input type="text" name="_mc4wp_honeypot" value="" tabindex="-1" autocomplete="off" />
                    </label> --}}
                    <input type="hidden" name="_mc4wp_timestamp" value="1604594626" />
                    <input type="hidden" name="_mc4wp_form_id" value="66" />
                    <input type="hidden" name="_mc4wp_form_element_id" value="mc4wp-form-1" />
                    <div class="mc4wp-response"></div>
                    <p class="bdaia-mc4wp-bform-p4 bd4-font">
                        @lang('blog::view.widget_newsletter.msg_spam')
                    </p>
                </form>
                <!-- / Mailchimp for WordPress Plugin -->
            </div>
        </div>
        <div class="widget content-only"></div>
    </div>
</section>