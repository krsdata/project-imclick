<div class="banner-box building parallax">
    <div class="container">
        <h2>{{ Lang::get('website-lang.my_account') }}</h2>
    </div>
    
    <div class="container">
    	<div class="row">
            <div class="my-account menu-admin"> 
                <ul class="nav nav-tabs clear">
                    <li role="presentation"><a href="{{ url($lang.'/mon-compte') }}">{{ Lang::get('website-lang.my_profil')}}</a></li>
                    <li role="presentation"><a href="{{ url($lang.'/mon-compte#edit-profile') }}">{{ Lang::get('website-lang.edit_profil')}}</a></li>
                    <li role="presentation"><a href="{{ url($lang.'/mon-compte#order') }}">{{ Lang::get('website-lang.my_favorite_list')}}</a></li>
                    <li role="presentation"><a href="{{ url($lang.'/mon-compte#List') }}">{{ Lang::get('website-lang.building_list')}}</a></li>
                    <li role="presentation"><a href="{{ url($lang.'/mon-compte#Password') }}">{{ Lang::get('website-lang.change_password')}}</a></li>
                    <li role="presentation"><a href="{{ url($lang.'/mon-compte#Transactions') }}">{{Lang::get('website-lang.transactions')}}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>