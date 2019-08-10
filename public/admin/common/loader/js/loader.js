layui.define(['jquery'], function (exports) {

    let $ = layui.$;

    layui.link(ROOT_COMMON_URL+'loader/css/loader.css');

    let windowHeight = window.innerHeight, bodyHeight = $('body').height();

    let obj = {

        height:function(){

            return Math.max(document.body.clientHeight, document.documentElement.clientHeight);

        },

        init:function(loaderNumber, autoClose = true){

            $('.loader-section').css({'background-color' : '#000', 'height':this.height(), 'z-index' : '9999'}).find('.loader-'+loaderNumber).removeClass('item-hide');

            if(autoClose){

                setTimeout(function () {

                    obj.close(loaderNumber);

                }, 1000);

            }

        },

        open:function (loaderNumber) {

            // console.log(document.body.clientHeight);return;
            $('.loader-section').css({'background-color' : '#000', 'height': this.height(), 'z-index' : '9999'}).find('.loader-'+loaderNumber).removeClass('item-hide');

        },

        close:function (loaderNumber) {

            $('.loader-section').css({'background-color' : '', 'z-index' : '0'}).find('.loader-'+loaderNumber).addClass('item-hide');

        }

    };

    exports('loader', obj);

});

