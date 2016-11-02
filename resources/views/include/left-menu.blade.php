<div class="left-menu">
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#left-menu" aria-expanded="false" aria-controls="left-menu">
        <i class="fa fa-bars"></i> Menu
    </button>
    <div class="collapse in" id="left-menu">
        <div class="well">
            <ul>
                <li class="panel_li"><a href="{{ url($lang.'/acheter') }}">{{ Lang::get('website-lang.buy') }}  </a></li>
                <li class="panel_li"><a href="{{ url($lang.'/vendre') }}">{{ Lang::get('website-lang.sale') }}  </a></li>
                <li class="panel_li"><a href="{{ url($lang.'/forfaits') }}">{{ Lang::get('website-lang.packages') }}  </a></li>
                <li class="panel_li"><a href="{{env('phase1')}}/partenaires/" target="_blank">{{ Lang::get('website-lang.traders') }}  </a></li>
                <li class="panel_li"><a href="{{env('phase1')}}/courtier/" target="_blank">{{ Lang::get('website-lang.brokers') }}  </a></li>
                <li class="panel_li"><a href="{{env('phase1')}}/financement/" target="_blank">{{ Lang::get('website-lang.funding') }}  </a></li>
                <li class="panel_li"><a href="{{ url($lang.'/courtier-immobilier-volontaire') }}">{{ Lang::get('website-lang.voluntary_brokers') }}  </a></li>
            </ul>
        </div>
    </div>
</div>