<div id="content_wrap">
    <div class="top_image">
        <?php if (!empty($options['top_image'])) : ?>
            <img src="<?= $image_url($options['top_image']) ?>">
        <?php endif; ?>
    </div>

    <div class="top_text">
        <div class="logo_mark"><img src="<?= $image_url($options['logo_mark']) ?>"></div>
        <div class="comment">最新!</div>
        <div class="logo_type"><img src="<?= $image_url($options['logo_type']) ?>"></div>
        <p>
            <span class="year"><?= date('Y') ?>年</span>
            <span class="special"><?= date('Y') ?>年 <?= $media['media_name'] ?> スペシャル特集</span><br>
            <?= $options['site_name'] ?></p>
        <h3><?= $options['site_catchcopy'] ?></h3>
    </div>

    <div class="content_list">
        <div class="logo">
            <img src="<?= $image_url($options['logo_mark']) ?>">
        </div>
        <h2><span>5つの項目で徹底リサーチ</span></h2>
        <p><?= date('Y年m月d日') ?>更新</p>
        <div class="shadow">
            <img src="/images/light.png">
        </div>
        <ul>
            <?php foreach (range(1, 5) AS $i) : ?>
                <li><p><?= $options['ranking' . $i] ?></p></li>
            <?php endforeach; ?>
        </ul>

        <?php if (!empty($options['ranking_bnr']) && !$this->input->get('action')) : ?>
            <div class="bnr">
                <img src="<?= $image_url($options['ranking_bnr']) ?>">
            </div>
        <?php elseif ($this->input->get('action')) : ?>
            <div class="search_result">
                <div class="search_header">
                    <p>検索結果<span>( <?= count($items) ?>件 )</span></p>
                </div>
                <div class="search_keywords">
                    <?php foreach (range(1, 5) AS $i) : ?>
                        <?= (!empty($this->input->get('ranking' . $i))) ? '<span>' . $options['ranking' . $i] . 'が星' . $this->input->get('ranking' . $i) . '以上</span>' : '' ?>
                    <?php endforeach; ?>

                    <?= (!empty($this->input->get('keywords'))) ? '<span>' . $this->input->get('keywords') . '</span>' : '' ?>

                    <?php if (!empty($this->input->get('sort2'))) : ?>
                        <?= ($this->input->get('sort2') == 'items.id') ? '<span>新着順
                    </span>' : '' ?>
                        <?= ($this->input->get('sort2') == 'total_ranking') ? '<span>総合評価順
                    </span>' : '' ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="list_btn">
            <div class="btn-select">
                <form method="get">
                    <p class="label">総合ランキング</p>
                    <select name="sort" class='select' onchange="submit(this.form)">
                        <option value="">総合ランキング</option>
                        <?php foreach (range(1, 5) AS $i) : ?>
                            <option value="ranking<?= $i ?>"
                                <?= 'ranking' . $i == $this->input->get('sort') ? ' selected' : '' ?>><?= $options['ranking' . $i] ?>
                                ランキング
                            </option>
                        <?php endforeach; ?>
                    </select>
                    </label>
                </form>
            </div>
        </div>
    </div>

    <div class="content_ranking">
        <?php $rank = 1;
        foreach ($items AS $data) : ?>
            <div class="ranking_wrap ranking<?= $rank ?>">
                <div class="product_header">
                    <div class="crown_image">
                        <img src="<?= $image_url($options['ranking' . (in_array($rank, [1, 2, 3]) ? $rank : '_default') . '_icon']) ?>">
                        <p>第<?= $rank ?>位</p>
                    </div>

                    <h2><?= $data['item_name'] ?></h2>

                    <div class="total_ranking">
                        <p class="num"><?= number_format(($data['total_ranking'] / 5), 1) ?></p>
                        <p class="star"><?= $genStarFloat(($data['total_ranking'] / 5)) ?></p>
                    </div>
                </div>

                <div class="matter">
                    <div class="product_image">
                        <?php if (empty($data['image_path2']) && empty($data['image_path3']) && empty($data['image_path4'])): ?>
                            <div class="main_thumb only">
                                <?php if (!empty($data['image_path1'])) : ?>
                                    <img src="<?= $image_url($data['image_path1']) ?>">
                                <?php endif; ?>
                            </div>
                        <?php else : ?>
                            <div class="main_thumb">
                                <?php if (!empty($data['image_path1'])) : ?>
                                    <img src="<?= $image_url($data['image_path1']) ?>">
                                <?php endif; ?>
                            </div>
                            <ul>
                                <?php foreach (range(1, 4) AS $i) : ?>
                                    <?php if (!empty($data['image_path' . $i])) : ?>
                                        <li<?= ($i === 1) ? ' class="active"' : '' ?>><img
                                                    src="<?= $image_url($data['image_path' . $i]) ?>"></li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <div class="clear"></div>
                    <p><?= $data['description'] ?></p>
                    <div class="point">
                        <h2>おすすめポイント</h2>
                        <ul>
                            <li>
                                <img src="<?= $image_url($options['point_icon']) ?>">
                                <span>1</span>
                                <p><?= $data['point1'] ?></p>
                            </li>

                            <li>
                                <img src="<?= $image_url($options['point_icon']) ?>">
                                <span>2</span>
                                <p><?= $data['point2'] ?></p>
                            </li>

                            <li>
                                <img src="<?= $image_url($options['point_icon']) ?>">
                                <span>3</span>
                                <p><?= $data['point3'] ?></p>
                            </li>
                        </ul>
                    </div>
                    <div class="graph">
                        <table>
                            <?php foreach (range(1, 5) AS $i) : ?>
                                <tr>
                                    <td class="name"><?= $options['ranking' . $i] ?></td>
                                    <td class="bar">
                                        <div class="progress"><span
                                                    class="ranking<?= $data['ranking' . $i] ?> wow slideInLeft"></span>
                                        </div>
                                    </td>
                                    <td><?= number_format($data['ranking' . $i], 1) ?>点</td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <?php if (!empty($data['campaign'])) : ?>
                        <div class="campaign">
                            <h2>キャンペーン情報</h2>
                            <p><?= $data['campaign'] ?></p>
                            <?php if ($options['campaign_btn_view_type'] == 1) : ?>
                                <div class="special">
                                    <div class="special_btn">
                                        <a href="<?= $data['official_link'] ?>" target="_blank" class="access_count"
                                           data-product_id="<?= $data['id'] ?>" data-ranking="<?= $rank ?>"
                                           data-genre_id="<?= $options['id'] ?>"
                                           onclick="return gtag_report_conversion('<?= $data['official_link'] ?>');"><?= (!empty($data['btn_text'])) ? $data['btn_text'] : 'キャンペーン情報を見る' ?></a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($options['comment_view_type'] == 0) : ?>
                        <div class='evaluation view_type_<?= $options['comment_view_type'] ?>'>
                            <div class="assessment_btn good active">
                                <img src="/images/like.png">
                                <span>良い評価</span>
                            </div>
                            <div class="assessment_btn bad">
                                <img src="/images/bad.png">
                                <span>悪い評価</span>
                            </div>

                            <div class="evaluation_text good active">
                                <?php if (!empty($good_comments[$data['id']])) : ?>
                                    <?php $j = 1;
                                    foreach ($good_comments[$data['id']] AS $comment) : ?>
                                        <div class="list_wrap<?= ($j >= 3) ? ' more' : '' ?>">
                                            <div class="user">
                                                <img src="/images/<?= $comment['image_name'] ?>.png">
                                            </div>
                                            <div class="info">
                                                <h3><?= $comment['user_info'] ?></h3>
                                                <p class="star"><?= $genStarFloat($comment['assessment']) ?></p>
                                                <!--<p class="one"><? /*= $genStar($comment['assessment']) */ ?></p>-->
                                                <p class="two">( <?= number_format($comment['assessment'], 1) ?> )</p>
                                            </div>
                                            <p><?= $comment['comment'] ?></p>
                                        </div>
                                        <?php $j++; endforeach; ?>
                                <?php endif; ?>

                                <div class="info_list view_more">
                                    <p><span></span></p>
                                </div>
                            </div>

                            <div class="evaluation_text bad">
                                <?php if (!empty($bad_comments[$data['id']])) : ?>
                                    <?php $j = 1;
                                    foreach ($bad_comments[$data['id']] AS $comment) : ?>
                                        <div class="list_wrap<?= ($j >= 3) ? ' more' : '' ?>">
                                            <div class="user">
                                                <img src="/images/<?= $comment['image_name'] ?>.png">
                                            </div>
                                            <div class="info">
                                                <h3><?= $comment['user_info'] ?></h3>
                                                <p class="star"><?= $genStarFloat($comment['assessment']) ?></p>
                                                <!--<p class="one"><? /*= $genStar($comment['assessment']) */ ?></p>-->
                                                <p class="two">( <?= number_format($comment['assessment'], 1) ?> )</p>
                                            </div>
                                            <p><?= $comment['comment'] ?></p>
                                        </div>
                                        <?php $j++; endforeach; ?>
                                <?php endif; ?>

                                <div class="info_list view_more">
                                    <p><span></span></p>
                                </div>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class='evaluation view_type_<?= $options['comment_view_type'] ?>'>
                            <div class="evaluation_text good active">
                                <?php if (!empty($all_comments[$data['id']])) : ?>
                                    <?php $j = 1;
                                    foreach ($all_comments[$data['id']] AS $comment) : ?>
                                        <div class="list_wrap<?= ($j >= 1) ? ' more' : '' ?>">
                                            <div class="user">
                                                <img src="/images/<?= $comment['image_name'] ?>.png">
                                            </div>
                                            <div class="info">
                                                <h3><?= $comment['user_info'] ?></h3>
                                                <p class="star"><?= $genStarFloat($comment['assessment']) ?></p>
                                                <!--<p class="one"><? /*= $genStar($comment['assessment']) */ ?></p>-->
                                                <p class="two">( <?= number_format($comment['assessment'], 1) ?> )</p>
                                            </div>
                                            <p><?= $comment['comment'] ?></p>
                                        </div>
                                        <?php $j++; endforeach; ?>
                                <?php endif; ?>

                                <div class="info_list view_more">
                                    <p><span></span></p>
                                </div>

                                <div class="store">
                                    <div class="special">
                                        <div class="special_btn">
                                            <a href="<?= $data['official_link'] ?>" target="_blank" class="access_count"
                                               data-product_id="<?= $data['id'] ?>" data-ranking="<?= $rank ?>"
                                               data-genre_id="<?= $options['id'] ?>"
                                               onclick="return gtag_report_conversion('<?= $data['official_link'] ?>');"><?= (!empty($data['btn_text'])) ? $data['btn_text'] : '詳細はこちら' ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($options['comment_view_type'] == 0) : ?>
                        <div class="store">
                            <div class="special">
                                <div class="special_btn">
                                    <a href="<?= $data['official_link'] ?>" target="_blank" class="access_count"
                                       data-product_id="<?= $data['id'] ?>" data-ranking="<?= $rank ?>"
                                       data-genre_id="<?= $options['id'] ?>"
                                       onclick="return gtag_report_conversion('<?= $data['official_link'] ?>');"><?= (!empty($data['btn_text'])) ? $data['btn_text'] : '詳細はこちら' ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php $rank++; endforeach; ?>

    </div>

    <div class="store_link_wrap">
        <p>
            <span>クチコミ引用元：</span><a href="https://shopping.yahoo.co.jp/" target="_blank">YAHOO</a><span> / </span><a
                    href="https://www.amazon.co.jp/" target="_blank">AMAZON</a><span> / </span><a
                    href="https://www.rakuten.co.jp/" target="_blank">RAKUTEN</a>
        </p>
    </div>

    <div class="search_warp">
        <div class="modal_close"><span></span></div>
        <div class="form">
            <form method="get">
                <?php foreach (range(1, 5) AS $i) : ?>
                    <select name="ranking<?= $i ?>">
                        <option value=""><?= $options['ranking' . $i] ?></option>
                        <?php foreach (range(5, 1) AS $j) : ?>
                            <option value="<?= $j ?>"<?= $this->input->get('ranking' . $i) == $j ? ' selected' : '' ?>>
                                星<?= $j ?>以上
                            </option>
                        <?php endforeach; ?>
                    </select>
                <?php endforeach; ?>
                <select name="sort2">
                    <option value="">並び替え</option>
                    <option value="items.id"<?= $this->input->get('sort2') == 'items.id' ? ' selected' : '' ?>>新着順
                    </option>
                    <option value="total_ranking"<?= $this->input->get('sort2') == 'total_ranking' ? ' selected' : '' ?>>
                        総合評価順
                    </option>
                </select>
                <input type="text" name="keywords" placeholder="キーワードを入力してください"
                       value="<?= $this->input->get('keywords') ?>"/>
                <input type="hidden" name="sort" value="<?= $this->input->get('sort') ?>"/>
                <button type="submit" name="action" value="search">検索</button>
            </form>
        </div>
    </div>
</div>