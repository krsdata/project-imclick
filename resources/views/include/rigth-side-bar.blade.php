<div class="side-box saved-text-box">
    <a target="_blank" href="{{env('phase1')}}/partenaires/"><img src="@if($lang=='FR') {{ URL::asset('website/images/rabais-partenaire.gif') }} @else {{ URL::asset('website/images/exclusive-discounts.jpg') }} @endif" /></a>
</div>
<div class="side-box saved-text-box">
    <h2 class="side-title">{{ Lang::get('website-lang.trader') }}</h2>
    <h3 class="side-sub-title">{{ Lang::get('website-lang.enjoy_from_exclusive_discounts') }}</h3>
</div>
<div class="side-box saved-text-box">
    <a href="{{env('phase1')}}/partenaire/?ID={{Helper::GetCommercantVedette()->UrlName}}">
    <img src="{{env('phase1')}}/plateforme/wp-content/themes/boldial/SolutionCode/Image/Commercants/{{Helper::GetCommercantVedette()->Logo}}" alt="Logo" style="width:100%"/></a> 
    <span class="side-sub-title">{{ Lang::get('website-lang.enjoy_from_exclusive_discounts') }}</span>
</div>

<div class="side-box saved-text-box">
    <a href="{{env('phase1')}}/partenaires/" class="btn sidebar-button">{{ Lang::get('website-lang.check_merchants') }}</a>
</div>
<div class="side-box saved-text-box">
    <h2 class="side-title">{{ Lang::get('website-lang.testimonials') }}</h2>
    <h3 class="side-sub-title">{{ Lang::get('website-lang.our_customers') }}</h3>
</div>
<div class="testimonials-box">
    <div id="testimonials-slider" class="owl-carousel owl-theme">
        @foreach($reviews as $key => $result)
        <div class="item">
            <h4 class="testimonials-title">
                {{Helper::GetReviewTitle($result['Rate'])}}! 
                <span class="rating-box">
                    <img src="{{URL::asset('website/images/rating' . $result['Rate'] . '.png')}}" alt="Appréciations" />
                </span>
            </h4>
            <p class="testimonials-content">{{$result["Text"]}}</p>
            <p class="testimonials-name">- {{$result["Username"]}}</p>
        </div>
        @endforeach
    </div>
</div>
<div class="side-box saved-text-box">
	<img src="{{URL::asset('website/images/logo-deuil-jeunesse.png')}}" alt="Logo Deuil-Jeunesse" />
    <a href="{{env('phase1')}}/tournez-pour-donner/" class="btn sidebar-button deuil-jeunesse">Tournez pour donner</a>
</div>
