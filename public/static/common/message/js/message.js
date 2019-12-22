layui.define(['jquery'], function (exports) {

    let $ = layui.$;

    let obj = {

        show: function (options) {

            let defaults = {
                message: ' 操作成功',
                time: '1000',
                type: 'success',
                showClose: false,
                autoClose: true,
                onClose: function () {
                }
            };

            if (typeof options === 'string') {
                defaults.message = options;
            }
            if (typeof options === 'object') {
                defaults = $.extend({}, defaults, options);
            }
            //template-show-message模版
            let templateClose = defaults.showClose ? '<a class="template-show-message--close">×</a>' : '';
            let template = '<div class="template-show-message messageFadeInDown">' +
                '<i class="template-show-message--icon template-show-message--' + defaults.type + '"></i>' +
                templateClose +
                '<div class="template-show-message--tip">' + defaults.message + '</div>' +
                '</div>';
            let _this = this;
            let $body = $('body');
            let $message = $(template);
            let timer;
            let closeFn, removeFn;
            //关闭
            closeFn = function () {
                $message.addClass('messageFadeOutUp');
                $message.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                    removeFn();
                })
            };
            //移除
            removeFn = function () {
                $message.remove();
                defaults.onClose(defaults);
                clearTimeout(timer);
            };
            //移除所有
            $('.template-show-message').remove();
            $body.append($message);
            //居中
            $message.css({
                'margin-left': '-' + $message.width() / 2 + 'px'
            });
            //去除动画类
            $message.one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
                $message.removeClass('messageFadeInDown');
            });
            //点击关闭
            $body.on('click', '.template-show-message--close', function (e) {
                closeFn();
            });
            //自动关闭
            if (defaults.autoClose) {
                timer = setTimeout(function () {
                    closeFn();
                }, defaults.time)
            }
        }

    };

    layui.link(ROOT_COMMON_URL + 'message/css/message.css');

    exports('message', obj);

});

