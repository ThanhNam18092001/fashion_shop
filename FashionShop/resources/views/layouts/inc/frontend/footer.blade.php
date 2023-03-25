<link rel="stylesheet" href="{{ asset('assets/css/frontend/footer.css') }}" rel="stylesheet">
<div class="footer" id="footer">
    <div class="footer-container">
        <ul class="footer-ul">
            <li class="footer-title">Company</li>
            <li class="footer-content">About Us</li>
            <li class="footer-content">Affliate</li>
            <li class="footer-content">Fashion Blogger</li>
        </ul>
        <ul class="footer-ul">
            <li class="footer-title">Help & Support</li>
            <li class="footer-content">Shipping Info</li>
            <li class="footer-content">Refunds</li>
            <li class="footer-content">How to Order</li>
            <li class="footer-content">How to Track</li>
            <li class="footer-content">Size Guides</li>
        </ul>
        <ul class="footer-ul">
            <li class="footer-title">Customer Care</li>
            <li class="footer-content">Payment Methods</li>
            <li class="footer-content">Bonus Point</li>
        </ul>
        <ul class="footer-ul">
            <li class="footer-title">Contact Us</li>
            <li class="footer-content"><img class="footer-icon" src="{{ url('image_path/icon_mail.png') }}">
                {{ $appSetting->email1 ?? 'Email 1' }}</li>
            <li class="footer-content"><img class="footer-icon" src="{{ url('image_path/icon_phone.png') }}">
                {{ $appSetting->phone1 ?? 'Phone 1' }}</li>
            <li class="footer-content">
                @if ($appSetting->facebook)
                    <a href="" target="_blank"><img class="footer-icon"
                            src="{{ url('image_path/icon_facebook.png') }}"></a>
                @endif
                @if ($appSetting->instagram)
                    <a href="" target="_blank">
                        <img class="footer-icon" src="{{ url('image_path/icon_instagram.png') }}"></a>
                @endif
                @if ($appSetting->youtube)
                    <a href="" target="_blank">
                        <img class="footer-icon" src="{{ url('image_path/icon_youtube.png') }}"></a>
                @endif
            </li>
            <li class="footer-content">
                @if ($appSetting->master_cart)
                    <a href="" target="_blank">
                        <img class="footer-icon" src="{{ url('image_path/icon_mastercard.png') }}"></a>
                @endif
                @if ($appSetting->visa)
                    <a href="" target="_blank">
                        <img class="footer-icon" src="{{ url('image_path/icon_symbols.png') }}"></a>
                @endif
                @if ($appSetting->paypal)
                    <a href="" target="_blank">
                        <img class="footer-icon" src="{{ url('image_path/icon_paypal.png') }}"></a>
                @endif
            </li>
        </ul>
    </div>
    <div class="footer-bottom">
        <p>© 2021 Couture2gether</p>
        <p>Site by Uway Technology</p>
    </div>
</div>
@yield('bottom')
