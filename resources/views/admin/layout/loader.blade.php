<section class="loader-section" id="loader-section">

    <input type="hidden" value="{{$autoload}}" name="autoload"/>

    <!--loading-18-->
    <div class="loader loader-18 item-hide">

        <div class="circle"></div>

        <div class="circle"></div>

        <div class="circle"></div>

    </div>

    <!--loading-2-->
    <div class="loader loader-2 item-hide">

        <svg class="loader-star">

            <polygon points="29.8 0.3 22.8 21.8 0 21.8 18.5 35.2 11.5 56.7 29.8 43.4 48.2 56.7 41.2 35.1 59.6 21.8 36.8 21.8 " fill="#18ffff"></polygon>

        </svg>

        <div class="loader-circles"></div>

    </div>

    <!--loading-17-->
    <div class="loader loader-17 item-hide">

        <div class="arc"></div>

        <h1><span>LOADING</span></h1>

    </div>

</section>

<script>

    layui.use(['jquery', 'common'] , function () {

        let $ = layui.$,
            loader = layui.loader;

        //页面loader
        let autoLoad = parseInt($('input[name=autoload]').val());
        
        switch (autoLoad) {
            case 1://自动loading且10s自动关闭
                loader.init(18, true);
                break;
            case 2://自动loading且不自动关闭
                loader.init(18, false);
                break;
            default:
        }

    });
</script>
