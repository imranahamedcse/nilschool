<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
    *{
        margin: 0;
        padding: 0;
    }
      /* page-content */
      .page-content {
          display: flex;
          justify-content: center;
          align-items: center;
      }
      a{
          text-decoration: none;
      }
      /* Email Template */

      .email-template {
          font-family: "Lexend", sans-serif;
          text-align: center;
          padding: 56px 60px;
          background: white;
          border-radius: 5px;
          max-width: 600px;
          box-shadow: 1px 1px 20px 1px #d5d5d5;
      }

      .email-template .template-heading h1 {
          font-family: "Lexend", sans-serif;
          font-weight: 600;
          font-size: 24px;
          line-height: 34px;
          margin-top: 20px;
      }

      .email-template .template-heading p {
          font-family: "Lexend", sans-serif;
          font-size: 16px;
          line-height: 24px;
          color: #6f767e;
          margin-top: 20px;
      }

      .email-template .template-heading .color-black {
          color: #1a1d1f;
      }

      .email-template .template-body {
          font-family: "Lexend", sans-serif;
          font-weight: 400;
          font-size: 14px;
          line-height: 24px;
          color: #6f767e;
          padding: 14px;
      }

      .email-template .template-body .content-part {
          text-align: left;
          margin-bottom: 28px;
      }

      .email-template .template-body .content-part p a {
          font-family: "Lexend", sans-serif;
          color: #0f6aff;
      }

      .email-template .template-body .content-part h5 {
          font-family: "Lexend", sans-serif;
          color: #1a1d1f;
          margin-top: 28px;
          padding: 0;
      }

      .email-template .template-body .content-details p {
          font-family: "Lexend", sans-serif;
          padding: 0 14px;
          margin-bottom: 28px;
      }

      .email-template .template-body .content-details p .link {
          color: #0f6aff;
      }

      .email-template .template-body .primary-text {
          font-family: "Lexend", sans-serif;
          font-weight: 600;
          font-size: 16px;
          line-height: 24px;
          color: #0f6aff;
          margin-top: 26px;
      }

      .email-template .template-body h4 {
          font-family: "Lexend", sans-serif;
          font-weight: 600;
          font-size: 16px;
          color: #29d697;
      }

      .email-template .template-body h5 {
          font-family: "Lexend", sans-serif;
          padding: 0 14px;
      }

      .email-template .template-button-group {
          display: flex;
          align-items: center;
          justify-content: center;
          padding-left: 14px;
          gap: 10px;
      }

      .email-template .template-button-group .template-btn {
          padding: 9px 2px;
          border-radius: 7px;
          background: linear-gradient(90deg, #0f6aff 0%, #21c6fb 100%);
      }

      .email-template .template-button-group .template-btn span {
          font-family: "Lexend", sans-serif;
          padding: 10px 16px;
          font-weight: 600;
          color: white;
          background: linear-gradient(90deg, #0f6aff 0%, #21c6fb 100%);
      }

      .email-template .template-button-group .template-btn span:hover {
          outline: none;
          border: none;
          color: #0f6aff;
          border-radius: 5px;
          background: white;
      }

      .email-template .template-btn-container {
          display: flex;
          align-items: center;
          justify-content: flex-start;
      }

      .email-template .template-btn-container .template-btn {
          padding: 9px 2px;
          border-radius: 7px;
          background: linear-gradient(90deg, #0f6aff 0%, #21c6fb 100%);
      }

      .email-template .template-btn-container .template-btn span {
          font-family: "Lexend", sans-serif;
          padding: 10px 16px;
          font-weight: 600;
          color: white;
          background: linear-gradient(90deg, #0f6aff 0%, #21c6fb 100%);
      }

      .email-template .template-btn-container .template-btn span:hover {
          outline: none;
          border: none;
          color: #0f6aff;
          border-radius: 5px;
          background: white;
      }

      .email-template .template-footer {
          font-family: "Lexend", sans-serif;
          font-weight: 500;
          font-size: 12px;
          line-height: 15px;
          color: #6f767e;
          border-top: 1px solid #dfe6e9;
          margin-top: 26px;
      }

      .email-template .template-footer p>a {
          color: #0f6aff;
          text-decoration: none;
      }

      .email-template .template-footer .social-media-button {
          display: flex;
          justify-content: center;
          align-items: center;
          margin-top: 26px;
          gap: 8px;
      }

      .email-template .template-footer .social-media-button a {
          display: flex;
          justify-content: center;
          align-items: center;
          padding: 8.5px;
          border-radius: 50%;
          background: linear-gradient(90deg, #0f6aff 0%, #21c6fb 100%);
      }

      .email-template .template-footer .social-media-button a:hover {
          background: linear-gradient(90deg, #21c6fb 0%, #0f6aff 100%);
      }

      .email-template .template-footer .template-footer-image {
          margin-top: 28px;
          margin-bottom: 8px;
      }

      @media (max-width: 576px) {
          .email-template {
              padding: 26px 30px;
          }

          .email-template .template-heading h1 {
              font-size: 20px;
              padding: 0 10px;
          }

          .email-template .template-heading p {
              font-size: 16px;
              padding: 0 8px;
          }

          .email-template .template-body {
              font-weight: 400;
              font-size: 14px;
              line-height: 24px;
              color: #6f767e;
          }

          .email-template .template-body p {
              padding: 0;
          }

          .email-template .template-body .template-content-image img {
              width: 100%;
              height: 100%;
          }

          .email-template .template-body h5 {
              padding: 0;
          }

          .email-template .template-button-group {
              flex-direction: column;
              padding: 0;
          }

          .email-template .template-button-group button {
              width: 100%;
          }

          .email-template .template-footer {
              font-size: 7px;
          }
      }
      @media (max-width: 420px) {
          .email-template {
              padding: 20px 7px;
          }
          .email-template .template-body {
              font-size: 12px;
          }
          .email-template .template-body .primary-text {
           margin-top: 26px;
          }
      }
    </style>
  </head>
  <body>
    <!-- Custom CSS  end -->
<div class="page-content">
    <!-- Start email tamplate  -->
    <div class="email-template">
        <!-- Start template header  -->
        <div class="template-heading">
            <img src="{{ @globalAsset(setting('favicon')) }}" alt="Frame">
        </div>
        <!-- End template header  -->
        <!-- Start template body  -->
        <div class="template-body">
            <!-- template text  -->
            <div class="content-part">
                <p class="primary-text">{{ ___('auth.confirm_your_e_mail_address') }}</p>
                <p>{{ ___('auth.hello_user') }}</p>
                <p>{{ ___('auth.welcome!') }}
                    <br> {{ ___('auth.are_receiving_this_email_because_you_have_registered_on_our_site') }}
                </p>

                <p> {{ ___('auth.click_the_link_below_to_active_your_laravel_starter_kit_account') }}
                </p>
                <p>
                    {{ ___('auth.this_link_will_expire_in_15_minutes_and_can_only_be_used_once') }}
                </p>
            </div>
            <!-- template button start -->
            <div class="template-btn-container">
                <a href="{{ route('verify-email', [$data->email, $data->token]) }}" class="template-btn">
                <span>{{ ___('auth.verify_email') }}</span>
            </a>
            </div>
            <!-- template button end -->
            <div class="content-part">
                <h5>{{ ___('auth.or') }}</h5>
                <p>{{ ___('auth.if_the_button_above_does_not_work_paste_this_link_into_your_web_browser') }}</p>
                <p>
                    <a class="link" href="{{ route('verify-email', [$data->email, $data->token]) }}">{{ route('verify-email', [$data->email, $data->token]) }}</a>
                </p>
                <p>{{ ___('auth.if_you_did_not_make_this_request_please_contact_us_or_ignore_this_message') }}</p>
            </div>
        </div>
        <!-- End template body -->
        <!-- Stat template footer  -->
        <div class="template-footer">
            <div class="template-footer-image">
                <!-- logo  -->
                <img src="{{ @globalAsset(setting('light_logo'), '150X40.svg') }}" alt="Logo">
            </div>

            <p>{{ Setting('footer_text') }}</p>

        </div>
        <!-- End template footer -->
    </div>
    <!-- End email template  -->
</div>
  </body>
</html>

