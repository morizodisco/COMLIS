<!--header始まり-->
<header>
    <div class="menu">
        <div class="logo">
            <a href="/">
                <div class="logo_mark"><img src="<?= $image_url($options['logo_mark']) ?>"></div>
                <div class="logo_type"><img src="<?= $image_url($options['logo_type']) ?>"></div>
            </a>
        </div>
        <div id="search"><div class="search_icon"></div><span>SEARCH</span></div>
        <div class="menu-trigger">
            <div class="span_menu">
                <span></span>
                <span></span>
                <span></span>
                <p>MENU</p>
            </div>
        </div>
        <nav>
            <div class="logo">
                <div class="logo_mark"><img src="<?= $image_url($options['logo_mark']) ?>"></div>
                <div class="logo_type"><img src="<?= $image_url($options['logo_type']) ?>"></div>
                <div class="menu-trigger">
                    <div class="span_menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>

            <div class="nav_content">
                <ul class="ranking">
                    <li class="top<?= (!$this->input->get('sort'))? ' active' : '' ?>">
                        <a href="/">総合ランキング</a>
                    </li>
                    <?php foreach (range(1, 5) AS $i) : ?>
                        <li class="<?= ( $this->input->get('sort') == 'ranking'.$i )? 'active' : '' ?>">
                            <a href="/?sort=ranking<?= $i ?>"><?= $options['ranking' . $i] ?>ランキング</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <ul class="link">
                    <?php foreach ($genres AS $genre) : ?>
                        <?php if (preg_match('{' . preg_quote($genre['domain']) . '}', site_url())) continue ?>
                        <li>
                            <a href="//<?= $genre['domain'] ?>"><?= $genre['site_name'] ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <ul class="info">
                    <li><a href="privacy">プライバシーポリシー</a></li>
                    <li><a href="mailto:info@<?= str_replace('www.', '', $_SERVER['HTTP_HOST']) ?>?subject=お問い合わせ">お問い合わせ</a></li>
                    <li><a href="mailto:info@<?= str_replace('www.', '', $_SERVER['HTTP_HOST']) ?>?subject=提携のご依頼">提携のご依頼</a></li>
                </ul>

                <?php if (!empty($options['company'])) : ?>
                    <dl>
                        <dt>運営会社</dt>
                        <dd><?= $options['company'] ?></dd>
                    </dl>
                <?php endif; ?>

                <?php if (!empty($options['address'])) : ?>
                    <dl>
                        <dt>本店所在地</dt>
                        <dd><?= $options['address'] ?></dd>
                    </dl>
                <?php endif; ?>

                <?php if (!empty($options['service'])) : ?>
                    <dl>
                        <dt>サービス内容</dt>
                        <dd><?= $options['service'] ?></dd>
                    </dl>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>
<!--header終わり-->
