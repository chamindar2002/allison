<div class="modal fade  bs-example-modal-lg" id="adcreative-selector-modal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Create an Ad Creative </h4>
            </div>

            <div class='panel-body'>

                <div id="select-links-placeholder">

                    <div class='form-group'>
                        <a href="{{ URL::to('#', null) }}" class="ad-creative-selector-link" data-toggle="modal" data-target="#adcreative-link-ad-modal">
                            <i class="fa fa-plus"></i>
                            <span class="menu-text"><strong> Create a link Ad (not connected to a Page) </strong></span>
                        </a>
                    </div>
                    <br>
                    <div class='form-group'>
                        <a href="{{ URL::to('#', null) }}" class="ad-creative-selector-link" data-toggle="modal" data-target="#adcreative-link-ad-conpage-modal">
                            <i class="fa fa-plus"></i>
                            <span class="menu-text"><strong> Create a Link Ad (connected to a page) </strong></span>
                        </a>
                    </div>
                    <br>
                    <div class='form-group'>
                        <a href="{{ URL::to('#', null) }}" class="ad-creative-selector-link" data-toggle="modal" data-target="#adcreative-call-to-action-modal">
                            <i class="fa fa-plus"></i>
                            <span class="menu-text"><strong> Create a Link Ad with a call to action </strong></span>
                        </a>
                    </div>

                    <br>
                    <div class='form-group'>
                        <a href="{{ URL::to('#', null) }}" class="ad-creative-selector-link" data-toggle="modal" data-target="#adcreative-video-page-modal">
                            <i class="fa fa-plus"></i>
                            <span class="menu-text"><strong> Create a Video Page Like Ad </strong></span>
                        </a>
                    </div>

                    <br>
                    <div class='form-group'>
                        <a href="{{ URL::to('#', null) }}" class="ad-creative-selector-link" data-toggle="modal" data-target="#adcreative-page-post-modal">
                            <i class="fa fa-plus"></i>
                            <span class="menu-text"><strong> Create an Ad From an Existing Page Post </strong></span>
                        </a>
                    </div>

                    <br>
                    <div class='form-group'>
                        <a href="{{ URL::to('#', null) }}" class="ad-creative-selector-link" data-toggle="modal" data-target="#adcreative-carousel-ad-modal">
                            {{--<i class="fa fa-plus disabled"></i>--}}
                            <i class="fa fa-plus"></i>
                            <span class="menu-text"><strong> Create a Carousel Ad </strong></span>
                        </a>
                    </div>

                </div>

                <div id="adcreative-form-placeholder">

                    @include('admanager.wizard._adcreative_link_ad_form')

                    @include('admanager.wizard._adcreative_link_ad_conpage_form')

                    @include('admanager.wizard._adcreative_call_to_action_form')

                    @include('admanager.wizard._adcreative_video_page_form')

                    @include('admanager.wizard._adcreative_page_post_form')

                    @include('admanager.wizard._adcreative_carousel_ad_form')


                </div>

            </div>
        </div>
    </div>
</div>


