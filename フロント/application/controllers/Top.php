<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Top extends MY_Controller
{

    public function index()
    {
        $where = [];
        //$where['status_flag'] = 1;
        $where['domain'] = str_replace('www.', '', $_SERVER['HTTP_HOST']);
        $genre = $this->db->where('deleted_at IS NULL', NULL, false)->where($where)->order_by('created_at', 'desc')->get('genres')->row_array();
        $genre_id = $genre['id'] ?? 0;

        $where = [];
        $where['status_flag'] = 1;
        $where['genre_id'] = $genre_id;

        // ランキング評価検索
        foreach (range(1, 5) AS $i) {
            if ($this->input->get('ranking' . $i)) $where['ranking' . $i . ' >='] = $this->input->get('ranking' . $i);
        }

        // ソート
        $order = (!empty($this->input->get('sort'))) ? $this->input->get('sort') : 'total_ranking';
        if (!empty($this->input->get('sort2'))) {
            $_GET['sort'] = NULL;
            $order = $this->input->get('sort2');
        }

        $query = $this->db->select('items.*, (ranking1 + ranking2 + ranking3 + ranking4 + ranking5) AS total_ranking')->where($where)->where('deleted_at IS NULL', NULL, false)->order_by($order, 'desc');

        // キーワード検索
        if ($this->input->get('keywords')) {
            $this->db
                ->group_start()
                    ->like('item_name', $this->input->get('keywords'))
                    ->or_like('description', $this->input->get('keywords'))
                ->group_end();
        }

        // メインデータ抽出
        $items = $query->get('items')->result_array();

        $comments = $this->db->join('sites', 'comments.site_id = sites.id')->where('deleted_at IS NULL', NULL, false)->order_by('display_number asc, created_at desc')->get('comments')->result_array();

        $all_comments = [];
        $good_comments = [];
        $bad_comments = [];
        foreach ($comments AS $val) {
            $all_comments[$val['item_id']][] = $val;
            if ($val['good_comment_flag'] == 1) $good_comments[$val['item_id']][] = $val;
            else $bad_comments[$val['item_id']][] = $val;
        }

        $this->show_view([$this->_view_prefix . 'top'], [
            'items' => $items,
            'all_comments' => $all_comments,
            'good_comments' => $good_comments,
            'bad_comments' => $bad_comments,
        ]);
    }

}