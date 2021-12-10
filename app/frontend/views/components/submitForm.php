<?php
?>
<div class="subtext">
    <p class="head">
        Subscribe to newsletter
    </p>
    <p class="content">
        Subscribe to our newsletter and get 10% discount on pineapple glasses.
    </p>
</div>
<div class="emailbox">
    <form action="/addEmail" method="post" id="subform">
        <div class="emailbox-email">
            <div class="vertical-line"></div>
            <input id="email1" name="email1" type="email" placeholder="Type your email address here…">
            <div class="submit-wrap">
                <button type="submit" form="subform" class="btn">
                                                <span class="arrow">
                                        <svg fill="none" height="14" viewBox="0 0 24 14" width="24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.7071 0.2929C17.3166 -0.0976334 16.6834 -0.0976334 16.2929 0.2929C15.9023 0.683403 15.9023 1.31658 16.2929 1.70708L20.5858 5.99999H1C0.447693 5.99999 0 6.44772 0 6.99999C0 7.55227 0.447693 7.99999 1 7.99999H20.5858L16.2929 12.2929C15.9023 12.6834 15.9023 13.3166 16.2929 13.7071C16.6834 14.0976 17.3166 14.0976 17.7071 13.7071L23.7071 7.70708C24.0977 7.31658 24.0977 6.6834 23.7071 6.2929L17.7071 0.2929Z"
                                                  fill="#131821"
                                                  opacity="0.3"/>
                                            </svg>
                                            
                                    </span>
                </button>

            </div>
        </div>
        <br>
        <div class="checkbox-wrap">
            <input id="terms" name="terms" type="checkbox" value="checked"/>
            <label for="terms"> I agree to <span>terms of service</span></label>
        </div>
    </form>

</div>
<?php include __DIR__ . '/errorMsg.php' ?>