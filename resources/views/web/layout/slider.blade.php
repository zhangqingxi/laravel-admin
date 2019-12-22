<script src="{{ asset('/static/common/flux/js/flux.js') }}" type="text/javascript" charset="utf-8"></script>
<section class="slider-container">
    <img src="{{ asset('/static/images/1.jpg') }}" alt=""/>
    <img src="{{ asset('/static/images/1.jpg') }}" alt=""/>
    <img src="{{ asset('/static/images/1.jpg') }}" alt=""/>
    <img src="{{ asset('/static/images/4.jpg') }}" alt=""/>
</section>
<script type="text/javascript" charset="utf-8">
    $(function () {
        window.f = new flux.slider('.slider-container', {
            pagination: false,
            controls: true,
            transitions: ['explode', 'tiles3d', 'blinds3d', 'zip', 'blocks', 'concentric', 'bars', 'turn', 'warp'],
            autoplay: true,
            width:'100%',
            height: 400,
        });
    });
</script>