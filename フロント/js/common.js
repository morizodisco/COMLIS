$(function () {
    $('.menu-trigger').on('click', function () {
        if ($('.menu-trigger').hasClass('active')) {
            $('.menu-trigger').removeClass('active');
            $('nav').removeClass('open');
            $('.overlay').removeClass('open');
            $('body').css('overflow','auto');
        } else {
            $('.menu-trigger').addClass('active');
            $('nav').addClass('open');
            $('.overlay').addClass('open');
            $('body').css('overflow','hidden');
        }
    });
    $('.overlay').on('click', function () {
        if ($(this).hasClass('open')) {
            $(this).removeClass('open');
            $('.menu-trigger').removeClass('active');
            $('nav').removeClass('open');
            $('body').css('overflow','auto');
        }
    });
});

// 画像切り替え
(function () {
    $(document).on('click', '.matter li:not(.active) img', function (e) {
        var self = $(this);
        self.closest('.matter').find('.main_thumb img').attr('src', self.attr('src'));
        self.closest('ul').find('li').each(function (i, elem) {
            $(elem).removeClass('active');
        });
        self.closest('li').addClass('active');
    });
})();

// 評価ボタン
(function () {
    $(document).on('click', '.assessment_btn:not(.active)', function (e) {
        if ($(this).hasClass('good')) {
            $(this).closest('.evaluation').find('.assessment_btn.good').addClass('active');
            $(this).closest('.evaluation').find('.assessment_btn.bad').removeClass('active');
            $(this).closest('.evaluation').find('.evaluation_text.good').addClass('active');
            $(this).closest('.evaluation').find('.evaluation_text.bad').removeClass('active');
        } else {
            $(this).closest('.evaluation').find('.assessment_btn.good').removeClass('active');
            $(this).closest('.evaluation').find('.assessment_btn.bad').addClass('active');
            $(this).closest('.evaluation').find('.evaluation_text.good').removeClass('active');
            $(this).closest('.evaluation').find('.evaluation_text.bad').addClass('active');
        }
    });
})();

// もっと見るボタン
(function () {
    $(document).on('click', '.view_more', function (e) {
        var self = $(this);
        if (self.hasClass('close')) {
            self.removeClass('close');
            self.closest('.evaluation_text').find('.more').each(function (i, elem) {
                $(elem).removeClass('active');
            })
            $('.evaluation.view_type_1 .store').find('.store_link').removeClass('active');
        } else {
            self.addClass('close');
            self.closest('.evaluation_text').find('.more').each(function (i, elem) {
                $(elem).addClass('active');
            })
            $('.evaluation.view_type_1 .store').find('.store_link').addClass('active');
        }
    });
})();

// セレクトボックスのセンタリング
(function () {
    $(document).on('change', '.select', function (e) {
        var $this = $(this)
        var $option = $this.find('option:selected');
        $('.label').text($option.text());

        // onchange後にフォーカスしてるのが嫌な場合
        $this.blur();
    });

    $(function () {
        var $this = $('.select');
        var $option = $this.find('option:selected');
        $('.label').text($option.text());

        // onchange後にフォーカスしてるのが嫌な場合
        $this.blur();
    });
})();

// フッターのフェードアウト
(function () {
    $(function () {
        $('footer').find('.see').delay(5000).fadeOut(500);
    });
})();

// 上に戻るボタン
(function () {
    $(function() {
        var topBtn = $('#return');
        topBtn.delay(5500).fadeIn(0);

        //スクロールしてトップへ戻る
        topBtn.click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 500);
            return false;
        });
    });
})();

// 評価バーのアニメーション
(function () {
    new WOW().init();
})();

// クリックログ
(function () {
    $(document).on('click', 'a.access_count', function(e) {
        var product_id = $(this).attr('data-product_id');
        var ranking = $(this).attr('data-ranking');
        var genre_id = $(this).attr('data-genre_id');
        var request_uri = location.pathname + location.search;
        var referrer = document.referrer;
        $.ajax({
            type: 'GET',
            url: '/api/click_log_register/',
            data: {
                'product_id': product_id,
                'ranking': ranking,
                'genre_id': genre_id,
                'referrer': referrer,
                'request_uri': request_uri
            },
            dataType: 'json',
            timeout: 5000,
        })
            .done(function(data) {
                // 通信成功時の処理を記述
                //console.log(data);
            })
            .fail(function() {
                // 通信失敗時の処理を記述
                //console.log('fail');
            });
    });
})();

// アクセスログ
(function () {
    $(function () {
        $.ajax({
            type: 'GET',
            url: '/api/access_log_register/',
            dataType: 'json',
            timeout: 5000,
        })
            .done(function(data) {
                // 通信成功時の処理を記述
                //console.log(data);
            })
            .fail(function() {
                // 通信失敗時の処理を記述
                //console.log('fail');
            });
    });
})();

// 検索モーダル
(function () {
    $(document).on('click', '#search, .modal_close, .search_warp', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var target_elem = $('.search_warp');

        if (target_elem.hasClass('active')) {
            target_elem.removeClass('active');
            $('body').css('overflow','auto');
        } else {
            target_elem.addClass('active');
            $('body').css('overflow','hidden');
        }
    });

    $(document).on('click', '.form', function(e) {
        e.stopPropagation();
    });
})();